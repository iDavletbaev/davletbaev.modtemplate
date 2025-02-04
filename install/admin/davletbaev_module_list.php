<?php

if (is_dir($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/davletbaev.modtemplate/")) {
    require_once(
        $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/davletbaev.modtemplate/admin/davletbaev_module_list.php"
    );
}

if (is_dir($_SERVER["DOCUMENT_ROOT"] . "/local/modules/davletbaev.modtemplate/")) {
    require_once(
        $_SERVER["DOCUMENT_ROOT"] . "/local/modules/davletbaev.modtemplate/admin/davletbaev_module_list.php"
    );
}
