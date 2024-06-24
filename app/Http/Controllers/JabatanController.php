<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatans = Jabatan::all();
        return view('backend.jabatan.index', compact('jabatans'));
    }

    public function create()
    {
        return view('backend.jabatan.tambah');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jabatan' => 'required|string|max:255|unique:jabatans,jabatan',
        ]);

        Jabatan::create([
            'jabatan' => $validated['jabatan'],
        ]);

        return redirect()->route('jabatans.index')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return view('backend.jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jabatan' => 'required|string|max:255',
        ]);

        $jabatan = Jabatan::findOrFail($id);
        $jabatan->update([
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->route('jabatans.index')->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();

        return redirect()->route('jabatans.index')->with('success', 'Jabatan berhasil dihapus.');
    }

    public function show($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return view('backend.jabatan.show', compact('jabatan'));
    }
}
