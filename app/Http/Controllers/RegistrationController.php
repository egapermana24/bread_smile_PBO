<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RegistrationController extends Controller
{
    public function index()
    {

        return view(
            'auth.register',
            [
                'tittle' => '',
                'judul' => '',
                'menu' => '',
                'submenu' => ''
            ]
        );
    }

    public function store(Request $request)
    {

        $karyawan = Karyawan::where('nip', $request->nip)->first();
        if (!empty($karyawan) || $karyawan == !null) {

            // cek apakah user itu terdaftar pada tabel karyawan
            if ($request->nip === $karyawan->nip && $request->nm_karyawan === $karyawan->nm_karyawan) {

                $nip = $karyawan->nip;
                $name = $karyawan->nm_karyawan;
                $role = $karyawan->role;

                // mengubah nama validasi
                $messages = [
                    'nip.required' => 'Nip tidak boleh kosong',
                    'nip.unique' => 'Nip sudah terdaftar',
                    'nm_karyawan.required' => 'Nama tidak boleh kosong',
                    'nm_karyawan.unique' => 'Nama sudah terdaftar',
                    'password.required' => 'Password tidak boleh kosong',
                    'password.min' => 'Password minimal 8 karakter',
                    'password.max' => 'Password maksimal 16 karakter',
                    'rePassword.required' => 'Konfirmasi Password tidak boleh kosong',
                    'rePassword.same' => 'Password tidak sama'
                ];

                $request->validate([
                    'nip' => 'required|unique:users,nip',
                    'nm_karyawan' => 'required|unique:users,name',
                    'password' => 'required|min:8|max:16',
                    'rePassword' => 'required|same:password',
                ], $messages);

                $input = $request->all();

                $input['password'] = bcrypt($input['password']);

                User::create([
                    'name' => $name,
                    'nip' => $nip,
                    'password' => $input['password'],
                    'role' => $role
                ]);

                Alert::success('Registrasi Berhasil', 'Silahkan Login!');
                return redirect('login');
            } else {
                return back()->with('registerError', 'NIP dan Nama tidak terdaftar!');
            }
        } else {
            Alert::error('Registrasi Gagal', 'Silahkan Registrasi Ulang!');
            return redirect('register');
        }
    }

    public function login()
    {
        return view(
            'auth.login'
        );
    }

    public function loginStore(Request $request)
    {
        $messages = [
            'nip.required' => 'NIP tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ];

        $request->validate([
            'nip' => 'required',
            'password' => 'required',
        ], $messages);

        $credentials = $request->only('nip', 'password');

        // pesan error jika email dan password tidak sesuai dengan data di database

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect(RouteServiceProvider::HOME)->with('success', 'Login Berhasil');
        }

        // return back()->withErrors([
        //     'email' => 'Email yang kamu masukan salah',
        //     'password' => 'Password yang kamu masukan salah',
        // ]);
        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout Berhasil');
    }
}
