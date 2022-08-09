<?php

namespace Randes\Translatable;

use Illuminate\Support\ServiceProvider;

class FilamentSpatieTranslatableProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->scoped('filament-spatie-translatable', function (): SpatieLaravelTranslatablePluginManager {
            return new SpatieLaravelTranslatablePluginManager();
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/filament-spatie-translatable.php' => config_path('filament-spatie-translatable.php'),
            ], 'filament-spatie-translatable-config');

            $this->publishes([
                __DIR__ . '/../resources/lang' => resource_path('lang/vendor/filament-spatie-translatable'),
            ], 'filament-spatie-translatable');
        }

        $this->loadTranslationsFrom(
            __DIR__.'/../resources/lang',
            'filament-spatie-translatable'
        );
    }
}
