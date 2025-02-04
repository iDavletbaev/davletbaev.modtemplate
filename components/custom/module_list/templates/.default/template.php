<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
};
/** @var array $arResult */
?>

<ul class="custom-module-list">
    <?php foreach ($arResult["ITEMS"] as $item): ?>
        <li><?= htmlspecialchars($item["NAME"]) ?> (ID: <?= $item["ID"] ?>)</li>
    <?php endforeach; ?>
</ul>
