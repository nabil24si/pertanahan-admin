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
                    <h4 class="card-title">Edit Data User</h4>
                    <p class="card-description">Silahkan ubah isi data</p>

                    <form action="{{ route('user.update', $dataUser->id) }}" method="POST" class="forms-sample">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $dataUser->name) }}">
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $dataUser->email) }}">
                            </div>
                        </div>

                        {{-- Role (ditambahkan) --}}
                        <div class="form-group row">
                            <label for="role" class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-9">
                                <select id="role" name="role" class="form-select form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="Admin" {{ old('role', $dataUser->role) == 'Admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>
                                    <option value="Pegawai" {{ old('role', $dataUser->role) == 'Pegawai' ? 'selected' : '' }}>
                                        Pegawai
                                    </option>
                                </select>
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Biarkan kosong jika tidak diganti">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                        <a href="{{ route('user.index') }}" class="btn btn-light">Batal</a>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
