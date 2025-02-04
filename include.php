<?php
use Bitrix\Main\Loader;

Loader::includeModule("custom.module");
Bitrix\Main\Loader::registerAutoloadClasses(
    "custom.module",
    array(
        "CustomModule\\RecordTable" => "lib/recordtable.php",
    )
);
