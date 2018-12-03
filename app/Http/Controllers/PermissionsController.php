<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
   public function index(){
       $permissions = Permission::all();
       return view ('permissions.index',compact('permissions'));
       }

   public function create(){
       $permission = Permission::get();
       return view('permissions.add',compact('permission'));
   }
    public function add(){
        return view('permissions.add',compact('permissions'));
    }

   public function store(Request $request)
   {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
            'display_name' => 'required',
            'description' => 'required',
        ]);
       $data = $request->toArray();
        Permission::create($data);
       return redirect(route('permissions.index'))->with('alert', 'Sukses Menambahkan Data Permission Baru');
    }
    public function edit($id){
        $permission = Permission::find($id);
        return view('permissions.add',compact('permission'));
    }

    public function update(Request $request, $id){
        $permission = Permission::find($id);
        $permission->fill($request->all());
        $permission->save();
        return redirect(route('permissions.index'))->with('alertedit',"$permission->name ,Sukses di rubah");
    }
    public function delete($id){
            Permission::destroy($id);
            return redirect(route('permissions.index'))->with('alertdel','Sukses menghapus Data Permission');
    }
}
