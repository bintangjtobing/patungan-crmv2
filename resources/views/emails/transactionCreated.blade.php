@extends('emails.layout')

@section('title', 'Transaksi Berhasil Dibuat!')

@section('content')
<h2>Halo, {{ $customerName }}</h2>
<p>Selamat! Transaksi <strong>{{ $transactionType }}</strong> Anda telah berhasil dilakukan.</p>

<div class="transaction-details">
    <p><strong>Jenis Transaksi:</strong> {{ $transactionType }}</p>
    <p><strong>{{ $transactionType == 'Penjualan' ? 'Produk' : 'Supplier' }}:</strong> {{ $productOrSupplier }}</p>
    <p><strong>Jumlah:</strong> {{ $amount }}</p>
    <p><strong>Harga Total:</strong> Rp {{ number_format($price, 0, ',', '.') }}</p>
</div>
@endsection
