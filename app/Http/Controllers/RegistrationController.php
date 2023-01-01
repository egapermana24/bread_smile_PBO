<?php

namespace App\Http\Controllers;

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

        // mengubah nama validasi
        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 50 karakter',
            'name.string' => 'Nama harus berupa huruf',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 16 karakter',
            'rePassword.required' => 'Konfirmasi Password tidak boleh kosong',
            'rePassword.same' => 'Password tidak sama',
        ];

        $request->validate([
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:16',
            'rePassword' => 'required|same:password',
        ], $messages);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        User::create($input);


        Alert::success('Registrasi Berhasil', 'Silahkan Login!');
        return redirect('login')->with('status', 'Registrasi Berhasil, Silahkan Login!');
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
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
        ];

        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ], $messages);

        $credentials = $request->only('email', 'password');

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
