@extends('dashboard.layout.index')
@section('title', 'Edit Transaction')
@section('content')

<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Dashboard /</span> Edit Transaction
</h4>

<div class="card mb-4">
    <h5 class="card-header">Edit Transaction Details</h5>
    <div class="card-body">
        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- User -->
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $transaction->user_id == $user->id ? 'selected' : '' }}>{{
                        $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Product -->
            <div class="mb-3">
                <label for="product_uuid" class="form-label">Product</label>
                <select name="product_uuid" id="product_uuid" class="form-select" required>
                    @foreach($products as $product)
                    <option value="{{ $product->uuid }}" {{ $transaction->product_uuid == $product->uuid ? 'selected' :
                        '' }}>{{ $product->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Transaction Type -->
            <div class="mb-3">
                <label for="jenis_transaksi" class="form-label">Transaction Type</label>
                <select name="jenis_transaksi" id="jenis_transaksi" class="form-select" required>
                    <option value="1" {{ $transaction->jenis_transaksi == 1 ? 'selected' : '' }}>Penjualan</option>
                    <option value="0" {{ $transaction->jenis_transaksi == 0 ? 'selected' : '' }}>Pembelian</option>
                </select>
            </div>


            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description"
                    class="form-control">{{ $transaction->description }}</textarea>
            </div>

            <!-- Amount (Subscription Duration) -->
            <div class="mb-3">
                <label for="jumlah" class="form-label">Amount (months)</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ $transaction->jumlah }}"
                    required>
            </div>

            <!-- Price -->
            <div class="mb-3">
                <label for="harga" class="form-label">Price</label>
                <input type="number" name="harga" id="harga" class="form-control" value="{{ $transaction->harga }}"
                    required>
            </div>

            <!-- Proof of Transaction -->
            <div class="mb-3">
                <label for="bukti_transaksi" class="form-label">Proof of Transaction</label>
                @if($transaction->bukti_transaksi)
                <p><a href="{{ $transaction->bukti_transaksi }}" target="_blank">View Existing Proof</a></p>
                @endif
                <input type="file" name="bukti_transaksi" id="bukti_transaksi" class="form-control" accept="image/*">
                <small class="form-text text-muted">Upload a new proof of transaction to replace the existing
                    one.</small>
            </div>

            <button type="submit" class="btn btn-primary">Update Transaction</button>
            <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection
