<?php

use Bitrix\Main\Application;
use Bitrix\Main\Entity\Base;
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use CustomModule\RecordTable;

class davletbaev_modtemplate extends CModule
{
    public function __construct()
    {
        $this->MODULE_ID = "davletbaev.modtemplate";
        $this->MODULE_NAME = "Мой модуль";
        $this->MODULE_DESCRIPTION = "Описание модуля";
        $this->PARTNER_NAME = "Компания";
        $this->PARTNER_URI = "https://example.com";
        $this->MODULE_VERSION = "1.0.0";
        $this->MODULE_VERSION_DATE = "2025-01-30";
    }

    public function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->installDB();
        $this->installAdminFiles();
        $this->installEvents();
        $this->installFiles();
    }

    public function installEvents()
    {
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler(
            "main",
            "OnBeforeUserLogin",
            $this->MODULE_ID,
            "CustomModuleHandler",
            "onBeforeUserLogin"
        );
    }

    public function installFiles()
    {
        CopyDirFiles(
            __DIR__ . "/admin",
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin/",
            true, // перезаписывает файлы
            true  // копирует рекурсивно
        );
    }

    public function installDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            RecordTable::getEntity()->createDbTable();
        }
    }

    public function installAdminFiles()
    {
        CopyDirFiles(
            __DIR__ . "/../admin",
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin",
            true,
            true
        );
    }

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
        DeleteDirFiles(
            __DIR__ . "/admin",
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin/"
        );
    }

    public function uninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            if (Application::getConnection()->isTableExists(RecordTable::getTableName())) {
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
