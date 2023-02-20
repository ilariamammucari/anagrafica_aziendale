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
    public function __construct(private readonly CompanyService $companyService){
        // Company service cannot be public! It's a service, no one should access to it publicly... It's a private instance
        // that can be only read by the controller.
    }

    public function index()
    {
        // Better to create a dedicated collection resource (https://laravel.com/docs/9.x/eloquent-resources#generating-resource-collections)
        // Not mandatory... But a better choice anyway. Another thing... you're not passing to the service any pagination data from query string
        // it should be: companyService->listCompanies($request->query('perPage'), $request->query('page')) or something similar
        return CompanyResource::collection($this->companyService->indexCompanyService());
    }

    public function store(CompanyStoreRequest $request): CompanyResource
    {
        $company = $this->companyService->createCompany(
            $request->toDto()
        );

        return new CompanyResource($company);
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
