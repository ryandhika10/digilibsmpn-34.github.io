@extends('layouts/dashboard/main')
@section('title', 'Semua User')
@section('active-user', 'active')
@section('active-data-user', 'active')
@section('collapse-data-user', 'menu-is-opening menu-open')
@section('content')
    <livewire:admin.user></livewire:admin.user>
@endsection