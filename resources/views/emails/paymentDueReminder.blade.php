@extends('emails.layout')
@section('title', 'Pengingat Jatuh Tempo Pembayaran')
@section('content')
<h2>Halo {{ $transaction->user->name }},</h2>
<p>Ini adalah pengingat bahwa pembayaran untuk transaksi <strong>{{ $transaction->product->nama }}</strong> akan jatuh
    tempo pada <strong>{{ \Carbon\Carbon::parse($transaction->due_date)->format('d M Y') }}</strong>.</p>
<p>Pastikan Anda melakukan pembayaran tepat waktu untuk menghindari denda atau penangguhan layanan.</p>
@endsection
