<?php
use Bitrix\Main\Loader;

Loader::includeModule("custom.module");
Bitrix\Main\Loader::registerAutoloadClasses(
    "davletbaev.modtemplate",
    array(
        "DavletbaevModule\\RecordTable" => "lib/recordtable.php",
    )
);
