<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Ibc\Modal\ProductsTable;
use Ibc\Modal\BarcodeTable;
Loader::includeModule("ibc.modal");
Loader::includeModule("iblock");
Loader::includeModule("catalog");
Loader::includeModule("sale");
$arResult = [];
switch ($_REQUEST["ajaxMethod"])
{
    case 'getBarcode':

        $product = ProductsTable::getList([
            'select' => ['*', 'barcode'],
            'filter' => ['id' => $_REQUEST['id'],'price' => $_REQUEST['price']]
        ])->fetch();

        if ($product){
            $arResult['status'] = 1;
            $arResult['ITEMS'][] = $product;
            $arResult['BarCode'] = $product['IBC_MODAL_PRODUCTS_barcode_code'];
        }else{
            $arResult['status'] = 0;
            $arResult['BarCode'] = 'none';
            $arResult['Msg'] = 'Продукт не найден';
        }


        break;
    case 'updateBarcode':

        $newBarCode = $_REQUEST['newBarCode'];
        $newBarCode = str_replace('a', "@", $newBarCode);

        $product = ProductsTable::getList([
            'select' => ['*', 'barcode'],
            'filter' => ['barcode.code' => $_REQUEST['oldBarCode']]
        ])->fetch();

        if ($product){
            $barcode = BarcodeTable::update($product['barcode_id'], [
                'code' => $newBarCode
            ]);

            if ($barcode){
                $arResult['status'] = 1;
                $arResult['BarCode'] = $newBarCode;
                $arResult['Msg'] = 'Штрихкод изменен';
            }else{
                $arResult['status'] = 0;
                $arResult['BarCode'] = 'none';
                $arResult['Msg'] = 'Штрихкод не найден';
            }
        }else{
            $arResult['status'] = 0;
            $arResult['BarCode'] = 'none';
            $arResult['Msg'] = 'Продукт не найден';
        }

        break;

}



$arResult['params'] = $_REQUEST;
echo json_encode($arResult);
?>