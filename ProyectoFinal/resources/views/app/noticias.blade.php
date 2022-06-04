@extends('layouts.app')

@section('content')
    <br><br><br><br>
    @foreach ($rowset as $row)

        <div class="row g-0 bg-light position-relative">
            <div class="col-md-6 mb-md-0 p-md-4" id="boton" style="border-right: 0px">
            <img src="{{ asset('img/'.$row->img) }}" class="w-50 mx-auto d-block" alt="{{$row->slug}}">
        </div>

        <div class="col-md-6 p-4 ps-md-0" id="boton">

            <h4>{{ $row->titulo  }}</h4>
            <br>
            <p>{{ $row->entradilla  }}</p>
            <br>
            <a href="{{ url('noticia/'.$row->slug) }}" class="stretched-link">Saber más</a>
        </div>
    </div>
    <br><br>
    @endforeach

@endsection
