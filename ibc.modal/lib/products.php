<?php

namespace Ibc\Modal;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class ProductsTable extends DataManager
{
    public static function getTableName()
    {
        return 'ibc_products';
    }

    public static function getMap()
    {
        return array(
            new IntegerField('id', array(
                'autocomplete' => true,
                'primary' => true,
                'title' => 'Id',
            )),
            new StringField('name', array(
                'required' => true,
                'title' => 'Название продукта',
                'validation' => function () {
                    return array(
                        new Validator\Length(null, 255),
                    );
                },
            )),
            new StringField('price', array(
                'required' => false,
                'title' => 'Цена',
            )),
            new IntegerField('barcode_id', [
                'column_name' => 'barcode_id',
            ]),

            new \Bitrix\Main\ORM\Fields\Relations\Reference("barcode", "Ibc\Modal\BarcodeTable", [
                "=this.barcode_id" => "ref.id"
            ]),

        );
    }
}
