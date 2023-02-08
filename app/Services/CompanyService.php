<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyService{

    public function indexCompanyService(){
        return Company::all();
    }

    public function createCompanyService($request){
        $company = Company::create([
            'user_id' => Auth::id(),
            'businessName' => $request['businessName'],
            'address' => $request['address'],
            'vat' =>  $request['vat'],
            'taxCode' => $request['taxCode'],
            'employees' => $request['employees'],
            'active' => $request['active'],
            'type' => $request['type'],
        ]);

        return $company;
    }

    public function showCompanyService($id){
        return Company::find($id);
    }

    public function updateCompanyService($request, $id){
        $company = Company::find($id);
        $company->update($request->all());
        return $company;
    }

    public function destroyCompanyService($id){
        Company::destroy($id);
        return response([
            'message' => 'No content'
        ], 204);
    }
}