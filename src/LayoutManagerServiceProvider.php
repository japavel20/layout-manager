<?php

namespace Layout\Manager;

use Illuminate\Support\ServiceProvider;

class LayoutManagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load views
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'layout');
        $this->layouts();
        $this->libs();
        $this->partials();
    }

    public function layouts()
    {
        // Register Blade components
    }
    private function libs()
    {
        \Illuminate\Support\Facades\Blade::component(
            'style',
            \Layout\Manager\App\View\Components\Layouts\Libs\Style::class
        );
        \Illuminate\Support\Facades\Blade::component('js', \Layout\Manager\App\View\Components\Layouts\Libs\Js::class);
    }
    private function partials()
    {
        \Illuminate\Support\Facades\Blade::component(
            'theme-guest',
            \Layout\Manager\App\View\Components\Layouts\Partials\Guest::class
        );
        \Illuminate\Support\Facades\Blade::component(
            'footer',
            \Layout\Manager\App\View\Components\Layouts\Partials\Footer::class
        );
        \Illuminate\Support\Facades\Blade::component(
            'preloader',
            \Layout\Manager\App\View\Components\Layouts\Partials\Preloader::class
        );
        \Illuminate\Support\Facades\Blade::component(
            'sidebar',
            \Layout\Manager\App\View\Components\Layouts\Partials\Sidebar::class
        );
        \Illuminate\Support\Facades\Blade::component(
            'header',
            \Layout\Manager\App\View\Components\Layouts\Partials\Header::class
        );
        \Illuminate\Support\Facades\Blade::component(
            'themeSettings',
            \Layout\Manager\App\View\Components\Layouts\Partials\ThemeSettings::class
        );
    }
}
