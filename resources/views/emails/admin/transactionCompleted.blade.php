@extends('emails.layout')
@section('title', 'Transaksi Customer Disetujui!')
@section('content')
<p>Transaksi atas nama {{ $transaction->user->name ?? $listPayments->user->name }} untuk produk
    <strong>{{ $transaction->product->nama ?? $listPayments->product->nama }}</strong> telah disetujui.
</p>
<p><strong>Jumlah:</strong> {{ $transaction->jumlah ?? $listPayments->jumlah }}</p>
<p><strong>Harga:</strong> {{ 'IDR ' . number_format($transaction->harga ?? $listPayments->harga) }}</p>
<p>Terima kasih atas kepercayaanmu pada PatunganYUK IDN! Feedbackmu akan sangat membantu kami untuk terus meningkatkan
    kualitas layanan dan memberikan pengalaman patungan yang lebih baik untuk semua pengguna. Jangan lupa bagikan
    pendapatmu setelah satu minggu disini <a
        href="https://g.page/r/CSM658ow_9wxEBM/review">https://g.page/r/CSM658ow_9wxEBM/review</a> ya! ⭐<br><br>- Tim
    PatunganYuk
    IDN</p>
@endsection