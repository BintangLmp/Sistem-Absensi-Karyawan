<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id'; 
    protected $fillable = [
        'nip', 'nama', 'tmp_tgl_lahir', 
        'JK', 'agama', 'alamat', 'no_tel', 'foto', 'jabatan_id'
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function absens()
    {
        return $this->hasMany(Absen::class);
    }
    // App\Models\Karyawan.php
public function user()
{
    return $this->hasOne(User::class);
}

}
