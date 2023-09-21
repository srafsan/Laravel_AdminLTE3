<?php

namespace App\Services;

use App\Models\Region;
use App\Models\Store;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RegionService
{
    public function getRegionList(Carbon $startTime): array
    {
        $data = Region::with('stores')->get();

        $response = [
            "data" => $data,
            "_response_status" => [
                "success" => true,
                "code" => ResponseAlias::HTTP_OK,
                "query_time" => $startTime->diffInSeconds(Carbon::now())
            ]
        ];

        return $response;
    }

    public function store(array $data): Store
    {
        $region = app()->make(Region::class);
        $region->fill($data);
        $region->save();
        return $region;
    }
}
