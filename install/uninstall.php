<?php

use Bitrix\Main\Application;
use Bitrix\Main\ModuleManager;
use CustomModule\RecordTable;

class custom_module extends CModule
{
    public function DoUninstall()
    {
        $this->uninstallDB();
        $this->uninstallAdminFiles();
        $this->uninstallEvents();
        $this->uninstallFiles();
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function uninstallEvents()
    {
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler(
            "main",
            "OnBeforeUserLogin",
            $this->MODULE_ID,
            "CustomModuleHandler",
            "onBeforeUserLogin"
        );
    }

    public function uninstallFiles()
    {
        DeleteDirFilesEx("/bitrix/components/custom/module_list");
    }

    public function uninstallDB()
    {
        /*$connection = Application::getConnection();
        $connection->dropTable(RecordTable::getTableName());*/
        if (Loader::includeModule($this->MODULE_ID)) {
            if (Application::getConnection()->isTableExists(AnydbTable::getTableName())) {
                $connection = Application::getInstance()->getConnection();
                $connection->dropTable(RecordTable::getTableName());
            }
        }
    }

    public function uninstallAdminFiles()
    {
        DeleteDirFiles(
            __DIR__ . "/../admin",
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin"
        );
    }
}

