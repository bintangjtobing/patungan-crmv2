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

class TransactionController extends Controller
{
    /**
     * Display a listing of the transactions.
     */
    public function index()
    {
        $transactions = Transaction::with(['user', 'product', 'supplier'])->get();
        return view('dashboard.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new transaction.
     */
    public function create()
    {
        $users = User::all();
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('dashboard.transactions.create', compact('users', 'products', 'suppliers'));
    }
    public function store(Request $request)
    {
        // Determine if it's a penjualan (1) or pembelian (0)
        $isPenjualan = $request->jenis_transaksi == 1;

        // Define validation rules
        $rules = [
            'jenis_transaksi' => 'required|boolean',
            'harga' => 'required|integer',
        ];

        if ($isPenjualan) {
            // Penjualan-specific validation rules
            $rules['user_id'] = 'required|exists:users,id';
            $rules['product_uuid'] = 'required|exists:products,uuid';
            $rules['jumlah'] = 'required|integer';
            $rules['bukti_transaksi'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } else {
            // Pembelian-specific validation rules
            $rules['supplier_uuid'] = 'required|exists:suppliers,uuid';
        }

        try {
            // Validate the request
            $request->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::error('Validation errors:', $e->errors());
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }

        // Base transaction data
        $data = $request->only([
            'jenis_transaksi',
            'harga',
            'description',
        ]);

        if ($isPenjualan) {
            // Penjualan-specific data
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
                    return response()->json([
                        'message' => 'File upload failed',
                        'error' => $e->getMessage(),
                    ], 500);
                }
            }
        } else {
            // Pembelian-specific data
            $data['user_id'] = auth()->id(); // Assign admin as user for pembelian
            $data['supplier_uuid'] = $request->supplier_uuid;
            $data['status'] = 1; // Automatically mark pembelian as paid
        }

        try {
            // Create the transaction
            Transaction::create($data);
        } catch (\Exception $e) {
            Log::error('Database error:', ['message' => $e->getMessage()]);
            return response()->json([
                'message' => 'Failed to save transaction',
                'error' => $e->getMessage(),
            ], 500);
        }

        Log::info('Transaction created successfully:', $data);

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
