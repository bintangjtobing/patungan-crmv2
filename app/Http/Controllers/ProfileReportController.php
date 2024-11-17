<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileReportController extends Controller
{
    public function getProfileReportStats()
    {
        $year = now()->year;

        // Ambil data pendapatan bulanan
        $incomeTrend = DB::table('transactions')
            ->selectRaw("DATE_FORMAT(created_at, '%b') AS month, SUM(harga) AS total")
            ->where('jenis_transaksi', 1)
            ->whereYear('created_at', $year)
            ->groupByRaw("DATE_FORMAT(created_at, '%b'), DATE_FORMAT(created_at, '%Y-%m')")
            ->orderByRaw("DATE_FORMAT(created_at, '%Y-%m') ASC")
            ->get();

        // Hitung total pendapatan
        $totalIncome = $incomeTrend->sum('total');

        // Hitung growth percentage bulan ke bulan
        $growthPercentages = [];
        $previousTotal = null;

        foreach ($incomeTrend as $index => $data) {
            if ($previousTotal !== null) {
                $growthPercentage = (($data->total - $previousTotal) / $previousTotal) * 100;
                $growthPercentages[] = round($growthPercentage, 2);
            }
            $previousTotal = $data->total;
        }

        // Rata-rata growth percentage
        $averageGrowthPercentage = count($growthPercentages) > 0
            ? round(array_sum($growthPercentages) / count($growthPercentages), 2)
            : 0;

        // Format data untuk respon API
        $months = $incomeTrend->pluck('month')->toArray();
        $trend = $incomeTrend->pluck('total')->toArray();

        return response()->json([
            'year' => $year,
            'growthPercentage' => $averageGrowthPercentage, // Rata-rata growth percentage
            'totalAmount' => $totalIncome,
            'trend' => $trend,
            'months' => $months,
        ]);
    }

}