<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->data['email'], $this->data['fullName'])
            ->subject($this->data['subject'])
            ->view('emails.contact')
            ->with([
                'fullName' => $this->data['fullName'],
                'email' => $this->data['email'],
                'subject' => $this->data['subject'],
                'content' => $this->data['content'],
            ]);
    }
}
