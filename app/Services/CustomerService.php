<?php

namespace App\Services;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CustomerService
{
    public function getCustomerList(Carbon $startTime): array
    {
        $data = Customer::all();

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
        $customer = app()->make(Customer::class);
        $customer->fill($data);
        $customer->save();
        return $customer;
    }

    public function validator(Request $request): \Illuminate\Validation\Validator
    {
        $data = $request->all();
        $rules = [
            "name" => "required | string",
            "email" => "required | string",
            "address" => "required | string",
            "phone_number" => "required | string"
        ];

        return Validator::make($data, $rules);
    }
}
