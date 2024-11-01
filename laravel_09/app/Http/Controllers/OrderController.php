<?php

namespace App\Http\Controllers;

use App\Events\OrderCreatedEvent;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store()
    {
        $data = [
            'orderNumber' => '125-258-358-785',
            'name' => 'Omar',
            'products' => [
                'iphone',
                'mac',
                'ipade'
            ]
        ];

        $email = 'omarhashem20051310@gmail.com';

        event(new OrderCreatedEvent($email, $data));

        dd('order created successfully');
    }
}
