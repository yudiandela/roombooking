<?php

namespace App\Mail;

use Illuminate\http\request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Approve extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($users)
    {
        $this->users=$users;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $to = $this->users;
        $to[] = $request['contact_email'];
        return $this->markdown('email.approve', ['msg'=>$request->description])
            ->to($to)
            ->cc($request->manager_email)
            ->subject($request->subject);
    }
}
