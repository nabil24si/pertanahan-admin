@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Data Sengketa Persil</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('sengketa_persil.index') }}">Data Sengketa</a></li>
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
                        <p class="card-description">Ubah data sengketa atau tambahkan file bukti baru.</p>

                        <form action="{{ route('sengketa_persil.update', $dataSengketa->sengketa_id) }}" method="POST"
                            class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- PERSIL_ID (FK) --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Persil (Lahan) Terkait</label>
                                <div class="col-sm-9">
                                    <select name="persil_id" class="form-select @error('persil_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Persil --</option>
                                        @foreach ($dataPersil as $p)
                                            <option value="{{ $p->persil_id }}"
                                                {{ old('persil_id', $dataSengketa->persil_id) == $p->persil_id ? 'selected' : '' }}>
                                                {{ $p->kode_persil ?? 'N/A' }} - {{ $p->warga->nama ?? 'Pemilik Tidak Diketahui' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('persil_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- PIHAK 1 --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pihak 1</label>
                                <div class="col-sm-9">
                                    <input type="text" name="pihak_1" class="form-control @error('pihak_1') is-invalid @enderror"
                                        value="{{ old('pihak_1', $dataSengketa->pihak_1) }}" required>
                                    @error('pihak_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- PIHAK 2 --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pihak 2</label>
                                <div class="col-sm-9">
                                    <input type="text" name="pihak_2" class="form-control @error('pihak_2') is-invalid @enderror"
                                        value="{{ old('pihak_2', $dataSengketa->pihak_2) }}">
                                    @error('pihak_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- KRONOLOGI --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kronologi</label>
                                <div class="col-sm-9">
                                    <textarea name="kronologi" class="form-control @error('kronologi') is-invalid @enderror" rows="4"
                                        required>{{ old('kronologi', $dataSengketa->kronologi) }}</textarea>
                                    @error('kronologi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- STATUS --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status Sengketa</label>
                                <div class="col-sm-9">
                                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                        @foreach (['diproses', 'diterima', 'ditolak'] as $s)
                                            <option value="{{ $s }}"
                                                {{ old('status', $dataSengketa->status) == $s ? 'selected' : '' }}>
                                                {{ ucfirst($s) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- PENYELESAIAN --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Penyelesaian</label>
                                <div class="col-sm-9">
                                    <textarea name="penyelesaian" class="form-control @error('penyelesaian') is-invalid @enderror" rows="3"
                                        placeholder="Keputusan atau hasil penyelesaian sengketa">{{ old('penyelesaian', $dataSengketa->penyelesaian) }}</textarea>
                                    @error('penyelesaian')
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
                            <a href="{{ route('sengketa_persil.index') }}" class="btn btn-light">Batal</a>
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

                        @if ($dataSengketa->attachments->count() > 0)
                            <div class="list-wrapper">
                                <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                                    @foreach ($dataSengketa->attachments as $media)
                                        <li class="d-block mb-3 border-bottom pb-2">
                                            <div class="d-flex align-items-center justify-content-between mb-2">

                                                {{-- Preview Nama File (Klik untuk lihat) --}}
                                                <a href="{{ asset('storage/uploads/sengketa_persil/' . $media->file_name) }}"
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

                                                {{-- Tombol Hapus --}}
                                                <form action="{{ route('sengketa_persil.deleteMedia', $media->media_id) }}"
                                                    method="POST" onsubmit="return confirm('Yakin hapus file ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm p-2">
                                                        <i class="mdi mdi-close"></i>
                                                    </button>
                                                </form>

                                                {{-- Preview Gambar Kecil --}}
                                                @if (str_contains($media->mime_type, 'image'))
                                                    <img src="{{ asset('storage/uploads/sengketa_persil/' . $media->file_name) }}"
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
