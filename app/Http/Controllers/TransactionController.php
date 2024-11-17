<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the transactions.
     */
    public function index()
    {
        $transactions = Transaction::with(['user', 'product', 'supplier'])
        ->orderBy('created_at', 'desc')
        ->get();

        // Grouping berdasarkan bulan dan tahun
        $groupedTransactions = $transactions->groupBy(function ($item) {
            return $item->created_at->format('F Y'); // Contoh: "November 2024"
        });
        notify()->success('Transactions loaded successfully!', 'Success');
        return view('dashboard.transactions.index', compact('groupedTransactions'));
    }

    /**
     * Show the form for creating a new transaction.
     */
    public function create()
    {
        $users = User::all();
        $products = Product::all();
        $suppliers = Supplier::all();
        notify()->info('Ready to create a new transaction!', 'Info');
        return view('dashboard.transactions.create', compact('users', 'products', 'suppliers'));
    }

    /**
     * Store a newly created transaction in storage.
     */
    public function store(Request $request)
    {
        $isPenjualan = $request->jenis_transaksi == 1;

        $rules = [
            'jenis_transaksi' => 'required|in:0,1',
            'harga' => 'required|integer',
        ];

        if ($isPenjualan) {
            $rules['user_id'] = 'required|exists:users,id';
            $rules['product_uuid'] = 'required|exists:products,uuid';
            $rules['jumlah'] = 'required|integer';
            $rules['bukti_transaksi'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } else {
            $rules['supplier_uuid'] = 'required|exists:suppliers,uuid';
        }

        $request->validate($rules);

        $data = $request->only([
            'jenis_transaksi',
            'harga',
            'description',
        ]);

        if ($isPenjualan) {
            $data['user_id'] = $request->user_id;
            $data['product_uuid'] = $request->product_uuid;
            $data['jumlah'] = $request->jumlah;
            $data['status'] = $request->hasFile('bukti_transaksi') ? 1 : 0;

            if ($request->hasFile('bukti_transaksi')) {
                try {
                    $uploadedFileUrl = Cloudinary::upload($request->file('bukti_transaksi')->getRealPath())->getSecurePath();
                    $data['bukti_transaksi'] = $uploadedFileUrl;
                } catch (\Exception $e) {
                    Log::error('File upload error:', ['message' => $e->getMessage()]);
                    notify()->error('File upload failed. Please try again.', 'Error');
                    return redirect()->back();
                }
            }
        } else {
            $data['user_id'] = auth()->id();
            $data['supplier_uuid'] = $request->supplier_uuid;
            $data['status'] = 1;
        }

        Transaction::create($data);
        notify()->success('Transaction created successfully!', 'Success');

        return redirect()->route('transactions.index');
    }

    /**
     * Show the form for editing the specified transaction.
     */
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $users = User::all();
        $products = Product::all();
        notify()->info('Edit the transaction details below.', 'Info');
        return view('dashboard.transactions.edit', compact('transaction', 'users', 'products'));
    }

    /**
     * Update the specified transaction in storage.
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis_transaksi' => 'required|boolean',
            'product_uuid' => 'required|exists:products,uuid',
            'description' => 'nullable|string',
            'jumlah' => 'required|integer',
            'harga' => 'required|integer',
            'tanggal_waktu_transaksi_selesai' => 'nullable|date',
            'bukti_transaksi' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->only([
            'user_id',
            'jenis_transaksi',
            'product_uuid',
            'description',
            'jumlah',
            'harga',
            'tanggal_waktu_transaksi_selesai'
        ]);

        if ($request->hasFile('bukti_transaksi')) {
            if ($transaction->bukti_transaksi) {
                $publicId = basename($transaction->bukti_transaksi, '.' . pathinfo($transaction->bukti_transaksi, PATHINFO_EXTENSION));
                Cloudinary::destroy($publicId);
            }

            $uploadedFileUrl = Cloudinary::upload($request->file('bukti_transaksi')->getRealPath())->getSecurePath();
            $data['bukti_transaksi'] = $uploadedFileUrl;
            $data['status'] = 1;
        } else {
            $data['status'] = $transaction->status;
        }

        $transaction->update($data);
        notify()->success('Transaction updated successfully!', 'Success');

        return redirect()->route('transactions.index');
    }

    /**
     * Remove the specified transaction from storage.
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->bukti_transaksi) {
            $publicId = basename($transaction->bukti_transaksi, '.' . pathinfo($transaction->bukti_transaksi, PATHINFO_EXTENSION));
            Cloudinary::destroy($publicId);
        }

        $transaction->delete();
        notify()->success('Transaction deleted successfully!', 'Success');

        return redirect()->route('transactions.index');
    }

    public function listPending()
    {
        $pendingTransactions = Transaction::with('user', 'product')->where('status', 0)->get();
        notify()->info('Loaded pending transactions.', 'Info');
        return view('dashboard.transactions.pending', compact('pendingTransactions'));
    }

    /**
     * Mark a transaction as paid.
     */
    public function markAsPaid(Transaction $transaction)
    {
        $transaction->update(['status' => 1]);
        notify()->success('Transaction marked as paid!', 'Success');
        return redirect()->route('transactions.pending');
    }
    public function getOrderStatisticsData()
    {
        $transactions = DB::table('transactions')
        ->join('products', 'transactions.product_uuid', '=', 'products.uuid')
        ->selectRaw('products.nama AS product_name, COUNT(transactions.id) AS total, MAX(transactions.created_at) AS latest_transaction')
        ->where('transactions.jenis_transaksi', 1)
        ->groupBy('products.nama')
        ->orderBy('latest_transaction', 'desc')
        ->get();

        $labels = $transactions->pluck('product_name');
        $series = $transactions->pluck('total');

        return response()->json([
            'labels' => $labels,
            'series' => $series,
        ]);

    }
}