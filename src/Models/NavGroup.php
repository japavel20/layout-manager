<?php

namespace Layout\Manager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UserTrackable;

use Pondit\Nestedset\NodeTrait;


use App\Traits\Historiable;

class NavGroup extends Model
{
    use UserTrackable;
    use SoftDeletes;

    // use NodeTrait;


    // use Historiable;
    // protected $connection = '';
    protected $table = 'nav_groups';
    protected $guarded = ['id'];


    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    public function navItems()
    {
        return $this->belongsToMany(\Layout\Manager\Models\NavItem::class)->withTimestamps();
    }

    ##ELOQUENTRELATIONSHIPMODEL##

    public static function treeOptions($selected_id = null)
    {
        $nodes = NavGroup::orderBy('id', 'asc')->get();
        $data = '<option value=""> Root/Top node </option>';

        $traverse = function ($categories, $prefix = '-', $parent_navGroup_name = null) use (&$traverse, &$data, $selected_id) {
            foreach ($categories as $navGroup) {
                // echo PHP_EOL . $prefix . ' ' . $navGroup->title;
                if ($selected_id && ($selected_id == $navGroup->id)) {
                    $data .= '<option selected value=' . $navGroup->id . '>' . ' ' . $prefix . ' ' . $navGroup->title . '</option>' . PHP_EOL;
                } else {
                    $data .= '<option value=' . $navGroup->id . '>' . ' ' . $prefix . ' ' . $navGroup->title . ($parent_navGroup_name == null ? '  ' : ("  (" . $parent_navGroup_name . ")  ")) . $navGroup->description . '</option>' . PHP_EOL;
                }
                $parent_navGroup_name = $navGroup->title;

                $traverse($navGroup->children ?? [], $prefix . '-', $parent_navGroup_name);
            }
            return $data;
        };
        $data = $traverse($nodes);

        return $data;
    }
}
