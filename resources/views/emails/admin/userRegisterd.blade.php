@extends('emails.layout')
@section('title', 'User baru telah mendaftar di platform PatunganYuk!')
@section('content')
    <h2>Notifikasi untuk Admin</h2>
    <p>Seorang pengguna baru telah mendaftar di platform. Berikut adalah detailnya:</p>
    <div class="user-info">
        <p><strong>Nama:</strong> {{ $customerName }}</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Produk Terdaftar:</strong> {{ $productName }}</p>
    </div>
    <p>Silakan ambil tindakan yang diperlukan untuk mengelola pengguna baru ini.</p>
@endsection
