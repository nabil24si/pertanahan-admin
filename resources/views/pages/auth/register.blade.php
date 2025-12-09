@extends('layouts.auth.appreg')

@section('content')
{{--
    TAMBAHKAN CSS INI AGAR TAMPILAN RAPI.
    Sebaiknya pindahkan CSS ini ke file stylesheet utama Anda (misal: style.css)
    agar tidak menumpuk di file blade.
--}}
<style>
    /* --- CSS KHUSUS HALAMAN REGISTER --- */

    /* Wrapper untuk Logo agar di tengah */
    .register-logo-wrapper {
        text-align: center;
        margin-bottom: 25px;
    }

    /* Ukuran Logo */
    .register-logo {
        width: 180px; /* Sesuaikan ukuran logo di sini */
        height: auto;
        object-fit: contain;
    }

    /* Styling agar Dropdown Select (Role) mirip dengan Input text */
    .form-group select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f8f8f8;
        color: #333;
        font-size: 14px;
        transition: all 0.3s ease;
        cursor: pointer;
        /* Menghilangkan panah default browser dan menggantinya dengan custom SVG agar rapi */
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20width%3D%27292.4%27%20height%3D%27292.4%27%3E%3Cpath%20fill%3D%27%23333%27%20d%3D%27M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%27%2F%3E%3C%2Fsvg%3E");
        background-repeat: no-repeat;
        background-position: right 15px top 50%;
        background-size: 12px auto;
    }

    /* Efek saat select di-klik */
    .form-group select:focus {
        border-color: #1a73e8; /* Biru saat fokus */
        outline: none;
        background-color: #fff;
    }

    /* Merapikan Alert Box agar sesuai tema */
    .alert {
        border-radius: 8px;
        font-size: 14px;
        border: none;
        margin-bottom: 20px;
    }
    .alert-danger {
        background-color: #ffebee;
        color: #c62828;
    }
    .alert-success {
        background-color: #e8f5e9;
        color: #2e7d32;
    }
    .alert ul {
        padding-left: 20px;
    }
</style>

{{-- BAGIAN KIRI (FORMULIR) --}}
<div class="left-section">
    <div class="register-box">

        {{-- === PENAMBAHAN LOGO === --}}
        <div class="register-logo-wrapper">
            {{-- Ganti path gambar sesuai lokasi logo Anda --}}
            <img src="{{ asset('assets/assets-admin/images/logo.png') }}"
                 alt="Logo Desa"
                 class="register-logo"
                 onerror="this.style.display='none'">
        </div>
        {{-- ======================== --}}

        <h2>Buat Akun</h2>
        <p>Sudah punya akun? <a href="{{ route('auth.index') }}">Masuk Sekarang</a></p>

        {{-- Notifikasi Error/Sukses --}}
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

        {{-- Formulir Pendaftaran --}}
        <form action="{{ route('auth.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <select name="role" required>
                    <option value="" disabled selected>Pilih Role Pengguna</option>
                    <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Pegawai" {{ old('role') == 'Pegawai' ? 'selected' : '' }}>Pegawai</option>
                </select>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
            </div>


            <button type="submit" class="btn-register" name="register">Daftar Akun</button>
        </form>

    </div>
</div>

{{-- BAGIAN KANAN (GAMBAR LATAR) --}}
<div class="right-section">
    {{-- Teks di atas gambar --}}
    <div>
        <h1>Daftar Admin Baru</h1>
        <p>Silahkan Login Jika Sudah Punya Akun</p>
    </div>
</div>
@endsection