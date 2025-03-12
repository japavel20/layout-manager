<?php

namespace Layout\Manager;

use Illuminate\Support\ServiceProvider;

class LayoutManagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load views
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'layout');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->layouts();
        $this->libs();
        $this->partials();
        $this->blocks();
        $this->dataDisplay();
        $this->dataEntry();
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
            'theme-master',
            \Layout\Manager\App\View\Components\Layouts\Partials\Master::class
        );
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
            'headerLogo',
            \Layout\Manager\App\View\Components\Layouts\Partials\Headerlogo::class
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
    public function blocks()
    {
        \Illuminate\Support\Facades\Blade::component(
            'title',
            \Layout\Manager\App\View\Components\Blocks\Title::class
        );
    }
    public function dataDisplay()
    {
        \Illuminate\Support\Facades\Blade::component(
            'favicon',
            \Layout\Manager\App\View\Components\DataDisplay\Favicon::class
        );
        \Illuminate\Support\Facades\Blade::component(
            'card',
            \Layout\Manager\App\View\Components\DataDisplay\Card::class
        );
        \Illuminate\Support\Facades\Blade::component(
            'copyright',
            \Layout\Manager\App\View\Components\DataDisplay\Copyright::class
        );
        \Illuminate\Support\Facades\Blade::component(
            'toster',
            \Layout\Manager\App\View\Components\DataDisplay\Toster::class
        );
        \Illuminate\Support\Facades\Blade::component(
            'table',
            \Layout\Manager\App\View\Components\DataDisplay\Tables\Table::class
        );
        \Illuminate\Support\Facades\Blade::component(
            'thead',
            \Layout\Manager\App\View\Components\DataDisplay\Tables\TableHead::class
        );
        \Illuminate\Support\Facades\Blade::component(
            'tbody',
            \Layout\Manager\App\View\Components\DataDisplay\Tables\TableBody::class
        );
    }

    public function dataEntry()
    {
        \Illuminate\Support\Facades\Blade::component(
            'selecttrio',
            \Layout\Manager\App\View\Components\DataEntry\Selecttrio::class
        );
    }
}