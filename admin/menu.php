<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$menu = array(
    array(
        'parent_menu' => 'global_menu_content', // местов глабальном меню
        'sort' => 400, //сортировка
        'text' => Loc::getMessage('DAV_MODULE_MENU_TEXT'), //описание из файла локализации
        'title' => Loc::getMessage('DAV_MODULE_TITLE'), //название из файла локализации
        'url' => 'custom_module_list.php', //ссылка на страницу из меню
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
