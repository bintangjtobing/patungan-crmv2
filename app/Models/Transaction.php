<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;

class Transaction extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_transaksi',
        'product_uuid',
        'supplier_uuid',
        'description',
        'jumlah',
        'harga',
        'tanggal_waktu_transaksi_selesai',
        'status',
        'bukti_transaksi',
        'uuid'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            // if (is_null($transaction->tanggal_waktu_transaksi_selesai)) {
            //     $transaction->tanggal_waktu_transaksi_selesai = Carbon::now()->setTimezone('Asia/Jakarta');
            // }
            $transaction->uuid = (string) Uuid::uuid4();
        });
    }

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
    public function getExpirationDateAttribute()
    {
        return Carbon::parse($this->updated_at)->addMonths($this->jumlah);
    }

    public function getExpirationStatusAttribute()
    {
        $expirationDate = $this->expiration_date;
        $daysToExpire = Carbon::now()->diffInDays($expirationDate, false);

        if ($daysToExpire <= 0) {
            return 'expired';
        } elseif ($daysToExpire <= 5) {
            return 'near_expiry';
        }

        return 'valid';
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_uuid', 'uuid');
    }
}