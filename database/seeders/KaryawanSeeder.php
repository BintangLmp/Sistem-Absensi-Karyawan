<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;
use App\Models\Jabatan;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        $jabatan = Jabatan::where('jabatan', 'Manager')->first();

        if ($jabatan) {
            Karyawan::create([
                'nip' => 1,
                'nama' => 'John Doe',
                'tmp_tgl_lahir' => 'Jakarta, 01-01-1990',
                'JK' => 'Laki-laki',
                'agama' => 'Islam',
                'alamat' => 'Jl. Kebon Jeruk No. 1',
                'no_tel' => '08123456789',
                'foto' => 'johndoe.jpg',
                'jabatan_id' => $jabatan->id,
            ]);
        }
    }
}
