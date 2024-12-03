@extends('emails.layout')
@section('title', 'Selamat Datang Di Platform PatunganYukIDN')
@section('content')
<h2>Halo {{ $user->name }}!</h2>
<p>Terima kasih telah mendaftar dengan kami. Kami sangat senang menyambut Anda di platform kami.</p>
<p>Berikut adalah detail akun Anda:</p>
<div class="user-info">
    <p><strong>Email:</strong> {{ $user->email }}<br>
        <strong>Password:</strong> {{ $plainPassword }}
    </p>
    <p style="text-align: center; margin-top: 35px">
        <a href="{{ url('/') }}" class="button"
            style="background-color:#052349; color:#f2d518; padding: 15px; border-radius: .25rem; text-decoration:none;">Login
            ke Aplikasi</a>
    </p>
</div>
<p>Terima kasih atas kepercayaan Anda pada PatunganYuk IDN! Feedback Anda sangat penting bagi kami untuk terus
    meningkatkan kualitas layanan dan memberikan pengalaman patungan yang lebih baik untuk semua pengguna. Jangan lupa
    untuk memberikan pendapat Anda setelah satu minggu di sini: <a
        href="https://g.page/r/CSM658ow_9wxEBM/review">https://g.page/r/CSM658ow_9wxEBM/review</a> ⭐<br><br>- Tim
    PatunganYuk IDN</p>
@endsection
