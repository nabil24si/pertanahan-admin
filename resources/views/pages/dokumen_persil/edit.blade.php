@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Data Dokumen Persil</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    {{-- Mengarahkan ke route index dokumen_persil --}}
                    <li class="breadcrumb-item"><a href="{{ route('dokumen_persil.index') }}">Data Dokumen Persil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            {{-- KOLOM KIRI: Form Edit Data --}}
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Edit Data & Tambah File</h4>
                        <p class="card-description">Ubah detail dokumen atau tambahkan file baru.</p>

                        {{-- ACTION: Mengarahkan ke route dokumen_persil.update --}}
                        <form action="{{ route('dokumen_persil.update', $dataDokumen->dokumen_id) }}" method="POST"
                            class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- 1. PERSIL_ID (FK) --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Persil (Lahan) Terkait</label>
                                <div class="col-sm-9">
                                    {{-- Menggunakan $dataPersil dari controller --}}
                                    <select name="persil_id" class="form-select @error('persil_id') is-invalid @enderror"
                                        required>
                                        <option value="">-- Pilih Persil --</option>
                                        @foreach ($dataPersil as $p)
                                            {{-- Menggunakan $dataDokumen->persil_id untuk menentukan yang dipilih --}}
                                            <option value="{{ $p->persil_id }}"
                                                {{ old('persil_id', $dataDokumen->persil_id) == $p->persil_id ? 'selected' : '' }}>
                                                {{ $p->kode_persil ?? 'N/A' }} -
                                                {{ $p->warga->nama ?? 'Pemilik Tidak Diketahui' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('persil_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- 2. JENIS_DOKUMEN --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jenis Dokumen</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('jenis_dokumen') is-invalid @enderror"
                                        name="jenis_dokumen" value="{{ old('jenis_dokumen', $dataDokumen->jenis_dokumen) }}"
                                        required>
                                    @error('jenis_dokumen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- 3. NOMOR --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nomor Dokumen</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('nomor') is-invalid @enderror"
                                        name="nomor" value="{{ old('nomor', $dataDokumen->nomor) }}">
                                    @error('nomor')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- 4. KETERANGAN --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="3">{{ old('keterangan', $dataDokumen->keterangan) }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- INPUT FILE BARU --}}
                            <div class="form-group row highlight-addon">
                                <label class="col-sm-3 col-form-label text-primary font-weight-bold">Tambah File
                                    Baru</label>
                                <div class="col-sm-9">
                                    <input type="file" name="files[]" class="form-control" multiple>
                                    <small class="text-muted">Biarkan kosong jika tidak ingin menambah file.</small>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-gradient-primary me-2">Simpan Perubahan</button>
                            <a href="{{ route('dokumen_persil.index') }}" class="btn btn-light">Batal</a>
                        </form>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: List File Lama (Management) --}}
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">File Terlampir</h4>
                        <p class="card-description">Kelola file yang sudah ada.</p>

                        {{-- Menggunakan $dataDokumen->attachments --}}
                        @if ($dataDokumen->attachments->count() > 0)
                            <div class="list-wrapper">
                                <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                                    @foreach ($dataDokumen->attachments as $media)
                                        <li class="d-block mb-3 border-bottom pb-2">
                                            <div class="d-flex align-items-center justify-content-between mb-2">

                                                {{-- Preview Nama File (Klik untuk lihat) --}}
                                                {{-- Path diubah ke 'uploads/dokumen_persil' --}}
                                                <a href="{{ asset('storage/uploads/dokumen_persil/' . $media->file_name) }}"
                                                    target="_blank"
                                                    class="text-decoration-none text-dark d-flex align-items-center">
                                                    @if (str_contains($media->mime_type, 'image'))
                                                        <i class="mdi mdi-image text-success me-2 icon-md"></i>
                                                    @else
                                                        <i class="mdi mdi-file-document text-info me-2 icon-md"></i>
                                                    @endif
                                                    <div class="text-truncate" style="max-width: 100px;"
                                                        title="{{ $media->caption }}">
                                                        {{ $media->caption }}
                                                    </div>
                                                </a>

                                                {{-- Tombol Hapus (Panggil DokumenPersilController@deleteMedia) --}}
                                                <form action="{{ route('dokumen_persil.deleteMedia', $media->media_id) }}"
                                                    method="POST" onsubmit="return confirm('Yakin hapus file ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm p-2">
                                                        <i class="mdi mdi-close"></i>
                                                </form>

                                                {{-- Preview Gambar Kecil jika itu gambar --}}
                                                @if (str_contains($media->mime_type, 'image'))
                                                    {{-- Path diubah ke 'uploads/dokumen_persil' --}}
                                                    <img src="{{ asset('storage/uploads/dokumen_persil/' . $media->file_name) }}"
                                                        class="img-thumbnail mt-1" style="height: 60px;">
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <div class="alert alert-secondary text-center">Belum ada file terlampir.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
