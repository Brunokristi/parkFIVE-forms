<?php

namespace App\Mail;

use App\Models\Checkin;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CheckinConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Checkin $checkin
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'parkFIVE — Online check-in dokončený — ' . $this->checkin->apartment->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.checkin-confirmation',
        );
    }
}