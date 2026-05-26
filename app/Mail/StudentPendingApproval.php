<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudentPendingApproval extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $student) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Cerere nouă de înregistrare elev');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.student-pending-approval');
    }
}
