<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class PaymentController extends Controller
{
    public function uploadPaymentProof(Request $request)
    {
        // Validasi file yang diunggah
        $request->validate([
            'paymentProof' => 'required|mimes:jpeg,png,jpg,pdf|max:2048', // File maksimal 2MB
        ]);

        // Ambil file dari request
        $file = $request->file('paymentProof');

        // Upload ke Cloudinary
        try {
            $uploadedFileUrl = Cloudinary::upload($file->getRealPath(), [
                'folder' => 'payment_proofs',
            ])->getSecurePath();

            return response()->json([
                'message' => 'Bukti pembayaran berhasil diunggah',
                'path' => $uploadedFileUrl,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengunggah bukti pembayaran',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}