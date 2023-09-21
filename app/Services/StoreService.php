<?php

namespace App\Services;

use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 *
 */
class StoreService
{
    /**
     * @param Carbon $startTime
     * @return array
     */
    public function getStoreList(Carbon $startTime): array
    {
        $data = Store::with('regions')->get();

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

    public function store(array $data): mixed
    {
        $stores = app()->make(Store::class);
        $stores->fill($data);
        $stores->save();
        $stores->regions()->attach($data['region']);
        return $stores;
    }

    public function validator(Request $request): \Illuminate\Validation\Validator
    {
        $data = $request->all();
        $rules = [
            "name" => "required | string",
            "region" => "required | integer",
        ];

        return Validator::make($data, $rules);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    public function filterValidator(Request $request): \Illuminate\Validation\Validator
    {
        $data = $request->all();
        $rules = [
            "name" => "required | string"
        ];

        return Validator::make($data, $rules);
    }
}
