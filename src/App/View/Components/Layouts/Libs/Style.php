<?php

namespace Layout\Manager\App\View\Components\Layouts\Libs;

use ThemeManager\Theme;
use Illuminate\View\Component;

class Style extends Component
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
    public function getCssFiles()
    {
        return $this->theme->getCssFiles();
    }

    public function getImageFiles()
    {
        return $this->theme->getImageFiles();
    }
    public function render()
    {
        return view('layout::components.layouts.libs.style', [
            'cssFiles' => $this->getCssFiles(),
            // 'imageFiles' => $this->getImageFiles(),
        ]);
    }
}
