<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyService{

    public function indexCompanyService(){
        $company = Company::all();
        return $company;
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

        if(isset($company)){
            return $company;
        }

        return response([
            'message' => 'Create non riuscito'
        ]);
    }

    public function showCompanyService($id){
        $company = Company::find($id);
        if(isset($company)){
            return $company;
        }

        return response([
            'message' => 'Show non riuscito'
        ]);
    }

    public function updateCompanyService($request, $id){
        $company = Company::find($id);
        if(isset($company)){
            $company->update($request->all());
            return $company;
        }

        return response([
            'message' => 'Update non riuscito'
        ]);
    }

    public function destroyCompanyService($id){
        $company = Company::find($id);
        if(isset($company)){
            $company->delete();
            return response([
                'message' => 'No content'
            ], 204);
        }

        return response([
            'message' => 'Destroy non riuscito'
        ]);

    }
}