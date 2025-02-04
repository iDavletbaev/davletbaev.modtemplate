<?php

if (is_dir($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/custom.module/")) {
    require_once(
        $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/custom.module/admin/custom_module_list.php"
    );
}

if (is_dir($_SERVER["DOCUMENT_ROOT"] . "/local/modules/custom.module/")) {
    require_once(
        $_SERVER["DOCUMENT_ROOT"] . "/local/modules/custom.module/admin/custom_module_list.php"
    );
}
