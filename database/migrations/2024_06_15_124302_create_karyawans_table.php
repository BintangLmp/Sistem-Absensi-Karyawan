<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id(); // Pastikan kolom id ada di sini
            $table->string('nama');
            $table->string('tmp_tgl_lahir');
            $table->enum('jk', ['Laki-laki', 'Perempuan']);
            $table->enum('agama', ['Islam', 'Kristen', 'Katholik', 'Hindu', 'Buddha', 'KongHuCu']);
            $table->text('alamat');
            $table->string('no_tel', 18);
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('jabatan_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawans');
    }
}
