<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;
    private Carbon $startTime;

    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
        $this->startTime = Carbon::now();
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $response = $this->categoryService->getCategoryList($this->startTime);
        return Response::json($response, ResponseAlias::HTTP_OK);
    }

    /**
     * @throws BindingResolutionException
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $this->categoryService->validator($request)->validate();
        $data = $this->categoryService->store($validated);

        $response = [
            "data" => $data,
            "response" => [
                "success" => true,
                "code" => ResponseAlias::HTTP_CREATED,
                "message" => "Category added successfully",
                "query_time" => $this->startTime->diffInSeconds(Carbon::now())
            ],
        ];

        return Response::json($response, ResponseAlias::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $validated = $this->categoryService->validator($request)->validate();
        $data = $this->categoryService->update($category, $validated);

        $response = [
            "data" => $data,
            "response" => [
                "success" => true,
                "code" => ResponseAlias::HTTP_OK,
                "message" => "Category updated successfully",
                "query_time" => $this->startTime->diffInSeconds(Carbon::now()),
            ]
        ];

        return Response::json($response, ResponseAlias::HTTP_OK);
    }

    public function destroy($id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $this->categoryService->destroy($category);

        $response = [
            "response" => [
                "success" => true,
                "code" => ResponseAlias::HTTP_OK,
                "message" => "Category deleted successfully",
                "query_time" => $this->startTime->diffInSeconds(Carbon::now()),
            ],
        ];

        return Response::json($response, ResponseAlias::HTTP_CREATED);

    }
}
