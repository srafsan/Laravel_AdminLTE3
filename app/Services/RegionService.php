<?php

namespace App\Services;

use App\Models\Region;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RegionService
{
    /**
     * @param Carbon $startTime
     * @return array
     */
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

    /**
     * @throws BindingResolutionException
     */
    public function store(array $data)
    {
        $region = app()->make(Region::class);
        $region->fill($data);
        $region->save();

        return $region;
    }

    /**
     * @param Region $region
     * @param array $data
     * @return Region
     */
    public function update(Region $region, array $data): Region
    {
        $region->fill($data);
        $region->update();
        return $region;
    }

    /**
     * @param Region $region
     * @return bool
     */
    public function destroy(Region $region): bool
    {
        $region->stores()->detach();
        return $region->delete();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    public function validator(Request $request): \Illuminate\Validation\Validator
    {
        $data = $request->all();
        $rules = [
            "city" => "required | string",
            "country" => "required | string"
        ];

        return Validator::make($data, $rules);
    }
}
