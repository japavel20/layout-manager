<?php

namespace Layout\Manager\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NavGroupRequest extends FormRequest
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
