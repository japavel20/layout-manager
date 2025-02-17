<?php

namespace Layout\Manager\App\View\Components\Layouts\Partials;

use Illuminate\View\Component;
use Layout\Manager\Models\NavGroup;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    // public $navGroup;
    public function __construct()
    {
        // update default value of $this->layoutConfig using session, db or config
        // $this->navGroup = NavGroup::with(['navItems' => function ($query) {
        //     $query->orderBy('sequence');
        // }])->orderBy('sequence')->get();
    }
    public function render()
    {
        $navGroups = NavGroup::with(['navItems' => function ($query) {
            $query->orderBy('position');
        }])->orderBy('position')->get();

        return view('layout::components.layouts.partials.sidebar', compact('navGroups'));
    }
}
