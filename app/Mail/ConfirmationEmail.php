<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class ConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $request)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'SaaS Confirmation Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'landlord.public-section.emails.confirmation',
            with: [
                'name' => $this->request->first_name.' '.$this->request->last_name,
            ],
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
