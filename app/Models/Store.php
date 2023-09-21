<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Store extends BaseModel
{
    /**
     * @var string
     */
    protected $table = "stores";
    /**
     * @var string[]
     */
    protected $guarded = BaseModel::COMMON_GUARDED_FIELDS_SIMPLE_SOFT_DELETE;

    /**
     * @return BelongsToMany
     */
    public function regions(): BelongsToMany
    {
        return $this->belongsToMany(Region::class, 'region_stores', 'store_id', 'region_id');
    }
}
