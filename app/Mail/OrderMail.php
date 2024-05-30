<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $template;
    public $vnp_SecureHash;
    public $secureHash;

    /**
     * Create a new message instance.
     */
    public function __construct($data, $template = '', $vnp_SecureHash = '', $secureHash = '')
    {
        $this->data = $data;
        $this->template = $template;
        $this->vnp_SecureHash = $vnp_SecureHash;
        $this->secureHash = $secureHash;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'This is email sending order successfully!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.order',
            with: [
                'order' => $this->data,
                'template' => $this->template,
                'vnp_SecureHash' => $this->vnp_SecureHash,
                'secureHash' => $this->secureHash,
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
