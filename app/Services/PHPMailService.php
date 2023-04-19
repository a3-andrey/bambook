<?php


namespace App\Services;

use App\Mail\Transport\PHPMailTransport;
use Illuminate\Mail\MailManager;

class PHPMailService extends MailManager
{
    protected function createMailTransport()
    {
        return new PHPMailTransport();
    }
}
