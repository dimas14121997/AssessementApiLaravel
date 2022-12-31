<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:employees,name',
            'status_id' => ['required', 'integer', Rule::exists('references', 'id')->where('code', 'employee_status')],
            'salary' => 'required|integer|min:2000000|max:10000000',
        ];
    }
}
