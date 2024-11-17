@extends('dashboard.layout.index')
@section('title', 'Add Supplier')
@section('content')

<h4 class="fw-bold py-3 mb-4">Add New Supplier</h4>

<div class="card">
    <div class="card-body">
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="contact_email" class="form-label">Contact Email</label>
                <input type="email" class="form-control" id="contact_email" name="contact_email">
            </div>
            <div class="mb-3">
                <label for="contact_phone" class="form-label">Contact Phone</label>
                <input type="text" class="form-control" id="contact_phone" name="contact_phone">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="website" class="form-label">Website</label>
                <input type="url" class="form-control" id="website" name="website">
            </div>
            <div class="form-check mb-3">
                <!-- Add a hidden field for unchecked value -->
                <input type="hidden" name="is_active" value="0">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1">
                <label class="form-check-label" for="is_active">Active</label>
            </div>
            <button type="submit" class="btn btn-primary">Save Supplier</button>
        </form>
    </div>
</div>

@endsection
