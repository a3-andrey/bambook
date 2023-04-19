<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $password;
    public $message;

    /**
     * Create a new message instance.
     ** @param string $password
     * @param string $message
     *
     * @return void
     */
    public function __construct(string $password,string $message)
    {
        //
        $this->password = $password;
        $this->message = $message;
    }

    /**
     * Build the message.

     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.users.password',['password' => $this->password])
            ->from(config('mail.from'))
            ->subject($this->message);
    }

}
