@extends('layouts/dashboard/main')
@section('title', 'Guru')
@section('active-guru', 'active')
@section('active-data-user', 'active')
@section('collapse-data-user', 'menu-is-opening menu-open')
@section('content')
    <livewire:admin.guru></livewire:admin.guru>
@endsection