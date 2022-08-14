<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Locales
    |--------------------------------------------------------------------------
    |
    | These are the locales that Filament will use to put translate resource
    | content. They may be overridden for each resource by setting the
    | `$translatableLocales` property.
    |
    */

    'locales' => [config('app.locale')],

    'show_hint' => true,

    'hint_icon' => 'heroicon-s-translate',

    'save_before_switch' => false,

    'refresh_page_after_updated' => true
];
