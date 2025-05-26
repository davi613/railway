<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        
        $users = User::all();
        return view('users.index', [
            'title' => 'Admin',
            'menu' => 'Users',
            'users' => $users, // Kirim variabel $users ke view
        ]);
    }

    public function create()
    {
        // return view('users.create');
        $users = User::all();
        return view('users.create', [
            'title' => 'Admin',
            'menu' => 'Users',
            'users' => $users // Kirim variabel $users ke view
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'jabatan' => 'required|in:admin,apoteker,karyawan,kasir,pemilik',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');

        
    }

    public function edit($id)
    {
 
        $users = User::find($id);
        return view('users.edit',[
            'title' => 'Admin',
            'menu' => 'Users',
            'users' => $users
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'jabatan' => 'required|in:admin,apoteker,karyawan,kasir,pemilik',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->jabatan = $request->jabatan;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}