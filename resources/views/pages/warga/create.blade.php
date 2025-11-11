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
                        <h4 class="card-title">Input Data Warga</h4>
                        <p class="card-description"> Silahkan isi form dibawah </p>
                        <form action="{{ route('warga.store') }} " method="POST" class="forms-sample">
                            @csrf
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">No
                                    KTP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="No KTP"
                                        id="exampleInputUsername2" name="no_ktp" value="{{ old('no_ktp') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Nama"
                                        name="nama" value="{{ old('nama') }}">
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis
                                    Kelamin</label>
                                <div class="col-sm-9">
                                    <select id="gender" name="jenis_kelamin" class="form-select">
                                        <option value="">-- Pilih --</option>
                                        <option value="Laki-laki">Laki Laki</option>
                                        <option value="Perempuan">Perempuan</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Agama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="exampleInputPassword2"
                                        placeholder="Agama" name="agama" value="{{ old('agama') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Pekerjaan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="exampleInputConfirmPassword2"
                                        placeholder="Pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">No Telepon</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="exampleInputConfirmPassword2"
                                        placeholder="Telepon" name="telp" value="{{ old('telp') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputEmail3" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email"
                                        name="email" value="{{ old('email') }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                            <a href="{{ route('warga.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
