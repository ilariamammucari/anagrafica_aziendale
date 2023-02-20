<?php

namespace App\Http\Requests;

use App\Dto\CompanyData;
use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'businessName' => 'required|string|min:3|max:255',
            'address' => 'nullable|string|min:3|max:255',
            'vat' =>  'required|size:11',
            'taxCode' => 'required|min:11|max:16',
            'employees' => 'integer|nullable',
            'active' => 'filled|boolean',
            'type' => 'required|integer',
        ];
    }

    public function toDto(): CompanyData
    {
        return CompanyData::newInstanceFrom(
            $this->only([
                'businessName', 'address', 'vat', 'taxCode', 'employees', 'active', 'type'
            ]),
            $this->user()
        );
    }
}
