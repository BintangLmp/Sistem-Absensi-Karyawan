@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2 class="title-1" style="text-align: center;">Form Absensi</h2>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6 offset-md-3">
            <form action="{{ route('absen.ta,bah') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="id_karyawan">NIP</label>
                    <input type="text" class="form-control" name="id_karyawan" value="{{ $user->id }}" readonly>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" value="{{ $user->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="waktu">Waktu</label>
                    <input type="text" class="form-control" name="waktu" value="{{ now() }}" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Absen</button>
                <a href="{{ route('absen') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
