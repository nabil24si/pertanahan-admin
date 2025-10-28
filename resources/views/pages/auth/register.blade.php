@extends('layouts.admin.applog')
@section('content')

                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo text-center mb-3">
                                <img src="{{ asset('assets/images/logo.svg') }}" alt="logo">
                            </div>

                            {{-- ✅ Pesan sukses atau error --}}
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

                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>

                            {{-- ✅ FORM REGISTER --}}
                            <form action="{{ route('auth.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" placeholder="Name"
                                        name="name" value="{{ old('name') }}" required>
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" placeholder="Email"
                                        name="email" value="{{ old('email') }}" required>
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" placeholder="Password"
                                        name="password" required>
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        placeholder="Confirm Password" name="password_confirmation" required>
                                </div>

                                <div class="mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" required>
                                            I agree to all Terms & Conditions
                                        </label>
                                    </div>
                                </div>

                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit" name="register"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                                        REGISTER
                                    </button>
                                </div>

                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account?
                                    <a href="{{ route('auth.index') }}" class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
@endsection
