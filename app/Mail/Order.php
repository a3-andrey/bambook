<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Order extends Mailable
{
    use Queueable, SerializesModels;



    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Models\Order $order)
    {
        //
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mails.from'))->subject('Заявка с сайта '.url('/'))->markdown('emails.order',[
            'order' => $this->order,
        ]);
    }
}
