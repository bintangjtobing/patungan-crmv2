@extends('emails.layout')

@section('title', 'Transaksi Berhasil Dibuat!')

@section('content')
<h2>Halo, {{ $customerName }}</h2>
<p>Selamat! Transaksi <strong>{{ $transactionType }}</strong> Anda telah berhasil dilakukan.</p>

<div class="transaction-details">
    <p><strong>Jenis Transaksi:</strong> {{ $transactionType }}<br><strong>{{ $transactionType == 'Penjualan' ?
            'Supplier' : 'Produk' }}:</strong> {{ $productOrSupplier }}<br><strong>Jumlah:</strong> {{ $amount
        }}<br><strong>Harga Total:</strong> Rp {{ number_format($price, 0, ',', '.') }}</p>
</div>
@endsection
