<?php

namespace Layout\Manager\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;


class TenantSetting extends Model
{
    protected $table   =   'tenant_settings';
    protected $guarded =   [];
    protected $keyType = 'string';
    public $incrementing = false;

    public static function rules($id = '')
    {
        if (strlen($id) > 0) {
            $id = ",$id";
        }
        return [
            'key'   => 'required|unique:tenat_settings,key' . $id,
            'value' => 'required',
        ];
    }

    public function getRouteKeyName()
    {
        return 'id';
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public static function get($tenantId, $key, $default = null)
    {
        return self::where('tenant_id', $tenantId)->where('key', $key)->value('value') ?? $default;
    }

    public static function set($tenantId, $key, $value)
    {
        return self::updateOrCreate(['tenant_id' => $tenantId, 'key' => $key], ['value' => $value]);
    }
}
