@extends('emails.layout')
@section('title', 'Akses anda telah dibuat!')
@section('content')
<h2>Halo, {{ $customerName }}</h2>
<p>Akses Anda untuk produk <strong>{{ $productName }}</strong> telah diperbarui.</p>
<div class="credentials">
    <p><strong>Email Akses:</strong> {{ $emailAkses }}</p>
    <p><strong>Profil Akses:</strong> {{ $profileAkses }}</p>
    <p><strong>PIN / Password Akses:</strong> {{ $pinAkses }}</p>
</div>
<p>Jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut, jangan ragu untuk membalas email ini.</p>
<p>Terima kasih atas kepercayaan Anda pada PatunganYuk IDN! Feedback Anda sangat berarti bagi kami untuk terus
    meningkatkan kualitas layanan kami dan memberikan pengalaman patungan yang lebih baik untuk semua pengguna. Jangan
    lupa bagikan pendapat Anda setelah satu minggu melalui tautan berikut: <a
        href="https://g.page/r/CSM658ow_9wxEBM/review">https://g.page/r/CSM658ow_9wxEBM/review</a> ⭐<br><br>- Tim
    PatunganYuk IDN</p>
@endsection