<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class OpinionStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $opinion;
    public $tutorEmail;
    public $tutorName;

    /**
     * Create a new message instance.
     *
     * @param $opinion
     * @param $user
     */
    public function __construct($opinion, $tutorEmail, $tutorName)
    {
        $this->opinion = $opinion;
        $this->tutorEmail = $tutorEmail;
        $this->tutorName = $tutorName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Statut de votre avis',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.opinions_status'  // Remarque: Assurez-vous que cette vue existe
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        return [];
    }
}
