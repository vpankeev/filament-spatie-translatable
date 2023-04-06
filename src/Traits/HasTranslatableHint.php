<?php

namespace Randes\Translatable\Traits;

trait HasTranslatableHint
{
    /**
     * @return array
     */
    public function getFormSchema(): array
    {
        $schema = parent::getFormSchema();

        if (config('filament-spatie-translatable.show_hint')) {
            $this->setTranslatableHintToComponents($schema);
        }

        return $schema;
    }

    /**
     * @param $components
     * @return void
     */
    public function setTranslatableHintToComponents($components)
    {
        $modelTranslatableArray = app($this->getModel())->translatable ?? [];
        $hintIcon = config('filament-spatie-translatable.hint_icon');

        foreach ($components ?? [] as $component) {
            // Ensure that we have correct class
            if (!is_string($component) && !is_object($component)) {
                continue;
            }

            // Search children recursively
            if (method_exists($component, 'getChildComponents')) {
                $this->setTranslatableHintToComponents($component->getChildComponents());
            }

            // Skip if component does not have a name
            if (!method_exists($component, 'getName')) {
                continue;
            }

            $isTranslatable     = in_array($component->getName(), $modelTranslatableArray);
            $hasHintMethod      = method_exists($component, 'hint');
            $hasHintIconMethod  = method_exists($component, 'hintIcon');

            if (!$isTranslatable) {
                continue;
            }

            if ($hasHintMethod && is_null($component->getHint())) {
                $component->hint(__('filament-spatie-translatable::common.translatable'));
            }
            if ($hasHintIconMethod && is_null($component->getHintIcon())) {
                $component->hintIcon($hintIcon);
            }
        }
    }
}
