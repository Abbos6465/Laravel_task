<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationCreated extends Mailable
{
    use Queueable, SerializesModels;

    public Application $application;
    
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

 
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('jeffrey@example.com', 'Jeffrey Way'),
            subject: 'Application Created',
        );
    }

    
    public function content(): Content
    {
        return new Content(
            view: 'emails.application_created',
        );

    }

    
    public function attachments(): array
    {
            $this->application->file_url ? $attach = [Attachment::fromStorageDisk('public', $this->application->file_url)] : $attach=[];
            return $attach;
    }
}
