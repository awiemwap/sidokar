@extends('deskapp.app')
@section('tittle', 'Error 403')
@section('judul', 'Error 403')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ url('/css/403.css')}}" />
@endsection
@section('halaman', 'Error 403')
@section('container')
<div class="wrapper">
    <div class="box">
    <h1>403</h1>
    <p>Maaf, Halaman ini hanya bisa diakses oleh Administrator!</p>
    <p><a href="dashboard">Silakan kembali ke halaman awal.</a></p>
    </div>
    </div>
@endsection


