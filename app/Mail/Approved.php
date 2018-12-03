<?php

namespace App\Mail;

use Illuminate\http\request;
use Illuminate\Foundation\Http\FormRequest;
//use http\Env\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Reservation;

class Approved extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $reservation = Reservation::find($request->id);
        return $this->markdown('email.approve', ['msg'=>$reservation->description])
            ->to($reservation->contact_email)
            ->cc($reservation->manager_email)
            ->subject($reservation->subject);
    }
}
