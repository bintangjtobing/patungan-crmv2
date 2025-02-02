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

            // Ambil harga produk berdasarkan UUID
            $product = Product::where('uuid', $validatedData['product_uuid'])->first();
            if (!$product) {
                return response()->json([
                    'message' => 'Produk tidak ditemukan.',
                ], 404);
            }

            // Cek apakah user sudah ada berdasarkan email atau no_hp
            $user = User::where('email', $validatedData['email'])
                ->orWhere('no_hp', $validatedData['no_hp'])
                ->first();

            $isNewUser = false;

            // Buat user baru jika tidak ditemukan
            if (!$user) {
                $isNewUser = true; // Tandai bahwa ini adalah pelanggan baru
                $nameParts = explode(' ', $validatedData['name']);
                $username = strtolower(implode('', $nameParts));

                $user = User::create([
                    'username' => $username,
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'no_hp' => $validatedData['no_hp'],
                    'password' => bcrypt('default_password'), // Ganti dengan logika password
                    'type' => 1, // 1 untuk customer
                ]);
            }

            $harga = $product->harga_jual;
            $jumlah = 1; // Default jumlah transaksi = 1

            // Menentukan deskripsi berdasarkan apakah pelanggan baru atau pelanggan lama
            if ($isNewUser) {
                $description = "Member baru dengan penjualan \"{$product->nama}\" untuk bulan " . 
                    now()->translatedFormat('F') . 
                    " hingga bulan " . 
                    now()->addMonths($jumlah)->translatedFormat('F');
            } else {
                $description = "Perpanjangan member dengan penjualan \"{$product->nama}\" untuk bulan " . 
                    now()->translatedFormat('F') . 
                    " hingga bulan " . 
                    now()->addMonths($jumlah)->translatedFormat('F');
            }

            // Simpan transaksi
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'product_uuid' => $product->uuid,
                'jumlah' => $jumlah,
                'harga' => $harga, // Ambil harga dari produk
                'bukti_transaksi' => $validatedData['bukti_transaksi'],
                'status' => 0,
                'jenis_transaksi' => 1, // 1 untuk penjualan
                'description' => $description,
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