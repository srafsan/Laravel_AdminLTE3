<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Services\StoreService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StoreController extends Controller
{
    protected StoreService $storeService;
    private Carbon $startTime;

    public function __construct(StoreService $storeService) {
        $this->storeService = $storeService;
        $this->startTime = Carbon::now();
    }

    public function index(Request $request): JsonResponse
    {
        $filter = $this->storeService->filterValidator($request)->validate();
        $response = $this->storeService->getStoreList($filter, $this->startTime);

        $data = Store::with('regions')->get();

        $response = [
            "data" => $data,
            "_response_status" => [
                "success" => true,
                "code" => ResponseAlias::HTTP_OK,
                "query_time" => $this->startTime->diffInSeconds(Carbon::now())
            ]
        ];
        return Response::json($response,ResponseAlias::HTTP_OK);
    }

    public function store(Request $request): JsonResponse
    {
        $regions = [1, 2];
        $stores = new Store();
        $stores->name = $request->name;
        $stores->save();
        $stores->regions()->attach($regions);

        $response = [
            "response" => [
                "success" => true,
                "code" => ResponseAlias::HTTP_CREATED,
                "message" => "Store added successfully",
                "query_time" => $this->startTime->diffInSeconds(Carbon::now()),
            ],
        ];

        return Response::json($response, ResponseAlias::HTTP_CREATED);

    }

    public function update(Request $request, $id): JsonResponse
    {
        $regions = [4, 5];
        $stores = Store::findOrFail($id);
        $stores->regions()->sync($regions);

        $response = [
            "data" => $stores,
            "response" => [
                "success" => true,
                "code" => ResponseAlias::HTTP_OK,
                "message" => "Store updated successfully",
                "query_time" => $this->startTime->diffInSeconds(Carbon::now()),
            ],
        ];

        return Response::json($response, ResponseAlias::HTTP_OK);
    }

    public function destroy($id): JsonResponse
    {
        $stores = Store::findOrFail($id);
        $stores->regions()->detach();
        $stores->delete();

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
