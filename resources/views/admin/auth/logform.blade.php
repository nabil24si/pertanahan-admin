@extends('layouts.admin.applog')
@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo text-center mb-3">
                                <img src="{{ asset('assets/images/logo.svg') }}" alt="logo">
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <h4 class="text-center mb-3">Hello! Let's get started</h4>
                            <h6 class="font-weight-light text-center mb-4">Sign in to continue.</h6>


                            <form action="{{ route('auth.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg" id="email"
                                        placeholder="Email" value="{{ old('email') }}" required>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        placeholder="Password" required>
                                </div>

                                <div class="mt-3 d-grid gap-2">
                                    {{-- Tombol login --}}
                                    <button type="submit" name="login"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                                        SIGN IN
                                    </button>
                                </div>
                                <div class="my-3 text-center text-muted">— OR —</div>
                                {{-- Tombol menuju register --}}
                                <div class="mb-2 d-grid gap-2">
                                    <a href="{{ route('auth.create') }}" class="btn btn-block btn-facebook auth-form-btn">
                                        <i class="mdi mdi-account-plus me-2"></i>
                                        Don't have an account? Create!
                                    </a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
    </div>
@endsection
