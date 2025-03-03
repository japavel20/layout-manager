<?php

namespace Layout\Manager\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;


class GeneralSetting extends Model
{
    protected $table   =   'general_settings';
    protected $guarded =   [];

    public static function rules($id = '')
    {
        if (strlen($id) > 0) 
        {
            $id = ",$id";
        }
        return [
            'key'   => 'required|unique:general_settings,key'.$id,
            'value' => 'required',
            'path'  => 'nullable',
        ];
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected static function booted()
    {
        static::creating(function($model) {
            $model->uuid = (String) Str::uuid();
        });
    }
}