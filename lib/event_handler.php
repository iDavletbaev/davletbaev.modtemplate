<?php
namespace DavletbaevModule;

use Bitrix\Main\Event;
use Bitrix\Main\EventResult;

class DavletbaevModuleHandler
{
    public static function onBeforeUserLogin(Event $event)
    {
        $params = $event->getParameters();
        if (strpos($params['LOGIN'], 'test') !== false) {
            global $APPLICATION;
            $APPLICATION->throwException("Запрещено использовать 'test' в логине.");
            return new EventResult(EventResult::ERROR, null, "davletbaev.modtemplate");
        }
        return new EventResult(EventResult::SUCCESS, null, "davletbaev.modtemplate");
    }
}
