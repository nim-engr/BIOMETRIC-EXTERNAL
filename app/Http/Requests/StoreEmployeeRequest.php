<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'biometric_number' => 'required|numeric|unique:employees,biometric_number',
            'first_name'       => 'required|string',
            'middle_initial'   => 'nullable|string|max:5',
            'family_name'      => 'required|string',
            'name_extension'   => 'nullable|string|max:50',
            'position'         => 'nullable|string|max:150',
            'employment_status'=> 'nullable|string|max:150',
            'sup_first_name'     => 'required|string',
            'sup_middle_initial' => 'nullable|string|max:5',
            'sup_family_name'    => 'required|string',
            'sup_name_extension' => 'nullable|string|max:50',
        ];
    }

    public function authorize() { return true; }
}
