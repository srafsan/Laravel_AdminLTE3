<?php

namespace App\Services;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CategoryService
{
    public function getCategoryList(Carbon $startTime): array
    {
        $data = Category::with('products')->get();

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
        $category = app()->make(Category::class);
        $category->fill($data);
        $category->save();
        return $category;
    }

    public function update(Category $category, array $data): Category
    {
        $category->fill($data);
        $category->update();
        return $category;
    }

    public function destroy(Category $category): bool
    {
        $category->products()->detach();
        return $category->delete();
    }

    public function validator(Request $request): \Illuminate\Validation\Validator
    {
        $data = $request->all();
        $rules = [
            "name" => "required | string"
        ];

        return Validator::make($data, $rules);
    }
}
