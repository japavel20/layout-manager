<?php

namespace Layout\Manager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UserTrackable;


use App\Traits\Historiable;

class NavItem extends Model
{
    use UserTrackable;
    use SoftDeletes;


    // use Historiable;
    protected $connection = '';
    protected $table = 'nav_items';
    protected $guarded = [];
    protected $keyType = 'string';
    public $incrementing = false;


    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    public function navGroups()
    {
        return $this->belongsToMany(\Layout\Manager\Models\NavGroup::class)->withTimestamps();
    }

    // public function role()
    // {
    //     return $this->belongsTo(\Pondit\Authorize\Models\Role::class);
    // }

    // public function roles()
    // {
    //     return $this->belongsToMany(\Pondit\Authorize\Models\Role::class)->withTimestamps();
    // }

    ##ELOQUENTRELATIONSHIPMODEL##
}
