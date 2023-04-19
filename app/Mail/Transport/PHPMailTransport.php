<?php
namespace App\Mail\Transport;
use Illuminate\Mail\Transport\Transport;
use Swift_Mime_SimpleMessage;


class PHPMailTransport extends Transport
{

    public function __construct()
    {
    }


    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        dd($message);
    }

}
