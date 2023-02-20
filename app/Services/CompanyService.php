<?php

namespace App\Services;

use App\Models\Company;
use App\Dto\CompanyData;
use Illuminate\Support\Facades\Auth;

class CompanyService{

    public function indexCompanyService(){
        // All the pagination data from the query string is missing!
        $company = Company::all();
        return $company;
    }

    public function createCompany(CompanyData $data): Company
    {
        $company = new Company();
        $company->fill($data->toArray())
            ->creator()
            ->associate($data->creator);

        return tap($company, fn (Company $company) => $company->save());
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
