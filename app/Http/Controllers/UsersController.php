<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Unit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use File;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   

    public function index()
    {
        $roles = Role::all();
        $data = User::with('Unit')->get();
        return view('users.index', compact('data', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $select = Unit::orderBy('name')->pluck('name', 'id');
        $select = [null => 'Pilih Unit'] + $select->toArray();
        $roles = Role::orderBy('name')->pluck('name', 'id');
        return view('users.add', compact('select', 'roles'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'unit_id' => 'required',
            'role'=> 'required',
            'photo' => 'required|image|max:2048',
        ]);
        $data = $request->toArray();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'unit_id' => $data['unit_id'],
            'password' => bcrypt($data['password']),
        ]);
        $user->roles()->sync($request->role);
        return redirect(route('users.index'))->with('alert', 'Sukses Menambahkan Data User Baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserModel $userModel
     * @return \Illuminate\Http\Response
     */
    public function show(UserModel $userModel)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserModel $userModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        $select = Unit::orderBy('name')->pluck('name', 'id');
        $allRoles = Role::orderBy('name')->pluck('name', 'id');
        $assignedRoles  = $data->roles->pluck('id')->toArray();
        return view('users.add', compact('data', 'select', 'assignedRoles','allRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\UserModel $userModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = User::find($id);
        $data->fill($request->all());
        $data->roles()->sync($request->role);
        $data->save();
        return redirect(route('users.index'))->with('alertedit', 'Sukses Edit Data User');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserModel $userModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currentUser= Auth::user();
        $user= User::findOrFail($id);
        if($user->id != $currentUser->id) {
            User::destroy($id);
            return redirect(route('users.index'))->with('alertdel', 'Sukses menghapus Data User');
        }
        return redirect(route('users.index'))->with('alertError', 'Tidak bisa hapus data sendiri!');

    }

    public function editProfile($id)
    {
        $data = User::find($id);
        $roles = Role::all();
        $select = Unit::orderBy('name')->pluck('name', 'id');
        return view('users.profile', compact('data', 'select','roles'));
    }

    public function updateProfile(Request $request, $id)
    {   
        $data = User::find($id);
        // $data->fill($request->all());
        $data->name = $request->name;
        $data->email = $request->email;
        $data->unit_id = $request->unit_id;
        


        if ($request->hasFile('photo')){            
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';            
            File::delete($destinationPath . '/' . $data->photo);

            $uploaded_photo = $request->file('photo');
            $extension      = $uploaded_photo->getClientOriginalExtension();
            $filename       = md5(time()) . '.' . $extension;
            $uploaded_photo->move($destinationPath, $filename);
            $data->photo = $filename;
        }
        // if ($request->hasFile('photo')){
        //     $uploaded_photo = $request->file('photo');
        //     $extension = $uploaded_photo->getClientOriginalExtension();
        //     $filename = md5(time()) . '.' . $extension;
        //     $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
        //     $uploaded_photo->move($destinationPath,$filename);
        //     $data->photo = $filename;
            
        // }

       
        $data->save();
        
        return redirect()->back()->with('alertedit', 'Sukses Edit Profile');
    }
}
