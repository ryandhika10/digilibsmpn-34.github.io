@extends('layouts/app')
@section('content')
    <section class="login" id="login">
        <div class="d-flex justify-content-center mt-4 pt-5">
            <div class="col-md-10">
                <div class="row mb-5 login-form bg-light rounded shadow">
                    <div class="col-md-7 p-0 m-0 gambar-login">
                        <img src="/img/pict1.jpg" class="rounded-start" width="100%" height="100%" alt="">
                    </div>
                    <div class="col-md-5 p-4">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show text-center rounded-5" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('loginError'))
                            <div class="alert alert-danger alert-dismissible fade show text-center rounded-5" role="alert">
                                {{ session('loginError') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($errors->has('g-recaptcha-response'))
                            <div class="alert alert-danger alert-dismissible fade show text-center rounded-5" role="alert">
                                {{ $errors->first('g-recaptcha-response') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @include('layouts/flash')
                        <main class="form-signin">
                            <h1 class="h3 mb-sm-3 mb-lg-4 fw-normal text-center heading">Masukkan Email dan Password</h1>
                            <form action="/login" method="post">
                                @csrf
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-md-10">
                                        <div class="form-sm my-3">
                                            <input type="email" name = "email" class="form-control @error ('email') is-invalid @enderror" id="email" placeholder="Masukkan Alamat Email" autofocus required @if(Cookie::has('useremail')) value="{{ Cookie::get('useremail') }}" @endif>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-sm password mb-3">
                                            <input type="password" name = "password" class="form-control active @error ('password') is-invalid @enderror" id="password" placeholder="Password" @if(Cookie::has('userpwd')) value="{{ Cookie::get('userpwd') }}" @endif required>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <span class="icon-area">
                                                <i id="icon" class="fa-solid fa-eye-slash text-secondary"></i>
                                            </span>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" @if(Cookie::has('useremail')) checked @endif>
                                            <label class="form-check-label subheading" for="remember">
                                                Biarkan tetap masuk
                                            </label>
                                        </div>
                                        <div class="form-sm mt-3">
                                            <p id="peringatan" class="p-2 text-danger bg-danger bg-opacity-25 rounded-5 subheading">Peringatan: Capslock Aktif</p>
                                        </div>
                                        <div class="form-sm mt-2 mb-2 captcha">
                                            {!! NoCaptcha::renderJs('id', false, 'onloadCallback') !!}
                                            {!! NoCaptcha::display() !!}
                                        </div>
                                        <button class="w-100 btn btn-sm btn-primary button-login mt-3 subheading" type="submit"><i class="fa-solid fa-right-to-bracket"></i> Masuk</button>
                                        <hr>
                                        <a class="w-100 btn btn-sm btn-danger login-google mt-3 subheading" href="{{ route('google.login') }}"><i class="fa-brands fa-google"></i> Masuk dengan Google</a>
                                        <hr>
                                    </div>
                                </div>
                            </form>
                            <small class="d-block text-center subheading"><a href="{{ route('password.request') }}">Lupa Password?</a></small>
                            <small class="d-block text-center mt-2 subheading">Belum terdaftar? <a href="/register_sebagai">Daftar Sekarang!</a></small>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    var onloadCallback = function() {
    alert("grecaptcha is ready!");
    };
</script>