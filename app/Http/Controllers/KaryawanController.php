<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\Absen;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    // Menampilkan daftar karyawan
    public function index()
    {
        $karyawans = Karyawan::with('jabatan')->get();
        $absens = Absen::all();
        return view('backend.karyawan.index', compact('karyawans','absens'));
    }

    // Menampilkan form tambah karyawan
    public function tambah()
    {
        $jabatan = Jabatan::all(); // Mendapatkan semua data jabatan
        return view('backend.karyawan.tambah', compact('jabatan'));
    }

    // Menyimpan data karyawan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:9',
            'nama' => 'required|string|max:255',
            'tmp_tgl_lahir' => 'required|string|max:255',
            'jk' => 'required|string|max:20',
            'agama' => 'required|string|max:20',
            'alamat' => 'required|string',
            'no_tel' => 'required|string|max:18',
            'jabatan_id' => 'required|exists:jabatans,id',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $karyawan = new Karyawan();
        $karyawan->nip = $validated['nip'];
        $karyawan->nama = $validated['nama'];
        $karyawan->tmp_tgl_lahir = $validated['tmp_tgl_lahir'];
        $karyawan->jk = $validated['jk'];
        $karyawan->agama = $validated['agama'];
        $karyawan->alamat = $validated['alamat'];
        $karyawan->no_tel = $validated['no_tel'];
        $karyawan->jabatan_id = $validated['jabatan_id'];
    
        if ($request->hasFile('foto')) {
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $fileName);
            $karyawan->foto = $fileName;
        }
    
        $karyawan->save();
    
        return redirect('/datakaryawan')->with('success', 'Data karyawan berhasil disimpan!');
    }
     
    // Menampilkan form edit karyawan
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $jabatan = Jabatan::all();
        return view('backend.karyawan.edit', compact('karyawan', 'jabatan'));
    }

    // Mengupdate data karyawan
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:9',
            'nama' => 'required|string|max:255',
            'tmp_tgl_lahir' => 'required|string|max:255',
            'jk' => 'required|string|max:20',
            'agama' => 'required|string|max:20',
            'alamat' => 'required|string',
            'no_tel' => 'required|string|max:18',
            'jabatan_id' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->fill($validated);

        if ($request->hasFile('foto')) {
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $fileName);
            $karyawan->foto = $fileName;
        }

        $karyawan->save();

        return redirect('/datakaryawan')->with('success', 'Data karyawan berhasil diperbarui!');
    }

    // Menghapus data karyawan
    public function hapus($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();
        return redirect('/datakaryawan')->with('success', 'Data karyawan berhasil dihapus!');
    }

}
