<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    // ====================
    // API METHODS
    // ====================

    // Register API
    public function registerApi(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nrp' => 'required|string|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'pangkat' => $request->pangkat ?? null,
            'nrp' => $request->nrp,
            'korps' => $request->korps ?? null,
            'jabatan' => $request->jabatan ?? null,
            'satuan' => $request->satuan ?? null,
            'nik' => $request->nik ?? null,
            'alamat' => $request->alamat ?? null,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Kamu berhasil registrasi',
            'user' => $user
        ], 201);
    }

    // Login API
    public function loginApi(Request $request)
    {
        $credentials = $request->only('nrp', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json([
                'message' => 'Login berhasil',
                'user' => Auth::user()
            ]);
        }

        return response()->json(['message' => 'NRP atau password salah'], 401);
    }

    // Logout API
    public function logoutApi(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Kamu berhasil logout']);
    }

    // Profile API
    public function profileApi()
    {
        return response()->json(Auth::user());
    }

    // ====================
    // WEB METHODS
    // ====================

    // Show login form (web)
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/dashboard')->with('sukses', 'Sudah login');
        }
        return view('auth.login');
    }

    // Handle login POST (web)
    public function loginWeb(Request $request)
    {
        $credentials = $request->only('nrp', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('sukses', 'Berhasil login');
        }

        return back()->withErrors([
            'nrp' => 'NRP atau password salah.',
        ])->onlyInput('nrp');
    }

    // Show register form (web)
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard')->with('sukses', 'Sudah login');
        }
        return view('auth.register');
    }

    // Handle register POST (web)
    public function registerWeb(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nrp' => 'required|string|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'pangkat' => $request->pangkat ?? null,
            'nrp' => $request->nrp,
            'korps' => $request->korps ?? null,
            'jabatan' => $request->jabatan ?? null,
            'satuan' => $request->satuan ?? null,
            'nik' => $request->nik ?? null,
            'alamat' => $request->alamat ?? null,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('sukses', 'Anda berhasil register');
    }

    // Dashboard (web)
    public function dashboard()
    {
        $user = Auth::user();
        return view('auth.dashboard', compact('user'));
    }

    // Logout (web)
    public function webLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('sukses', 'Berhasil logout');
    }

      // Tampilkan form edit profil (web)
    public function editProfile()
    {
        $user = Auth::user();
        return view('auth.edit', compact('user'));
    }

    // mengupdate profile (web)
    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user) {
            Log::error('User tidak ditemukan saat update profile');
            return redirect()->route('dashboard')->with('error', 'User tidak ditemukan');
        }

        // Ambil data yang diizinkan
        $data = $request->only([
            'name', 'pangkat', 'nrp', 'korps', 'jabatan', 'satuan', 'nik', 'alamat'
        ]);

        Log::info('Data request:', $data);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
            Log::info('Password ikut diupdate');
        }

        try {
            $user->fill($data);
            $user->save();

            Log::info('User berhasil disave', $user->toArray());

            return redirect()->route('dashboard')->with('sukses', 'Profile berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Gagal update profile: '.$e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Gagal update profile: '.$e->getMessage());
        }
    }
}


