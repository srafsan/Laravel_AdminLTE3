<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Store extends Model
{
    use HasFactory;

    protected $guarded = ["id"];
    protected $table = "stores";

    public function regions(): BelongsToMany
    {
        return $this->belongsToMany(Region::class, 'region_stores', 'store_id', 'region_id');
    }
}
