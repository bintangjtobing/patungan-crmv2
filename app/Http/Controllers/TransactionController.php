<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the transactions.
     */
    public function index()
    {
        $transactions = Transaction::with(['user', 'product'])->get();
        return view('dashboard.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new transaction.
     */
    public function create()
    {
        $users = User::all();
        $products = Product::all();
        return view('dashboard.transactions.create', compact('users', 'products'));
    }

    /**
     * Store a newly created transaction in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis_transaksi' => 'required|boolean', // 0 for pembelian, 1 for penjualan
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

        // Set the initial status based on whether proof of transaction is provided
        $data['status'] = $request->hasFile('bukti_transaksi') ? 1 : 0; // 1 for paid, 0 for pending

        // Handle bukti_transaksi upload if provided
        if ($request->hasFile('bukti_transaksi')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('bukti_transaksi')->getRealPath())->getSecurePath();
            $data['bukti_transaksi'] = $uploadedFileUrl;
        }

        // Set the current date and time for `tanggal_waktu_transaksi_selesai` if not provided
        if (is_null($data['tanggal_waktu_transaksi_selesai'])) {
            $data['tanggal_waktu_transaksi_selesai'] = Carbon::now()->setTimezone('Asia/Jakarta');
        }

        // Create the transaction
        Transaction::create($data);

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    /**
     * Show the form for editing the specified transaction.
     */
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $users = User::all();
        $products = Product::all();
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

        // Update status based on whether proof of transaction is provided
        if ($request->hasFile('bukti_transaksi')) {
            // Delete old proof of transaction from Cloudinary if it exists
            if ($transaction->bukti_transaksi) {
                $publicId = basename($transaction->bukti_transaksi, '.' . pathinfo($transaction->bukti_transaksi, PATHINFO_EXTENSION));
                Cloudinary::destroy($publicId);
            }

            // Upload new proof of transaction
            $uploadedFileUrl = Cloudinary::upload($request->file('bukti_transaksi')->getRealPath())->getSecurePath();
            $data['bukti_transaksi'] = $uploadedFileUrl;
            $data['status'] = 1; // Set to paid if proof is provided
        } else {
            // Keep current status if no new bukti_transaksi is uploaded
            $data['status'] = $transaction->status;
        }

        // Update the transaction data
        $transaction->update($data);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified transaction from storage.
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        // Delete proof of transaction from Cloudinary if it exists
        if ($transaction->bukti_transaksi) {
            $publicId = basename($transaction->bukti_transaksi, '.' . pathinfo($transaction->bukti_transaksi, PATHINFO_EXTENSION));
            Cloudinary::destroy($publicId);
        }

        // Delete the transaction
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
    public function listPending()
    {
        $pendingTransactions = Transaction::with('user', 'product')->where('status', 0)->get(); // 0 for pending
        return view('dashboard.transactions.pending', compact('pendingTransactions'));
    }

    /**
     * Mark a transaction as paid.
     */
    public function markAsPaid(Transaction $transaction)
    {
        $transaction->update(['status' => 1]); // 1 for paid
        return redirect()->route('transactions.pending')->with('success', 'Transaction marked as paid.');
    }
}