<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', [
            'title' => 'Admin',
            'menu' => 'Users',
            'users' => $users,
        ]);
    }

    public function create()
    {
        $users = User::all();
        return view('users.create', [
            'title' => 'Admin',
            'menu' => 'Users',
            'users' => $users
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
        
        // Validasi: tidak boleh hapus diri sendiri
        if ($user->id == Auth::id()) {
            return redirect()->route('users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Validasi: untuk role yang sama, harus tersisa minimal 1 user
        $countSameJabatan = User::where('jabatan', $user->jabatan)->count();
        if ($countSameJabatan <= 1) {
            return redirect()->route('users.index')->with('error', "Tidak dapat menghapus user karena role {$user->jabatan} harus memiliki setidaknya satu user.");
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (!$ids || !is_array($ids)) {
            return redirect()->route('users.index')->with('error', 'Tidak ada user yang dipilih.');
        }

        $errors = [];
        $successIds = [];

        foreach ($ids as $id) {
            $user = User::find($id);
            if (!$user) {
                continue;
            }

            // Cek hapus diri sendiri
            if ($user->id == Auth::id()) {
                $errors[] = "User '{$user->name}' tidak dapat dihapus karena merupakan akun Anda sendiri.";
                continue;
            }

            // Cek jumlah role
            $countSameJabatan = User::where('jabatan', $user->jabatan)->count();
            if ($countSameJabatan <= 1) {
                $errors[] = "User '{$user->name}' dengan role {$user->jabatan} tidak dapat dihapus karena harus tersisa minimal satu user untuk role tersebut.";
                continue;
            }

            $successIds[] = $id;
        }

        if (!empty($successIds)) {
            User::whereIn('id', $successIds)->delete();
        }

        if (!empty($errors)) {
            $errorMessage = implode('<br>', $errors);
            return redirect()->route('users.index')->with('error', $errorMessage);
        }

        if (!empty($successIds)) {
            return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus!');
        }

        return redirect()->route('users.index')->with('error', 'Tidak ada user yang dapat dihapus.');
    }
}