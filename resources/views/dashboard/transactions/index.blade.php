@extends('dashboard.layout.index')
@section('title', 'Transactions')
@section('content')


<div class="card-header d-flex align-items-center justify-content-between">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> Transactions
    </h4>
    <a href="{{ route('transactions.create') }}" class="btn btn-sm btn-primary rounded-pill">+ Add transaction</a>
</div>

<div class="accordion" id="transactionsAccordion">
    @foreach ($groupedTransactions as $groupKey => $group)
    <div class="accordion-item">
        <!-- Accordion Header -->
        <h2 class="accordion-header" id="heading-{{ Str::slug($groupKey) }}">
            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse-{{ Str::slug($groupKey) }}" aria-expanded="true"
                aria-controls="collapse-{{ Str::slug($groupKey) }}">
                <strong>{{ $groupKey }}</strong>&nbsp; ({{ count($group) }} Transactions)
            </button>
        </h2>

        <!-- Accordion Body -->
        <div id="collapse-{{ Str::slug($groupKey) }}" class="accordion-collapse collapse"
            aria-labelledby="heading-{{ Str::slug($groupKey) }}" data-bs-parent="#transactionsAccordion">
            <div class="accordion-body table-responsive">
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
                        @foreach ($group as $transaction)
                        <tr>
                            <!-- User and Transaction Type Icon -->
                            <td>
                                <span class="me-2">
                                    @if ($transaction->jenis_transaksi == 1)
                                    <i class="bx bx-up-arrow-alt text-success"></i>
                                    @else
                                    <i class="bx bx-down-arrow-alt text-danger"></i>
                                    @endif
                                </span>
                                {{ $transaction->user->name ?? 'N/A' }}
                            </td>

                            <!-- Product Name -->
                            <td>{{ $transaction->product->nama ?? ($transaction->supplier->name ?? 'N/A') }}</td>

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
                        @if ($transaction->expiration_status == 'expired') bg-danger
                        @elseif($transaction->expiration_status == 'near_expiry') bg-warning
                        @else bg-success @endif">
                                    {{ $transaction->expiration_date->format('Y-m-d') }}
                                </span>
                            </td>

                            <!-- Proof of Transaction -->
                            <td>
                                @if ($transaction->bukti_transaksi)
                                <a href="{{ $transaction->bukti_transaksi }}" target="_blank">View
                                    Proof</a>
                                @else
                                <span class="text-muted">No Proof</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td>
                                <a href="{{ route('transactions.edit', $transaction->id) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
