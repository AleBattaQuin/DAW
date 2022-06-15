@extends('layouts.app')

@section('content')
    <br><br><br><br>
    <div class="row">

            <img src="{{ asset('img/'.$row->img) }}" width="500px" alt="{{'img/'.$row->titulo}}" class="center">

            <br><br><br><br><br>

            <p class="parrafos">
        <p style="font-family: Roboto; font-size: 18px;">{{$row->texto}}</p>
        </p>

            <br><br>


    </div>

@endsection
