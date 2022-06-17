<?php
use Bitrix\Main\Application;
use Bitrix\Main\Loader;

use Ibc\Modal\ProductsTable;
use Ibc\Modal\BarcodeTable;


class Modalwindow extends \CBitrixComponent {

	public function executeComponent()
	{
		CJSCore::Init(["jquery3"]);
        Loader::includeModule("ibc.modal");
		$page = 'main';

		$this->includeComponentTemplate($page);
		
	}

}