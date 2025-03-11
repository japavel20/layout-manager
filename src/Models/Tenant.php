<?php

namespace Layout\Manager\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Layout\Manager\Models\TenantSetting;


class Tenant extends Model
{
    protected $table   =   'tenants';
    protected $guarded =   [];
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

    public function settings()
    {
        return $this->hasMany(TenantSetting::class);
    }
}
