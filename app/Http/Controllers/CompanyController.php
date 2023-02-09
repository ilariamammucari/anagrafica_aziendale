<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CompanyService;

class CompanyController extends Controller
{
    public $companyService;
    public function __construct(CompanyService $companyService){
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($page = 0, $perPage = 0)
    {
        return $this->companyService->indexCompanyService($page, $perPage);
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
        
        return $this->companyService->createCompanyService($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->companyService->showCompanyService($id);
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
        return $this->companyService->updateCompanyService($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return $this->companyService->destroyCompanyService($id);
    }
}
