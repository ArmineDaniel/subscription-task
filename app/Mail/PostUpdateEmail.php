<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostUpdateEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $email;
    public $website;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $email, $website)
    {
        $this->details = $details;
        $this->email = $email;
        $this->website = $website;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $website = $this->website;
        return new Envelope(
            subject: $website,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'post_update_email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
