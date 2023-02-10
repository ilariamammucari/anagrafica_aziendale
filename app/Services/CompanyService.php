<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyService{

    public function indexCompanyService(){
        $company = Company::all();
        return $company;
    }

    public function createCompanyService($company, $request)
    {
        $company_res = $company;

        $company_res->user_id = Auth::id();

        if( !isset($request['active']) ){
            $request['active'] = 0;
        }

        $company_res->fill($request);
        $company_res->save();

        return $company_res;
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

    public function destroyCompanyService($company){

        return $company->delete();

    }
}