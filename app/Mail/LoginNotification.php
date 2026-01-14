<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoginNotification extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $ipAddress;
    public string $userAgent;
    public string $loginTime;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $ipAddress, string $userAgent)
    {
        $this->user = $user;
        $this->ipAddress = $ipAddress;
        $this->userAgent = $userAgent;
        $this->loginTime = now()->format('F j, Y \a\t g:i A');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'অক্ষর - New Login Detected',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.login-notification',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
