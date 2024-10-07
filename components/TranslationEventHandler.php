<?php

namespace app\components;

class TranslationEventHandler
{

    public static function handleMissingTranslation($event)
    {
        $event->translatedMessage = 'Translation missing: ' . $event->message;
    }
}