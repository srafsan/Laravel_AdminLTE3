<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Services\RegionService;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RegionController extends Controller
{
    /**
     * @var RegionService
     */
    protected RegionService $regionService;
    /**
     * @var Carbon
     */
    private Carbon $startTime;

    /**
     * @param RegionService $regionService
     */
    public function __construct(RegionService $regionService) {
        $this->regionService = $regionService;
        $this->startTime = Carbon::now();
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $response = $this->regionService->getRegionList($this->startTime);
        return Response::json($response,ResponseAlias::HTTP_OK);
    }

    /**
     * @throws BindingResolutionException
     * @throws ValidationException
     */
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

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id): JsonResponse
    {
        $region = Region::findOrFail($id);
        $validated = $this->regionService->validator($request)->validate();
        $data = $this->regionService->update($region, $validated);

        $response = [
            "data" => $data,
            "response" => [
                "success" => true,
                "code" => ResponseAlias::HTTP_OK,
                "message" => "Region Updated Successfully",
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
        $region = Region::findOrFail($id);
        $this->regionService->destroy($region);

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
