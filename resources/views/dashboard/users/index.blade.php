@extends('dashboard.layout.index')
@section('title', 'Users List')
@section('content')

<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Dashboard/</span> Users List
</h4>
<!-- Statistik -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Users</h5>
                <p class="card-text">{{ $totalUsers }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Active Users</h5>
                <p class="card-text">{{ $activeUsers }}</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    @foreach($users as $user)
    <div class="col-lg-3 col-md-3 col-sm-6 mb-4">
        <div class="card text-center h-100">
            <div class="card-body">
                <!-- Profile Picture -->
                <div class="d-flex justify-content-center">
                    @if($user->profile_picture)
                    <img src="{{ $user->profile_picture }}" alt="Profile Picture" class="rounded-circle mb-3"
                        style="width: 80px; height: 80px; object-fit: cover;">
                    @else
                    <img src="https://res.cloudinary.com/dflafxsqp/image/upload/v1731524475/Man_Avatar_hxgato.gif"
                        alt="Default Avatar" class="rounded-circle mb-3"
                        style="width: 80px; height: 80px; object-fit: cover;">
                    @endif
                </div>

                <!-- User Name -->
                <h6 class="card-title mb-1">{{ $user->name }}</h6>
                <p class="text-muted small">{{ $user->username ?? 'N/A' }}</p>

                <!-- Email -->
                <p class="text-muted small mb-1">
                    <i class="bx bx-envelope"></i> {{ $user->email }}
                </p>

                <!-- WhatsApp -->
                <p class="text-muted small">
                    <i class="bx bxl-whatsapp"></i>
                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $user->no_hp) }}">
                        {{ preg_replace('/^0/', '62', $user->no_hp) }}
                    </a>
                </p>

                <!-- Status -->
                <p>
                    <span class="badge {{ $user->is_active == 'Active' ? 'bg-label-success' : 'bg-label-danger' }}">
                        {{ $user->is_active == 'Active' ? 'Active' : 'Inactive' }}
                    </span>
                </p>

                <!-- Subscription Start Date -->
                <p class="text-muted small mb-1">
                    <i class="bx bx-calendar"></i>
                    {{ $user->subscription_start_date ? $user->subscription_start_date->format('Y-m-d') : 'N/A' }}
                </p>

                <!-- Subscription Duration -->
                <p class="text-muted small">
                    <i class="bx bx-time"></i>
                    {{ $user->subscription_duration_months }} months
                </p>
            </div>

            <!-- Actions -->
            <div class="card-footer">
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary"
                    style="margin-right: 8px;">Edit</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit"
                        onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection