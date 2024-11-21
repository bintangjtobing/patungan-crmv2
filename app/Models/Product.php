<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use App\Models\Transaction;

class Product extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'uuid',
        'nama',
        'harga_jual',
        'harga_beli',
        'type',
        'description',
        'url_image',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->uuid = (string) Uuid::uuid4();
        });
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('uuid', 'asc');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'product_uuid', 'uuid');
    }
    public function kredentialCustomers()
    {
        return $this->hasMany(KredentialCustomer::class, 'product_uuid', 'uuid');
    }

}
