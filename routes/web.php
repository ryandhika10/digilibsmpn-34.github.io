<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Peminjam\BukuController;
use App\Http\Controllers\Peminjam\EbookController;
use App\Http\Controllers\Peminjam\PostsController;
use App\Http\Controllers\Peminjam\BerandaController;
use App\Http\Controllers\Petugas\Blog\TagController;
use App\Http\Controllers\Petugas\Buku\RakController;
use App\Http\Controllers\Petugas\KategoriController;
use App\Http\Controllers\Petugas\PenerbitController;
use App\Http\Controllers\Petugas\Blog\LikeController;
use App\Http\Controllers\Petugas\Blog\PostController;
use App\Http\Controllers\Petugas\DashboardController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Petugas\TempatTerbitController;
use App\Http\Controllers\Petugas\Buku\DashBukuController;
use App\Http\Controllers\Petugas\Ebook\DashEbookController;
use App\Http\Controllers\Petugas\Transaksi\TransaksiBukuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Halaman Depan
Route::get('/', [BerandaController::class, 'index'])->name('/');

// Ebook
Route::get('/ebook', [EbookController::class, 'index']);

// Blog
Route::get('/posts', [PostsController::class, 'index']);

Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('/login/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('/login/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

    // Register
    Route::get('/register_sebagai', [RegisterController::class, 'register_sebagai']);
    Route::get('/guru_register', [RegisterController::class, 'guru_register']);
    Route::get('/siswa_register', [RegisterController::class, 'siswa_register']);

    // Forgot Password
    Route::get('/lupa_password', [ForgetPasswordController::class, 'lupa_password']);
    Route::get('/reset_password', [ForgetPasswordController::class, 'reset_password']);
});

// Login
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Register
Route::post('/registerSiswa', [RegisterController::class, 'storeSiswa']);
Route::post('/registerGuru', [RegisterController::class, 'storeGuru']);

// Forgot Password
Route::post('/lupa_password', [ForgetPasswordController::class, 'kirim_link']);

Route::middleware(['verified'])->group(function () {
    // Buku
    Route::get('/buku', [BukuController::class, 'index']);
    Route::get('/buku/keranjang', [BukuController::class, 'keranjang']);
    Route::get('/buku/keranjang/{id}/konfirmasi', [BukuController::class, 'konfirmasi']);
    Route::get('/buku/keranjang/{id}/delete', [BukuController::class, 'delete']);
    Route::post('/buku/keranjang/pinjam', [BukuController::class, 'pinjam']);
    Route::get('/buku/{buku:slug}', [BukuController::class, 'show'])->name('detail buku');
    Route::post('/buku/{buku:slug}', [BukuController::class, 'tambahKeranjang']);
    // E-Book
    Route::get('/ebook/{ebook:slug}', [EbookController::class, 'show'])->name('detail buku');
    // Blog
    Route::get('/posts/{post:slug}', [PostsController::class, 'show'])->name('postShow');
    Route::post('/posts/{post:slug}', [PostsController::class, 'postKomentar']);
    Route::get('/posts/like/{post:slug}', [LikeController::class, 'like']);
    // Dashboard
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    // Kategori
    Route::get('/kategori', KategoriController::class);
    // Profile
    Route::resource('/profile', ProfileController::class);

    Route::middleware(['role:admin|petugas'])->group(function () {
        // CRUD Semua
        Route::get('/penerbit', PenerbitController::class);
        Route::get('/tempat-terbit', TempatTerbitController::class);
        // Dashboard Buku
        Route::get('/rak', RakController::class);
        Route::get('/d-buku', DashBukuController::class);
        // Dashboard Ebook
        Route::get('/d-ebook', DashEbookController::class);
        // Transaksi
        Route::get('/transaksi-buku', TransaksiBukuController::class);
        // Admin
        Route::get('/user', UserController::class);
        Route::get('/guru', GuruController::class);
        Route::get('/siswa', SiswaController::class);
    });

    // Route::middleware(['role:admin'])->group(function () {
    //     Route::get('/pengaturan', PengaturanController::class);
    // });

    Route::middleware(['role:guru|siswa|alumni'])->group(function () {
        //Blog
        Route::resource('/d-blog', PostController::class)->names(['index' => 'dashBlog']);
        Route::get('/d-blog/{id}/konfirmasi', [PostController::class, 'konfirmasi']);
        Route::get('/d-blog/{id}/delete', [PostController::class, 'delete']);
        Route::get('/d-blog/{id}/rekomendasi', [PostController::class, 'rekomendasi']);
        Route::get('/d-blogs/checkSlug', [PostController::class, 'checkSlug']);
        Route::post('/d-blog/search', [PostController::class, 'index']);
        // Tag
        Route::get('/tag', TagController::class);
    });
});

Auth::routes(['verify' => true]);
