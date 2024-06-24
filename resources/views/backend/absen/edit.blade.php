@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Absensi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Absensi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('absen.update', $absen->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="karyawan_id">Nama Karyawan</label>
                                <select name="karyawan_id" id="karyawan_id" class="form-control">
                                    @foreach($karyawans as $karyawan)
                                        <option value="{{ $karyawan->id }}" {{ $karyawan->id == $absen->karyawan_id ? 'selected' : '' }}>{{ $karyawan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $absen->tanggal }}" required>
                            </div>
                            <div class="form-group">
                                <label for="waktu_masuk">Waktu Masuk</label>
                                <input type="time" name="waktu_masuk" id="waktu_masuk" class="form-control" value="{{ $absen->waktu_masuk }}" required>
                            </div>
                            <div class="form-group">
                                <label for="waktu_keluar">Waktu Keluar</label>
                                <input type="time" name="waktu_keluar" id="waktu_keluar" class="form-control" value="{{ $absen->waktu_keluar }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
