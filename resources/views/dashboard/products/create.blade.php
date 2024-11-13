@extends('dashboard.layout.index')
@section('title', 'Add Product')
@section('content')

<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Dashboard /</span> Add Product
</h4>

<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Name</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="harga_jual" class="form-label">Selling Price</label>
                <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
            </div>
            <div class="mb-3">
                <label for="harga_beli" class="form-label">Buying Price</label>
                <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <input type="text" class="form-control" id="type" name="type" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="url_image" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="url_image" name="url_image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</div>

@endsection
