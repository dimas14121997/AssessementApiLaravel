<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class GetEmployeeRequest extends FormRequest
{
    protected $redirect = '';
    public function authorize()
    {
         return true;
    }

    
    public function rules()
    {
        return [
            'per_page' => 'nullable|integer',
            'page' => 'nullable|integer',
            'order_by' => 'required|string|in:name,salary',
            'order_type' => 'required|string|in:ASC,DESC'
        ];
    }
}
