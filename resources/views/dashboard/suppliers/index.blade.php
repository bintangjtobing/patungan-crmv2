@extends('dashboard.layout.index')
@section('title', 'Suppliers')
@section('content')

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Suppliers List</h5>
        <a href="{{ route('suppliers.create') }}" class="btn btn-sm btn-primary rounded-pill">+ Add Suppliers</a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact Email</th>
                    <th>Contact Phone</th>
                    <th>Website</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->contact_email }}</td>
                    <td>{{ $supplier->contact_phone }}</td>
                    <td>
                        @if($supplier->website)
                        <a href="{{ $supplier->website }}" target="_blank">{{ $supplier->website }}</a>
                        @else
                        N/A
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $supplier->is_active ? 'success' : 'secondary' }}">
                            {{ $supplier->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('suppliers.edit', $supplier->uuid) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('suppliers.destroy', $supplier->uuid) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete this supplier?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
