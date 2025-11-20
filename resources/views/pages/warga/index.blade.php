@extends('layouts.admin.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Bina Desa </h3>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <a href="{{ route('warga.create') }}" class="btn btn-gradient-info">Tambah Data</a>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Warga</h4>
                        <p class="card-description"> Warga yang terdaftar</p>
                        </p>
                        <div class="table-responsive">
                            <form method="GET" action="{{ route('warga.index') }}" class="mb-3">
                                <div class="row">
                                    <div class="col-md-2">
                                        <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                                            <option value="">All</option>
                                            <option value="Laki-laki"
                                                {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                            </option>
                                            <option value="Perempuan"
                                                {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control"
                                                id="exampleInputIconRight" value="{{ request('search') }}"
                                                placeholder="Search" aria-label="Search">
                                            <button type="submit" class="input-group-text" id="basic-addon2">
                                                <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                            @if (request('search'))
                                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                                    class="btn btn-outline-secondary ml-3" id="clear-search"> Clear</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No KTP</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Agama</th>
                                        <th>Pekerjaan</th>
                                        <th>No Telepon</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataWarga as $item)
                                        <tr>
                                            <td>{{ $item->no_ktp }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->jenis_kelamin }}</td>
                                            <td>{{ $item->agama }}</td>
                                            <td>{{ $item->pekerjaan }}</td>
                                            <td>{{ $item->telp }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td><a href="{{ route('warga.edit', $item->warga_id) }}"
                                                    class="btn btn-gradient-success">Edit</a>
                                                <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                                                    style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-gradient-danger"
                                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $dataWarga->links('pagination::simple-bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
