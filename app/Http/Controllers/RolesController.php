<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
   public function index(){
       $permissions = Permission::orderBy('display_name')->get();
       $roles = Role::all();
       return view ('roles.index',compact('roles','permissions'));
       }

   public function create(){
       $permission = Permission::get();
       return view('roles.add',compact('permission'));
   }
    public function add(){
        $permissions = Permission::orderBy('name')->pluck('name','id');
        return view('roles.add',compact('permissions'));
    }

   public function store(Request $request)
   {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'description' => 'required',
        ]);
       $data = $request->toArray();
       $role = Role::create($data);
       $role->permissions()->sync($request->permission);
       return redirect(route('roles.index'))->with('alert', 'Sukses Menambahkan Data Role Baru');
    }
    public function edit($id){
        $role = Role::find($id);
        $allPermissions = Permission::orderBy('name')->pluck('name', 'id');
        $assignedPermissions = $role->permissions->pluck('id')->toArray();
        return view('roles.add', compact( 'allPermissions','assignedPermissions','role'));
    }

    public function update(Request $request, $id){
        $role = Role::find($id);
        $role->fill($request->all());
        $role->permissions()->sync($request->permission);
        $role->save();
        return redirect(route('roles.index'))->with('alertedit',"$role->name ,Sukses di rubah");
    }
    public function delete($id){
            Role::destroy($id);
            return redirect(route('roles.index'))->with('alertdel','Sukses menghapus Data Role');
    }
}
