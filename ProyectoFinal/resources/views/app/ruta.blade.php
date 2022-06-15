@extends('layouts.app')

    @section('content')

<br><br><br><br>

<!--BODY-->
    <div class="row">

        <!--DESCRIPCIÓN-->

        <div class="row">
<h1 style="font-family: Ubuntu; text-align: center">{{ $row->nombre  }}</h1>
            <br><br><br>
            <h3 style="font-family: Ubuntu">Descripción de la ruta:</h3>

            <div class="col-8">

                <p style="font-family: Roboto; font-size: 18px;">{{$row->descripcion}}</p>

            </div>

            <br><br>

            <div class="col-4" id="boton">
                <br>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">DURACIÓN: {{ $row->duracion  }}</li>
                    <li class="list-group-item">PUERTO: {{ $row->puerto  }}</li>
                    <li class="list-group-item"> PROVINCIA: {{ $row->provincia}}</li>
                </ul>

                <br>

            </div>

        </div>

        <!--IMAGEN-->
        <div>
            <img src="{{ asset('img/'.$row->imagen) }}" width="500px" alt="{{'img/'.$row->nombre}}" class="center">
            <br><br>
        </div>

        <!--MAPA-->
        <div class="row justify-content-center">

            <iframe src="{{$row->mapa}}" width="500" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

    </div>

@endsection
