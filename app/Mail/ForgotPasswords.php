<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswords extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $nama, $url;

    public function __construct($user, $url)
    {
        $this->nama = $user['name'];
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function build()
    {
        return $this->view('emailRecivedView')->with([
            'nama' => $this->nama,
            'url' => $this->url,
        ])->subject('Reset Password Account');
    }
}
