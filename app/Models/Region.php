<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Region extends Model
{
    use HasFactory;

    protected $guarded = ["id"];
    protected $table = "regions";

    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class, 'region_stores', 'region_id', 'store_id');
    }
}
