@extends('dashboard.layout.index')
@section('title', 'Transactions')
@section('content')

<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Dashboard /</span> Transactions
</h4>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Transactions List</h5>
        <a href="{{ route('transactions.create') }}" class="btn btn-sm btn-primary rounded-pill">+ Add Transaction</a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Product</th>
                    <th>Price & Amount</th>
                    <th>Status</th>
                    <th>Expiration Date</th>
                    <th>Proof of Transaction</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <!-- User and Transaction Type Icon -->
                    <td>
                        <span class="me-2">
                            @if($transaction->jenis_transaksi == 1)
                            <i class="bx bx-up-arrow-alt text-success"></i>
                            @else
                            <i class="bx bx-down-arrow-alt text-danger"></i>
                            @endif
                        </span>
                        {{ $transaction->user->name ?? 'N/A' }}
                    </td>

                    <!-- Product Name -->
                    <td>{{ $transaction->product->nama ?? $transaction->supplier->name ?? 'N/A' }}</td>

                    <!-- Combined Price and Amount -->
                    <td>
                        <div style="font-weight: bold; font-size: 1.1em;">
                            Rp {{ number_format($transaction->harga, 2) }}
                        </div>
                        <small style="color: #6c757d;">
                            {{ $transaction->jumlah }} months
                        </small>
                    </td>

                    <!-- Status -->
                    <td>
                        <span class="badge bg-label-{{ $transaction->status == 1 ? 'success' : 'warning' }}">
                            {{ $transaction->status == 1 ? 'Paid' : 'Pending' }}
                        </span>
                    </td>

                    <!-- Expiration Date with Conditional Styling -->
                    <td>
                        <span class="badge
                @if($transaction->expiration_status == 'expired') bg-danger
                @elseif($transaction->expiration_status == 'near_expiry') bg-warning
                @else bg-success
                @endif">
                            {{ $transaction->expiration_date->format('Y-m-d') }}
                        </span>
                    </td>

                    <!-- Proof of Transaction -->
                    <td>
                        @if($transaction->bukti_transaksi)
                        <a href="{{ $transaction->bukti_transaksi }}" target="_blank">View Proof</a>
                        @else
                        <span class="text-muted">No Proof</span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td>
                        <a href="{{ route('transactions.edit', $transaction->id) }}"
                            class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete this transaction?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
