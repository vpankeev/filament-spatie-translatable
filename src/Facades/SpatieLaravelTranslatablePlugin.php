<?php

namespace Randes\Translatable\Facades;

use Closure;
use Illuminate\Support\Facades\Facade;
use Randes\Translatable\SpatieLaravelTranslatablePluginManager;

/**
 * @method static void getLocaleLabelUsing(?Closure $callback)
 * @method static null|string getLocaleLabel(string $locale, ?string $displayLocale = null)
 *
 * @see SpatieLaravelTranslatablePluginManager
 */
class SpatieLaravelTranslatablePlugin extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'filament-spatie-translatable';
    }
}
