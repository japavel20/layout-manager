<?php

namespace Layout\Manager\App\View\Components\Layouts\Libs;

use Illuminate\View\Component;
use ThemeManager\Theme;

class Js extends Component
{
    protected $theme;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }

    public function getJsFiles()
    {
        return $this->theme->getJsFiles();
    }

    public function render()
    {
        return view('layout::components.layouts.libs.js', ['jsFiles' => $this->getJsFiles()]);
    }
}
