<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetOvertimeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date_started' => 'required|date_format:Y-m-d|before:' . $this->request->get('date_ended'),
            'date_ended' => 'required|date_format:Y-m-d|after:' . $this->request->get('date_started')
        ];
    }
}
