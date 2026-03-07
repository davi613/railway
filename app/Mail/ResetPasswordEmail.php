<?php

namespace App\Mail;

use App\Models\Pelanggan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public Pelanggan $pelanggan;
    public string $token;

    public function __construct(Pelanggan $pelanggan, string $token)
    {
        $this->pelanggan = $pelanggan;
        $this->token     = $token;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🔐 Reset Password Anda - ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.reset-password',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}