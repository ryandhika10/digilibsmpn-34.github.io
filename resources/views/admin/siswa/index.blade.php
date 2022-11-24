@extends('layouts/dashboard/main')
@section('title', 'Siswa')
@section('active-siswa', 'active')
@section('active-data-user', 'active')
@section('collapse-data-user', 'menu-is-opening menu-open')
@section('content')
    <livewire:admin.siswa></livewire:admin.siswa>
@endsection