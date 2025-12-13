@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-danger text-white me-2">
                    <i class="mdi mdi-alert-octagon"></i>
                </span>
                Data Sengketa Persil
            </h3>
            <nav aria-label="breadcrumb">
                <a href="{{ route('sengketa_persil.create') }}" class="btn btn-gradient-primary btn-icon-text">
                    <i class="mdi mdi-plus btn-icon-prepend"></i> Tambah Sengketa
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
                        <form method="GET" action="{{ route('sengketa_persil.index') }}" class="mb-4">
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Cari Pihak 1, Pihak 2, atau Kronologi..." value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-gradient-primary">
                                            <i class="mdi mdi-magnify"></i> Cari
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="mdi mdi-filter"></i></span>
                                        <select name="status" class="form-select" onchange="this.form.submit()">
                                            <option value="">-- Filter Status --</option>
                                            @foreach (['diproses', 'diterima', 'ditolak'] as $s)
                                                <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>
                                                    {{ ucfirst($s) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if (request('search') || request('status'))
                                    <div class="col-md-2">
                                        <a href="{{ route('sengketa_persil.index') }}"
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
                                        <th>Persil</th>
                                        <th>Pihak 1 & 2</th>
                                        <th>Kronologi Singkat</th>
                                        <th>Status</th>
                                        <th>Tgl Sengketa</th>
                                        <th class="text-center" width="150px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Menggunakan $dataSengketa (dari Controller) --}}
                                    @forelse ($dataSengketa as $item)
                                        <tr>
                                            <td>
                                                <span class="fw-bold">{{ $item->persil->kode_persil ?? 'N/A' }}</span>
                                                <span class="d-block text-muted small">{{ $item->persil->warga->nama ?? 'Pemilik Tidak Diketahui' }}</span>
                                            </td>
                                            <td>
                                                P1: {{ $item->pihak_1 }}
                                                <br>P2: {{ $item->pihak_2 ?? '-' }}
                                            </td>
                                            <td class="text-wrap" style="max-width: 300px;">
                                                {{ Str::limit($item->kronologi, 60) }}
                                            </td>
                                            <td>
                                                @php
                                                    $badge = match($item->status) {
                                                        'diterima' => 'bg-success',
                                                        'ditolak' => 'bg-danger',
                                                        default => 'bg-warning text-dark',
                                                    };
                                                @endphp
                                                <span class="badge rounded-pill {{ $badge }}">{{ ucfirst($item->status) }}</span>
                                            </td>
                                            <td>
                                                {{ $item->created_at->format('d M Y') }}
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">

                                                    {{-- Tombol Detail --}}
                                                    <a href="{{ route('sengketa_persil.show', $item->sengketa_id) }}"
                                                        class="btn btn-sm btn-info text-white d-flex align-items-center"
                                                        title="Lihat Detail">
                                                        <i class="mdi mdi-eye"></i> Detail
                                                    </a>

                                                    @if (Auth::check() && Auth::user()->role === 'Admin')
                                                        {{-- Tombol Edit --}}
                                                        <a href="{{ route('sengketa_persil.edit', $item->sengketa_id) }}"
                                                            class="btn btn-sm btn-warning text-dark d-flex align-items-center"
                                                            title="Edit Data">
                                                            <i class="mdi mdi-pencil"></i> Edit
                                                        </a>

                                                        {{-- Tombol Hapus --}}
                                                        <form action="{{ route('sengketa_persil.destroy', $item->sengketa_id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger text-white d-flex align-items-center"
                                                                onclick="return confirm('Yakin ingin menghapus data sengketa ini?')"
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
                                            <td colspan="6" class="text-center py-5 text-muted">
                                                <i class="mdi mdi-alert-circle-outline display-4 d-block mb-3"></i>
                                                Belum ada data sengketa persil yang ditemukan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-4 d-flex justify-content-end">
                            {{ $dataSengketa->withQueryString()->links('pagination::simple-bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
