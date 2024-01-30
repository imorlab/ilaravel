<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController  extends Controller
{
    /**
     * Ship the given order.
     */
    public function store()
    {
        // $order = Order::findOrFail($request->order_id);
        $email = $_POST['email'];

        // Ship the order...
        Mail::to($email)->send(new OrderShipped());

        return redirect('/home');
    }
}
