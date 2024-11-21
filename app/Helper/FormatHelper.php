<?php
namespace App\Helpers;

class FormatHelper
{
    public static function formatRupiahShort($angka)
    {
        if ($angka >= 1000000000) {
            return 'Rp ' . number_format($angka / 1000000000, 1) . 'M';
        } elseif ($angka >= 1000000) {
            return 'Rp ' . number_format($angka / 1000000, 1) . 'Jt';
        } elseif ($angka >= 1000) {
            return 'Rp ' . number_format($angka / 1000, 1) . 'K';
        }
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}