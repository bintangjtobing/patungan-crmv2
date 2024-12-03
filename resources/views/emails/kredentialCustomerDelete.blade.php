@extends('emails.layout')
@section('title', 'Akses anda telah dibuat!')
@section('content')
<h2>Halo, {{ $customerName }}</h2>
<p>Akses Anda untuk produk <strong>{{ $productName }}</strong> telah dihapus.</p>
<div class="credentials">
    <p><strong>Email Akses:</strong> {{ $emailAkses }}<br><strong>Profil Akses:</strong> {{ $profileAkses
        }}<br><strong>PIN / Password Akses:</strong> {{ $pinAkses }}</p>
</div>
@endsection
