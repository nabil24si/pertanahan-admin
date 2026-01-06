<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function create()
    {
        return view('pages.auth.register');
    }

    public function store(Request $request)
    {
        // ===================== LOGIN =====================
        if ($request->has('login')) {

            $request->validate([
                'email'    => 'required',
                'password' => 'required|min:3',
            ]);

            $email    = $request->email;
            $password = $request->password;

     
            // ===================== LOGIN NORMAL DATABASE =====================
            $user = User::where('email', $email)->first();

            if ($user && Hash::check($password, $user->password)) {

                Auth::login($user);
                $request->session()->regenerate();

                return redirect()->route('dashboard.index')
                    ->with('success', 'Login berhasil!');
            }

            return back()->with('error', 'Email atau password salah')->withInput();
        }

        // ===================== REGISTER =====================
        if ($request->has('register')) {

            $request->validate([
                'name'     => 'required|string|max:50',
                'email'    => 'required|email|unique:users',
                'role'     => 'required|in:Admin,Pegawai',
                'password' => [
                    'required',
                    'min:3',
                    'regex:/[A-Z]/',
                    'confirmed',
                ],
            ]);

            User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'role'     => $request->role,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('auth.index')
                ->with('success', 'Akun berhasil dibuat, silakan login!');
        }

        return back()->with('error', 'Aksi tidak dikenali.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.index')->with('success', 'Anda telah logout.');
    }
}
