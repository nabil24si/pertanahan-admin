@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-account-group"></i> </span>
                Data Warga
            </h3>
            <nav aria-label="breadcrumb">
                <a href="{{ route('warga.create') }}" class="btn btn-gradient-primary btn-icon-text">
                    <i class="mdi mdi-plus btn-icon-prepend"></i> Tambah Data
                </a>
            </nav>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <form method="GET" action="{{ route('warga.index') }}" class="mb-4">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text bg-transparent border-end-0">
                                            <i class="mdi mdi-magnify text-primary"></i>
                                        </span>
                                        <input type="text" name="search" class="form-control border-start-0"
                                            placeholder="Cari nama atau NIK..." value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-gradient-primary">Cari</button>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                                        <option value="">-- Semua Gender --</option>
                                        <option value="Laki-laki"
                                            {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="Perempuan"
                                            {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                </div>

                                @if (request('search') || request('jenis_kelamin'))
                                    <div class="col-md-2">
                                        <a href="{{ route('warga.index') }}" class="btn btn-inverse-secondary btn-sm">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>No KTP</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Agama</th>
                                        <th>Pekerjaan</th>
                                        <th>Kontak</th>
                                        @if (Auth::check() && Auth::user()->role === 'Admin')
                                            <th class="text-center" width="150px">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataWarga as $item)
                                        <tr>
                                            <td class="fw-bold text-muted">{{ $item->no_ktp }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-gradient-info text-white rounded-circle d-flex justify-content-center align-items-center me-2"
                                                        style="width:30px; height:30px; font-size:12px;">
                                                        {{ substr($item->nama, 0, 1) }}
                                                    </div>
                                                    {{ $item->nama }}
                                                </div>
                                            </td>
                                            <td>
                                                @if ($item->jenis_kelamin == 'Laki-laki')
                                                    <span class="badge rounded-pill bg-info text-dark">Laki-laki</span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger text-white">Perempuan</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->agama }}</td>
                                            <td>{{ $item->pekerjaan }}</td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <small><i class="mdi mdi-phone text-success"></i>
                                                        {{ $item->telp }}</small>
                                                    <small class="text-muted">{{ $item->email }}</small>
                                                </div>
                                            </td>
                                            @if (Auth::check() && Auth::user()->role === 'Admin')
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        {{-- Tombol Edit --}}
                                                        <a href="{{ route('warga.edit', $item->warga_id) }}"
                                                            class="btn btn-sm btn-warning text-dark d-flex align-items-center">
                                                            <i class="mdi mdi-pencil me-1"></i> Edit
                                                        </a>

                                                        {{-- Tombol Hapus --}}
                                                        <form action="{{ route('warga.destroy', $item->warga_id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger d-flex align-items-center"
                                                                onclick="return confirm('Yakin ingin menghapus data {{ $item->nama }}?')">
                                                                <i class="mdi mdi-delete me-1"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4 text-muted">
                                                <i class="mdi mdi-file-find display-4 d-block mb-2"></i>
                                                Data tidak ditemukan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 d-flex justify-content-end">
                            {{ $dataWarga->withQueryString()->links('pagination::SIMPLE-bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
