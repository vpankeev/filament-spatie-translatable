<?php

namespace Randes\Translatable;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class FilamentSpatieTranslatableProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/filament-spatie-translatable.php', 'filament-spatie-translatable');
    }

    public function boot(): void
    {
        //
    }
}
