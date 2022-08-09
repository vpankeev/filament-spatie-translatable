<?php

namespace Randes\Translatable\Traits;

use Exception;
use Spatie\Translatable\HasTranslations;

trait ResourceTranslatable
{
    public static function getDefaultTranslatableLocale(): string
    {
        return static::getTranslatableLocales()[0];
    }

    public static function getTranslatableAttributes(): array
    {
        $model = static::getModel();

        if (! method_exists($model, 'getTranslatableAttributes')) {
            throw new Exception("Model [{$model}] must use trait [" . HasTranslations::class . '].');
        }

        $attributes = app($model)->getTranslatableAttributes();

        if (! count($attributes)) {
            throw new Exception("Model [{$model}] must have [\$translatable] properties defined.");
        }

        return $attributes;
    }

    public static function getTranslatableLocales(): array
    {
        return config('filament-spatie-translatable.locales');
    }
}