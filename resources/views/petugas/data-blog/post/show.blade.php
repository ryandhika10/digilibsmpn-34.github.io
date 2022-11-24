@extends('layouts/dashboard/main')
@section('title', 'Detail Post')
@section('active-d-post', 'active')
@section('active-data-blog', 'active')
@section('collapse-data-blog', 'menu-is-opening menu-open')
@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-10 text-center card">
            <div class="text-left card-header">
                <a href="/d-blog" class="btn btn-secondary btn-sm"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                <a href="/d-blog/{{ $post->slug }}/edit" class="btn btn-primary btn-sm"><i class="fa-solid fa-edit"></i> Edit</a>
            </div>
            <h2 class="mt-3">{{ $post->judul }}</h2>
            <div style="max-height: 350px; overflow: hidden">
                <img src="/storage/{{ $post->sampul }}" alt="{{ $post->nama }}" class="mt-3 card-img-top col-md-6 mx-auto" height="350px" width="100%">
            </div>
            <article class="my-3 text-left card-body">
                {!! $post->konten !!}
            </article>
            <div class="card-footer">
                <p><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></p>
            </div>
        </div>
    </div>
@endsection