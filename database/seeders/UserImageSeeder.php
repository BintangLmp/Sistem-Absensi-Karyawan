<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserImageSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('role', 'Admin')->first();
        if ($admin) {
            $admin->image_path = 'path_to_admin_image.jpg';
            $admin->save();
        }

        $karyawan = User::where('role', 'Karyawan')->first();
        if ($karyawan) {
            $karyawan->image_path = 'path_to_karyawan_image.jpg';
            $karyawan->save();
        }
    }
}
