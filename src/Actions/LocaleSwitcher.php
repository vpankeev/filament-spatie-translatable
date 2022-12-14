<?php

namespace Randes\Translatable\Actions;

use Filament\Pages\Actions\SelectAction;
use Randes\Translatable\Facades\SpatieLaravelTranslatablePlugin;

class LocaleSwitcher extends SelectAction
{
    const SESSION_KEY = 'model-locale';

    public static function getDefaultName(): ?string
    {
        return 'activeLocale';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('filament-spatie-translatable::common.active_locale.label'));

        $this->options(function (): array {
            $livewire = $this->getLivewire();

            if (! method_exists($livewire, 'getTranslatableLocales')) {
                return [];
            }

            $locales = [];

            foreach ($livewire->getTranslatableLocales() as $locale) {
                $locales[$locale] = SpatieLaravelTranslatablePlugin::getLocaleLabel($locale) ?? $locale;
            }

            return $locales;
        });
    }
}
