<?php

namespace App\Models;

class Customer extends BaseModel
{
    protected $table = "customers";
    protected $guarded = BaseModel::COMMON_GUARDED_FIELDS_SIMPLE_SOFT_DELETE;
}
