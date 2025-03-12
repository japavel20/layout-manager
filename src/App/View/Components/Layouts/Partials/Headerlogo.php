<?php

namespace Layout\Manager\App\View\Components\Layouts\Partials;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Headerlogo extends Component
{
    public $headerLogo = "/themes/trezo/assets/images/logo-icon.png";
    /**
     * Create a new component instance.
     *
     * @return void
     * * @return \Illuminate\View\View
     */

    public function __construct()
    {
        if((Schema::hasTable('general_settings')))
        {
            try{
                $setup = DB::table('general_settings')->where('key', 'header-logo')->first();
                if(!is_null($setup)) {
                    $this->headerLogo = $setup->value;
                }
            }catch(Exception $e){
                // (Schema::hasTable('core_configs'))
            }
        }
    }
    public function render()
    {
        return view('layout::components.layouts.partials.header_logo');
    }
}