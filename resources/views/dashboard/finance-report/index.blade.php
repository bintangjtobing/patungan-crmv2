@extends('dashboard.layout.index')
@section('title', 'Finance Report')
@section('content')

<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Dashboard /</span> Finance Report
</h4>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Finance Report</h5>
        <div class="d-flex gap-2">
            <a href="{{ route('finance-report.export') }}"
                class="btn btn-warning btn-sm d-flex align-items-center gap-1">
                <i class="bx bx-download"></i>
                Download as CSV
            </a>
            <a href="{{ route('finance-report.export-excel') }}"
                class="btn btn-success btn-sm d-flex align-items-center gap-1">
                <i class="bx bx-file"></i>
                Download as Excel
            </a>
        </div>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Product</th>
                    <th class="text-center">Type</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Transaction Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report as $month => $data)
                <tr>
                    <td colspan="5" style="background-color: #d3d3d3" class="text-right fw-bold">Periode: {{ $month }}
                    </td>
                </tr>
                @foreach($data['transactions'] as $transaction)
                <tr>
                    <td>{{ $transaction->uuid }}</td>
                    <td>{{ $transaction->product ? $transaction->product->nama : 'N/A' }}</td>
                    <td class="text-center">
                        <span class="badge bg-label-{{ $transaction->jenis_transaksi == 1 ? 'success' : 'primary' }}">
                            {{ $transaction->jenis_transaksi == 1 ? 'Penjualan' : 'Pembelian' }}
                        </span>
                    </td>
                    <td class="text-end">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                    <td class="text-end">
                        {{ $transaction->created_at ? $transaction->created_at->format('Y-m-d H:i:s') : 'N/A' }}
                    </td>
                </tr>
                @endforeach
                <tr class="bg-" style="background-color:#dbe5d8">
                    <td colspan="3" class="text-end fw-bold">Total Penjualan:</td>
                    <td colspan="2" class="text-end"><b>Rp {{ number_format($data['sales'], 0, ',', '.') }}</b></td>
                </tr>
                <tr class="bg-" style="background-color:#d8e4e5">
                    <td colspan="3" class="text-end fw-bold">Total Pembelian:</td>
                    <td colspan="2" class="text-end"><b>Rp {{ number_format($data['purchases'], 0, ',', '.') }}</b></td>
                </tr>
                <tr class="{{ $data['profit'] < 0 ? 'bg-danger text-white' : '' }}"
                    style="background-color: {{ $data['profit'] >= 0 ? '#aef1a8' : '#ff6961' }}">
                    <td colspan="3" class="text-end fw-bold">Profit:</td>
                    <td colspan="2" class="text-end"><b>Rp {{ number_format($data['profit'], 0, ',', '.') }}</b></td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection