<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Services\StoreService;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StoreController extends Controller
{
    /**
     * @var StoreService
     */
    protected StoreService $storeService;
    /**
     * @var Carbon
     */
    private Carbon $startTime;

    /**
     * @param StoreService $storeService
     */
    public function __construct(StoreService $storeService) {
        $this->storeService = $storeService;
        $this->startTime = Carbon::now();
    }

    public function index()
    {
        $lists = Store::all();
        return view('store.allStore', ['data' => $lists]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $this->storeService->validator($request)->validate();
        $data = $this->storeService->store($validated);

        $response = [
            "data" => $data,
            "response" => [
                "success" => true,
                "code" => ResponseAlias::HTTP_CREATED,
                "message" => "Store added successfully",
                "query_time" => $this->startTime->diffInSeconds(Carbon::now()),
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
        $store = Store::findOrFail($id);
        $validated = $this->storeService->validator($request)->validate();
        $data = $this->storeService->update($store, $validated);

        $response = [
            "data" => $data,
            "response" => [
                "success" => true,
                "code" => ResponseAlias::HTTP_OK,
                "message" => "Store updated successfully",
                "query_time" => $this->startTime->diffInSeconds(Carbon::now()),
            ],
        ];

        return Response::json($response, ResponseAlias::HTTP_OK);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $store = Store::findOrFail($id);
        $this->storeService->destroy($store);

        $response = [
            "response" => [
                "success" => true,
                "code" => ResponseAlias::HTTP_CREATED,
                "message" => "Store deleted successfully",
                "query_time" => $this->startTime->diffInSeconds(Carbon::now()),
            ],
        ];

        return Response::json($response, ResponseAlias::HTTP_CREATED);
    }
}
