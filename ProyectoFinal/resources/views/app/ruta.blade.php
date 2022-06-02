@extends('layouts.app')

@section('content')

<div class="row">

    @foreach ($rowset as $row)

        <img src="{{'img/'.$row->imagen}}" width="500px" alt="{{'img/'.$row->nombre}}" class="center">

        <br><br>
        <div class="col-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">DURACIÓN: {{ $row->duracion  }}</li>
                <li class="list-group-item">DISTANCIA: {{ $row->distancia  }}</li>
                <li class="list-group-item">PUERTO: {{ $row->puerto  }}</li>
                <li class="list-group-item">PROVINCIA: {{ $row->provincia}}</li>
            </ul>
        </div>

        <br><br>
        <p class="parrafos">{{$row->desripcion}}</p>
        <br><br>

        <div class="row justify-content-center">
            <iframe src="{{$row->mapa}}" width="500" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    @endforeach

</div>

@endsection
