@extends('dashboard.layout.index')
@section('title', 'Setting Rekening')
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Setting/</span> Rekening</h4>
<div class="container">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Rekening List</h5>
            <!-- Small Add Rekening Button -->
            <a href="{{ route('rekenings.create') }}" class="btn btn-sm btn-primary rounded-pill">+ Add Rekening</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead class="align-middle">
                    <tr>
                        <th class="py-3">Name</th>
                        <th class="py-3">Bank</th>
                        <th class="py-3">Account Number</th>
                        <th class="py-3">Type</th>
                        <th class="py-3">Status</th>
                        <th class="py-3">Image</th>
                        <th class="py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($rekenings as $rekening)
                    <tr>
                        <td class="py-3"><strong>{{ $rekening->name }}</strong></td>
                        <td class="py-3">{{ $rekening->bank }}</td>
                        <td class="py-3">{{ $rekening->no_rek ?? 'N/A' }}</td>
                        <td class="py-3">
                            @if($rekening->type === 'bank')
                            <span class="badge bg-label-primary">Bank</span>
                            @elseif($rekening->type === 'emoney')
                            <span class="badge bg-label-success">E-Money</span>
                            @elseif($rekening->type === 'qris')
                            <span class="badge bg-label-info">QRIS</span>
                            @else
                            <span class="badge bg-label-secondary">Unknown</span>
                            @endif
                        </td>
                        <td class="py-3">
                            @if($rekening->is_active)
                            <span class="badge bg-label-success">Active</span>
                            @else
                            <span class="badge bg-label-warning">Inactive</span>
                            @endif
                        </td>
                        <td class="py-3">
                            @if($rekening->image)
                            <img src="{{ $rekening->image }}" alt="Image" class="rounded" width="50" height="50" />
                            @else
                            N/A
                            @endif
                        </td>
                        <td class="py-3">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('rekenings.edit', $rekening->id) }}">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('rekenings.destroy', $rekening->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item" type="submit"
                                            onclick="return confirm('Are you sure?')">
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
</div>
@endsection
