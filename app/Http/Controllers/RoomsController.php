<?php

namespace App\Http\Controllers;

use App\Area;
use App\Http\Requests\StoreAuthorRequest;
use App\Reservation;
use App\Room;
use Illuminate\Http\Request;
use Alert;
use Zizaco\Entrust\Entrust;
use File;
use Storage;
use App\Facility;
class RoomsController extends Controller
{
    function index()
    {
        // $data = Room::join('facilities', 'rooms.facility_id', '=', 'facilities.id')
        //     ->get();
        // dd($data);
        // return view('rooms.index', compact('data'));
        // $data = Room::with(['area', 'facility'])->get();
        // dd($data);

        // foreach ($data as $d) {
        //     dd($d->facility_id);
        // }
        $facilities = [];
        $data = Room::with('area')->get();
        foreach ($data as $d) {
            $facilities= Facility::find($d->facility_id)/* ->orderBy('name') */->get();
        }

        dd($facilities);
        
        return view('rooms.index', compact('data', 'facilities'));
    }

    function create()
    {
        $facility=facility::get();
        return view('rooms.add', compact('facility'));
    }

    function add()
    {
        $select = Area::orderBy('name')->pluck('name', 'id');
        $facilities = Facility::orderBy('name')->pluck('name','id');
        $select = [null => 'Pilih Area'] + $select->toArray();
        return view('rooms.add', compact('select','facilities'));
    }

    function delete($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect(route('rooms.index'))->with('alertdel', 'Sukses menghapus Data Ruangan');
    }

    function store(Request $request)
    {
        $this->validate($request, [
            'area_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'capacity' => 'required',
            'contact_name' => 'required',
            'contact_email' => 'required|email',
            'contact_hp' => 'required|numeric',
            'photo' => 'image|max:2048',
        ], [
            'email.required' => 'Mohon email diisi dan harus berbentuk email', //custom validasi
            'email.email' => 'Format E-Mail masih salah', //custom validasi
            'photo.required' => 'foto harus berformat jpg',
        ]);

        $data = Room::create($request->except('photo'));
        
        if ($request->hasFile('photo')){
            Storage::delete('img/');
            $uploaded_photo = $request->file('photo');

            $extension = $uploaded_photo->getClientOriginalExtension();

            $filename = md5(time()) . '.' . $extension;

            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
            $uploaded_photo->move($destinationPath,$filename);

            $data->photo = $filename;
            $data->save();
            $data = $request->toArray();
    //    $role = Role::create($data);
    //    $role->permissions()->sync($request->permission);
      
        }
        return redirect(route('rooms.index'))->with('alert', 'Sukses Menambahkan Data Ruangan Baru');
    }

    function edit($id)
    {
        $data = Room::find($id);
        $select = Area::orderBy('name')->pluck('name', 'id');
        $allfacilities = Facility::orderBy('name')->pluck('name','id');
        $assignedfacilities = $data->facilities->pluck('id')->toArray();
        return view('rooms.add', compact('data', 'select','allfacilities','assignedfacilities'));
    } 

    public function update(Request $request, $id)
    {
        $data = Room::find($id);
        $data->name          = $request->name;
        $data->area_id       = $request->area_id;
        $data->capacity      = $request->capacity;
        $data->contact_name  = $request->contact_name;
        $data->contact_email = $request->contact_email;
        $data->contact_hp    = $request->contact_hp;
        $data->description   = $request->description;
        $data->is_active     = $request->is_active;
        $data->facility_id   = $request->facility_id;

        if ($request->hasFile('photo')){            
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';            
            File::delete($destinationPath . '/' . $data->photo);

            $uploaded_photo = $request->file('photo');
            $extension      = $uploaded_photo->getClientOriginalExtension();
            $filename       = md5(time()) . '.' . $extension;
            $uploaded_photo->move($destinationPath, $filename);
            $data->photo = $filename;
        }
       
        if(empty($request['is_active']))
            $request['is_active'] = 0;
        $data->facilities()->sync($request->facility);
        $data->save();

        return redirect(route('rooms.index'))->with('alertedit', 'Sukses Edit Data Area');
    }
    

    public function getByAreaId()
    {
        $areaId = request()->areaId;
        $data = Room::where('area_id', $areaId)->pluck('name', 'id');
        $data = [null => 'Chose Room'] + $data->toArray();
        $s = '';
        foreach ($data as $k => $v) {
            $s .= '<option value="' . $k . '">' . $v . '</option>';
        }
        return $s;
    }

    public function trash()
    {
        $rooms = Room::onlyTrashed()->get();
        return view('rooms.trash', compact('rooms'));
    }

    public function restore($id)
    {
        $room = Room::onlyTrashed()->findOrFail($id);
        $room->restore();
        return redirect(route('rooms.trash'))->with('alertedit', 'Sukses merestore Data Ruangan');
    }

    public function perma_del($id)
    {
        $room = Room::onlyTrashed()->findOrFail($id);
        $room->forceDelete();

        return redirect(route('rooms.trash'))->with('alertdel', 'Sukses menghapus permanen Data Ruangan');
    }

//    public function massDestroy(Request $request)
//    {
//        if ($request->input('id')) {
//            $entries = Room::whereIn('id', $request->input('id'))->get();
//
//            foreach ($entries as $entry) {
//                $entry->delete();
//            }
//        }
//    }
}
