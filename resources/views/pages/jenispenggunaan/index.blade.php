@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-format-list-bulleted-type"></i>
                </span>
                Data Jenis Penggunaan
            </h3>
            <nav aria-label="breadcrumb">
                <a href="{{ route('jenispenggunaan.create') }}" class="btn btn-gradient-primary btn-icon-text">
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

                        <form method="GET" action="{{ route('jenispenggunaan.index') }}" class="mb-4">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <span class="input-group-text bg-transparent border-end-0">
                                            <i class="mdi mdi-magnify text-primary"></i>
                                        </span>
                                        <input type="text" name="search" class="form-control border-start-0"
                                            placeholder="Cari jenis penggunaan..." value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-gradient-primary">Cari</button>
                                    </div>
                                </div>

                                @if (request('search'))
                                    <div class="col-md-2">
                                        <a href="{{ route('jenispenggunaan.index') }}"
                                            class="btn btn-inverse-secondary btn-sm">
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
                                        <th>Nama Penggunaan</th>
                                        <th>Keterangan</th>
                                        @if (Auth::check() && Auth::user()->role === 'Admin')
                                            <th class="text-center" width="200px">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataJenisPenggunaan as $item)
                                        <tr>
                                            <td>
                                                <span class="fw-bold text-primary">{{ $item->nama_penggunaan }}</span>
                                            </td>
                                            <td class="text-muted">{{ $item->keterangan ?? '-' }}</td>

                                            @if (Auth::check() && Auth::user()->role === 'Admin')
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-1">
                                                        {{-- Tombol Edit --}}
                                                        <a href="{{ route('jenispenggunaan.edit', $item->jenis_id) }}"
                                                            class="btn btn-sm btn-warning text-dark d-flex align-items-center"
                                                            title="Edit Data">
                                                            <i class="mdi mdi-pencil me-1"></i> Edit
                                                        </a>

                                                        {{-- Tombol Hapus --}}
                                                        <form
                                                            action="{{ route('jenispenggunaan.destroy', $item->jenis_id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger text-white d-flex align-items-center"
                                                                onclick="return confirm('Yakin ingin menghapus data {{ $item->nama_penggunaan }}?')"
                                                                title="Hapus Data">
                                                                <i class="mdi mdi-delete me-1"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-4 text-muted">
                                                <i class="mdi mdi-file-hidden display-4 d-block mb-2"></i>
                                                Data jenis penggunaan tidak ditemukan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 d-flex justify-content-end">
                            {{ $dataJenisPenggunaan->withQueryString()->links('pagination::simple-bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
