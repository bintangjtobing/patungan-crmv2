<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class FinanceReportExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Transaction::join('products', 'transactions.product_uuid', '=', 'products.uuid')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->select(
                'transactions.uuid as transaction_id',
                'products.nama as product_name',
                DB::raw("CASE WHEN transactions.jenis_transaksi = 1 THEN 'Penjualan' ELSE 'Pembelian' END as transaction_type"),
                'transactions.harga as price',
                'transactions.created_at as date'
            )
            ->orderBy('transactions.created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return ['Transaction ID', 'Product', 'Transaction Type', 'Price', 'Date'];
    }
}