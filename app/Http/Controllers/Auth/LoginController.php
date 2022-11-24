<?php

namespace App\Http\Controllers\Auth;

use App\Rules\Lowercase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login', [
            'title' => ' | Login',
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns|exists:users,email',
            'password' => ['required', new Lowercase],
        ]);
        $request->validate([
            'g-recaptcha-response' => 'required|captcha'
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if ($request->has('remember')) {
                Cookie::queue('useremail', $request->email, 1440);
                Cookie::queue('userpwd', $request->password, 1440);
            }
            if (auth()->user()->hasRole('siswa')) {
                return redirect()->intended('/');
            } elseif (auth()->user()->hasRole('admin') || auth()->user()->hasRole('petugas')) {
                return redirect()->intended('/dashboard');
            } elseif (auth()->user()->hasRole('guru')) {
                return redirect()->intended('/dashboard');
            } elseif (auth()->user()->hasRole('alumni')) {
                return redirect()->intended('/posts');
            }
        }

        return redirect('/login')->with('loginError', 'Login Gagal!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
