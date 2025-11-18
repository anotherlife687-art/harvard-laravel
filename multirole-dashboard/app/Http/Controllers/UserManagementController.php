<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    // Tampilkan halaman admin beserta daftar user
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $users = User::all();
        return view('dashboard.admin', compact('users'));
    }

    // Fungsi untuk mengubah role user
    public function updateRole(Request $request, User $user)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'role' => 'required|in:admin,guru,siswa',
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Role berhasil diperbarui.');
    }
}
