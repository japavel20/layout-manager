<?php

namespace Layout\Manager\App\View\Components\Layouts\Partials;
use Exception;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Title extends Component
{
    public $title = "IntelliApps";
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        if((Schema::hasTable('organization_setups')))
        {
            try{
                $setup = DB::table('organization_setups')->where('key', 'title')->first();
                if(!is_null($setup)) {
                    $this->title = $setup->value;
                }
            }catch(Exception $e){
                // (Schema::hasTable('core_configs'))
            }
        }
    }
    public function render()
    {
        return view('layout::components.layouts.partials.title',['title'=>$this->title]);
    }
}