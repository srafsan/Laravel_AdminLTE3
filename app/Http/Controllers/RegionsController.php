<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RegionsController extends Controller
{
    private Carbon $startTime;

    public function __construct() {
        $this->startTime = Carbon::now();
    }

    public function index(): JsonResponse
    {
        $data = Region::with('stores')->get();

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
        $region = new Region();
        $region->name = $request->name;
        $region->save();

        $response = [
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
