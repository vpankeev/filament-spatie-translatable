<?php

namespace Randes\Translatable\Traits;

use Filament\Pages\Actions\Action;
use Randes\Translatable\Actions\LocaleSwitcher;

trait HasActiveLocaleSwitcher
{
    public $activeLocale = null;

    public ?array $translatableLocales = null;

    protected function getActiveLocaleSelectAction(): Action
    {
        return LocaleSwitcher::make();
    }

    public function setTranslatableLocales(array $locales): void
    {
        $this->translatableLocales = $locales;
    }

    public function getTranslatableLocales(): array
    {
        return $this->translatableLocales ?? static::getResource()::getTranslatableLocales();
    }

    public function updatingActiveLocale($locale)
    {
        session()->put(LocaleSwitcher::SESSION_KEY, $locale);
    }
}
