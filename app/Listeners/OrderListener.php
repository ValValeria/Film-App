<?php

namespace App\Listeners;

use App\Events\OrderStatusChanged;
use App\Models\Message;

class OrderListener 
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderStatusChanged  $event
     * @return void
     */
    public function handle(OrderStatusChanged $event)
    {
        $order = $event->order;
        $user = $order->user;
        
        $user->messages()->create([
            "message"=>"Только что ваше блюдо было приготовлено, а именно '$order->product->title'",
            "status"=>"un_read"
        ]);
    }
}
