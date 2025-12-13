@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Form Input Data Sengketa Persil</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('sengketa_persil.index') }}">Data Sengketa</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Input Sengketa</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Input Data Sengketa</h4>
                        <p class="card-description">Silahkan isi form berikut untuk menambahkan data sengketa</p>

                        <form action="{{ route('sengketa_persil.store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                            @csrf

                            {{-- PERSIL_ID (FK) --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Persil (Lahan) Terkait</label>
                                <div class="col-sm-9">
                                    <select name="persil_id" class="form-select @error('persil_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Persil --</option>
                                        @foreach ($dataPersil as $p)
                                            <option value="{{ $p->persil_id }}" {{ old('persil_id') == $p->persil_id ? 'selected' : '' }}>
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
                                <label class="col-sm-3 col-form-label">Pihak 1 (Penggugat/Pelapor)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="pihak_1" class="form-control @error('pihak_1') is-invalid @enderror"
                                        placeholder="Nama Pihak 1" value="{{ old('pihak_1') }}" required>
                                    @error('pihak_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- PIHAK 2 --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pihak 2 (Tergugat/Terlapor)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="pihak_2" class="form-control @error('pihak_2') is-invalid @enderror"
                                        placeholder="Nama Pihak 2 (Jika Ada)" value="{{ old('pihak_2') }}">
                                    @error('pihak_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- KRONOLOGI --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kronologi Sengketa</label>
                                <div class="col-sm-9">
                                    <textarea name="kronologi" class="form-control @error('kronologi') is-invalid @enderror" rows="4"
                                        placeholder="Jelaskan secara ringkas kronologi sengketa">{{ old('kronologi') }}</textarea>
                                    @error('kronologi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- STATUS (Default: diproses) --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status Sengketa</label>
                                <div class="col-sm-9">
                                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="diproses" {{ old('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="diterima" {{ old('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                        <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- PENYELESAIAN (Kosongkan saat create) --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Penyelesaian</label>
                                <div class="col-sm-9">
                                    <textarea name="penyelesaian" class="form-control @error('penyelesaian') is-invalid @enderror" rows="3"
                                        placeholder="Hasil penyelesaian sengketa (diisi saat status berubah)">{{ old('penyelesaian') }}</textarea>
                                    <small class="text-muted d-block mt-1">Kosongkan jika sengketa masih berstatus 'Diproses'.</small>
                                    @error('penyelesaian')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- INPUT FILE --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Upload Bukti/Lampiran</label>
                                <div class="col-sm-9">
                                    <input type="file" name="files[]" class="form-control" multiple>
                                    <small class="text-muted d-block mt-1">Bisa pilih banyak file sekaligus. Format: JPG, PNG, PDF. Max 5MB.</small>
                                </div>
                            </div>

                            {{-- Tombol --}}
                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                            <a href="{{ route('sengketa_persil.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
