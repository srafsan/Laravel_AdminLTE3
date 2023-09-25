<?php

namespace App\Services;

use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StoreService
{
    /**
     * @param Carbon $startTime
     * @return array
     */
    public function getStoreList(Carbon $startTime): array
    {
        $data = Store::select('id', 'name', 'contact_number', 'description')
                ->with(['regions' => function($query) {
                    $query->select('city', 'country');
                }])
                ->get();

        // remove the pivot key from each item in the collection
        $data->each(function($store) {
            $store->regions->each(function ($region) {
                unset($region->pivot);
            });
        });

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
     * @param array $data
     * @return Store
     * @throws BindingResolutionException
     */
    public function store(array $data): Store
    {
        $store = app()->make(Store::class);
        $store->fill($data);
        $store->save();
        $store->regions()->attach($data['region']);
        return $store;
    }

    /**
     * @param Store $store
     * @param array $data
     * @return Store
     */
    public function update(Store $store, array $data): Store
    {
        $store->fill($data);
        $store->update();
        $store->regions()->sync($data['region']);
        return $store;
    }

    /**
     * @param Store $store
     * @return bool
     */
    public function destroy(Store $store): bool
    {
        $store->regions()->detach();
        return $store->delete();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    public function validator(Request $request): \Illuminate\Validation\Validator
    {
        $data = $request->all();
        $rules = [
            "name" => "required | string",
            "contact_number" => "required | string",
            "description" => "required | string",
            "region" => "required | string",
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
