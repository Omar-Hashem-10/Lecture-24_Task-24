<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderCreateMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
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

        Mail::to('omarhashem20051310@gmail.com')->send(new OrderCreateMail($data));
    }
}
