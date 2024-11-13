@extends('dashboard.layout.index')
@section('title', 'List Payments')
@section('content')

<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Dashboard /</span> List Payments
</h4>

<div class="card">
    <h5 class="card-header">Pending Transactions</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Product</th>
                    <th>Transaction Type</th>
                    <th>Amount</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingTransactions as $transaction)
                <tr>
                    <td>{{ $transaction->user->name ?? 'N/A' }}</td>
                    <td>{{ $transaction->product->nama ?? 'N/A' }}</td>
                    <td>{{ $transaction->jenis_transaksi == 1 ? 'Penjualan' : 'Pembelian' }}</td>
                    <td>{{ $transaction->jumlah }} months</td>
                    <td>{{ number_format($transaction->harga, 2) }}</td>
                    <td><span class="badge bg-label-warning">Pending</span></td>
                    <td>
                        <form action="{{ route('transactions.markPaid', $transaction->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-success"
                                onclick="return confirm('Mark this transaction as paid?')">Mark as Paid</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
