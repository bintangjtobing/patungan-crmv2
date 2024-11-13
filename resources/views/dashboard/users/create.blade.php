@extends('dashboard.layout.index')
@section('title', 'Add New User')
@section('content')

<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Dashboard/</span> Add New User
</h4>

<div class="card mb-4">
    <h5 class="card-header">User Profile Details</h5>
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Profile Picture -->
            <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4">
                <img src="{{ asset('default-avatar.png') }}" alt="user-avatar" class="d-block rounded" height="100"
                    width="100" id="uploadedAvatar" />
                <div class="button-wrapper">
                    <label for="profile_picture" class="btn btn-primary me-2 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">Upload new photo</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input type="file" id="profile_picture" name="profile_picture" class="account-file-input" hidden
                            accept="image/png, image/jpeg" />
                    </label>
                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4" id="resetImage">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
                    </button>
                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                </div>
            </div>

            <div class="row">
                <!-- Username -->
                <div class="mb-3 col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                        placeholder="Enter username" />
                </div>

                <!-- Name -->
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name"
                        required />
                </div>

                <!-- Address -->
                <div class="mb-3 col-md-6">
                    <label for="alamat" class="form-label">Address</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Enter address" />
                </div>

                <!-- Email -->
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"
                        required />
                </div>

                <!-- Phone Number -->
                <div class="mb-3 col-md-6">
                    <label for="no_hp" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Enter phone number"
                        required />
                </div>

                <!-- Type (User or Customer) -->
                <div class="mb-3 col-md-6">
                    <label class="form-label">Type</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="type_user" value="0">
                        <label class="form-check-label" for="type_user">User</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="type_customer" value="1" checked>
                        <label class="form-check-label" for="type_customer">Customer</label>
                    </div>
                </div>

                <!-- Is Active -->
                <div class="mb-3 col-md-6">
                    <label class="form-label">Is Active</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active">
                        <label class="form-check-label" for="is_active">Set as active</label>
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-3 col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter password" required />
                </div>

                <!-- Confirm Password -->
                <div class="mb-3 col-md-6">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirm password" required />
                </div>
            </div>

            <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Create User</button>
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
