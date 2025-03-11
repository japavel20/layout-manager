<?php

namespace Layout\Manager\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenantSettingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }
}
