<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 *
 */
class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    protected ProductService $productService;
    /**
     * @var Carbon
     */
    private Carbon $startTime;

    /**
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        $this->startTime = Carbon::now();
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $response = $this->productService->getProductList($this->startTime);
        return Response::json($response, ResponseAlias::HTTP_OK);
    }

    /**
     * @throws ValidationException
     * @throws BindingResolutionException
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $this->productService->validator($request)->validate();
        $data = $this->productService->store($validated);

        $response = [
            "data" => $data,
            "response" => [
                "success" => true,
                "code" => ResponseAlias::HTTP_CREATED,
                "message" => "Product added successfully",
                "query_time" => $this->startTime->diffInSeconds(Carbon::now())
            ],
        ];

        return Response::json($response, ResponseAlias::HTTP_CREATED);
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $validated = $this->productService->validator($request)->validate();
        $data = $this->productService->update($product, $validated);

        $response = [
            "data" => $data,
            "response" => [
                "success" => true,
                "code" => ResponseAlias::HTTP_OK,
                "message" => "Product updated successfully",
                "query_time" => $this->startTime->diffInSeconds(Carbon::now())
            ]
        ];

        return Response::json($response, ResponseAlias::HTTP_OK);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $this->productService->destroy($product);

        $response = [
            "response" => [
                "success" => true,
                "code" => ResponseAlias::HTTP_OK,
                "message" => "Product deleted successfully",
                "query_time" => $this->startTime->diffInSeconds(Carbon::now()),
            ],
        ];

        return Response::json($response, ResponseAlias::HTTP_OK);

    }
}
