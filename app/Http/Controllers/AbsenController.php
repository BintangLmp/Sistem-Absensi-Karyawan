<?php
namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    public function index()
    {
        $absens = Absen::with('karyawan')->get();
        return view('backend.absen.index', compact('absens'));
    }

    public function tambah()
    {
        // Ambil karyawan yang sedang login
        $user = Auth::user();
        $karyawan = $user->karyawan;

        if (is_null($karyawan)) {
            return redirect()->back()->with('error', 'Karyawan tidak ditemukan. Pastikan Anda memiliki entri terkait di tabel karyawans.');
        }

        return view('backend.absen.tambah', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'required',
            'waktu_keluar' => 'nullable',
        ]);

        Absen::create($request->all());

        return redirect()->route('absen.index')->with('success', 'Absensi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $absen = Absen::findOrFail($id);
        $karyawans = Karyawan::all();
        return view('backend.absen.edit', compact('absen', 'karyawans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'required',
            'waktu_keluar' => 'nullable',
        ]);

        $absen = Absen::findOrFail($id);
        $absen->update($request->all());

        return redirect()->route('absen.index')->with('success', 'Absensi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $absen = Absen::findOrFail($id);
        $absen->delete();

        return redirect()->route('absen.index')->with('success', 'Absensi berhasil dihapus.');
    }
    

    public function absenMasuk(Request $request)
    {
        $user = Auth::user();
        $karyawan = $user->karyawan;

        if (!$karyawan) {
            return redirect()->route('absen.index')->with('error', 'Karyawan tidak ditemukan. Pastikan Anda memiliki entri terkait di tabel karyawans.');
        }

        Absen::create([
            'karyawan_id' => $karyawan->id,
            'tanggal' => date('Y-m-d'),
            'waktu_masuk' => date('H:i:s'),
        ]);

        return redirect()->route('absen.index')->with('success', 'Anda berhasil absen masuk.');
    }

    public function absenKeluar(Request $request)
    {
        $user = Auth::user();
        $karyawan = $user->karyawan;

        if (!$karyawan) {
            return redirect()->route('absen.index')->with('error', 'Karyawan tidak ditemukan. Pastikan Anda memiliki entri terkait di tabel karyawans.');
        }

        $absen = Absen::where('karyawan_id', $karyawan->id)->where('tanggal', date('Y-m-d'))->first();

        if ($absen) {
            $absen->update(['waktu_keluar' => date('H:i:s')]);
            return redirect()->route('absen.index')->with('success', 'Anda berhasil absen keluar.');
        } else {
            return redirect()->route('absen.index')->with('error', 'Anda belum absen masuk hari ini.');
        }
    }
}
