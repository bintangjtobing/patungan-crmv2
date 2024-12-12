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
            "Halo kak " . $user->name . ",\n\n" .
            "Transaksi pembelian untuk produk " . $transaction->product->nama . " telah berhasil dilakukan.\n\n" .
            "*Detail Transaksi*" . ",\n\n" .
            "Jumlah: " . $transaction->jumlah ." Bulan". "\n" .
            "Harga Total: Rp " . number_format($transaction->harga, 0, ',', '.') . "\n\n" :
            "Halo " . $user->name . ",\n\n" .
            "Transaksi pembelian dari supplier " . $transaction->supplier->name . " telah berhasil dilakukan.\n\n" .
            "Detail Transaksi:\n" .
            "Harga Total: Rp " . number_format($transaction->harga, 0, ',', '.') . "\n\n";

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

        $messageBody = "Halo kak " . $user->name . ",\n\n" .
            "Pembayaran kamu telah dikonfirmasi dan diverifikasi.\n\n" .
            "Anda akan menerima kredensial login dan informasi detail produk Anda dalam waktu kurang dari 30 menit.\n\n" .
            "Terima kasih telah menggunakan layanan kami.";

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

        $messageBody = "Halo kak " . $user->name . ",\n\n" .
            "Transaksi kamu telah dihapus dari sistem kami.\n\n" .
            "Jika ini adalah kesalahan, silakan hubungi dukungan kami.\n\n" .
            "Terima kasih telah menggunakan layanan kami.";

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
