
@extends('layouts.admin')

@section('content')

    <br><br><br>

    <h2>Bienvenido {{Auth::user()->nombre}} </h2>

    <p>Este es el <strong>Panel de Administración</strong></p>

@endsection
