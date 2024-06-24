<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('karyawan')->get();
        return view('backend.user.index', compact('users'));
    }

    public function create()
    {
        $karyawans = Karyawan::all();
        return view('backend.user.tambah', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|max:20',
            'nip' => 'required_if:role,Karyawan|exists:karyawans,nip',
        ]);

        try {
            $user = new User();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->password = Hash::make($validated['password']);
            $user->role = $validated['role'];

            if ($validated['role'] == 'Karyawan') {
                $user->nip = $validated['nip'];
            }

            $user->save();

            return redirect('/users')->with('success', 'Data user berhasil disimpan!');
        } catch (Exception $e) {
            Log::error('Error saving user: ' . $e->getMessage());
            return redirect()->back()->withErrors('Gagal menyimpan data user. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $karyawans = Karyawan::all();
        return view('backend.user.edit', compact('user', 'karyawans'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|string|max:20',
            'nip' => 'required_if:role,Karyawan|exists:karyawans,nip',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            if ($request->filled('password')) {
                $user->password = Hash::make($validated['password']);
            }
            $user->role = $validated['role'];

            if ($validated['role'] == 'Karyawan') {
                $user->nip = $validated['nip'];
            } else {
                $user->nip = null;
            }

            $user->save();

            return redirect('/users')->with('success', 'Data user berhasil diperbarui!');
        } catch (Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return redirect()->back()->withErrors('Gagal memperbarui data user. Silakan coba lagi.');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect('/users')->with('success', 'Data user berhasil dihapus!');
        } catch (Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->back()->withErrors('Gagal menghapus data user. Silakan coba lagi.');
        }
    }
}
