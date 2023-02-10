<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'businessName' => 'max:255',
            'address' => 'max:255',
            'vat' =>  'digits:11',
            'taxCode' => 'max:11',
            'employees' => 'integer',
            'active' => 'boolean',
            'type' => 'integer',
        ];
    }
}
