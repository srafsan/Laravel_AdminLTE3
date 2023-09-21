<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Services\RegionService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RegionController extends Controller
{
    protected RegionService $regionService;
    private Carbon $startTime;

    public function __construct(RegionService $regionService) {
        $this->regionService = $regionService;
        $this->startTime = Carbon::now();
    }

    public function index(): JsonResponse
    {
        $response = $this->regionService->getRegionList($this->startTime);
        return Response::json($response,ResponseAlias::HTTP_OK);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $this->regionService->validator($request)->validate();
        $data = $this->regionService->store($validated);

        $response = [
            "data" => $data,
            "response" => [
                "success" => true,
                "code" => ResponseAlias::HTTP_CREATED,
                "message" => "Region added successfully",
                "query_time" => $this->startTime->diffInSeconds(Carbon::now()),
            ],
        ];

        return Response::json($response, ResponseAlias::HTTP_CREATED);
    }

    public function update(Request $request, $id): void
    {
        //
    }

    public function destroy($id): JsonResponse
    {
        $stores = Region::findOrFail($id);
        $stores->regions()->detach();
        $stores->delete();

        $response = [
            "response" => [
                "success" => true,
                "code" => ResponseAlias::HTTP_OK,
                "message" => "Region deleted successfully",
                "query_time" => $this->startTime->diffInSeconds(Carbon::now()),
            ],
        ];

        return Response::json($response, ResponseAlias::HTTP_CREATED);

    }
}
