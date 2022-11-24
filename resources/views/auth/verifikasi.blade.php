@extends('layouts/app')
@section('content')
    <section class="verifikasi_email" id="verifikasi_email">
        <div class="d-flex justify-content-center mt-5 pt-5">
            <div class="col-md-6">
                <div class="row mb-5 verifikasi_email-form bg-light rounded shadow">
                    <div class="col-md-12 p-4">
                        @include('layouts/flash')
                        <main class="form-signin card">
                            <div class="card-header mb-sm-2 mb-lg-3 fw-normal">
                                <h3 class="pt-2 heading">Verifikasi Alamat Email Anda</h3>
                            </div>
                            <div class="card-body py-0">
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('Link verifikasi sudah dikirim ke email anda.') }}
                                    </div>
                                @endif
                                {{ __('Email anda belum diverifikasi,') }}
                                <form action="{{ route('verification.resend') }}" method="post" class="d-inline">
                                    @csrf
                                        <button class="mx-0 my-4 p-0 btn btn-link subheading align-baseline" type="submit">Kirim ulang kode verifikasi</button>
                                </form>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection