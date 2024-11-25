<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestListMail extends Mailable
{
    use Queueable, SerializesModels;

    private array $email;
    /**
     * Create a new message instance.
     */
    public function __construct(array $email)
    {
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->email["subject"],
            from: $this->email["from"],
            cc: isset($this->email["cc"]) ? [$this->email['cc']] : [],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $content = new Content(
            with: ["text" => $this->email["body"]],
        );

        switch ($this->email["type"]) {
            case "text":
                $content->text("emails.test.text_version");
                break;
            default:
                $content->html("emails.test.html_version");
        }

        return $content;
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
