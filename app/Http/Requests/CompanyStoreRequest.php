<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'businessName' => 'required|max:255',
            'address' => 'max:255|nullable',
            'vat' =>  'required|digits:11',
            'taxCode' => 'required|max:11',
            'employees' => 'integer|nullable',
            'active' => 'boolean|nullable',
            'type' => 'required|integer',
        ];
    }
}
