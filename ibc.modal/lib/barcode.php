<?php

namespace Ibc\Modal;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class BarcodeTable extends DataManager
{
    public static function getTableName()
    {
        return 'ibc_barcode';
    }

    public static function getMap()
    {
        return array(
            new IntegerField('id', array(
                'autocomplete' => true,
                'primary' => true,
                'title' => 'id',
            )),
            new StringField('code', array(
                'required' => false,
                'title' => 'Код',
            )),
            new StringField('description', array(
                'required' => false,
                'title' => 'Описание',
            )),
        );
    }
}
