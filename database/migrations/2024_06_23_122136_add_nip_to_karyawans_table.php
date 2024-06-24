<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNipToKaryawansTable extends Migration
{
    public function up()
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->string('nip')->unique()->after('id'); // Pastikan kolom sesuai dengan kebutuhan Anda
        });
    }

    public function down()
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->dropColumn('nip');
        });
    }
}
