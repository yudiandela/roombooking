<?php

namespace App\Http\Controllers;

use App\Facility;
use Illuminate\Http\Request;
use App\Room;
Class FacilitiesController extends controller
{

    public function index(){
        $facilities = Facility::with('room')->get();
        return view ('facilities.index',compact('facilities'));
    }

    public function add(){
       
        $select = Room::orderBy('name')->pluck('name', 'id');
        $select = [null => 'Pilih ruangan'] + $select->toArray();
        return view('facilities.add', compact('select'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' =>'required|unique:permissions,name',


        ]); 
        $data = $request->toArray();
        Facility::Create($data);
        return redirect(route('facilities.index'))->with('alert','Sukses menambahkan Data Fasilitas baru');
    }

    public function edit($id){
       
       
        $facility = Facility::find($id);
        $select = Room::orderBy('name')->pluck('name', 'id');
        return view('facilities.add',compact('facility','select'));
    }

    public function facilityupdate(Request $request, $id){
        $facility = Facility::find($id);
        $facility->fill($request->all());
        $facility->save();
        return redirect(route('facilities.index'))->with('alertedit',"$facility->name ,Sukses di rubah");
    }
    public function facilitydelete($id){
            Facility::destroy($id);
            return redirect(route('facilities.index'))->with('alertdel','Sukses menghapus Data Fasilitas');
    }


}