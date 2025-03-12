<?php

namespace Layout\Manager\Models;

use App\Models\User;
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
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function adminUser()
    {
        return $this->hasOne(User::class, 'tenant_id');
    }
}
