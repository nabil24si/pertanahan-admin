@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-table-large menu-icon"></i>
                </span>
                Data Persil
            </h3>
            <nav aria-label="breadcrumb">
                <a href="{{ route('persil.create') }}" class="btn btn-gradient-primary btn-icon-text">
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

                        <form method="GET" action="{{ route('persil.index') }}" class="mb-4">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Cari Kode Persil atau Pemilik..." value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-gradient-primary">
                                            <i class="mdi mdi-magnify"></i>Cari
                                        </button>
                                    </div>
                                </div>
                                @if (request('search') || request('penggunaan'))
                                    <div class="col-md-2">
                                        <a href="{{ route('persil.index') }}"
                                            class="btn btn-inverse-secondary btn-icon-text">
                                            <i class="mdi mdi-refresh btn-icon-prepend"></i> Reset
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Kode Persil</th>
                                        <th>Pemilik</th>
                                        <th>Luas (m²)</th>
                                        <th>Penggunaan</th>
                                        <th>Alamat Lahan</th>
                                        <th>RT / RW</th>
                                        <th class="text-center" width="200px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataPersil as $item)
                                        <tr>
                                            <td class="fw-bold text-primary">{{ $item->kode_persil }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-account-circle text-muted me-2"
                                                        style="font-size: 20px;"></i>
                                                    {{ $item->warga ? $item->warga->nama : '-' }}
                                                </div>
                                            </td>
                                            <td>{{ $item->luas_m2 }} m²</td>
                                            <td>
                                                 {{ $item->jenis ? $item->jenis->nama_penggunaan : '-' }}
                                            </td>
                                            <td class="text-wrap" style="max-width: 200px;">{{ $item->alamat_lahan }}</td>
                                            <td>{{ $item->rt }} / {{ $item->rw }}</td>

                                            {{-- Kolom Aksi (Gabungan Detail + Admin Actions) --}}
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">

                                                    {{-- Tombol Detail --}}
                                                    <a href="{{ route('persil.show', $item->persil_id) }}"
                                                        class="btn btn-sm btn-info text-white d-flex align-items-center"
                                                        title="Lihat Detail">
                                                        <i class="mdi mdi-eye me-1"></i> Detail
                                                    </a>

                                                    @if (Auth::check() && Auth::user()->role === 'Admin')
                                                        {{-- Tombol Edit --}}
                                                        <a href="{{ route('persil.edit', $item->persil_id) }}"
                                                            class="btn btn-sm btn-warning text-dark d-flex align-items-center"
                                                            title="Edit Data">
                                                            <i class="mdi mdi-pencil me-1"></i> Edit
                                                        </a>

                                                        {{-- Tombol Hapus --}}
                                                        <form action="{{ route('persil.destroy', $item->persil_id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger text-white d-flex align-items-center"
                                                                onclick="return confirm('Yakin ingin menghapus data ini beserta lampirannya?')"
                                                                title="Hapus Data">
                                                                <i class="mdi mdi-delete me-1"></i> Hapus
                                                            </button>
                                                        </form>
                                                    @endif

                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5 text-muted">
                                                <i class="mdi mdi-map-marker-off display-4 d-block mb-3"></i>
                                                Belum ada data persil yang ditemukan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 d-flex justify-content-end">
                            {{ $dataPersil->withQueryString()->links('pagination::simple-bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
