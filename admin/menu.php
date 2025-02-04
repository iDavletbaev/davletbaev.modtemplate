<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$menu = array(
    array(
        'parent_menu' => 'global_menu_content',//определяем место меню, в данном случае оно находится в главном меню
        'sort' => 400,//сортировка, в каком месте будет находиться наш пункт
        'text' => 'Custom module text',//описание из файла локализации
        'title' => 'Custom module title',//название из файла локализации
        'url' => 'custom_module_list.php',//ссылка на страницу из меню
        'items_id' => 'menu_references',
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
