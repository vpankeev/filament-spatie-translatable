<?php

namespace Randes\Translatable\Traits;

use Filament\Pages\Actions\Action;
use Randes\Translatable\Actions\LocaleSwitcher;

/**
 * @deprecated Use `HasActiveLocaleSwitcher` instead.
 */
trait HasActiveFormLocaleSwitcher
{
    public $activeLocale = null;

    public $activeFormLocale = null;

    public ?array $translatableLocales = null;

    protected function getActiveFormLocaleSelectAction(): Action
    {
        return LocaleSwitcher::make();
    }

    public function updatingActiveLocale($locale)
    {
        session()->put(LocaleSwitcher::SESSION_KEY, $locale);
    }

    public function updatedActiveLocale(): void
    {
        $this->syncInput(
            'activeFormLocale',
            $this->activeLocale,
        );
    }

    public function getRecordTitle(): string
    {
        if ($this->activeFormLocale) {
            $this->record->setLocale($this->activeFormLocale);
        }

        return parent::getRecordTitle();
    }

    public function setTranslatableLocales(array $locales): void
    {
        $this->translatableLocales = $locales;
    }

    public function getTranslatableLocales(): array
    {
        return $this->translatableLocales ?? static::getResource()::getTranslatableLocales();
    }

    public function getActiveFormLocale(): ?string
    {
        return $this->activeFormLocale;
    }
}
