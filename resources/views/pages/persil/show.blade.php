@extends('layouts.admin.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Detail Persil</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('persil.index') }}">Data Persil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        {{-- KIRI: INFORMASI UTAMA --}}
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informasi Lahan</h4>
                    <p class="card-description">Detail data persil: <strong>{{ $persil->kode_persil }}</strong></p>

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th style="width: 30%">Pemilik</th>
                                    <td>: {{ $persil->warga ? $persil->warga->nama : 'Tidak diketahui' }}</td>
                                </tr>
                                <tr>
                                    <th>Luas</th>
                                    <td>: {{ $persil->luas_m2 }} m²</td>
                                </tr>
                                <tr>
                                    <th>Penggunaan</th>
                                    <td>: <span class="badge badge-gradient-info">{{ $persil->penggunaan }}</span></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>: {{ $persil->alamat_lahan }}</td>
                                </tr>
                                <tr>
                                    <th>RT / RW</th>
                                    <td>: {{ $persil->rt }} / {{ $persil->rw }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('persil.edit', $persil->persil_id) }}" class="btn btn-warning btn-sm">Edit Data</a>
                        <a href="{{ route('persil.index') }}" class="btn btn-light btn-sm">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- KANAN: LAMPIRAN FILE --}}
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Dokumen & Foto Lampiran</h4>
                    <p class="card-description">
                        Total file: {{ $persil->attachments->count() }}
                    </p>

                    @if($persil->attachments->count() > 0)
                        <div class="row">
                            @foreach($persil->attachments as $media)
                                <div class="col-md-6 mb-4">
                                    <div class="border p-2 rounded text-center h-100">

                                        {{-- TAMPILAN GAMBAR / ICON --}}
                                        @if(str_contains($media->mime_type, 'image'))
                                            {{-- GAMBAR --}}
                                            {{-- Pastikan path ini sesuai dengan Controller: uploads/persil --}}
                                            <img src="{{ asset('storage/uploads/persil/' . $media->file_name) }}"
                                                 class="img-fluid rounded mb-2"
                                                 style="max-height: 120px; object-fit: cover; width: 100%;"
                                                 alt="{{ $media->caption }}"
                                                 onerror="this.onerror=null;this.src='https://via.placeholder.com/150?text=Gambar+Rusak';">
                                                 {{-- ^ Tambahan: Jika gambar error, ganti placeholder --}}
                                        @else
                                            {{-- DOKUMEN --}}
                                            <div class="py-4 text-primary">
                                                <i class="mdi mdi-file-document mdi-48px"></i>
                                            </div>
                                        @endif

                                        {{-- Nama File --}}
                                        <p class="text-small text-muted mb-1 text-truncate" title="{{ $media->caption }}">
                                            {{ $media->caption }}
                                        </p>

                                        {{-- TOMBOL LIHAT --}}
                                        <div class="d-flex justify-content-center gap-2 mt-2">
                                            <a href="{{ asset('storage/uploads/persil/' . $media->file_name) }}"
                                               target="_blank" class="btn btn-inverse-info btn-sm py-1 px-2">
                                               <i class="mdi mdi-eye"></i> Lihat
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-secondary text-center">
                            Tidak ada lampiran file.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
