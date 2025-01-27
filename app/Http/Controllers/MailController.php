<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Models\Newsletter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Send and store the newsletter.
     */
    public function store(Request $request)
    {
        $email = $request->input('email');
        $html = $request->input('html');

        // Enviar el email
        Mail::to($email)->send(new OrderShipped());

        // Registrar el envío
        Newsletter::create([
            'email' => $email,
            'content' => $html,
            'sent_at' => now(),
            'status' => 'sent'
        ]);

        return redirect('/home')->with('success', 'Newsletter enviado correctamente');
    }
}
