@extends('emails.layout')
@section('title', 'Pembayaran Anda Sedang Diverifikasi')
@section('content')
<p>Terima kasih telah melakukan pemesanan.<br>Pembayaran Anda untuk produk <strong>{{ $transaction->product->nama
        }}</strong> sedang diverifikasi.</p>
<div class="user-info">
    <p><strong>Jumlah:</strong> {{ $transaction->jumlah ?? 1 }} Bulan<br>
        <strong>Harga:</strong> {{ 'IDR ' . number_format($transaction->harga), 0 }}
    </p>
</div>
<p>Kami akan menghubungi Anda setelah verifikasi selesai.</p>
<p>Terima kasih atas kepercayaan Anda pada PatunganYUK IDN! Feedback Anda sangat penting bagi kami untuk terus
    meningkatkan kualitas layanan dan memberikan pengalaman patungan yang lebih baik untuk semua pengguna. Jangan lupa
    untuk memberikan pendapat Anda setelah satu minggu di sini: <a
        href="https://g.page/r/CSM658ow_9wxEBM/review">https://g.page/r/CSM658ow_9wxEBM/review</a> ⭐<br><br>- Tim
    PatunganYuk IDN</p>
@endsection