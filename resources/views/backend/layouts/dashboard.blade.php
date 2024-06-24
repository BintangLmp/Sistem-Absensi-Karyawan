@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if(auth()->user()->role == 'Admin')
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ auth()->user()->role }} - Dashboard</h5>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(auth()->user()->role == 'Karyawan')
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Dashboard Absensi</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($absens)
                                    @foreach ($absens as $absen)
                                        <tr>
                                            <td>{{ $absen->karyawan->nip }}</td>
                                            <td>{{ $absen->karyawan->nama }}</td>
                                            <td>{{ $absen->waktu_masuk }} - {{ $absen->waktu_keluar ?? 'Belum Absen Keluar' }}</td>
                                        </tr>
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('absen.masuk') }}" method="post" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-primary">Absen Masuk</button>
                            </form>
                            <form action="{{ route('absen.keluar') }}" method="post" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Absen Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
</div>
@endsection
