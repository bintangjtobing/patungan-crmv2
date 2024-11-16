@extends('emails.layout')
@section('title', 'Transaksi Anda Telah Selesai.')
@section('content')
<h2>Halo {{ $transaction->user->name ?? $listPayments->user->name }},</h2>
<p>Transaksi Anda telah selesai! Terima kasih telah berlangganan produk <strong>{{ $transaction->product->nama ??
        $listPayments->product->nama }}</strong>.</p>
<p><strong>Jumlah:</strong> {{ $transaction->jumlah ?? $listPayments->jumlah }} Bulan<br>
    <strong>Harga:</strong> {{ 'IDR ' . number_format($transaction->harga ?? $listPayments->harga) }}
</p>
<p>Terima kasih atas kepercayaan Anda pada PatunganYuk IDN! Feedback Anda sangat berarti bagi kami untuk terus
    meningkatkan kualitas layanan kami dan memberikan pengalaman patungan yang lebih baik untuk semua pengguna. Jangan
    lupa bagikan pendapat Anda setelah satu minggu melalui tautan berikut: <a
        href="https://g.page/r/CSM658ow_9wxEBM/review">https://g.page/r/CSM658ow_9wxEBM/review</a> ⭐<br><br>- Tim
    PatunganYuk IDN
</p>
@endsection