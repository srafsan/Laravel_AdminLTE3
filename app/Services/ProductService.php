<?php

namespace App\Services;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 *
 */
class ProductService
{
    /**
     * @param Carbon $startTime
     * @return array
     */
    public function getProductList(Carbon $startTime): array
    {
        $data = Product::select('name', 'description', 'price', 'inventory')
                ->with('categories:name')
                ->get();

        // remove the pivot key from each item in the collection
        $data->each(function($product){
            $product->categories->each(function($category) {
                unset($category->pivot);
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
     * @return Product
     * @throws BindingResolutionException
     */
    public function store(array $data): Product
    {
        $product = app()->make(Product::class);
        $product->fill($data);
        $product->save();
        $product->categories()->attach($data['category']);
        return $product;
    }

    /**
     * @param Product $product
     * @param array $data
     * @return Product
     */
    public function update(Product $product, array $data): Product
    {
        $product->fill($data);
        $product->update();
        $product->categories()->attach($data['category']);
        return $product;
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function destroy(Product $product): bool
    {
        $product->categories()->detach();
        return $product->delete();
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
            "description" => "required | string",
            "price" => "required | integer",
            "inventory" => "required | integer",
            "category" => "required | integer"
        ];

        return Validator::make($data, $rules);
    }
}
