<?php

namespace Layout\Manager\App\View\Components\Layouts\Partials;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class Preloader extends Component
{ 
    public $preloader_text = "IntelliApps";
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
                $setup = DB::table('general_settings')->where('key', 'preloader-text')->first();
                if(!is_null($setup)) {
                    $this->preloader_text = $setup->value;
                }
            }catch(Exception $e){
                // (Schema::hasTable('core_configs'))
            }
        }
    }
    public function render()
    {
        return view('layout::components.layouts.partials.preloader');
    }
}