@extends('dashboard.layout.index')
@section('title', 'Edit Rekening')
@section('content')

<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Setting/</span> Edit Rekening
</h4>

<div class="col-xxl">
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Rekening</h5>
            <small class="text-muted float-end">Edit rekening details</small>
        </div>
        <div class="card-body">
            <form action="{{ route('rekenings.update', $rekening->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="name">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="{{ $rekening->name }}"
                            placeholder="Enter account holder's name" required />
                    </div>
                </div>

                <!-- Bank -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="bank">Bank</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="bank" name="bank" value="{{ $rekening->bank }}"
                            placeholder="Enter bank name" required />
                    </div>
                </div>

                <!-- Account Number -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="no_rek">Account Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_rek" name="no_rek"
                            value="{{ $rekening->no_rek }}" placeholder="Enter account number" />
                    </div>
                </div>

                <!-- Type (Dropdown) -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="type">Payment Type</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="type" name="type" required>
                            <option value="bank" {{ $rekening->type === 'bank' ? 'selected' : '' }}>Bank</option>
                            <option value="emoney" {{ $rekening->type === 'emoney' ? 'selected' : '' }}>E-Money</option>
                            <option value="qris" {{ $rekening->type === 'qris' ? 'selected' : '' }}>QRIS</option>
                        </select>
                    </div>
                </div>

                <!-- Image Upload (only for QRIS type) -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="image">Upload Image</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" />
                        <small class="form-text text-muted">Only for QRIS payment type</small>
                        @if($rekening->image)
                        <img src="{{ $rekening->image }}" alt="Current Image" class="mt-2" width="100" height="100" />
                        @endif
                    </div>
                </div>

                <!-- Active Status -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="is_active">Is Active</label>
                    <div class="col-sm-10">
                        <input type="checkbox" id="is_active" name="is_active" {{ $rekening->is_active ? 'checked' : ''
                        }} />
                        <small class="form-text text-muted">Set this as the active account</small>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('rekenings.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
