<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Helper\SendMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionCreated;
use App\Mail\TransactionUpdated;
use App\Mail\TransactionDeleted;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        $user = $transaction->user; // Assuming there's a user relationship
        $sendMessage = new SendMessage();

        // Define the message body for different types of transactions
        $messageBody = $transaction->jenis_transaksi == 1 ?
            "🎉 *Hi Kak " . $user->name . "!*\n\n" .
            "Yeay, transaksi pembelian produk *" . $transaction->product->nama . "* berhasil! ✅\n\n" .
            "✨ *Detail Transaksi:* \n" .
            "🗓️ Jumlah: *" . $transaction->jumlah . " Bulan*\n" .
            "💰 Total Harga: *Rp " . number_format($transaction->harga, 0, ',', '.') . "*\n\n" .
            "🎗️ *Langkah selanjutnya:*\n" .
            "Makasih udah bertransaksi ya! Sekarang kamu tinggal menunggu untuk *verifikasi pembayaran* dari kami. ⏳\n\n" .
            "Kalau ada kendala, langsung aja hubungi tim support kami. 😊\n\n" .
            "Terima kasih sudah mempercayai layanan kami! 💙" :

            "📦 *Hi Kak " . $user->name . "!*\n\n" .
            "Transaksi pembelian dari *supplier " . $transaction->supplier->name . "* berhasil nih! 🎊\n\n" .
            "✨ *Detail Transaksi:* \n" .
            "💰 Total Harga: *Rp " . number_format($transaction->harga, 0, ',', '.') . "*\n\n" .
            "Terima kasih banyak ya, semoga lancar terus! ✨🙏";

        $sendMessage->send($user->no_hp, $messageBody);

        // Send email to the user when a transaction is created
        Mail::to($user->email)->send(new TransactionCreated($transaction));
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        $user = $transaction->user;
        $sendMessage = new SendMessage();

        $messageBody = "✅ *Hi Kak " . $user->name . "!*\n\n" .
            "Pembayaran kamu udah dikonfirmasi dan diverifikasi ya! 🎉\n\n" .
            "Makasih sudah menggunakan layanan kami. 💙\n" .
            "Selamat menikmati layanan dan semoga sukses selalu! 🚀";

        $sendMessage->send($user->no_hp, $messageBody);

        // Send email to the user when a transaction is updated
        Mail::to($user->email)->send(new TransactionUpdated($transaction));
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        $user = $transaction->user;
        $sendMessage = new SendMessage();

        $messageBody = "⚠️ *Hi Kak " . $user->name . "!*\n\n" .
            "Transaksi kamu sudah dihapus dari sistem kami. 🗑️\n\n" .
            "Kalau ini terjadi karena kesalahan atau butuh bantuan lebih lanjut, langsung aja hubungi tim support kami ya! 🙏\n\n" .
            "Makasih banyak sudah menggunakan layanan kami. 💙";

        $sendMessage->send($user->no_hp, $messageBody);

        // Send email to the user when a transaction is deleted
        Mail::to($user->email)->send(new TransactionDeleted($transaction));
    }


    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        // Logic for restored transactions
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        // Logic for force deleted transactions
    }
}
