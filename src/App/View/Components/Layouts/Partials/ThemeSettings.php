<?php

namespace Layout\Manager\App\View\Components\Layouts\Partials;

use Illuminate\View\Component;

class ThemeSettings extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // update default value of $this->layoutConfig using session, db or config
    }
    public function render()
    {
        return view('layout::components.layouts.partials.theme_settings');
    }
}
