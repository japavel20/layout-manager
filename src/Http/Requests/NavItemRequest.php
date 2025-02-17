<?php

namespace Layout\Manager\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NavItemRequest extends FormRequest
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
