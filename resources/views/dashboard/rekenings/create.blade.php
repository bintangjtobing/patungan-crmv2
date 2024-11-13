@extends('dashboard.layout.index')
@section('title', 'Setting Rekening')
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Setting/</span> Add Rekening</h4>
<!-- Rekening Form Layout -->
<div class="col-xxl">
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Rekening Form</h5>
            <small class="text-muted float-end">Add or edit rekening details</small>
        </div>
        <div class="card-body">
            <form action="{{ route('rekenings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Name -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="name">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter account holder's name" required />
                    </div>
                </div>

                <!-- Bank -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="bank">Bank</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="bank" name="bank" placeholder="Enter bank name"
                            required />
                    </div>
                </div>

                <!-- Account Number -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="no_rek">Account Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_rek" name="no_rek"
                            placeholder="Enter account number" />
                    </div>
                </div>

                <!-- Type (Dropdown) -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="type">Payment Type</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="type" name="type" required>
                            <option value="" selected>Select an option</option>
                            <option value="bank">Bank</option>
                            <option value="emoney">E-Money</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>
                </div>

                <!-- Image Upload (only for QRIS type) -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="image">Upload Image</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" />
                        <small class="form-text text-muted">Only for QRIS payment type</small>
                    </div>
                </div>

                <!-- Active Status -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="is_active">Is Active</label>
                    <div class="col-sm-10">
                        <input type="checkbox" id="is_active" name="is_active" />
                        <small class="form-text text-muted">Set this as the active account</small>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
