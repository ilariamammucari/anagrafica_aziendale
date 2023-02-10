<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyResource;
use App\Models\Company;
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
        return CompanyResource::collection($this->companyService->indexCompanyService($page, $perPage));
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
            'address' => 'max:255|nullable',
            'vat' =>  'required|digits:11',
            'taxCode' => 'required|max:11',
            'employees' => 'integer|nullable',
            'active' => 'boolean|nullable',
            'type' => 'required|integer',
        ]);

        return new CompanyResource($this->companyService->createCompanyService(new Company(), $request->all()));
    }

    public function show(Company $company)
    {
        return new CompanyResource($this->companyService->showCompanyService($company));
    }

    public function update(Request $request, Company $company)
    {
        return new CompanyResource($this->companyService->updateCompanyService($request->all(), $company));
    }

    public function destroy(Company $company)
    {
        $this->companyService->destroyCompanyService($company);
        return response()->json([
            'message' => 'No content'
        ], 204);
    }
}
