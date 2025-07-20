<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LanguageSelector extends Component
{
    public $currentLocale;
    public $availableLocales;
    public $otherLocale;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->currentLocale = app()->getLocale();
        $this->availableLocales = [
            'it' => __('common.italian'),
            'en' => __('common.english'),
        ];
        $this->otherLocale = $this->currentLocale === 'it' ? 'en' : 'it';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.language-selector');
    }
}
