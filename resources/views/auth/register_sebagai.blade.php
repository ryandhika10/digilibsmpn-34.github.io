@extends('layouts/app')
@section('content')
    <section class="register-sebagai" id="register-sebagai">
        <div class="d-flex justify-content-center mt-5 pt-5">
            <div class="col-md-8 col-lg-6 border p-4 bg-light register-wrapper shadow rounded-3">
                <main class="form-signin align-items-center">
                    <h1 class="h3 mb-5 fw-normal text-center heading">Registrasi Sebagai ?</h1>
                    <div class="row d-flex card-register justify-content-center">
                        <div class="col-md-5 col-lg-4 me-3 guru-wrapper">
                            <a href="/guru_register" class="card">
                                <div class="lingkaran text-center mt-5">
                                    <i class="fa-solid fa-chalkboard-user fa-5x"></i>
                                </div>
                                <div class="card-body d-flex justify-content-center rounded-bottom">
                                    <h4>Guru</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-5">
                            <a href="/siswa_register" class="card d-flex justify-content-center align-items-center">
                                <div class="lingkaran text-center mt-5">
                                    <i class="fa-solid fa-user fa-5x"></i>
                                </div>
                                <div class="card-body d-flex justify-content-center rounded-bottom">
                                    <h4>Siswa</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <small class="d-block text-center mt-4">Sudah terdaftar? <a href="/login">Masuk</a></small>
                </main>
            </div>
        </div>
    </section>
@endsection