<?php

namespace CustomModule;

use Bitrix\Main\Entity;
use Bitrix\Main\Type;

class RecordTable extends Entity\DataManager
{
    public static function getTableName(): string
    {
        return 'custom_table';
    }

    public static function getMap(): array
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true
            ]),
            new Entity\StringField('NAME', [
                'required' => true
            ]),
            new Entity\DatetimeField('CREATED_AT', [
                'default_value' => function () {
                    return new Type\DateTime();
                }
            ]),
        ];
    }
}
