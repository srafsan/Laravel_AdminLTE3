<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends BaseModel
{
    /**
     * @var string
     */
    protected $table = "products";
    /**
     * @var string[]
     */
    protected $guarded = BaseModel::COMMON_GUARDED_FIELDS_SIMPLE_SOFT_DELETE;

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_products', 'product_id', 'category_id');
    }
}
