@extends('emails.layout')
@section('title', 'Pengingat Jatuh Tempo Pembayaran')
@section('content')
<h2>Halo {{ $transaction->user->name }},</h2>
<p>Ini adalah pengingat bahwa pembayaran untuk transaksi <strong>{{ $transaction->product->nama }}</strong> akan jatuh
    tempo pada <strong>{{ \Carbon\Carbon::parse($transaction->due_date)->format('d M Y') }}</strong>.</p>
<p>Pastikan Anda melakukan pembayaran tepat waktu untuk menghindari denda atau penangguhan layanan.</p>
<p>Terima kasih atas kepercayaan Anda pada PatunganYuk IDN! Feedback Anda sangat berarti bagi kami untuk terus
    meningkatkan kualitas layanan kami dan memberikan pengalaman patungan yang lebih baik untuk semua pengguna. Jangan
    lupa bagikan pendapat Anda setelah satu minggu melalui tautan berikut: <a
        href="https://g.page/r/CSM658ow_9wxEBM/review">https://g.page/r/CSM658ow_9wxEBM/review</a> ⭐<br><br>- Tim
    PatunganYuk IDN</p>
@endsection