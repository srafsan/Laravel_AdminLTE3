<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CustomerController extends Controller
{
    protected CustomerService $customerService;
    private Carbon $startTime;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
        $this->startTime = Carbon::now();
    }

    public function index(): JsonResponse
    {
        $response = $this->customerService->getCustomerList($this->startTime);
        return Response::json($response, ResponseAlias::HTTP_OK);
    }

    /**
     * @throws BindingResolutionException
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $this->customerService->validator($request)->validate();
        $data = $this->customerService->store($validated);

        $response = [
            "data" => $data,
            "response" => [
                "success" => true,
                "code" => ResponseAlias::HTTP_CREATED,
                "message" => "Customer added successfully",
                "query_time" => $this->startTime->diffInSeconds(Carbon::now()),
            ],
        ];

        return Response::json($response, ResponseAlias::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
