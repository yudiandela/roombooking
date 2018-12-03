<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Room;
use App\Unit;
use App\Area;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cbRoom = $request->get('room');
        $cbArea = $request->get('area');

        $ruangan = Room::get()->count();
        $areaC = Area::get()->count();
        $unit = Unit::get()->count();
        $reservation = Reservation::get()->count();

        $area = Area::orderBy('name')->pluck('name', 'id');
        $area = [null => 'All Area'] + $area->toArray();
        $room = Room::orderBy('name')->where('area_id', $cbArea)->pluck('name', 'id');
        if ($cbRoom == null) {
            $calendar = Reservation::all();
        } else {
            $calendar = Reservation::where('room_id', $cbRoom)->get();
        }
        $available = Room::where('is_active', 1)->paginate(7);
        return view('welcome', compact('ruangan', 'unit', 'area','areaC', 'room', 'available', 'reservation', 'calendar'));
    }

//    public function notif(){
//        $a['status'] = Auth::user()->name;
//        $a['id'] = Auth::id();
//        $a['values']=DB::table('Reservation')->get();
//        return view('app')->with($a);
//    }
}