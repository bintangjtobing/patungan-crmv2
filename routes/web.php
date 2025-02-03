<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KredentialCustomerController;
use App\Http\Controllers\MultiStepController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProfileReportController;
use App\Http\Controllers\FinanceReportController;
use App\Exports\FinanceReportExport;
use App\Helper\SendMessage;
use App\Http\Controllers\PaymentController;
use App\Models\KredentialCustomer;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Rekening;
use App\Models\Transaction;
use App\Models\User;
use App\Http\Controllers\CustomerTransactionController;

Route::get('/', function () {
    return redirect('/dashboard');
});
Route::get('/user/register', function(){
    return redirect('/register');
});
Route::get('/register', function () {
    $products = Product::where('status', 1)->distinct()->get();
    $rekenings = Rekening::where('bank', '!=', 'QRIS')->where('is_active', 1)->distinct()->get();


    // dd([
    //     'products' => $products,
    //     'rekenings' => $rekenings
    // ]);

    return view('fe.register', compact('products', 'rekenings'));
});

Route::post('/customer/transaction/create', [CustomerTransactionController::class, 'createTransaction']);

Route::get('/api/payment-data', function () {
    $products = Product::where('status', 1)->distinct()->get();
    $rekenings = Rekening::where('bank', '!=', ['QRIS'])->where('is_active', 1)->distinct()->get();

    return response()->json([
        'products' => $products,
        'rekenings' => $rekenings,
    ]);
});
// Routes for login and logout
Route::middleware(['guest'])->group(function () {
    // Route for showing the login form
    Route::get('/admin/login', function() {
        return view('dashboard.login.login');
    })->name('login.form');

    // Route for handling login submission
    Route::post('/admin/login', [LoginController::class, 'login'])->name('login');
});
Route::get('/api/order-statistics', [TransactionController::class, 'getOrderStatisticsData']);
Route::get('/api/dashboard-stats', function () {
    $totalIncome = DB::table('transactions')
        ->where('jenis_transaksi', 1) // Penjualan
        ->sum('harga');

    $totalExpenses = DB::table('transactions')
        ->where('jenis_transaksi', 0) // Pembelian
        ->sum('harga');

    $totalProfit = $totalIncome - $totalExpenses;

    $incomeTrend = DB::table('transactions')
    ->select(
        DB::raw("DATE_FORMAT(created_at, '%b') as month"),
        DB::raw('SUM(harga) as total')
    )
    ->where('jenis_transaksi', 1)
    ->groupBy(DB::raw("DATE_FORMAT(created_at, '%b'), DATE_FORMAT(created_at, '%Y-%m')"))
    ->orderBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
    ->pluck('total', 'month');

    $expensesThisWeek = DB::table('transactions')
        ->where('jenis_transaksi', 0)
        ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
        ->sum('harga');

    $expensesLastWeek = DB::table('transactions')
        ->where('jenis_transaksi', 0)
        ->whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
        ->sum('harga');

    $expenseDifference = $expensesThisWeek - $expensesLastWeek;

    return response()->json([
        'totalIncome' => $totalIncome,
        'totalExpenses' => $totalExpenses,
        'totalProfit' => $totalProfit,
        'incomeTrend' => $incomeTrend,
        'expensesThisWeek' => $expensesThisWeek,
        'expenseDifference' => $expenseDifference,
    ]);
});
Route::get('/api/growth-chart-data', function () {
    // Data yang akan dikirim ke chart
    $selectedYear = request('year', now()->year); // Default tahun ini
    $previousYear = $selectedYear - 1;

    // Ambil total pendapatan tahun berjalan
    $currentYearData = DB::table('transactions')
        ->where('jenis_transaksi', 1) // Hanya penjualan
        ->whereYear('created_at', $selectedYear)
        ->sum('harga');

    // Ambil total pendapatan tahun sebelumnya
    $previousYearData = DB::table('transactions')
        ->where('jenis_transaksi', 1) // Hanya penjualan
        ->whereYear('created_at', $previousYear)
        ->sum('harga');

    // Hitung persentase growth
    $growthPercentage = $previousYearData > 0
        ? round((($currentYearData - $previousYearData) / $previousYearData) * 100, 2)
        : 100;

    return response()->json([
        'selectedYear' => $selectedYear,
        'previousYear' => $previousYear,
        'growthPercentage' => $growthPercentage,
        'currentYearTotal' => $currentYearData,
        'previousYearTotal' => $previousYearData,
    ]);
})->name('api.growth-chart-data');

Route::get('/api/revenue-data', action: function (Request $request) {
    // Data tahun saat ini dan tahun sebelumnya
    $selectedYear = $request->query('year', now()->year); // Default ke tahun ini
    $previousYear = $selectedYear - 1;

    // Fetch data for current year using DB Query
    $currentYearData = DB::table('transactions')
        ->selectRaw("MONTH(created_at) as month, SUM(harga) as total")
        ->whereYear('created_at', $selectedYear)
        ->groupBy(DB::raw("MONTH(created_at)"))
        ->orderBy(DB::raw("MONTH(created_at)"))
        ->pluck('total', 'month')
        ->toArray();

    // Fetch data for previous year using DB Query
    $previousYearData = DB::table('transactions')
        ->selectRaw("MONTH(created_at) as month, SUM(harga) as total")
        ->whereYear('created_at', $previousYear)
        ->groupBy(DB::raw("MONTH(created_at)"))
        ->orderBy(DB::raw("MONTH(created_at)"))
        ->pluck('total', 'month')
        ->toArray();

    // Fill missing months with 0
    $formattedCurrentYearData = array_replace(array_fill(1, 12, 0), $currentYearData);
    $formattedPreviousYearData = array_replace(array_fill(1, 12, 0), $previousYearData);

    return response()->json([
        'selectedYear' => $selectedYear,
        'previousYear' => $previousYear,
        'currentYearData' => array_values($formattedCurrentYearData),
        'previousYearData' => array_values($formattedPreviousYearData),
    ]);
});
Route::post('/upload-payment-proof', action: [PaymentController::class, 'uploadPaymentProof']);

Route::get('/api/profile-report-stats', [ProfileReportController::class, 'getProfileReportStats']);


// Logout route available to authenticated users
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('products/price/{uuid}', [ProductController::class, 'getPriceByUuid']);
// Protected routes that require login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        // Ambil data email dan produk, hitung jumlah pengguna
        $kredentialCustomerCount = DB::table('kredential_customers')
        ->join('products', 'kredential_customers.product_uuid', '=', 'products.uuid')
        ->select('kredential_customers.email_akses', 'kredential_customers.product_uuid', DB::raw('COUNT(*) as user_count'), 'products.nama as product_name')
        ->groupBy('kredential_customers.email_akses', 'kredential_customers.product_uuid', 'products.nama')
        ->get();
        $selectedYear = request('year', now()->year); // Tahun yang dipilih
        $previousYear = $selectedYear - 1;

        // Revenue untuk tahun terpilih
        // Data untuk grafik
        $currentYearRevenue = DB::table('transactions')
        ->selectRaw("MONTH(created_at) as month, SUM(harga) as total")
        ->where('jenis_transaksi', 1) // Penjualan
        ->whereYear('created_at', $selectedYear)
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('total', 'month');

        $previousYearRevenue = DB::table('transactions')
            ->selectRaw("MONTH(created_at) as month, SUM(harga) as total")
            ->where('jenis_transaksi', 1) // Penjualan
            ->whereYear('created_at', $previousYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // Persentase pertumbuhan
        $currentTotal = $currentYearRevenue->sum();
        $previousTotal = $previousYearRevenue->sum();

        $growthPercentage = $previousTotal > 0
            ? round((($currentTotal - $previousTotal) / $previousTotal) * 100, 2)
            : ($currentTotal > 0 ? 100 : 0);

        // Format data grafik untuk frontend
        $currentYearData = array_fill(1, 12, 0);
        $previousYearData = array_fill(1, 12, 0);

        foreach ($currentYearRevenue as $month => $total) {
            $currentYearData[$month] = $total;
        }

        foreach ($previousYearRevenue as $month => $total) {
            $previousYearData[$month] = $total;
        }
        $currentMonth = now()->month; // Bulan berjalan
        $currentYear = now()->year; // Tahun berjalan

        // Total Pembelian (Payments) untuk bulan ini
        $currentMonthPayments = DB::table('transactions')
            ->where('jenis_transaksi', 0) // Pembelian
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('harga');

        // Total Pembelian (Payments) untuk bulan sebelumnya
        $previousMonthPayments = DB::table('transactions')
            ->where('jenis_transaksi', 0) // Pembelian
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth - 1)
            ->sum('harga');

        // Hitung Persentase Perubahan untuk Pembelian
        $paymentsPercentage = $previousMonthPayments > 0
            ? round((($currentMonthPayments - $previousMonthPayments) / $previousMonthPayments) * 100, 2)
            : ($currentMonthPayments > 0 ? 100 : 0);

        // Total Penjualan (Transactions) untuk bulan ini
        $currentMonthTransactions = DB::table('transactions')
            ->where('jenis_transaksi', 1) // Penjualan
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('harga');

        // Total Penjualan (Transactions) untuk bulan sebelumnya
        $previousMonthTransactions = DB::table('transactions')
            ->where('jenis_transaksi', 1) // Penjualan
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth - 1)
            ->sum('harga');

        // Hitung Persentase Perubahan untuk Penjualan
        $transactionsPercentage = $previousMonthTransactions > 0
            ? round((($currentMonthTransactions - $previousMonthTransactions) / $previousMonthTransactions) * 100, 2)
            : ($currentMonthTransactions > 0 ? 100 : 0);
        // Statistik Order
        $orderStatistics = DB::table('transactions')
            ->join('products', 'transactions.product_uuid', '=', 'products.uuid')
            ->select(
                'products.nama as product_name',
                DB::raw('COUNT(transactions.id) as total'),
                DB::raw('MAX(transactions.created_at) as latest_transaction')
            )
            ->where('transactions.jenis_transaksi', 1)
            ->groupBy('products.nama')
            ->orderBy('latest_transaction', 'DESC')
            ->get()
            ->toArray();

        // Total Penjualan
        $totalSales = DB::table('transactions')
            ->where('jenis_transaksi', 1)
            ->count();

        // Transaksi Terbaru
        $transactions = \App\Models\Transaction::with(['user', 'product', 'supplier'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Data Profile Report
        $year = now()->year; // Tahun laporan
        $incomeTrend = DB::table('transactions')
            ->selectRaw("DATE_FORMAT(created_at, '%b') AS month, SUM(harga) AS total")
            ->where('jenis_transaksi', 1)
            ->whereYear('created_at', $year)
            ->groupByRaw("DATE_FORMAT(created_at, '%b'), DATE_FORMAT(created_at, '%Y-%m')")
            ->orderByRaw("DATE_FORMAT(created_at, '%Y-%m') ASC")
            ->get();

        // Hitung total pendapatan
        $totalAmount = $incomeTrend->sum('total');

        // Hitung growth percentage
        $growthPercentages = [];
        $previousTotal = null;

        foreach ($incomeTrend as $data) {
            if ($previousTotal !== null) {
                $growthPercentage = (($data->total - $previousTotal) / $previousTotal) * 100;
                $growthPercentages[] = round($growthPercentage, 2);
            }
            $previousTotal = $data->total;
        }

        // Rata-rata growth percentage
        $growthPercentage = count($growthPercentages) > 0
            ? round(array_sum($growthPercentages) / count($growthPercentages), 2)
            : 0;

        // Format data untuk Profile Report
        $months = $incomeTrend->isNotEmpty() ? $incomeTrend->pluck('month')->toArray() : [];
        $trend = $incomeTrend->isNotEmpty() ? $incomeTrend->pluck('total')->toArray() : [];
        // Total users
        $totalUsers = User::count();

        // Users with active subscriptions (have credentials)
        $activeUsers = KredentialCustomer::distinct('user_id')->count('user_id');

        // Users without subscriptions (do not have credentials)
        $inactiveUsers = $totalUsers - $activeUsers;

        // Percentage of users still subscribed
        $retentionPercentage = $totalUsers > 0 ? round(($activeUsers / $totalUsers) * 100, 2) : 0;

        return view('dashboard.index', compact(
            'orderStatistics',
        'totalSales',
        'transactions',
        'year',
        'growthPercentage',
        'totalAmount',
        'months',
        'trend',
        'currentMonthPayments',
        'paymentsPercentage',
        'currentMonthTransactions',
        'transactionsPercentage',
        'currentYearRevenue',
        'previousYearRevenue',
        'growthPercentage',
        'selectedYear',
        'currentYearData',
        'previousYearData',
        'growthPercentage',
        'currentTotal',
        'previousTotal' ,
        'selectedYear',
        'previousYear',
        'kredentialCustomerCount',
        'totalUsers',
        'activeUsers',
        'inactiveUsers',
        'retentionPercentage',
        ));
    })->name('dashboard');


    Route::resource('rekenings', RekeningController::class);
    Route::resource('users', UserController::class);
    Route::resource('transactions', TransactionController::class);

    // Route for listing pending transactions
    Route::get('/payments', [TransactionController::class, 'listPending'])->name('transactions.pending');

    // Route for marking a transaction as paid
    Route::patch('/transactions/{transaction}/mark-paid', [TransactionController::class, 'markAsPaid'])->name('transactions.markPaid');

    Route::get('/expiry-transactions', function () {
        // Filter transaksi near expiry langsung di database
        $transactions = Transaction::with(['user', 'product', 'supplier'])
            ->get()
            ->filter(function ($transaction) {
                return $transaction->expiration_status == 'near_expiry';
            });

        // Buat array untuk transaksi yang valid
        $filteredTransactions = [];
        foreach ($transactions as $transaction) {
            $latestTransaction = Transaction::where('user_id', $transaction->user_id)
                ->where('jenis_transaksi', 1) // Penjualan
                ->where('status', 1) // Paid
                ->whereNotNull('bukti_transaksi') // Bukti transaksi ada
                ->whereDate('tanggal_waktu_transaksi_selesai', '>=', $transaction->expiration_date)
                ->first();

            // Tambahkan transaksi jika tidak ada transaksi terbaru
            if (!$latestTransaction) {
                $filteredTransactions[] = $transaction;
            }
        }

        return view('dashboard.transactions.exp', [
            'filteredTransactions' => $filteredTransactions
        ]);
    })->name('transactions.exp');
    Route::post('/expiry-transactions/send-reminder/{id}', function ($id) {
        $transaction = Transaction::with(['user', 'product'])->findOrFail($id);
        $sendMessage = new SendMessage();
    
        // Format pesan reminder pembayaran
        $message = "✨ *Reminder Pembayaran* ✨\n\n"
            . "Halo kak {$transaction->user->name}👋\n"
            . "Produk: *{$transaction->product->nama}*\n"
            . "Berakhir: *{$transaction->expiration_date->format('d M Y')}*\n\n"
            . "Segera perpanjang untuk 1 bulan berikutnya (*" . now()->format('F Y') . " - " . now()->addMonth()->format('F Y') . "*) dengan nominal *Rp " . number_format($transaction->harga, 0, ',', '.') . "*.\n\n"
            . "💳 *Transfer ke:*\n"
            . "- Dana: 081262845980\n"
            . "- BCA: 3831 2466 16\n"
            . "- SUPER BANK: 0000 2191 3645\n"
            . "- SeaBank: 9014 6720 8839\n"
            . "- QRIS: https://short.patunganyuk.com/qris\n\n"
            . "✨ Konfirmasi / kirim bukti pembayaran agar segera kami proses ya! Terima kasih. 🙏";
    
        // Kirim pesan reminder ke WhatsApp
        
        // Buat transaksi baru untuk perpanjangan
        $newTransaction = Transaction::create([
            'user_id' => $transaction->user->id,
            'product_uuid' => $transaction->product->uuid,
            'jumlah' => 1, // Perpanjangan 1 bulan
            'harga' => $transaction->harga,
            'status' => 0, // Status 0 karena masih menunggu pembayaran
            'jenis_transaksi' => 1, // 1 untuk penjualan
            'bukti_transaksi' => null, // Bukti transaksi kosong, harus diisi setelah pembayaran
            'description' => "Perpanjangan member dengan penjualan \"{$transaction->product->nama}\" untuk bulan " . 
            now()->translatedFormat('F') . 
            " hingga bulan " . 
            now()->addMonth()->translatedFormat('F'),
        ]);
        
        $sendMessage->send($transaction->user->no_hp, $message);
        return redirect()->back()->with('success', 'Reminder successfully sent and renewal transaction created.');
    })->name('transactions.sendReminder');
    Route::resource('products', ProductController::class);
    Route::resource('kredential_customers', KredentialCustomerController::class);

    Route::get('kredential_customers/user/{userId}/products', [KredentialCustomerController::class, 'getProductsForUser']);

    // Multi-step form routes
    Route::get('/multi-step-form', [MultiStepController::class, 'showForm'])->name('showMultiStepForm');
    Route::post('/multi-step-form', [MultiStepController::class, 'submitForm'])->name('submitMultiStepForm');

    Route::resource('suppliers', SupplierController::class);
    Route::get('/finance-report', function () {
        // Data transaksi yang dikelompokkan berdasarkan bulan
        $transactionsByMonth = Transaction::with(['product', 'supplier'])
            ->selectRaw("
                DATE_FORMAT(created_at, '%M %Y') AS month,
                jenis_transaksi,
                SUM(harga) AS total,
                uuid,
                COUNT(*) AS count,
                created_at
            ")
            ->groupByRaw("DATE_FORMAT(created_at, '%Y-%m'), jenis_transaksi, created_at, uuid")
            ->orderByRaw("DATE_FORMAT(created_at, '%Y-%m') DESC, created_at DESC")
            ->get();

        // Hitung total penjualan, pembelian, dan keuntungan
        $report = $transactionsByMonth->groupBy('month')->map(function ($group) {
            $sales = $group->where('jenis_transaksi', 1)->sum('total');
            $purchases = $group->where('jenis_transaksi', 0)->sum('total');
            $profit = $sales - $purchases;

            return [
                'sales' => $sales,
                'purchases' => $purchases,
                'profit' => $profit,
                'transactions' => $group
            ];
        });

        return view('dashboard.finance-report.index', compact('report'));
        // return response()->json( $transactionsByMonth);
    })->name('finance-report');
    Route::get('/finance-report/export', [FinanceReportController::class, 'export'])->name('finance-report.export');
    Route::get('/finance-report/export-excel', function () {
        return Excel::download(new FinanceReportExport, 'finance_report.xlsx');
    })->name('finance-report.export-excel');

});