@extends('layouts/dashboard/main')
@section('title', 'Buku')
@section('active-d-buku', 'active')
@section('active-data-buku', 'active')
@section('collapse-data-buku', 'menu-is-opening menu-open')
@section('content')
    <livewire:petugas.buku></livewire:petugas.buku>
@endsection