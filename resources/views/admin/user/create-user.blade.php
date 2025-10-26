@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Form Elements</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Elements</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Input Data User</h4>
                    <p class="card-description">Silahkan isi form di bawah ini</p>

                    <form action="{{ route('user.store') }}" method="POST" class="forms-sample">
                        @csrf
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text"
                                       class="form-control"
                                       id="inputName"
                                       name="name"
                                       placeholder="Name"
                                       value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email"
                                       class="form-control"
                                       id="inputEmail"
                                       name="email"
                                       placeholder="Email"
                                       value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password"
                                       class="form-control"
                                       id="inputPassword"
                                       name="password"
                                       placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputConfirmPassword" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                            <div class="col-sm-9">
                                <input type="password"
                                       class="form-control"
                                       id="inputConfirmPassword"
                                       name="password_confirmation"
                                       placeholder="Konfirmasi Password">
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-start">
                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                            <a href="{{ route('user.index') }}" class="btn btn-light">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
