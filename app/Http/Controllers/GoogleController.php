<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Cookie;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            // 
            $findUser = User::where('google_id', $user->getId())->first();
            if ($findUser) {
                Auth::login($findUser);
                if (auth()->user()->hasRole('siswa')) {
                    return redirect()->intended('/');
                } elseif (auth()->user()->hasRole('admin') || auth()->user()->hasRole('petugas')) {
                    return redirect()->intended('/dashboard');
                } elseif (auth()->user()->hasRole('guru')) {
                    return redirect()->intended('/d-blog');
                }
            } else {
                $newUser = User::where('email', $user->getEmail())->firstOrFail();
                $newUser->update([
                    'google_id' => $user->getId(),
                ]);
                Auth::login($newUser);
                if (auth()->user()->hasRole('siswa')) {
                    return redirect()->intended('/');
                } elseif (auth()->user()->hasRole('admin') || auth()->user()->hasRole('petugas')) {
                    return redirect()->intended('/dashboard');
                } elseif (auth()->user()->hasRole('guru')) {
                    return redirect()->intended('/d-blog');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->intended('login')->with('loginError', 'Login Gagal, Email Anda belum terdaftar!');
        }
    }
}
