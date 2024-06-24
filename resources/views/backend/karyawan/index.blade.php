@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Karyawan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Karyawan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('/datakaryawan/tambah') }}" class="btn btn-primary">Tambah Karyawan</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Tempat dan Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Agama</th>
                                    <th>Alamat</th>
                                    <th>No Telepon</th>
                                    <th>Jabatan</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawans as $karyawan)
                                    <tr>
                                        <td>{{ $karyawan->nip }}</td>
                                        <td>{{ $karyawan->nama }}</td>
                                        <td>{{ $karyawan->tmp_tgl_lahir }}</td>
                                        <td>{{ $karyawan->jk }}</td>
                                        <td>{{ $karyawan->agama }}</td>
                                        <td>{{ $karyawan->alamat }}</td>
                                        <td>{{ $karyawan->no_tel }}</td>
                                        <td>{{ $karyawan->jabatan->jabatan }}</td> <!-- Perbaikan pada bagian ini -->
                                        <td><img src="{{ url('uploads/' . $karyawan->foto) }}" width="50" height="50"></td>
                                        <td>
                                            <a href="{{ url('/datakaryawan/edit/' . $karyawan->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('/datakaryawan/hapus/' . $karyawan->id) }}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
