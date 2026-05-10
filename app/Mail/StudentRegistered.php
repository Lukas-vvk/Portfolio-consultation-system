<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudentRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $consultation;
    public function __construct(User $student, Consultation $consultation)
    {
        $this->student = $student;
        $this->consultation = $consultation;
    }

    public function build()
    {
        return $this->view('emails.student_registered')
            ->with([
                'student' => $this->student,
                'consultation' => $this->consultation,
            ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Student Registered',
        );
    }

    /**
     * Get the message content definition.
     */


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
