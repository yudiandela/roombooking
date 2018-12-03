<?php

namespace App\Http\Controllers;

use App\Area;
use App\Mail\Addrequest;
use App\Mail\Sendrequest;
use Illuminate\Support\Facades\Input;
use Mail;
use App\mail\Approve;
use App\mail\Approved;
use App\mail\Reject;
use App\Models\Role;
use App\Reservation;
use App\Unit;
use App\Room;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MaddHatter\LaravelFullcalendar\Calendar;
use Zizaco\Entrust\Entrust;
use Illuminate\Support\Facades\Validator;

class ReservationsController extends Controller
{
    //untuk menampilkan list reservation
    public function index(Request $request)
    {
        $area = Area::orderBy('name')->pluck('name', 'id');
        $area = [null => 'All Area'] + $area->toArray();
        $room = Room::orderBy('name')->pluck('name', 'id');
        $room = [null => 'All Room'] + $room->toArray();
        $search1 = $request->get('status');
        $search2 = $request->get('room');
        $search3 = $request->get('tgl_awal');
        $search4 = $request->get('tgl_akhir');
        $data = Reservation::with('user', 'room');
        $data = $data->where('status', 'LIKE', '%' . $search1 . '%');
        $data = $data->where('room_id', 'LIKE', '%' . $search2 . '%');

        if ($search4 < $search3) {
            echo "coi";
        } else {
            if ($search3 != null and $search4 != null) {
                $data = $data->whereBetween('start', array($search3, $search4));
            }
        }
        $data = $data->get();
        return view('reservation.index', compact('data', 'area', 'room'));
    }

    //untuk add schedule
    function addSchedule()
    {
        $select1 = User::orderBy('name')->pluck('name', 'id');
        $select1 = $select1->toArray();
        $select2 = Area::orderBy('name')->pluck('name', 'id');
        $select2 = [null => 'Pilih Area'] + $select2->toArray();
        $select3 = Room::orderBy('name')->pluck('name', 'id');
        $select3 = [null => 'Pilih Room'] + $select3->toArray();
        $select4 = Unit::orderBy('name')->pluck('name', 'id');
        $select4 = [null => 'Pilih Unit'] + $select4->toArray();
        return view('reservation.addSchedule', compact('select1', 'select2', 'select3', 'select4'));
    }

    //untuk menambah data add schedule
    function storeSchedule(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'user' => 'required',
            'subject' => 'required',
            'description' => 'required',
            'start' => 'required',
            'end' => 'required',
            'room_id' => 'required',
            'type' => 'required',
            'unit_id' => 'required',
            'contact_hp' => 'required|numeric',
            'contact_name' => 'required',
            'contact_email' => 'required|email',
            'manager_email' => 'required|email',
        ], [
            'email.required' => 'Mohon email diisi dan harus berbentuk email', //custom validasi
            'email.email' => 'Format E-Mail masih salah', //custom validasi
        ]);
        $data = $request->toArray();
        $data ['start'] = date("Y-m-d H:i", strtotime($data['start']));
        $data ['end'] = date("Y-m-d H:i", strtotime($data['end']));
        $data['status'] = 'approved'; //membuat otomatis status save menjadi approved

        //validasi cek kapasitas
        $capacity = Room::where('id', '=', $request->room_id)->pluck('capacity')
            ->first();
        $cekCapacity = count($request->user);
        $jam_mulai_cek = $request->start;
        $jam_akhir_cek = $request->end;

        if ($cekCapacity > $capacity) {
            //jika kapasitas tidak mencukupi
            return redirect()->back()->with('error', 'error')->withInput($request->all());
        } else {
            $conflict = Reservation::where('room_id', '=', $request->room_id)
                ->where('start', '<', $jam_akhir_cek)
                ->where('end', '>', $jam_mulai_cek)->get();
            $cekreservation = count($conflict);
            if ($cekreservation > 0) {
                return redirect()->back()->with('conflict', 'konflik')->withInput($request->all());;
            } else {
                $reservation = Reservation::create($data); //menyimpan data user_id
                $reservation->attend()->sync($request->user); //simpan id user ke database reservation_user
                $users = User::whereIn('id', $request->user)
                    ->pluck('email');
                Mail::send(new Approve($users));
                return redirect(route('reservation.index'))->with('alert', 'Sukses Menambahkan Data Ruangan Baru');
            }
        }
    }

    //mendapatkan id user dan name dari tabel user pakai json
    function getAttend(Request $request)
    {
        $attends = [];
        if ($request->has('user')) {
            $search = $request->user;
            $attends = User::select("id", "name")
                ->where('name', 'LIKE', "%$search%")
                ->get();
            $attends = [null => 'Chose Attend'] + $attends->toArray();
        }
        return response()->json($attends);
    }

//untuk masuk ke tampilan button area
    public function reservationArea()
    {
        $area = Area::all();
        return view('reservation.area', compact('area'));
    }

    //untuk masuk ke tampilan button room setelah memilih area
    public function reservationRoom($idArea)
    {
        $room = Room::orderBy('name', 'asc')
            ->where('area_id', $idArea)
            ->where('is_active', '=', 1)
            ->get();
        return view('reservation.room', compact('room'));
    }

    //untuk masuk ke tampilan calendar reservation
    public function meetingDetail(Reservation $reservation)
    {
        $data = Reservation::find($reservation);
        return view('reservation.index', compact('data'));
    }

    public function detail($id)
    {
        $data = Reservation::find($id);
        return view('reservation.detail', compact('data'));
    }

    public function reservationCalendar(Request $request, $idArea, $idRoom)
    {
        $cbArea = $request->get('area');
        $cbRoom = $request->get('room');

        if (!empty($cbArea) || !empty($cbRoom)) {
            if (empty($cbRoom)) {
                return redirect()->route('reservation.calendar', ['idArea' => $cbArea, 'idRoom' => 0]);
            } else {
                return redirect()->route('reservation.calendar', ['idArea' => $cbArea, 'idRoom' => $cbRoom]);
            }
        }
        $area = Area::orderBy('name')->pluck('name', 'id');
        $room = Room::orderBy('name')->where('area_id', $idArea)->pluck('name', 'id');

        if (empty($idRoom)) {
            $reservation = Reservation::whereHas('room', function ($q) use ($idArea) {
                $q->area_id = $idArea;
            })->get();
        } else {
            $reservation = Reservation::where('room_id', $idRoom)->get();
        }
        return view('reservation.calendar', compact('reservation', 'room', 'area'));
    }

    public function calendar(Request $request)
    {
        $reservation = Reservation::all();
        $events = array();

        foreach ($reservation as $reser) {
            $e = array();
            $e['id'] = $reser->id;
            $e['title'] = $reser->subject;
            $e['start'] = $reser->start;
            $e['end'] = $reser->end;
            $e['url'] = route('reservation.detail', $reser->id);
            array_push($events, $e);
        }
        return response()->json($events);
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $reservations = Reservation::where('room_id', 'LIKE', '%' . $request->search . "%")->get();
            if ($reservations) {
                foreach ($reservations as $key => $reservation) {
                    $output .= '<tr>' .
                        '<td>' . $reservation->id . '</td>' .
                        '<td>' . $reservation->subject . '</td>' .
                        '<td>' . $reservation->start . '</td>' .
                        '<td>' . $reservation->end . '</td>' .
                        '</tr>';
                }
                return Response($output);
            }
        }
    }

    function update(Request $request, $id)
    {
        $data = Reservation::find($id);
        if (empty($request['status']))
            $request['status'] = 'approved';

        $data->fill($request->all());
        $data->save();
        Mail::send(new Approved());
        return redirect(route('reservation.index'))->with('alertedit', 'Sukses approve');
    }

    public function reject(Request $request)
    {
        $data = Reservation::find($request->id);

        if ($data != null) {
            $data->status = $request->status;
            $data->reason = $request->reason;
            $data->save();
            mail::send(new Reject());

            return redirect(route('reservation.index'))->with('alertedit', 'Sukses reject');
        } else {
            return redirect(route('reservation.index'))->with('alertedit', 'gagal');
        }
    }

    //untuk add schedule
    function addrequest(Request $request, $idArea, $idRoom)
    {
        $select1 = Area::orderBy('name')->pluck('name', 'id');
        $select1 = [null => 'Pilih Area'] + $select1->toArray();

        $select2 = Room::orderBy('name')->pluck('name', 'id');
        $select2 = [null => 'Pilih Room'] + $select2->toArray();

        $select3 = Unit::orderBy('name')->pluck('name', 'id');
        $select3 = [null => 'Pilih Unit'] + $select3->toArray();

        return view('reservation.addrequest', compact('select1', 'select2', 'select3'));
    }

    //untuk menambah data add schedule
    function storerequest(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required',
            'description' => 'required',
            'start' => 'required',
            'end' => 'required',
            'room_id' => 'required',
            'type' => 'required',
            'unit_id' => 'required',
            'contact_email' => 'required|email',
            'manager_email' => 'required|email',
        ], [
            'email.required' => 'Mohon email diisi dan harus berbentuk email', //custom validasi
            'email.email' => 'Format E-Mail masih salah', //custom validasi
        ]);

        $data = $request->toArray();
        $data ['start'] = date("Y-m-d H:i", strtotime($data['start']));
        $data ['end'] = date("Y-m-d H:i", strtotime($data['end']));
        $data['status'] = 'pending';
        $data['user_id'] = Auth::id();

        $jam_mulai_cek = $request->start;
        $jam_akhir_cek = $request->end;

        $conflict = Reservation::where('room_id', '=', $request->room_id)
            ->where('start', '<', $jam_akhir_cek)
            ->where('end', '>', $jam_mulai_cek)->get();
        $cekreservation = count($conflict);
        if ($cekreservation > 0) {
            return redirect()->back()->with('conflict', 'konflik')->withInput($request->all());;
        } else {
            $reservation = Reservation::create($data);
            $reservation->attend()->sync($request->user);
            $room = Room::where('id', $request->room_id)->pluck('name');
            $area = Area::where('id', $request->area_id)->pluck('name');
            Mail::send(new Addrequest($room, $area));
            Mail::send(new Sendrequest($reservation, $room, $area));
            return redirect()->route('reservation.calendar', ['idArea' => $data['area_id'], 'idRoom' => $data['room_id']])
                ->with('alertedit', 'sukses');
        }
    }

    function getAttendence(Request $request)
    {
        $attendence = [];
        if ($request->has('user')) {
            $search = $request->user;
            $attendence = User::select("id", "name")
                ->where('name', 'LIKE', "%$search%")
                ->get();
            $attendence = [null => 'Choose Attendence'] + $attendence->toArray();
        }
        return response()->json($attendence);
    }

    public function show(Request $request)
    {
        $area = Area::orderBy('name')->pluck('name', 'id');
        $area = [null => 'All Area'] + $area->toArray();
        $room = Room::orderBy('name')->pluck('name', 'id');
        $room = [null => 'All Room'] + $room->toArray();

        $search1 = $request->get('status');
        $search2 = $request->get('room');
        $search3 = $request->get('start');
        $search4 = $request->get('end');

        $data = Reservation::with('user', 'room')
            ->where('status', 'LIKE', '%' . $search1 . '%')
            ->where('room_id', 'LIKE', '%' . $search2 . '%')
            ->when(($search3 != null && $search4 != null), function ($query) use ($search3, $search4) {
                $query->whereBetween('start', [$search3, $search4]);
            })
            ->where('user_id', Auth::user()->id)
            ->get();
        return view('reservation.mybooking', compact('data', 'area', 'room'));
    }

    public function cancel(Request $request)
    {
        $data = Reservation::find($request->id);
        if ($data != null) {
            $data->status = $request->status;
            $data->reason = $request->reason;
            $data->save();

            return redirect(route('reservation.show'))->with('alertedit', 'anda telah membatalkan ruangan');
        } else {
            return redirect(route('reservation.show'))->with('alertedit', 'gagal');
        }
    }

    public static function notif()
    {
        $notif = Reservation::where('status', '=', 'pending')->get();
        return $notif;
    }
}