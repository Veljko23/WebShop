<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderCreatedMail extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from(config('mail.from.address'), $this->order)
                ->subject('An order has been created for you');
        
        return $this->view('front.emails.order_created')
                ->with([
                    'order' => $this->order,
                ]);
    }
}
