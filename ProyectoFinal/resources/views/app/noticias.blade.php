@extends('layouts.app')

@section('content')

    @foreach ($rowset as $row)

        <div class="row g-0 bg-light position-relative">
            <div class="col-md-6 mb-md-0 p-md-4" id="boton" style="border-right: 0px">
            <img src="{{'img/'.$row->imagen}}" class="w-75 mx-auto d-block" alt="{{$row->imagen}}">
        </div>
        <div class="col-md-6 p-4 ps-md-0">
            <h4>{{ $row->titulo  }}</h4>
            <p>{{ $row->entradilla  }}</p>
            <a href="{{ url('noticia/'.$row->slug) }}" class="stretched-link">Saber más</a>
        </div>
    </div>
    <br><br>
    @endforeach

@endsection
