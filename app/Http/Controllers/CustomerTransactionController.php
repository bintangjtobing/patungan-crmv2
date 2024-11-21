<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class CustomerTransactionController extends Controller
{
    public function createTransaction(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'no_hp' => 'required|string|max:15',
                'product_uuid' => 'required|exists:products,uuid',
                'bukti_transaksi' => 'required|url', // Harus URL valid
            ]);
            // Generate username
            $nameParts = explode(' ', $validatedData['name']);
            $username = strtolower(implode('', $nameParts));
            // Ambil harga produk berdasarkan UUID
            $product = Product::where('uuid', $validatedData['product_uuid'])->first();
            if (!$product) {
                return response()->json([
                    'message' => 'Produk tidak ditemukan.',
                ], 404);
            }
            // Buat user baru
            $user = User::create([
                'username' => $username,
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'no_hp' => $validatedData['no_hp'],
                'password' => bcrypt('default_password'), // Ganti dengan logika password
                'type' => 1, // 1 untuk customer
            ]);
            $harga = $product->harga_jual;

            // Simpan transaksi (sesuaikan dengan model Anda)
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'product_uuid' => $product->uuid,
                'harga' => $harga, // Ambil harga dari produk
                'bukti_transaksi' => $validatedData['bukti_transaksi'],
                'status' => 0,
                'jenis_transaksi' => 1, // 1 untuk penjualan
            ]);

            return response()->json([
                'message' => 'Transaksi berhasil disimpan.',
                'data' => $transaction,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan transaksi.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
