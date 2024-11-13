@extends('dashboard.layout.index')
@section('title', 'Users List')
@section('content')

<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Dashboard/</span> Users List
</h4>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">User Details</h5>
        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary rounded-pill">+ Add User</a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($users as $user)
                <tr>

                    <!-- Username -->
                    <td>@if($user->profile_picture)
                        <img src="{{ $user->profile_picture }}" alt="Profile Picture" class="avatar avatar-xs pull-up"
                            style="object-fit: cover;">
                        @else
                        <img src="https://res.cloudinary.com/dflafxsqp/image/upload/v1731524475/Man_Avatar_hxgato.gif"
                            alt="Default Avatar" class="avatar avatar-xs pull-up">
                        @endif
                        <strong>{{ $user->name }}</strong>
                        <small class="text-muted">{{ $user->username ?? 'N/A' }}</small>
                    </td>
                    <!-- Email -->
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $user->no_hp) }}">{{ preg_replace('/^0/',
                            '62', $user->no_hp) }}</a>
                    </td>

                    <!-- Type -->
                    <td>
                        @if($user->type == 1)
                        <span class="badge bg-label-info">Customer</span>
                        @else
                        <span class="badge bg-label-primary">User</span>
                        @endif
                    </td>

                    <!-- Status -->
                    <td>
                        @if($user->is_active)
                        <span class="badge bg-label-success">Active</span>
                        @else
                        <span class="badge bg-label-warning">Inactive</span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item" type="submit"
                                        onclick="return confirm('Are you sure you want to delete this user?')">
                                        <i class="bx bx-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
