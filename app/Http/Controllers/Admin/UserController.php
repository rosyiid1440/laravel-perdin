<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Hash;
use Alert;

class UserController extends Controller
{
    public function index()
    {
        $data = User::with(['role'])->orderBy('name')->get();
        $role = Role::orderBy('nama_role')->get();
        return view('admin/user',compact('data','role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email',
            'password' => 'required|max:255|min:8|confirmed',
            'role_id' => 'required|in:2,3'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();

        Alert::success('Sukses','Data berhasil ditambah !');
        return back();
    }

    public function destroy($id)
    {
        User::find($id)->delete();

        Alert::success('Sukses','Data berhasil dihapus !');
        return back();
    }

    public function reset_password($id)
    {
        User::find($id)->update([
            'password' => Hash::make('12345678')
        ]);

        Alert::success('Sukses','Password berhasil direset !');
        return back();
    }

    public function update($id,Request $request)
    {
        $request->validate([
            'edit_name' => 'required|max:255',
            'edit_username' => 'required|max:255',
            'edit_role_id' => 'required|in:2,3'
        ]);

        $user = User::find($id);
        $user->name = $request->edit_name;
        $user->username = $request->edit_username;
        $user->role_id = $request->edit_role_id;
        $user->save();

        Alert::success('Sukses','Data berhasil diubah !');
        return back();
    }
}