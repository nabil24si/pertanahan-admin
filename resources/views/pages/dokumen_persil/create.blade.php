@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Form Input Data Dokumen Persil</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dokumen</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Input Dokumen Persil</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            {{-- Menggunakan col-md-8 agar form terlihat seimbang --}}
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Input Data Dokumen Persil</h4>
                        <p class="card-description">Silahkan isi form berikut untuk menambahkan data dokumen</p>

                        {{-- PENTING: enctype="multipart/form-data" WAJIB ADA untuk upload file --}}
                        {{-- Mengarahkan ke route dokumen_persil.store --}}
                        <form action="{{ route('dokumen_persil.store') }}" method="POST" class="forms-sample"
                            enctype="multipart/form-data">
                            @csrf

                            {{-- 1. PERSIL_ID (FK) --}}
                            {{-- Menggantikan input 'Kode Persil' dan 'Pemilik Warga' --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Persil (Lahan) Terkait</label>
                                <div class="col-sm-9">
                                    {{-- Data yang dilempar dari controller adalah $dataPersil --}}
                                    <select name="persil_id" class="form-select @error('persil_id') is-invalid @enderror"
                                        required>
                                        <option value="">-- Pilih Persil --</option>
                                        @foreach ($dataPersil as $p)
                                            <option value="{{ $p->persil_id }}"
                                                {{ old('persil_id') == $p->persil_id ? 'selected' : '' }}>
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
                            {{-- Menggantikan input 'Luas Tanah' --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jenis Dokumen</label>
                                <div class="col-sm-9">
                                    <input type="text" name="jenis_dokumen"
                                        class="form-control @error('jenis_dokumen') is-invalid @enderror"
                                        placeholder="Contoh: Sertifikat Hak Milik, Akta Jual Beli, dll."
                                        value="{{ old('jenis_dokumen') }}" required>
                                    @error('jenis_dokumen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- 3. NOMOR --}}
                            {{-- Menggantikan input 'Penggunaan' --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nomor Dokumen</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nomor"
                                        class="form-control @error('nomor') is-invalid @enderror"
                                        placeholder="Nomor unik dokumen (Contoh: 123/SHM/2023)" value="{{ old('nomor') }}">
                                    @error('nomor')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- 4. KETERANGAN --}}
                            {{-- Menggantikan input 'Alamat Lahan', 'RT', dan 'RW' --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3"
                                        placeholder="Deskripsi atau catatan tambahan mengenai dokumen ini">{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- 5. INPUT FILE (Sesuai dengan template) --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Upload File Dokumen</label>
                                <div class="col-sm-9">
                                    {{-- Perhatikan penamaan name="files[]" untuk multiple upload --}}
                                    <input type="file" name="files[]"
                                        class="form-control @error('files.*') is-invalid @enderror" multiple>
                                    <small class="text-muted d-block mt-1">Bisa pilih banyak file sekaligus. Format: JPG,
                                        PNG, PDF, DOCX. Max 5MB per file.</small>
                                    @error('files.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Tombol --}}
                            <button type="submit" class="btn btn-gradient-primary me-2">Simpan Dokumen</button>
                            {{-- Mengarahkan ke route dokumen_persil.index --}}
                            <a href="{{ route('dokumen_persil.index') }}" class="btn btn-light">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
