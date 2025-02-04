<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use CustomModule\RecordTable;

Loader::includeModule('custom.module');

$arResult["ITEMS"] = RecordTable::getList([
    'order' => ['ID' => 'DESC']
])->fetchAll();

$this->includeComponentTemplate();
