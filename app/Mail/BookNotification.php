<?php

namespace App\Mail;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookNotification extends Mailable
{
    use Queueable, SerializesModels;

    public string $action;
    public Book $book;
    public string $userName;

    /**
     * Create a new message instance.
     */
    public function __construct(string $action, Book $book, string $userName)
    {
        $this->action = $action;
        $this->book = $book;
        $this->userName = $userName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $actionText = match($this->action) {
            'added' => 'New Book Added',
            'updated' => 'Book Updated',
            'deleted' => 'Book Deleted',
            default => 'Book Activity',
        };

        return new Envelope(
            subject: "অক্ষর - {$actionText}: {$this->book->title}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.book-notification',
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
