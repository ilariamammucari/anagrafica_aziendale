<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public $companyService;
    public function __construct(CompanyService $companyService){
        $this->companyService = $companyService;
    }

    public function index()
    {
        return CompanyResource::collection($this->companyService->indexCompanyService());;
    }

    public function store(CompanyStoreRequest $request)
    {
        $request->validated();
        return new CompanyResource($this->companyService->createCompanyService(Auth::id(), $request->businessName, $request->address, $request->vat, $request->taxCode, $request->employees, $request->active, $request->type));
    }

    public function show(Company $company)
    {
        return new CompanyResource($this->companyService->showCompanyService($company));
    }

    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $request->validated();
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
