<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin.php");

use Bitrix\Main\Grid\Options as GridOptions;
use Bitrix\Main\Loader;
use Bitrix\Main\UI\PageNavigation;
use DavletbaevModule\RecordTable;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/** @var $APPLICATION CMain */

$APPLICATION->SetTitle(Loc::getMessage('DAV_MODULE_LIST_TITLE'));

try {
    Loader::includeModule("davletbaev.modtemplate");
} catch (\Bitrix\Main\LoaderException $e) {
}
$list_id = 'example_list';

$grid_options = new GridOptions($list_id);
$sort = $grid_options->GetSorting(['sort' => ['ID' => 'DESC'], 'vars' => ['by' => 'by', 'order' => 'order']]);
$nav_params = $grid_options->GetNavParams();

$nav = new PageNavigation('request_list');
$nav->allowAllRecords(true)
    ->setPageSize($nav_params['nPageSize'])
    ->initFromUri();

$filterOption = new Bitrix\Main\UI\Filter\Options($list_id);
$filterData = $filterOption->getFilter([]);
$filter = [];

$ui_filter = [
    ['id' => 'NAME', 'name' => 'Название', 'type' => 'text', 'default' => true],
    ['id' => 'CREATED_AT', 'name' => 'Дата создания', 'type' => 'date',],
    ['id' => 'ID', 'name' => 'ид', 'type' => 'number', 'default' => true],
];

foreach ($filterData as $k => $v) {
    if ($filterData['FIND']) {
        // Поле поиска
        $filter['NAME'] = "%" . $filterData['FIND'] . "%";
    } else {
        // Нормализация параметров фильтра для его корректной работы
        $filter = \Bitrix\Main\UI\Filter\Type::getLogicFilter($filterData, $ui_filter);
    }
}

$res = RecordTable::getList([
    'filter' => $filter,
    'select' => [
        "*",
    ],
    'offset' => $nav->getOffset(),
    'limit' => $nav->getLimit(),
    'order' => $sort['sort'],
    'count_total' => true,
]);
$nav->setRecordCount($res->getCount());
?>
    <div class="adm-toolbar-panel">
        <a href="custom_module_edit.php" class="ui-btn ui-btn-primary">
            <?= Loc::getMessage('DAV_MODULE_LIST_ADD_BTN'); ?>
        </a>
    </div>
    <div>
        <?php $APPLICATION->IncludeComponent('bitrix:main.ui.filter', '', [
            'FILTER_ID' => $list_id,
            'GRID_ID' => $list_id,
            'FILTER' => $ui_filter,
            'ENABLE_LIVE_SEARCH' => true,
            'ENABLE_LABEL' => true
        ]); ?>
    </div>
<?php
$columns = array();
$columns[] = ['id' => 'ID', 'name' => 'ID', 'sort' => 'ID', 'default' => true];
$columns[] = ['id' => 'NAME', 'name' => 'Название', 'sort' => 'NAME', 'default' => true];
$columns[] = ['id' => 'CREATED_AT', 'name' => 'Создано', 'sort' => 'CREATED_AT', 'default' => true];

$list = array();
foreach ($res->fetchAll() as $row) {
    $list[] = [
        'data' => [
            "ID" => $row['ID'],
            "NAME" => $row['NAME'],
            "CREATED_AT" => $row['CREATED_AT'],
        ],
        "actions" => [
            [
                "text" => "Редактировать",
                "onclick" => "BX.SidePanel.Instance.open('custom_module_edit.php?ID={$row['ID']}');"
            ],
            [
                "text" => "Удалить",
                "onclick" => "if(confirm('Удалить запись?')) location.href='?delete={$row['ID']}'"
            ]
        ]
    ];
}
$APPLICATION->IncludeComponent(
    'bitrix:main.ui.grid',
    '',
    [
        'GRID_ID' => $list_id,
        'COLUMNS' => $columns,
        'ROWS' => $list,
        'SHOW_ROW_CHECKBOXES' => false,
        'NAV_OBJECT' => $nav,
        'AJAX_MODE' => 'Y',
        'AJAX_ID' => \CAjax::getComponentID(
            'bitrix:main.ui.grid',
            '.default',
            ''
        ),
        'PAGE_SIZES' => [
            ['NAME' => '5', 'VALUE' => '5'],
            ['NAME' => '20', 'VALUE' => '20'],
            ['NAME' => '50', 'VALUE' => '50'],
            ['NAME' => '100', 'VALUE' => '100']
        ],
        'AJAX_OPTION_JUMP' => 'N',
        'SHOW_CHECK_ALL_CHECKBOXES' => false,
        'SHOW_ROW_ACTIONS_MENU' => true,
        'SHOW_GRID_SETTINGS_MENU' => true,
        'SHOW_NAVIGATION_PANEL' => true,
        'SHOW_PAGINATION' => true,
        'SHOW_SELECTED_COUNTER' => true,
        'SHOW_TOTAL_COUNTER' => true,
        'SHOW_PAGESIZE' => true,
        'SHOW_ACTION_PANEL' => true,
        'ALLOW_COLUMNS_SORT' => true,
        'ALLOW_COLUMNS_RESIZE' => true,
        'ALLOW_HORIZONTAL_SCROLL' => true,
        'ALLOW_SORT' => true,
        'ALLOW_PIN_HEADER' => true,
        'AJAX_OPTION_HISTORY' => 'N',
    ]
);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
