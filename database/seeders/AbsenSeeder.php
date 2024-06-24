<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;
use App\Models\Absen;

class AbsenSeeder extends Seeder
{
    public function run()
    {
        $karyawan = Karyawan::first();

        if ($karyawan) {
            Absen::create([
                'id_karyawan' => $karyawan->id,
                'nama' => $karyawan->nama,
                'waktu' => now(),
            ]);
        }
    }
}
