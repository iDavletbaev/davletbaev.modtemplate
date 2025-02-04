<?php
namespace CustomModule;

use Bitrix\Main\Event;
use Bitrix\Main\EventResult;

class CustomModuleHandler
{
    public static function onBeforeUserLogin(Event $event)
    {
        $params = $event->getParameters();
        if (strpos($params['LOGIN'], 'test') !== false) {
            global $APPLICATION;
            $APPLICATION->throwException("Запрещено использовать 'test' в логине.");
            return new EventResult(EventResult::ERROR, null, "custom.module");
        }
        return new EventResult(EventResult::SUCCESS, null, "custom.module");
    }
}
