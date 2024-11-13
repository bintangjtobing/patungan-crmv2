<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\Product;
use App\Models\User;

class ListPayments extends BaseModel
{
    use HasFactory;
    protected $table = 'transactions';

    protected $fillable = [
        'tanggal_waktu_transaksi_selesai',
    ];

    public function getModifiedTransactionDateAttribute()
    {
        return Carbon::parse($this->tanggal_waktu_transaksi_selesai)->addMonth()->format('Y-m-d');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_uuid', 'uuid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}