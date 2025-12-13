@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-file-document-box-outline"></i> {{-- Menggunakan ikon dokumen --}}
                </span>
                Data Dokumen Persil
            </h3>
            <nav aria-label="breadcrumb">
                {{-- Mengarahkan ke route dokumen_persil.create --}}
                <a href="{{ route('dokumen_persil.create') }}" class="btn btn-gradient-primary btn-icon-text">
                    <i class="mdi mdi-plus btn-icon-prepend"></i> Tambah Dokumen
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

                        {{-- Form Pencarian dan Filter Dokumen --}}
                        <form method="GET" action="{{ route('dokumen_persil.index') }}" class="mb-4">
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <div class="input-group">
                                        {{-- Pencarian berdasarkan Nomor Dokumen atau Keterangan --}}
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Cari Nomor Dokumen atau Keterangan..."
                                            value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-gradient-primary">
                                            <i class="mdi mdi-magnify"></i>Cari
                                        </button>
                                    </div>
                                </div>


                                @if (request('search') || request('jenis_dokumen'))
                                    <div class="col-md-2">
                                        <a href="{{ route('dokumen_persil.index') }}"
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
                                        <th>Persil Terkait</th>
                                        <th>Jenis Dokumen</th>
                                        <th>Nomor Dokumen</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal Dibuat</th>
                                        <th class="text-center" width="150px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Menggunakan $dataDokumen sesuai nama variabel di DokumenPersilController@index --}}
                                    @forelse ($dataDokumen as $item)
                                        <tr>
                                            {{-- Kolom Persil Terkait (Mengambil data relasi) --}}
                                            <td class="fw-bold text-primary">
                                                @if ($item->persil)
                                                    {{ $item->persil->kode_persil ?? 'N/A' }}
                                                    <span
                                                        class="d-block text-muted small">{{ $item->persil->warga->nama ?? 'Pemilik Tidak Diketahui' }}</span>
                                                @else
                                                    Persil Dihapus
                                                @endif
                                            </td>

                                            {{-- Jenis Dokumen --}}
                                            <td>
                                                <span class="badge rounded-pill bg-gradient-primary">
                                                    {{ $item->jenis_dokumen }}
                                                </span>
                                            </td>

                                            {{-- Nomor Dokumen --}}
                                            <td>{{ $item->nomor ?? '-' }}</td>

                                            {{-- Keterangan (Teks panjang) --}}
                                            <td class="text-wrap" style="max-width: 300px;">
                                                {{ Str::limit($item->keterangan, 50) ?? '-' }}
                                            </td>

                                            {{-- Tanggal Dibuat --}}
                                            <td>
                                                {{ $item->created_at->format('d M Y') }}
                                                <span
                                                    class="d-block text-muted small">{{ $item->created_at->diffForHumans() }}</span>
                                            </td>

                                            {{-- Kolom Aksi --}}
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">

                                                    {{-- Tombol Detail --}}
                                                    <a href="{{ route('dokumen_persil.show', $item->dokumen_id) }}"
                                                        class="btn btn-sm btn-info text-white d-flex align-items-center"
                                                        title="Lihat Detail">
                                                        <i class="mdi mdi-eye"></i> Detail
                                                    </a>

                                                    @if (Auth::check() && Auth::user()->role === 'Admin')
                                                        {{-- Tombol Edit --}}
                                                        <a href="{{ route('dokumen_persil.edit', $item->dokumen_id) }}"
                                                            class="btn btn-sm btn-warning text-dark d-flex align-items-center"
                                                            title="Edit Data">
                                                            <i class="mdi mdi-pencil me-1"></i> Edit
                                                        </a>

                                                        {{-- Tombol Hapus --}}
                                                        <form
                                                            action="{{ route('dokumen_persil.destroy', $item->dokumen_id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger text-white d-flex align-items-center"
                                                                onclick="return confirm('Yakin ingin menghapus dokumen ini beserta semua filenya?')"
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
                                                <i class="mdi mdi-file-question-outline display-4 d-block mb-3"></i>
                                                Belum ada data dokumen persil yang ditemukan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-4 d-flex justify-content-end">
                            {{-- Menggunakan $dataDokumen untuk pagination --}}
                            {{ $dataDokumen->withQueryString()->links('pagination::simple-bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
