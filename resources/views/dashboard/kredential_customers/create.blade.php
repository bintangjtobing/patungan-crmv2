@extends('dashboard.layout.index')
@section('title', 'Add Customer Credential')
@section('content')

<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Dashboard /</span> Add Customer Credential
</h4>

<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('kredential_customers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    <option value="">Select a User</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="product_uuid" class="form-label">Product</label>
                <select class="form-control" id="product_uuid" name="product_uuid" required>
                    <option value="">Select a Product</option>
                    <!-- Options will be dynamically loaded based on the selected user -->
                </select>
            </div>

            <div class="mb-3">
                <label for="email_akses" class="form-label">Email Access</label>
                <input type="text" class="form-control" id="email_akses" name="email_akses" required>
            </div>

            <div class="mb-3">
                <label for="profil_akes" class="form-label">Profile Access</label>
                <input type="text" class="form-control" id="profil_akes" name="profil_akes">
            </div>

            <div class="mb-3">
                <label for="pin" class="form-label">PIN</label>
                <input type="text" class="form-control" id="pin" name="pin">
            </div>

            <button type="submit" class="btn btn-primary">Create Credential</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const userSelect = document.getElementById('user_id');
        const productSelect = document.getElementById('product_uuid');

        userSelect.addEventListener('change', function () {
            const userId = this.value;

            // Clear existing options in product dropdown
            productSelect.innerHTML = '<option value="">Select a Product</option>';

            if (userId) {
                // Fetch products for the selected user
                fetch(`/kredential_customers/user/${userId}/products`)
                    .then(response => response.json())
                    .then(products => {
                        products.forEach(product => {
                            const option = document.createElement('option');
                            option.value = product.uuid;
                            option.textContent = product.nama;
                            productSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching products:', error));
            }
        });
    });
</script>

@endsection
