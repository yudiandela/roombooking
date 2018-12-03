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
use PhpParser\Node\Stmt\Return_;

class Sendrequest extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reservation, $room,  $area)
    {
        $this->resertvation = $reservation;
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

        Return $this->markdown('email.request', ['msg'=>$request->description, 'date'=>$request->start, 'sub'=>$request->subject])
            ->to('adminmrbs@gmail.com')
            ->subject('Request Room')
            ->with(['id'=>$this->resertvation->id, 'room'=>$this->room, 'area'=>$this->area]);
    }
}

