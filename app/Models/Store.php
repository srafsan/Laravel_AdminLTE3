<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Store extends Model
{
    use HasFactory;

    protected $table = "stores";
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function regions(): BelongsToMany
    {
        return $this->belongsToMany(Region::class, 'region_stores', 'store_id', 'region_id');
    }
}
