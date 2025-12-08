@extends('layouts.auth.appreg')
@section('content')
    <div class="left-section">
        <div class="register-box">
            <h2>Buat Akun</h2>
            <p>Sudah punya akun? <a href="{{ route('auth.index') }}">Masuk Sekarang</a></p>

            {{-- Notifikasi Error --}}
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

            <form action="{{ route('auth.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                </div>

                <!-- Tambahan ROLE -->
                <div class="form-group">
                    <select name="role" required>
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="Admin">Admin</option>
                        <option value="Pegawai">Pegawai</option>
                    </select>
                </div>

                <button type="submit" class="btn-register" name="register">Daftar</button>
            </form>

        </div>
    </div>

    <div class="right-section">
        <h1>Daftar Admin Baru</h1>
        <p>(Silahkan Login Jika Sudah Punya Akun)</p>
    </div>
@endsection
