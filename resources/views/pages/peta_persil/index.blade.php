@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white me-2">
                    <i class="mdi mdi-map-marker-radius"></i>
                </span>
                Data Peta Persil
            </h3>
            <nav aria-label="breadcrumb">
                <a href="{{ route('peta_persil.create') }}" class="btn btn-gradient-primary btn-icon-text">
                    <i class="mdi mdi-plus btn-icon-prepend"></i> Tambah Peta
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

                        {{-- Form Pencarian dan Filter --}}
                        <form method="GET" action="{{ route('peta_persil.index') }}" class="mb-4">
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Cari berdasarkan Kode Persil, Pemilik, dll..." value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-gradient-primary">
                                            <i class="mdi mdi-magnify"></i> Cari
                                        </button>
                                    </div>
                                </div>
                                {{-- Jika ada filter khusus, tambahkan di sini --}}
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Kode Persil</th>
                                        <th>Pemilik Lahan</th>
                                        <th>Dimensi (P x L)</th>
                                        <th>Data Geospasial</th>
                                        <th>Tgl Dibuat</th>
                                        <th class="text-center" width="150px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Menggunakan $dataPeta (dari Controller) --}}
                                    @forelse ($dataPeta as $item)
                                        <tr>
                                            <td>
                                                <span class="fw-bold">{{ $item->persil->kode_persil ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                {{ $item->persil->warga->nama ?? 'Pemilik Tidak Diketahui' }}
                                            </td>
                                            <td>
                                                @if ($item->panjang_m && $item->lebar_m)
                                                    {{ number_format($item->panjang_m, 2) }}m x {{ number_format($item->lebar_m, 2) }}m
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->geojson)
                                                    <span class="badge bg-success text-white">Ada Data</span>
                                                @else
                                                    <span class="badge bg-secondary">Kosong</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->created_at->format('d M Y') }}
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">

                                                    {{-- Tombol Detail --}}
                                                    <a href="{{ route('peta_persil.show', $item->peta_id) }}"
                                                        class="btn btn-sm btn-info text-white d-flex align-items-center"
                                                        title="Lihat Detail">
                                                        <i class="mdi mdi-eye"></i> Detail
                                                    </a>

                                                    @if (Auth::check() && Auth::user()->role === 'Admin')
                                                        {{-- Tombol Edit --}}
                                                        <a href="{{ route('peta_persil.edit', $item->peta_id) }}"
                                                            class="btn btn-sm btn-warning text-dark d-flex align-items-center"
                                                            title="Edit Data">
                                                            <i class="mdi mdi-pencil"></i> Edit
                                                        </a>

                                                        {{-- Tombol Hapus --}}
                                                        <form action="{{ route('peta_persil.destroy', $item->peta_id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger text-white d-flex align-items-center"
                                                                onclick="return confirm('Yakin ingin menghapus data peta ini? (Semua file lampiran juga akan terhapus)')"
                                                                title="Hapus Data">
                                                                <i class="mdi mdi-delete"></i> Hapus
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
                                                Belum ada data peta persil yang ditemukan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-4 d-flex justify-content-end">
                            {{ $dataPeta->withQueryString()->links('pagination::simple-bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
