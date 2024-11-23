@extends('emails.layout')
@section('title', 'Akses anda telah dibuat!')
@section('content')
<h2>Halo, {{ $customerName }}</h2>
<p>Selamat! Akses Anda untuk produk <strong>{{ $productName }}</strong> telah berhasil dibuat.</p>
<div class="credentials">
    <p><strong>Email Akses:</strong> {{ $emailAkses }}</p>
    <p><strong>Profil Akses:</strong> {{ $profileAkses }}</p>
    <p><strong>PIN / Password Akses:</strong> {{ $pinAkses }}</p>
</div>
@endsection
