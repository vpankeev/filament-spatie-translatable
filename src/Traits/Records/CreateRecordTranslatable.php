<?php

namespace Randes\Translatable\Traits\Records;

use Illuminate\Database\Eloquent\Model;
use Randes\Translatable\Traits\HasActiveFormLocaleSwitcher;

trait CreateRecordTranslatable
{
    use HasActiveFormLocaleSwitcher;

    public function mount(): void
    {
        static::authorizeResourceAccess();

        abort_unless(static::getResource()::canCreate(), 403);

        $this->setActiveFormLocale();

        $this->fillForm();
    }

    protected function setActiveFormLocale(): void
    {
        $this->activeLocale = $this->activeFormLocale = static::getResource()::getDefaultTranslatableLocale();
    }

    protected function handleRecordCreation(array $data): Model
    {
        $record = static::getModel()::usingLocale(
            $this->activeFormLocale,
        )->fill($data);
        $record->save();

        return $record;
    }

    protected function getActions(): array
    {
        return array_merge(
            [$this->getActiveFormLocaleSelectAction()],
            parent::getActions() ?? [],
        );
    }
}
