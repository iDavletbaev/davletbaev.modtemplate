<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$menu = array(
    array(
        'parent_menu' => 'global_menu_content', // местов глабальном меню
        'sort' => 400, //сортировка
        'text' => Loc::getMessage('DAV_MODULE_MENU_TEXT'), // Название в меню
        'title' => Loc::getMessage('DAV_MODULE_TITLE'), // Заголовок страницы
        "icon" => "util_menu_icon",
        'url' => 'davletbaev_module_list.php',
        'items_id' => 'menu_references',
        // вложенные пункты меню при необходимости
        /*'items' => array(
            array(
                'text' => Loc::getMessage('MYMODULE_SUBMENU_TITLE'),
                'url' => 'mymodule_index.php?lang=' . LANGUAGE_ID,
                'more_url' => array('mymodule_index.php?lang=' . LANGUAGE_ID),
                'title' => Loc::getMessage('MYMODULE_SUBMENU_TITLE'),
            ),
        ),*/
    ),
);

return $menu;
