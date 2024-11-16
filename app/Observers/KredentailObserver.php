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
    /**
     * Handle the KredentialCustomer "created" event.
     */
    public function created(KredentialCustomer $kredentialCustomer): void
    {
        $user = $kredentialCustomer->user;
        $sendMessage = new SendMessage();

        // send message via wa

        $sendMessage->send(
            $user->no_hp,
            'Halo kak ' . $user->name . ',' . "\n\n" .
                'Selamat! Akses kamu untuk produk ' . $kredentialCustomer->product->nama . ' telah berhasil dibuat.' . "\n\n" .
                'Detail akses:' . "\n" .
                'Email: ' . $kredentialCustomer->email_akses . "\n" .
                'Profil: ' . $kredentialCustomer->profil_akes . "\n" .
                'PIN / Password: ' . $kredentialCustomer->pin . "\n\n" .
                'Terima kasih telah menggunakan layanan kami.'
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

        $sendMessage->send(
            $user->no_hp,
            'Halo kak ' . $user->name . ',' . "\n\n" .
                'Akses kamu untuk produk ' . $kredentialCustomer->product->nama . ' telah diperbarui.' . "\n\n" .
                'Detail akses:' . "\n" .
                'Email: ' . $kredentialCustomer->email_akses . "\n" .
                'Profil: ' . $kredentialCustomer->profil_akes . "\n" .
                'PIN / Password: ' . $kredentialCustomer->pin . "\n\n" .
                'Terima kasih telah menggunakan layanan kami.'
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

        $sendMessage->send(
            $user->no_hp,
            'Halo kak ' . $user->name . ',' . "\n\n" .
                'Akses kamu untuk produk ' . $kredentialCustomer->product->nama . ' telah di hapus.' . "\n\n" .
                'Detail akses:' . "\n" .
                'Email: ' . $kredentialCustomer->email_akses . "\n" .
                'Profil: ' . $kredentialCustomer->profil_akes . "\n" .
                'PIN / Password: ' . $kredentialCustomer->pin . "\n\n" .
                'Terima kasih telah menggunakan layanan kami.'
        );

         // Send email to the user when a credential is updated
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
