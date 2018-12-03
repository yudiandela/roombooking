<?php

namespace App\Mail;

use App\Reservation;
use App\User;
use Illuminate\http\request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Addrequest extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($room,  $area)
    {
        $this->room = $room;
        $this->area = $area;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        Return $this->markdown('email.process', ['date'=>$request->start, 'name'=>$request->contact_name, 'sub'=>$request->subject])
            ->to($request->contact_email)
            ->cc($request->manager_email)
            ->subject('Pending')
            ->with(['room'=>$this->room, 'area'=>$this->area]);;

    }
}
