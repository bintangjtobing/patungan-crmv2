@extends('emails.layout')
@section('title', 'Verifikasi Email')

@section('content')
{{-- <h2>Verifikasi Email</h2> --}}
<p>Silakan verifikasi email dengan klik tombol di bawah ini.</p>

@component('mail::button', ['url' => $url])
Verifikasi
@endcomponent

<p><strong>E-mail ini dibuat otomatis, mohon tidak membalas. Jika ada kendala, silakan hubungi <a
            href="mailto:info@patunganyuk.com">Admin patunganYuk</a>.</strong></p>

<p>Terima kasih atas kepercayaan Anda pada PatunganYUK IDN! Feedback Anda sangat penting bagi kami untuk terus
    meningkatkan kualitas layanan dan memberikan pengalaman patungan yang lebih baik untuk semua pengguna. Jangan lupa
    untuk memberikan pendapat Anda setelah satu minggu di sini: <a
        href="https://g.page/r/CSM658ow_9wxEBM/review">https://g.page/r/CSM658ow_9wxEBM/review</a> ⭐</p>

<p>- Tim PatunganYuk IDN</p>
@endsection