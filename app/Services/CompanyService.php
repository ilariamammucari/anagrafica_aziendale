<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyService{

    public function indexCompanyService(){
        $company = Company::all();
        return $company;
    }

    public function createCompanyService($model, $user_id, $businessName, $address, $vat, $taxCode, $employees, $active, $type)
    {
        $company = $model;

        $data = [
            $company->user_id = $user_id,
            $company->businessName = $businessName,
            $company->address = $address,
            $company->vat = $vat,
            $company->taxCode = $taxCode,
            $company->employees = $employees,
            $company->active = $active ?? 0,
            $company->type = $type,
        ];

        $company->fill($data);
        $company->save();

        return $company;
    }

    public function showCompanyService($company)
    {
        return $company;
    }

    public function updateCompanyService($request, $company)
    {
        $company->update($request);
        return $company;
    }

    public function destroyCompanyService($company)
    {
        return $company->delete();
    }
}