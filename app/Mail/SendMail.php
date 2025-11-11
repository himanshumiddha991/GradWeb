<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
     public function build()
    {
        $subject = 'Subject of the email';
        $fromEmail = 'enquiry@guidner.com';
        $fromName = 'Guidner';

        return $this->subject($subject)
            ->from($fromEmail, $fromName)
            ->markdown('emails.sendmail') // This can be any string, as we're not using a separate Blade file
            ->with([
                'content' => 'This is the body of the email.',
            ]);
    }
    }
