<?php

namespace Layout\Manager\App\View\Components\Layouts\Partials;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Header extends Component
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
        $user = Auth::user();
        return view('layout::components.layouts.partials.header', compact('user'));
    }
}
