<?php

namespace App\Observers;

use App\Models\KredentialCustomer;
use App\Helper\SendMessage;
use App\Mail\KredentialCustomers;
use Illuminate\Support\Facades\Mail;
use App\Mail\KredentialCustomersUpdate;
use App\Mail\KredentialCustomerDelete;

class KredentailObserver
{
    public function created(KredentialCustomer $kredentialCustomer): void
    {
        $user = $kredentialCustomer->user;
        $sendMessage = new SendMessage();
        // Pisahkan PIN dan Password dari data dinamis
        list($pin, $password) = explode(' / ', $kredentialCustomer->pin);
        // send message via wa

        $sendMessage->send(
            $user->no_hp,
            '🎉 Hi Kak *' . $user->name . '*,' . "\n\n" .
            'Yeay! Akses buat produk *' . $kredentialCustomer->product->nama . '* udah jadi nih! 🚀' . "\n\n" .
            '✨ *Detail aksesnya:*' . "\n" .
            '📋 *Profil*: ' . $kredentialCustomer->profil_akes . "\n" .
            '📧 *Email*: ' . $kredentialCustomer->email_akses . "\n" .
            '🔑 *PIN*: ' . $pin . "\n" .
            '🔒 *Password*: ' . $password . "\n\n" .
            'Terima kasih udah pake layanan kami ya! 🫶' . "\n\n" .
            'Selamat mencoba dan semoga lancar! 🌟'
        );

        // Send email to the user when a credential is created
        Mail::to($user->email)->send(new KredentialCustomers($kredentialCustomer));
    }

    /**
     * Handle the KredentialCustomer "updated" event.
     */
    public function updated(KredentialCustomer $kredentialCustomer): void
    {
        $user = $kredentialCustomer->user;
        $sendMessage = new SendMessage();

        // Pisahkan PIN dan Password dari data dinamis
        list($pin, $password) = explode(' / ', $kredentialCustomer->pin);

        $sendMessage->send(
            $user->no_hp,
            '🔄 Hi Kak *' . $user->name . '*,' . "\n\n" .
            'Info nih, akses kamu buat produk *' . $kredentialCustomer->product->nama . '* udah di-update ya! 🛠️' . "\n\n" .
            '✨ *Detail terbaru:*' . "\n" .
            '📋 *Profil*: ' . $kredentialCustomer->profil_akes . "\n" .
            '📧 *Email*: ' . $kredentialCustomer->email_akses . "\n" .
            '🔑 *PIN*: ' . $pin . "\n" .
            '🔒 *Password*: ' . $password . "\n\n" .
            'Makasih ya udah terus pake layanan kami! 💙' . "\n" .
            'Semoga lancar terus! 🚀'
        );

        // Send email to the user when a credential is updated
        Mail::to($user->email)->send(new KredentialCustomersUpdate($kredentialCustomer));
    }

    /**
     * Handle the KredentialCustomer "deleted" event.
     */
    public function deleted(KredentialCustomer $kredentialCustomer): void
    {
        $user = $kredentialCustomer->user;
        $sendMessage = new SendMessage();
        // Pisahkan PIN dan Password dari data dinamis
        list($pin, $password) = explode(' / ', $kredentialCustomer->pin);

        $sendMessage->send(
            $user->no_hp,
            '❌ Hi Kak *' . $user->name . '*,' . "\n\n" .
            'Akses kamu buat produk *' . $kredentialCustomer->product->nama . '* udah dihapus ya. 🗑️' . "\n\n" .
            '✨ *Detail sebelumnya:*' . "\n" .
            '📋 *Profil*: ' . $kredentialCustomer->profil_akes . "\n" .
            '📧 *Email*: ' . $kredentialCustomer->email_akses . "\n" .
            '🔑 *PIN*: ' . $pin . "\n" .
            '🔒 *Password*: ' . $password . "\n\n" .
            'Kalau butuh bantuan atau mau aktifin lagi, kabarin aja ya! 🙏' . "\n" .
            'Terima kasih banyak sudah bersama kami. 💙'
        );

        // Send email to the user when a credential is deleted
        Mail::to($user->email)->send(new KredentialCustomerDelete($kredentialCustomer));
    }

    /**
     * Handle the KredentialCustomer "restored" event.
     */
    public function restored(KredentialCustomer $kredentialCustomer): void
    {
        //
    }

    /**
     * Handle the KredentialCustomer "force deleted" event.
     */
    public function forceDeleted(KredentialCustomer $kredentialCustomer): void
    {
        //
    }
}