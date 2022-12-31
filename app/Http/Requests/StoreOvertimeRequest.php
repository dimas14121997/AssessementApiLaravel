<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOvertimeRequest extends FormRequest
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
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => ['required', 'date_format:Y-m-d', Rule::unique('overtimes', 'date')->where('employee_id', $this->request->get('employee_id'))],
            'time_started' => 'required|date_format:H:i|before:' . $this->request->get('time_ended'),
            'time_ended' => 'required|date_format:H:i|after:' . $this->request->get('time_started')
        ];
    }
}
