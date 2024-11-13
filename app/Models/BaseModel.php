<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BaseModel extends Model
{
    protected static function booted()
    {
        static::addGlobalScope('created_at_desc', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }
}