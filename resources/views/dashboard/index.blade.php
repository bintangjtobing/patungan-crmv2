@extends('dashboard.layout.index')
@section('title', 'Dashboard homepage')
@php
if (!function_exists('formatRupiahShort')) {
function formatRupiahShort($angka) {
if ($angka >= 1000000000) {
// Format ke M (Miliar)
return 'Rp ' . number_format($angka / 1000000000, 1) . 'M';
} elseif ($angka >= 1000000) {
// Format ke Jt (Juta)
return 'Rp ' . number_format($angka / 1000000, 1) . 'Jt';
} elseif ($angka >= 1000) {
// Format ke K (Ribu)
return 'Rp ' . number_format($angka / 1000, 1) . 'K';
}
return 'Rp ' . number_format($angka, 0, ',', '.');
}
}
@endphp
@section('content')
<div class="col-lg-8 mb-4 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-7">
                <div class="card-body">
                    <h5 class="card-title text-primary">Congratulations {{ Auth::user()->name }}! 🎉</h5>
                    <p class="mb-4">
                        You have done <span class="fw-bold">{{ $growthPercentage }}%</span> more sales this month.
                        Check your finance report to see details.<br />
                        Currently, there are <span class="fw-bold">{{ $totalUsers }}</span> users in total, and
                        <span class="fw-bold">{{ $inactiveUsers }}</span> users are no longer subscribed.
                        <span class="fw-bold">{{ $retentionPercentage }}%</span> of users are still subscribed.
                    </p>

                    <a href="/finance-report" class="btn btn-sm btn-outline-primary">View
                        Finance Reports</a>
                </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                    <img src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}" height="140"
                        alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                        data-app-light-img="illustrations/man-with-laptop-light.png" />
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-4 order-1">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <!-- Rocket icon centered and enlarged -->
                    <div class="mb-0">
                        <video class="rounded" style="width: 120px; height: 120px;" autoplay muted playsinline loop>
                            <source src="{{ asset('assets/img/Rocket.webm') }}" type="video/webm">
                            <source src="{{ asset('assets/img/Rocket.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <span class="fw-semibold d-block mb-3" style="font-size: 1.2em;">Fast Create</span>

                    <!-- Animated button with glowing shadow -->
                    <button class="btn btn-primary w-100 animated-btn" data-bs-toggle="modal"
                        data-bs-target="#confirmTransferModal" style="box-shadow: 0px 0px 10px rgba(255, 165, 0, 0.8);">
                        Start
                    </button>
                </div>
            </div>
        </div>

        <!-- Confirmation Modal -->
        <div class="modal fade" id="confirmTransferModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Transfer Proof</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Has the customer sent the transfer proof?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a href="{{ route('showMultiStepForm') }}" class="btn btn-primary">Yes, Proceed</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Total Revenue -->
<div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
        <div class="row row-bordered g-0">
            <div class="col-md-8">
                <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
                <div id="totalRevenueChart" class="px-2"></div>
            </div>
            <div class="col-md-4">
                <div class="card-body">
                    <div class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{ $selectedYear }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                <a class="dropdown-item"
                                    href="{{ route('dashboard', ['year' => $selectedYear - 1]) }}">{{ $selectedYear - 1
                                    }}</a>
                                <a class="dropdown-item" href="{{ route('dashboard', ['year' => $selectedYear]) }}">{{
                                    $selectedYear }}</a>

                            </div>
                        </div>
                    </div>
                </div>
                <div id="growthChart"></div>
                <div class="text-center fw-semibold pt-3 mb-2">{{ $growthPercentage }}% Growth</div>

                <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                    <div class="d-flex">
                        <div class="me-2">
                            <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                        </div>
                        <div class="d-flex flex-column">
                            <small>{{ $selectedYear }}</small>
                            <h6 class="mb-0">{{ formatRupiahShort($currentTotal) }}</h6>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="me-2">
                            <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                        </div>
                        <div class="d-flex flex-column">
                            <small>{{ $previousYear }}</small>
                            <h6 class="mb-0">{{ formatRupiahShort($previousTotal) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Total Revenue -->
<div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
    <div class="row">
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                <a class="dropdown-item" href="/finance-report">View
                                    More</a>
                            </div>
                        </div>
                    </div>
                    <span class="d-block mb-1">Pembelian</span>
                    <h3 class="card-title text-nowrap mb-2">Rp {{ number_format($currentMonthPayments, 0, ',', '.') }}
                    </h3>
                    <small class="{{ $paymentsPercentage >= 0 ? 'text-success' : 'text-danger' }} fw-semibold">
                        <i class="bx {{ $paymentsPercentage >= 0 ? 'bx-up-arrow-alt' : 'bx-down-arrow-alt' }}"></i>
                        {{ $paymentsPercentage }}%
                    </small>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                <a class="dropdown-item" href="/finance-report">View
                                    More</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Penjualan</span>
                    <h3 class="card-title mb-2">Rp {{ number_format($currentMonthTransactions, 0, ',', '.') }}</h3>
                    <small class="{{ $transactionsPercentage >= 0 ? 'text-success' : 'text-danger' }} fw-semibold">
                        <i class="bx {{ $transactionsPercentage >= 0 ? 'bx-up-arrow-alt' : 'bx-down-arrow-alt' }}"></i>
                        {{ $transactionsPercentage }}%
                    </small>
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h5 class="text-nowrap mb-2">Profile Report</h5>
                                <span class="badge bg-label-warning rounded-pill">Year {{ $year }}</span>
                            </div>
                            <div class="mt-sm-auto">
                                <small class="text-success text-nowrap fw-semibold">
                                    <i class="bx bx-chevron-up"></i> {{ $growthPercentage }}%
                                </small>
                                <h3 class="mb-0">Rp {{ number_format($totalAmount, 0, ',', '.') }}</h3>
                            </div>
                        </div>
                        <div id="profileReportChart"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<div class="row">
    <!-- Order Statistics -->
    <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
        <div class="card h-auto">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Order Statistics</h5>
                    <small class="text-muted">{{ $totalSales }} Total Sales</small>

                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                </div>
                <ul class="p-0 m-0">
                    @foreach($orderStatistics as $stat)
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            @php
                            $iconClass = match($stat->product_name) {
                            'Netflix DUO', 'Netflix Sharing', 'Netflix Personal Private' => 'bx bx-tv',
                            'Spotify Premium' => 'bx bx-headphone',
                            'Youtube Premium' => 'bx bx-play-circle',
                            'Prime Video' => 'bx bx-film',
                            'ChatGPT+' => 'bx bx-brain',
                            'Microsoft Office 365 Sharing' => 'bx bx-file',
                            'HBO GO', 'Disney+ Hotstar', 'WeTV VIP' => 'bx bx-movie',
                            default => 'bx bx-box' // Default icon
                            };
                            @endphp
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="{{ $iconClass }}"></i>
                            </span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">{{ $stat->product_name }}</h6> <!-- Perbaikan di sini -->
                                <small class="text-muted">Total Orders</small>
                            </div>
                            <div class="user-progress">
                                <small class="fw-semibold">{{ $stat->total }} Orders</small> <!-- Perbaikan di sini -->
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
    <!--/ Order Statistics -->

    <!-- Expense Overview -->
    <div class="col-md-6 col-lg-4 order-1 mb-4">
        <div class="card h-auto">
            <div class="card-body px-0">
                <div class="tab-content p-0">
                    <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                        <div class="d-flex p-4 pt-3">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="../assets/img/icons/unicons/wallet.png" alt="User" />
                            </div>
                            <div>
                                <small class="text-muted d-block">Total Balance</small>
                                <div class="d-flex align-items-center">
                                    <h6 id="totalBalance" class="mb-0 me-1">$0.00</h6>
                                    <small id="balanceChange" class="text-success fw-semibold">
                                        <i class="bx bx-chevron-up"></i> 0.0%
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div id="incomeChart"></div>
                        <div class="d-flex justify-content-center pt-4 gap-1">
                            <div id="expensesOfWeek"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Expense Overview -->

    <!-- Transactions -->
    <div class="col-md-6 col-lg-4 order-2 mb-4">
        <div class="card h-auto">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">Transactions</h5>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                        <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                        <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                        <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    @foreach($transactions as $transaction)
                    @php
                    $iconClass = match($transaction->product->nama ?? $transaction->supplier->name) {
                    'Netflix DUO', 'Netflix Sharing', 'Netflix Personal Private' => 'bx bx-tv',
                    'Spotify Premium' => 'bx bx-headphone',
                    'Youtube Premium' => 'bx bx-play-circle',
                    'Prime Video' => 'bx bx-film',
                    'ChatGPT+' => 'bx bx-brain',
                    'Microsoft Office 365 Sharing' => 'bx bx-file',
                    'HBO GO', 'Disney+ Hotstar', 'WeTV VIP' => 'bx bx-movie',
                    default => 'bx bx-box' // Default icon
                    };
                    @endphp
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="{{ $iconClass }}"></i>
                            </span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="text-muted d-block mb-1">
                                    {{ $transaction->product->nama ?? $transaction->supplier->name ?? 'Unknown' }}
                                </small>
                                <h6 class="mb-0">{{ $transaction->description ?? 'Transaction' }}</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                                <h6
                                    class="mb-0 {{ $transaction->jenis_transaksi == 1 ? 'text-success' : 'text-danger' }}">
                                    {{ $transaction->jenis_transaksi == 1 ? '+' : '-' }}Rp
                                    {{ number_format($transaction->harga, 2, ',', '.') }}
                                </h6>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 order-3 mb-4">
        <div class="card h-auto">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Order Statistics</h5>
                    <small class="text-muted">{{ $kredentialCustomerCount->count() }} Total Records</small>
                </div>
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    @foreach($kredentialCustomerCount as $stat)
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="bx bx-user"></i>
                            </span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">{{ $stat->email_akses }}</h6>
                                <small class="text-muted">{{ $stat->product_name ?? 'Unknown Product' }}</small>

                            </div>
                            <div class="user-progress">
                                <small class="fw-semibold">{{ $stat->user_count }} Users</small>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection