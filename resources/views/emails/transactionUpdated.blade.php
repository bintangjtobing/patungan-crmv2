@extends('emails.layout')

@section('title', 'Transaksi Anda Telah Diperbarui!')

@section('content')
<h2>Halo, {{ $customerName }}</h2>
<p>Detail transaksi <strong>{{ $transactionType }}</strong> Anda telah diperbarui.</p>

<div class="transaction-details">
    <p><strong>Jenis Transaksi:</strong> {{ $transactionType }}</p>
    <p><strong>{{ $transactionType == 'Penjualan' ? 'Produk' : 'Supplier' }}:</strong> {{ $productOrSupplier }}</p>
    <p><strong>Jumlah:</strong> {{ $amount }}</p>
    <p><strong>Harga Total:</strong> Rp {{ number_format($price, 0, ',', '.') }}</p>
</div>
@endsection
