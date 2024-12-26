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

            <!-- Transaction Type -->
            <div class="mb-3">
                <label for="jenis_transaksi" class="form-label">Transaction Type</label>
                <select name="jenis_transaksi" id="jenis_transaksi" class="form-select" required>
                    <option value="">Select Transaction Type</option>
                    <option value="1">Penjualan</option> <!-- 1 for penjualan -->
                    <option value="0">Pembelian</option> <!-- 0 for pembelian -->
                </select>
            </div>

            <!-- User (only visible for Penjualan) -->
            <div class="mb-3" id="user_section" style="display: none;">
                <label for="user_id" class="form-label">User</label>
                <select name="user_id" id="user_id" class="form-select select2">
                    <option value="">Select a User</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Product (only visible for Penjualan) -->
            <div class="mb-3" id="product_section" style="display: none;">
                <label for="product_uuid" class="form-label">Product</label>
                <select name="product_uuid" id="product_uuid" class="form-select" onchange="updatePrice(this)">
                    <option value="">Select a Product</option>
                    @foreach($products as $product)
                    <option value="{{ $product->uuid }}">{{ $product->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Supplier (only visible for Pembelian) -->
            <div class="mb-3" id="supplier_section" style="display: none;">
                <label for="supplier_uuid" class="form-label">Supplier</label>
                <select name="supplier_uuid" id="supplier_uuid" class="form-select">
                    <option value="">Select a Supplier</option>
                    @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->uuid }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Amount (Subscription Duration for Penjualan only) -->
            <div class="mb-3" id="amount_section" style="display: none;">
                <label for="jumlah" class="form-label">Amount (months)</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control"
                    placeholder="Enter subscription duration in months">
            </div>

            <!-- Price -->
            <div class="mb-3">
                <label for="harga" class="form-label">Price</label>
                <input type="number" name="harga" id="harga" class="form-control" placeholder="Enter price" required>
            </div>

            <!-- Proof of Transaction (Only for Penjualan) -->
            <div class="mb-3" id="proof_section" style="display: none;">
                <label for="bukti_transaksi" class="form-label">Proof of Transaction</label>
                <input type="file" name="bukti_transaksi" id="bukti_transaksi" class="form-control" accept="image/*">
                <small class="form-text text-muted">Upload proof of transaction if available.</small>
            </div>

            <button type="submit" class="btn btn-primary">Create Transaction</button>
            <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>

<script>
    document.getElementById('jenis_transaksi').addEventListener('change', function() {
        var transactionType = this.value;
        document.getElementById('user_section').style.display = transactionType === '1' ? 'block' : 'none';
        document.getElementById('product_section').style.display = transactionType === '1' ? 'block' : 'none';
        document.getElementById('proof_section').style.display = transactionType === '1' ? 'block' : 'none';
        document.getElementById('amount_section').style.display = transactionType === '1' ? 'block' : 'none';
        document.getElementById('supplier_section').style.display = transactionType === '0' ? 'block' : 'none';
    });
    function updatePrice(productSelect) {
        var productUuid = productSelect.value;
        if (productUuid) {
            // Assuming you have a route 'products.price' that returns the price of a product by its UUID
            fetch(`/products/price/${productUuid}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('harga').value = data.harga_jual;
                })
                .catch(error => console.error('Error fetching price:', error));
        } else {
            document.getElementById('harga').value = ''; // Clear the price field if no product is selected
        }
    }
</script>

@endsection