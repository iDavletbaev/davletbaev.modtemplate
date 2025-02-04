<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin.php");

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use CustomModule\RecordTable;

Loader::includeModule("custom.module");

$connection = Application::getConnection();
$ID = intval($_GET["ID"]);
$record = ["ID" => "", "NAME" => ""];

if ($ID > 0) {
    $record = RecordTable::getById($ID)->fetch();
}

if ($_POST["save"] && check_bitrix_sessid()) {
    $data = ["NAME" => $_POST["NAME"]];

    if ($ID > 0) {
        RecordTable::update($ID, $data);
    } else {
        RecordTable::add($data);
    }

    //    LocalRedirect("/bitrix/admin/custom_module_list.php");
    LocalRedirect(
        "/bitrix/admin/custom_module_list.php?lang=" . LANGUAGE_ID . GetFilterParams(
            "filter_",
            false
        )
    );
}

?>
    <form method="post">
        <?= bitrix_sessid_post() ?>
        <div class="ui-form">
            <div class="ui-form-row">
                <div class="ui-form-label">Название:</div>
                <div class="ui-form-input">
                    <input type="text" autofocus name="NAME" value="<?= htmlspecialchars($record["NAME"]) ?>" required>
                </div>
            </div>
        </div>
        <br>
        <input type="submit" name="save" value="Сохранить" class="ui-btn ui-btn-success">
        <a href="custom_module_list.php" class="ui-btn ui-btn-light-border">Отмена</a>
    </form>

<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
