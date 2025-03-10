<?php

namespace Layout\Manager\App\View\Components\DataDisplay;

use Exception;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use ThemeManager\Theme;

class Favicon extends Component
{
    protected $theme;
    // public $icon = "/themes/trezo/assets/images/favicon.png";
    public $favicon = "";
    /**
     * Create a new component instance.
     *
     * @return void
     * * @return \Illuminate\View\View
     */

    public function __construct(Theme $theme)
    {
        $this->theme = $theme;

        if ((Schema::hasTable('general_settings'))) {
            try {
                $setup = DB::table('general_settings')->where('key', 'favicon')->first();
                if (!is_null($setup)) {
                    $this->favicon = $setup->value;
                }
            } catch (Exception $e) {
                dd($e);
            }
        } else {
            $this->favicon = $this->theme->getImageFiles() ?? null;
            // dd($favicon);
        }
    }
    public function render()
    {
        return view('layout::components.datadisplay.favicon', ['favicons' => $this->favicon]);
    }
}