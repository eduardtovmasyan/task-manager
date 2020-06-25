<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invitation extends Mailable
{
    use Queueable, SerializesModels;

    public $senderName;
    public $boardName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $senderName, string $boardName)
    {
        $this->senderName = $senderName;
        $this->boardName = $boardName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invitation');
    }
}
