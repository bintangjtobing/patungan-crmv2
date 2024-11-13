@extends('dashboard.layout.index')
@section('title', 'Credentials List')
@section('content')

<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Dashboard /</span> Credentials List
</h4>
<div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">Credential Customers List</h5>
    <a href="{{ route('kredential_customers.create') }}" class="btn btn-sm btn-primary rounded-pill">+ Add
        Credential</a>
</div>
<div class="accordion mt-3" id="accordionExample">
    @foreach($groupedCredentials as $email => $credentials)
    <div class="card accordion-item">
        <h2 class="accordion-header" id="heading-{{ md5($email) }}">
            <button type="button" class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                data-bs-toggle="collapse" data-bs-target="#accordion-{{ md5($email) }}"
                aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="accordion-{{ md5($email) }}">
                {{ $email }}
            </button>
        </h2>

        <div id="accordion-{{ md5($email) }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User & Product</th>
                                <th>Profile Access</th>
                                <th>PIN</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($credentials as $credential)
                            <tr>
                                <td>
                                    <strong>{{ $credential->user->name ?? 'N/A' }}</strong><br>
                                    <span class="text-muted">{{ $credential->product->nama ?? 'N/A' }}</span>
                                </td>
                                <td style="max-width: 150px; white-space: normal;">
                                    {{ $credential->profil_akes ?? '-' }}
                                </td>
                                <td style="max-width: 100px; white-space: normal;">
                                    {{ $credential->pin ?? '-' }}
                                </td>
                                <td>
                                    <a href="{{ route('kredential_customers.edit', $credential->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('kredential_customers.destroy', $credential->id) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this credential?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
