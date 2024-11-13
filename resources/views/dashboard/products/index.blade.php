@extends('dashboard.layout.index')
@section('title', 'Products')
@section('content')

<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Dashboard /</span> Products
</h4>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Product List</h5>
        <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary rounded-pill">+ Add Product</a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>S/L</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <!-- Product Name with Image (if available) -->
                    <td>
                        @if($product->url_image)
                        <img src="{{ $product->url_image }}" alt="{{ $product->nama }}" width="50" height="50"
                            class="me-2" />
                        @endif
                        {{ $product->nama }}
                    </td>

                    <!-- Combined Selling and Buying Price with Profit Calculation -->
                    <td>
                        <div>
                            <span class="text-success">
                                <i class="bx bx-up-arrow-alt"></i> Rp {{ number_format($product->harga_jual, 2) }}
                            </span><br>
                            <span class="text-danger">
                                <i class="bx bx-down-arrow-alt"></i> Rp {{ number_format($product->harga_beli, 2) }}
                            </span><br>
                            <small class="text-muted">
                                Keuntungan: Rp {{ number_format($product->harga_jual - $product->harga_beli, 2) }}
                            </small>
                        </div>
                    </td>

                    <!-- Product Type -->
                    <td>{{ $product->type }}</td>

                    <!-- Actions -->
                    <td>
                        <a href="{{ route('products.edit', $product->uuid) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('products.destroy', $product->uuid) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection
