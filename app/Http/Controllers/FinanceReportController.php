<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class FinanceReportController extends Controller
{
    public function export()
    {
        // Ambil data laporan
        $report = DB::table('transactions')
            ->join('products', 'transactions.product_uuid', '=', 'products.uuid')
            ->join('suppliers', 'transactions.supplier_id', '=', 'suppliers.id')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->select(
                'transactions.uuid as transaction_id',
                'products.nama as product_name',
                'suppliers.nama as supplier_name',
                'transactions.jenis_transaksi',
                'transactions.harga as price',
                'transactions.created_at as date'
            )
            ->orderBy('transactions.created_at', 'desc')
            ->get();

        // Ubah menjadi array untuk CSV
        $reportArray = $report->map(function ($row) {
            return [
                'Transaction ID' => $row->transaction_id,
                'Product' => $row->product_name,
                'Transaction Type' => $row->jenis_transaksi == 1 ? 'Penjualan' : 'Pembelian',
                'Price' => $row->price,
                'Date' => $row->date,
            ];
        })->toArray();

        // Tambahkan header CSV
        array_unshift($reportArray, array_keys($reportArray[0]));

        // Konversi array ke file CSV
        $filename = 'finance_report_' . now()->format('Y_m_d_His') . '.csv';
        $file = fopen('php://output', 'w');
        foreach ($reportArray as $row) {
            fputcsv($file, $row);
        }
        fclose($file);

        // Berikan respons unduh
        return Response::streamDownload(function () use ($file) {
            echo $file;
        }, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}