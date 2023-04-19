<?php


namespace App\Services;
use Illuminate\Support\Facades\View;

class MailService
{
    protected $view;

    protected $to;

    protected $subject;

    protected $from;

    public function view(string $view,array $data)
    {
        $this->view = View::make($view, $data);

        return $this;
    }

    public function to($to)
    {
        $this->to = $to;

        return $this;
    }

    public function subject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    public function from($from)
    {
        $this->from = $from;

        return $this;
    }

    public function send(){

        $to = $this->to;
        $subject =  $this->subject;
        $message = $this->view->render();
        $from = config('mail.from.address',$this->from);
        $headers  = "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: {$from} <{$from}>\r\n";
        $headers .= "Reply-To: {$from}\r\n";

        return mail ($to, $subject, $message, $headers);
    }

}
