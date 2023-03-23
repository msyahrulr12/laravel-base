<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    private $name;
    private $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        string $subject,
        string $name,
        string $link
    )
    {
        $this->subject = $subject;
        $this->name = $name;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('emails.forgot-password-request')->with([
            'subject' => $this->subject,
            'name' => $this->name,
            'link' => $this->link
        ]);
    }
}
