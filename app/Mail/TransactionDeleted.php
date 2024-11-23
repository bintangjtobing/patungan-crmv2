<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TransactionDeleted extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Transaction Deleted Successfully'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.transactionDeleted',
            with: [
                'transactionType' => $this->transaction->jenis_transaksi == 1 ? 'Penjualan' : 'Pembelian',
                'productOrSupplier' => $this->transaction->jenis_transaksi == 1 ?
                                       $this->transaction->product->nama :
                                       $this->transaction->supplier->name,
                'amount' => $this->transaction->jumlah,
                'price' => $this->transaction->harga
            ]
        );
    }
}