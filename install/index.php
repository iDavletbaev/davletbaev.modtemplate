<?php

use Bitrix\Main\Application;
use Bitrix\Main\Entity\Base;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use DavletbaevModule\RecordTable;

class davletbaev_modtemplate extends CModule
{
    public function __construct()
    {
        $this->MODULE_ID = "davletbaev.modtemplate";
        $this->MODULE_NAME = Loc::getMessage('DAV_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('DAV_MODULE_DESCRIPTION');
        $this->PARTNER_NAME = Loc::getMessage('DAV_MODULE_VENDOR_NAME');
        $this->PARTNER_URI = Loc::getMessage('DAV_MODULE_VENDOR_URL');
        $this->MODULE_VERSION = "1.0.0";
        $this->MODULE_VERSION_DATE = "2025-01-30";
    }

    public function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);

        $this->InstallDB();
        $this->InstallEvents();
        $this->InstallFiles();
    }

    public function DoUninstall()
    {
        $this->UninstallDB();
        $this->UninstallEvents();
        $this->UninstallFiles();

        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function InstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            RecordTable::getEntity()->createDbTable();
        }
    }

    public function UninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            if (Application::getConnection()->isTableExists(RecordTable::getTableName())) {
                $connection = Application::getInstance()->getConnection();
                $connection->dropTable(RecordTable::getTableName());
            }
        }
    }

    public function InstallFiles()
    {
        CopyDirFiles(
            __DIR__ . "/admin",
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin/",
            true,
            true
        );
        CopyDirFiles(
            __DIR__ . "/components",
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/components/",
            true,
            true
        );
    }

    public function UninstallFiles()
    {
        DeleteDirFiles(
            __DIR__ . "/admin",
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin/"
        );
        DeleteDirFiles(
            __DIR__ . "/components",
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/components/"
        );
    }

    public function InstallEvents()
    {
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler(
            "main",
            "OnBeforeUserLogin",
            $this->MODULE_ID,
            "DavletbaevModuleHandler",
            "onBeforeUserLogin"
        );
    }

    public function UninstallEvents()
    {
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler(
            "main",
            "OnBeforeUserLogin",
            $this->MODULE_ID,
            "DavletbaevModuleHandler",
            "onBeforeUserLogin"
        );
    }
}
