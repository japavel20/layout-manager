<?php

namespace Layout\Manager\App\View\Components\DataDisplay\Tables;


class TableHead extends Component
{
    private $data = null;
    protected $id = null;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id = null)
    {
        $this->data['id'] = $id;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $view =  'datadisplay::components.tables.table-head';
        return view($view, $this->data);
    }
}
