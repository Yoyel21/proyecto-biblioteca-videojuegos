<?php

namespace App\Mail;

use App\Models\Videojuego;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NuevoVideojuego extends Mailable
{
    use Queueable, SerializesModels;

    public $videojuego;
    /**
     * Create a new message instance.
     */
    public function __construct(Videojuego $videojuego)
    {
        $this->videojuego = $videojuego;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuevo Videojuego',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.nuevo_videojuego',
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

    public function build()
    {
        return $this->subject('Nuevo Videojuego Creado')
        ->view('emails.nuevo_videojuego')
        ->with([
            'videojuego' => $this->videojuego
        ]);
    }
}
