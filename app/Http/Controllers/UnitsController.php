<?php

namespace App\Http\Controllers;

use App\Area;
use App\Unit;
use App\User;
use App\UserModel;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Unit::all();
        return view('units.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('units.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $data = $request->toArray();
        Unit::create($data);
        return redirect(route('units.index'))->with('alert', 'Sukses Menambahkan Data Unit Baru');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        $data = Unit::find($unit);
        return view('units.index', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Unit::find($id);

        $data->fill($request->all());
        $data->save();
        return redirect(route('units.index'))->with('alertedit', 'Sukses Edit Data Unit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function delete($unit)
    {
            Unit::destroy($unit);
            return redirect(route('units.index'))->with('alertdel', 'Sukses menghapus Data Unit');
    }

    public function trash()
    {
        $units = Unit::onlyTrashed()->get();
        return view('units.trash', compact('units'));
    }

    public function restore($id)
    {
        $unit = Unit::onlyTrashed()->findOrFail($id);
        $unit->restore();
        return redirect(route('units.trash'))->with('alertedit', 'Sukses merestore Data Ruangan');
    }

    public function perma_del($id)
    {
        $unit = Unit::onlyTrashed()->findOrFail($id);
        $unit->forceDelete();
        return redirect(route('units.trash'))->with('alertdel', 'Sukses menghapus permanen Data Ruangan');
    }

//    public function massDestroy(Request $request)
//    {
//        if ($request->input('id')) {
//            $entries = Unit::whereIn('id', $request->input('id'))->get();
//
//            foreach ($entries as $entry) {
//                $entry->delete();
//            }
//        }
//    }
}
