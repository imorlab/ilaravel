<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Message;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('iml@beonww.com', 'Israel Moreno'),
            subject: 'Test - Newsletter Laravel',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    // public function build()
    // {
    //     return $this->from('iml@beonww.com')
    //                 ->view('mail')
    //                 ->subject('Test - Newsletter Laravel')
    //                 /*->text('mails.demo_plain')
    //                 ->with(
    //                   [
    //                         'testVarOne' => '1',
    //                         'testVarTwo' => '2',
    //                   ])
    //                   ->attach(public_path('/images').'/demo.jpg', [
    //                           'as' => 'demo.jpg',
    //                           'mime' => 'image/jpeg',
    //                   ])*/;
    // }
}
