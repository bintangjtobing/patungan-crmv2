@extends('emails.layout')
@section('title', 'Transaksi Anda Telah Selesai.')
@section('content')
<h2>Halo {{ $transaction->user->name ?? $listPayments->user->name }},</h2>
<p>Transaksi Anda telah selesai! Terima kasih telah berlangganan produk <strong>{{ $transaction->product->nama ??
        $listPayments->product->nama }}</strong>.</p>
<p><strong>Jumlah:</strong> {{ $transaction->jumlah ?? $listPayments->jumlah }} Bulan<br>
    <strong>Harga:</strong> {{ 'IDR ' . number_format($transaction->harga ?? $listPayments->harga) }}
</p>
@endsection
