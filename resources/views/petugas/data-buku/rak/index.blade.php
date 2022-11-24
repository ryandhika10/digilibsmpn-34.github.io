@extends('layouts/dashboard/main')
@section('title', 'Rak')
@section('active-rak', 'active')
@section('active-data-buku', 'active')
@section('collapse-data-buku', 'menu-is-opening menu-open')
@section('content')
    <livewire:petugas.rak></livewire:petugas.rak>
@endsection