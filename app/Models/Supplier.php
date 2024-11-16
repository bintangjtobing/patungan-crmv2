<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Supplier extends Model
{
    use HasFactory;
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'uuid',
        'name',
        'contact_email',
        'contact_phone',
        'address',
        'website',
        'is_active',
    ];

    // Automatically generate UUID when creating a new supplier
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($supplier) {
            $supplier->uuid = (string) Uuid::uuid4();
        });
    }
}