<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswords;
use App\Models\PasswordResets;
use App\Models\PemilikBengkel;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function userregister()
    {
        return view('userregister');
    }

    public function ownerregister()
    {
        return view('ownerregister');
    }

    public function douserregister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:100', 'email', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => 'required',
            'phone_number' => ['required', 'numeric', 'digits:12'],
            'alamat' => ['required', 'string', 'max:100'],
        ], [
            'required' => ':attribute wajib di isi',
            'unique' => 'Email sudah terdaftar',
            'confirmed' => 'Password tidak sama',
            'numeric' => 'Nomor handphone harus angka',
            'digits' => 'Harus 12 digit',
        ]);
        //pastikan email yang di register belum pernah terdaftar sama sekali sebagai user, owner ataupun admin
        if (User::whereemail($request->email)->first()) {
            return redirect()->route('login')->with('error', 'email ini sudah terdaftar sebagai user, harap gunakan email lain');
        } else if (PemilikBengkel::whereemail($request->email)->first()) {
            return redirect()->route('login')->with('error', 'email ini sudah terdaftar sebagai owner, harap gunakan email lain');
        } else if (Admin::whereemail($request->email)->first()) {
            return redirect()->route('login')->with('error', 'email ini sudah terdaftar sebagai admin, harap gunakan email lain');
        } else {
            // register user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'alamat' => $request->alamat,
                'phone_number' => $request->phone_number,
            ]);
            Auth::login($user);
            return redirect()->route('login')->with('success', 'Berhasil registrasi akun users, silahkan login');
        }
    }

    public function doownerregister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:100', 'email', 'unique:' . PemilikBengkel::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => 'required',
            'phone_number' => ['required', 'numeric', 'digits:12'],
        ], [
            'required' => ':attribute wajib di isi',
            'unique' => 'Email sudah terdaftar',
            'confirmed' => 'Password tidak sama',
            'numeric' => 'Nomor handphone harus angka',
            'digits' => 'Harus 12 digit',
        ]);
        //pastikan email yang di register belum pernah terdaftar sama sekali sebagai user, owner ataupun admin
        if (User::whereemail($request->email)->first()) {
            return redirect()->route('login')->with('error', 'email ini sudah terdaftar sebagai user, harap gunakan email lain');
        } else if (PemilikBengkel::whereemail($request->email)->first()) {
            return redirect()->route('login')->with('error', 'email ini sudah terdaftar sebagai owner, harap gunakan email lain');
        } else if (Admin::whereemail($request->email)->first()) {
            return redirect()->route('login')->with('error', 'email ini sudah terdaftar sebagai admin, harap gunakan email lain');
        } else {
            // register owner
            $owner = PemilikBengkel::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone_number,
            ]);
            Auth::login($owner);
            return redirect()->route('login')->with('success', 'Berhasil registrasi akun owner, silahkan login');
        }
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'required' => ':attribute jangan di kosongkan',
            'email' => 'format penulisan email salah'
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('adminindex');
        }

        if (Auth::guard('pemilikbengkel')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route("bengkel.index");
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function forgotPassView(Request $request)
    {
        return view('forgotPassword');
    }

    public function forgotPassSend(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'required' => 'email wajib di masukan',
            'email' => 'penulisan email salah',
        ]);

        try {
            #forgot akun berdasarkan akun pada roles(user, pemilik bengkel, admin) apa yang mau di reset
            if ($user = User::whereemail($request->email)->first()) {
                $mail = $user;
            } else if ($pemilikBengkel = PemilikBengkel::whereemail($request->email)->first()) {
                $mail = $pemilikBengkel;
            } else if ($admin = Admin::whereemail($request->email)->first()) {
                $mail = $admin;
            }
            #generate token untuk reset password
            $url = PasswordResets::create(['email' => $mail->email, 'token' => Str::random(64)]);
            #kirim token reset password ke email bersangkutan
            Mail::to($mail->email)->send(new ForgotPasswords($mail, $this->urlForgot($url)));
            return redirect()->route('forgotPassView')->with('success', 'Berhasil, Silahkan cek email anda untuk melakukan reset password');
        } catch (Exception $error) {
            #jika email tidak ditemukan maka redirect ke halaman berikut dan kasih flash data error
            return redirect()->route('forgotPassView')->with('error', 'Email Salah Atau Email Belum Terdaftar Di Sistem');
        }
    }

    public function resetPasswordView($tokenURL)
    {
        try {
            $user = PasswordResets::wheretoken($tokenURL)->firstOrFail();
            return view('resetPassword', ['user' => $user]);
        } catch (\Exception $error) {
            return view('tokenForgotExpire');
        }
    }

    public function resetPasswordSend(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ], [
            'required' => ':attribute wajib di isi',
            'confirmed' => 'password tidak sama'
        ]);

        #execute logic reset password
        try {
            #reset password berdasarkan kondisi pada email dari role akun(user, pemilik bengkel, admin) 
            if ($users = User::whereemail($request->email)->first()) {
                $users->update(['password' => Hash::make($request->password)]);
            } else if ($pemilik_bengkel = PemilikBengkel::whereemail($request->email)->first()) {
                $pemilik_bengkel->update(['password' => Hash::make($request->email)]);
            } else if ($admin = Admin::whereemail($request->email)->first()) {
                $admin->update(['password' => Hash::make($request->password)]);
            }
            PasswordResets::whereemail($request->email)->delete(); #delete token after change password
            return redirect()->route('login')->with('success', 'Berhasil ubah password, selanjutnya silahkan login'); #give response berhasil ubah password
        } catch (\Exception $error) {
            return view('tokenForgotExpire')->with('error', $error);
        }
    }
}
