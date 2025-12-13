@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Detail Dokumen Persil</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    {{-- Mengarahkan ke route index dokumen_persil --}}
                    <li class="breadcrumb-item"><a href="{{ route('dokumen_persil.index') }}">Data Dokumen Persil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            {{-- KIRI: INFORMASI UTAMA DOKUMEN --}}
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informasi Dokumen</h4>
                        <p class="card-description">Detail data dokumen: <strong>{{ $dokumen->jenis_dokumen }}</strong></p>

                        {{-- Menggunakan $dokumen (bukan $persil) sesuai yang dilempar controller --}}
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th style="width: 35%">Jenis Dokumen</th>
                                        <td>: <span class="badge badge-gradient-primary">{{ $dokumen->jenis_dokumen }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Dokumen</th>
                                        <td>: {{ $dokumen->nomor ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Persil Terkait</th>
                                        {{-- Memastikan relasi persil dan pemiliknya dimuat --}}
                                        <td>:
                                            @if ($dokumen->persil)
                                                {{ $dokumen->persil->kode_persil }}
                                                ({{ $dokumen->persil->warga->nama ?? 'Pemilik Tidak Diketahui' }})
                                            @else
                                                <span class="text-danger">Persil Tidak Ditemukan</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Dibuat</th>
                                        <td>: {{ $dokumen->created_at->format('d F Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan</th>
                                        <td>: {{ $dokumen->keterangan ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            @if (Auth::check() && Auth::user()->role === 'Admin')
                                {{-- Mengarahkan ke route edit dokumen_persil --}}
                                <a href="{{ route('dokumen_persil.edit', $dokumen->dokumen_id) }}" class="btn btn-warning btn-sm">Edit Data</a>
                            @endif
                            {{-- Mengarahkan ke route index dokumen_persil --}}
                            <a href="{{ route('dokumen_persil.index') }}" class="btn btn-light btn-sm">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KANAN: LAMPIRAN FILE --}}
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Lampiran File Dokumen</h4>
                        <p class="card-description">
                            Total file: {{ $dokumen->attachments->count() }}
                        </p>

                        @if ($dokumen->attachments->count() > 0)
                            <div class="row">
                                {{-- Menggunakan $dokumen->attachments (relasi media) --}}
                                @foreach ($dokumen->attachments as $media)
                                    <div class="col-md-6 mb-4">
                                        <div class="border p-2 rounded text-center h-100">

                                            {{-- TAMPILAN GAMBAR / ICON --}}
                                            @if (str_contains($media->mime_type, 'image'))
                                                {{-- GAMBAR --}}
                                                {{-- Path penyimpanan diubah ke 'uploads/dokumen_persil' --}}
                                                <img src="{{ asset('storage/uploads/dokumen_persil/' . $media->file_name) }}"
                                                    class="img-fluid rounded mb-2"
                                                    style="max-height: 120px; object-fit: cover; width: 100%;"
                                                    alt="{{ $media->caption }}"
                                                    onerror="this.onerror=null;this.src='https://via.placeholder.com/150?text=Gambar+Rusak';">
                                            @else
                                                {{-- DOKUMEN --}}
                                                <div class="py-4 text-primary">
                                                    <i class="mdi mdi-file-document mdi-48px"></i>
                                                </div>
                                            @endif

                                            {{-- Nama File --}}
                                            <p class="text-small text-muted mb-1 text-truncate"
                                                title="{{ $media->caption }}">
                                                {{ $media->caption }}
                                            </p>

                                            {{-- TOMBOL LIHAT --}}
                                            <div class="d-flex justify-content-center gap-2 mt-2">
                                                {{-- Path penyimpanan diubah ke 'uploads/dokumen_persil' --}}
                                                <a href="{{ asset('storage/uploads/dokumen_persil/' . $media->file_name) }}"
                                                    target="_blank" class="btn btn-inverse-info btn-sm py-1 px-2">
                                                    <i class="mdi mdi-eye"></i> Lihat
                                                </a>

                                                @if (Auth::check() && Auth::user()->role === 'Admin')
                                                    {{-- Tombol Hapus Media (asumsi route deleteMedia sudah dibuat) --}}
                                                    <form action="{{ route('dokumen_persil.deleteMedia', $media->media_id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-inverse-danger btn-sm py-1 px-2"
                                                            onclick="return confirm('Yakin ingin menghapus file ini?')" title="Hapus File">
                                                            <i class="mdi mdi-delete"></i> Hapus
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            {{-- TAMPILAN NO FILE --}}
                            <div class="d-flex flex-column align-items-center justify-content-center text-center p-5 border rounded bg-light"
                                style="min-height: 250px;">
                                <i class="mdi mdi-file-multiple-outline mdi-48px text-muted mb-3"></i>
                                <h6 class="text-muted fw-bold">Tidak Ada Lampiran</h6>
                                <p class="text-muted small">Tidak ada dokumen atau foto yang dilampirkan untuk data ini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
