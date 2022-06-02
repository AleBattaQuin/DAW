@extends('layouts.app')

@section('content')

    <br><br><br>

<div class="row">
<div>
        <img src="{{'img/'.$row->imagen}}" width="500px" alt="{{'img/'.$row->nombre}}" class="center">
</div>
        <br><br>
        <div class="col-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">DURACIÓN: {{ $row->duracion  }}</li>
                <li class="list-group-item">PUERTO: {{ $row->puerto  }}</li>
                <li class="list-group-item">PROVINCIA: {{ $row->provincia}}</li>
            </ul>
        </div>
    <br><br><br><br><br>
        <br><br>
        <p class="parrafos">{{$row->descripcion}}</p>
        <br><br>

        <div class="row justify-content-center">
            <iframe src="{{$row->mapa}}" width="500" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

</div>

@endsection
