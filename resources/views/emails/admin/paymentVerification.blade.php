@extends('emails.layout')
@section('title', 'Menunggu Konfirmasi Pembayaran')
@section('content')
    <p>User <strong>{{$user->name}}</strong> telah melakukan pembayaran dan saat ini sedang menunggu konfirmasi.</p>
    <div class="user-info">
        <p><strong>Durasi:</strong> {{ $transaction->jumlah ?? 1 }} Bulan<br>
            <strong>Harga:</strong> {{ 'IDR ' . number_format($transaction->harga, 0) }}</p>
    </div>
    <p>Mohon segera lakukan tindakan untuk user ini</p>
@endsection
