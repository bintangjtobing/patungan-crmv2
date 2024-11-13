<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bank',
        'no_rek',
        'type',
        'image'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->is_active && $model->type !== 'emoney' && $model->type !== 'qris') {
                static::where('is_active', true)
                    ->where('id', '!=', value: $model->id)
                    ->where('type', '!=', 'emoney')
                    ->where('type', '!=', 'qris')
                    ->update(['is_active' => false]);
            }
        });
    }

}