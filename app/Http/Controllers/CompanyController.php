<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return Company::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'businessName' => 'required|max:255',
            'address' => 'max:255',
            'vat' =>  'required|digits:11',
            'taxCode' => 'required|max:11',
            'employees' => 'integer',
            'active' => 'boolean',
            'type' => 'required|integer',
        ]);
        
        return Company::create([
            'user_id' => Auth::id(),
            'businessName' => $request['businessName'],
            'address' => $request['address'] ?? '',
            'vat' =>  $request['vat'],
            'taxCode' => $request['taxCode'],
            'employees' => $request['employees'] ?? '',
            'active' => $request['active'] ?? '',
            'type' => $request['type'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return Company::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        $company->update($request->all());
        return $company;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Company::destroy($id);
        return response([
            'body' => 'No content'
        ], 204);
    }
}
