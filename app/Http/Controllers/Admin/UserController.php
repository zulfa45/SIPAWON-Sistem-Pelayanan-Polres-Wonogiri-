<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'role' => 'required|in:admin,user',
        ]);
        
        // Prevent admin from removing their own admin role
        if ($user->id === auth()->id() && $request->role !== 'admin') {
            return back()->with('error', 'Anda tidak dapat menghapus akses admin Anda sendiri.');
        }

        $user->update(['role' => $request->role]);

        return back()->with('success', 'Peran pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent admin from deleting themselves
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }
        
        $user->delete();

        return back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
