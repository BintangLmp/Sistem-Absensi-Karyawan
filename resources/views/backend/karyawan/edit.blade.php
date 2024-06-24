@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Karyawan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Karyawan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <form method="POST" action="{{ url('/datakaryawan/update/' . $karyawan->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id_karyawan">NIP</label>
                                <input type="text" class="form-control" name="nip" maxlength="9" required value="{{ $karyawan->id_karyawan }}">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" required value="{{ $karyawan->nama }}">
                            </div>
                            <div class="form-group">
                                <label for="tmp_tgl_lahir">Tempat dan Tanggal Lahir</label>
                                <input type="text" class="form-control" name="tmp_tgl_lahir" required value="{{ $karyawan->tmp_tgl_lahir }}">
                            </div>
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <select class="form-control" name="jk" required>
                                    <option value="Laki-laki" {{ $karyawan->jk == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $karyawan->jk == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="agama">Agama</label>
                                <select class="form-control" name="agama" required>
                                    <option value="Islam" {{ $karyawan->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ $karyawan->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katholik" {{ $karyawan->agama == 'Katholik' ? 'selected' : '' }}>Katholik</option>
                                    <option value="Hindu" {{ $karyawan->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ $karyawan->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="KongHuCu" {{ $karyawan->agama == 'KongHuCu' ? 'selected' : '' }}>KongHuCu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" name="alamat" required>{{ $karyawan->alamat }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="no_tel">No Telepon</label>
                                <input type="text" class="form-control" name="no_tel" maxlength="18" required value="{{ $karyawan->no_tel }}">
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <select class="form-control" name="jabatan" required>
                                    <option value="">--</option>
                                    @foreach($jabatan as $data)
                                        <option value="{{ $data }}" {{ $karyawan->jabatan == $data ? 'selected' : '' }}>{{ $data }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" class="form-control" name="foto">
                                <img src="{{ asset('storage/' . $karyawan->foto) }}" alt="Foto Karyawan" width="100">
                            </div>
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('datakaryawan.update', $karyawan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ url('/datakaryawan') }}" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
