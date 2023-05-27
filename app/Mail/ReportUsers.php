<?php

namespace App\Mail;

use App\Http\Controllers\UsuarioController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReportUsers extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reporte de usuarios',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $userController = new UsuarioController();
        $report = $userController->getReportOfUsersPerCountry();

        return new Content(
            view: 'emails.reporte',
            with: [
                'report' => $report,
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
