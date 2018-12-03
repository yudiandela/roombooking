<?php

namespace App\Http\Controllers;

use App\Area;
use App\Models\Role;
use App\Unit;
use App\Room;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Zizaco\Entrust\Entrust;

class AreasController extends Controller
{
    public function index(Request $request){
            $data = Area:: with('rooms')->get();
            return view('areas.index',compact('data'));
    }
    //menuju form inputan
    public function add(){
        $select = Unit::orderBy('name')->pluck('name','id');
        $select = [null => 'Pilih Unit'] + $select->toArray();
        return view('areas.add', compact('select'));
    }
    //proses menyimpan data pada saat menekan tombol save
    public function store(Request $request){
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                'unit_id' => 'required',
            ]);
            $data = $request->toArray();
            Area::create($data);
            return redirect(route('areas.index'))->with('alert', 'Sukses Menambahkan Data Area Baru');

    }
    public function edit($id){
        $data = Area::find($id);
        $select = Unit::orderBy('name')->pluck('name','id');
        return view('areas.add',compact('data','select'));
    }

    public function update(Request $request, $id){
        $data = Area::find($id);
        $data->fill($request->all());
        $data->save();
        return redirect(route('areas.index'))->with('alertedit',"$data->name ,Sukses di rubah");
    }
    public function delete($id){
            Area::destroy($id);
            return redirect(route('areas.index'))->with('alertdel','Sukses menghapus Data Area');
    }

    public function trash()
    {
        $areas = Area::onlyTrashed()->get();
        return view('areas.trash', compact('areas'));
    }

    public function restore($id)
    {
        $area = Area::onlyTrashed()->findOrFail($id);
        $area->restore();
        return redirect(route('areas.trash'))->with('alertedit', 'Sukses merestore Data Ruangan');
    }

    public function perma_del($id)
    {
        $area = Area::onlyTrashed()->findOrFail($id);
        $area->forceDelete();
        return redirect(route('areas.trash'))->with('alertdel', 'Sukses menghapus permanen Data Ruangan');
    }

//    public function massDestroy(Request $request)
//    {
//        if ($request->input('id')) {
//            $entries = Area::whereIn('id', $request->input('id'))->get();
//
//            foreach ($entries as $entry) {
//                $entry->delete();
//            }
//        }
//    }
}
