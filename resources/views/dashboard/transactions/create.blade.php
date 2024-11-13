@extends('dashboard.layout.index')
@section('title', 'Add New Transaction')
@section('content')

<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Dashboard /</span> Add New Transaction
</h4>

<div class="card mb-4">
    <h5 class="card-header">Transaction Details</h5>
    <div class="card-body">
        <form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- User -->
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="">Select a User</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Product -->
            <div class="mb-3">
                <label for="product_uuid" class="form-label">Product</label>
                <select name="product_uuid" id="product_uuid" class="form-select" required>
                    <option value="">Select a Product</option>
                    @foreach($products as $product)
                    <option value="{{ $product->uuid }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Transaction Type -->
            <div class="mb-3">
                <label for="jenis_transaksi" class="form-label">Transaction Type</label>
                <select name="jenis_transaksi" id="jenis_transaksi" class="form-select" required>
                    <option value="penjualan">Penjualan</option>
                    <option value="pembelian">Pembelian</option>
                </select>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"
                    placeholder="Enter description (optional)"></textarea>
            </div>

            <!-- Amount (Subscription Duration) -->
            <div class="mb-3">
                <label for="jumlah" class="form-label">Amount (months)</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control"
                    placeholder="Enter subscription duration in months" required>
            </div>

            <!-- Price -->
            <div class="mb-3">
                <label for="harga" class="form-label">Price</label>
                <input type="number" name="harga" id="harga" class="form-control" placeholder="Enter price" required>
            </div>

            <!-- Proof of Transaction -->
            <div class="mb-3">
                <label for="bukti_transaksi" class="form-label">Proof of Transaction</label>
                <input type="file" name="bukti_transaksi" id="bukti_transaksi" class="form-control" accept="image/*">
                <small class="form-text text-muted">Upload proof of transaction if available.</small>
            </div>

            <button type="submit" class="btn btn-primary">Create Transaction</button>
            <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection
