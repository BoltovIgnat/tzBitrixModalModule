<?php

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Ibc\Modal\ProductsTable;
use Ibc\Modal\BarcodeTable;

Loc::loadMessages(__FILE__);

class ibc_modal extends CModule
{
    public function __construct()
    {
        $arModuleVersion = array();
        
        include __DIR__ . '/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }
        
        $this->MODULE_ID = 'ibc.modal';
        $this->MODULE_NAME = 'Модуль модального окна Clever';
        $this->MODULE_DESCRIPTION =  'Модального окно';
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = 'ibc';
        $this->PARTNER_URI = 'ibc';
    }

    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->installDB();
        AddMessage2Log(__DIR__."/components", "ibc");
        AddMessage2Log($_SERVER["DOCUMENT_ROOT"]."/local/components/ibc", "ibc");

        copyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/local/modules/ibc.modal/components', $_SERVER['DOCUMENT_ROOT'] . '/local/components/ibc', true, true);
        copyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/local/modules/ibc.modal/pages', $_SERVER["DOCUMENT_ROOT"], true, true);
        copyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/local/modules/ibc.modal/ajax', $_SERVER["DOCUMENT_ROOT"] . '/ajax', true, true);
    }

    public function doUninstall()
    {
        $this->uninstallDB();
        DeleteDirFilesEx("/local/components/ibc");
        DeleteDirFilesEx("/ajax/modalwindow");
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function installDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            ProductsTable::getEntity()->createDbTable();
            BarcodeTable::getEntity()->createDbTable();

            $barcode = BarcodeTable::createObject();
            $barcode->setCode('7501370');
            $barcode->setDescription('88');
            $barcode->save();

            $product = ProductsTable::createObject();
            $product->setName('43');
            $product->setPrice('88');
            $product->setBarcodeId($barcode->getId());
            $product->save();
        }
    }

    public function uninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            $connection = Application::getInstance()->getConnection();
            $connection->dropTable(ProductsTable::getTableName());
            $connection->dropTable(BarcodeTable::getTableName());
        }
    }
}
