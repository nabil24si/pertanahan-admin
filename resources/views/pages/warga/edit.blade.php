@extends('layouts.admin.app')
@section('content')
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Form elements </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Forms</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form elements</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Data Warga</h4>
                            <p class="card-description"> Silahkan ubah isi data </p>
                            <form action="{{ route('warga.update', $dataWarga->warga_id) }}" method="POST"
                                class="forms-sample">
                                @csrf
                                @method('PUT')

                                <div class="form-group row">
                                    <label for="no_ktp" class="col-sm-3 col-form-label">No KTP</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="no_ktp" name="no_ktp"
                                            value="{{ old('no_ktp', $dataWarga->no_ktp) }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ old('nama', $dataWarga->nama) }}">
                                    </div>
                                </div>

                                <div class="form-group row align-items-center">
                                    <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis
                                        Kelamin</label>
                                    <div class="col-sm-9">
                                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-select">
                                            <option value="">-- Pilih --</option>
                                            <option value="Laki-laki"
                                                {{ old('jenis_kelamin', $dataWarga->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="Perempuan"
                                                {{ old('jenis_kelamin', $dataWarga->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="agama" name="agama"
                                            value="{{ old('agama', $dataWarga->agama) }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                            value="{{ old('pekerjaan', $dataWarga->pekerjaan) }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="telp" class="col-sm-3 col-form-label">No Telepon</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="telp" name="telp"
                                            value="{{ old('telp', $dataWarga->telp) }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email', $dataWarga->email) }}">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                                <a href="{{ route('warga.index') }}" class="btn btn-light">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
