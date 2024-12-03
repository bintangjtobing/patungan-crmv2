@extends('emails.layout')

@section('title', 'Transaksi Anda Telah Dihapus!')

@section('content')
<h2>Halo, {{ $customerName }}</h2>
<p>Transaksi <strong>{{ $transactionType }}</strong> Anda telah berhasil dihapus dari sistem kami.</p>
@endsection
