<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\KredentialCustomer;

class KredentialCustomerDelete extends Mailable
{
    use Queueable, SerializesModels;
    public $kredentialCustomer;

    /**
     * Create a new message instance.
     */
    public function __construct(KredentialCustomer $kredentialCustomer)
    {
        $this->kredentialCustomer = $kredentialCustomer;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kredential Customer Delete',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.kredentialCustomerDelete',
                with:[
                    'customerName' => $this->kredentialCustomer->user->name,
                    'productName' => $this->kredentialCustomer->product->nama,
                    'emailAkses' => $this->kredentialCustomer->email_akses,
                    'profileAkses' => $this->kredentialCustomer->profil_akes,
                    'pinAkses' => $this->kredentialCustomer->pin
                ]
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
