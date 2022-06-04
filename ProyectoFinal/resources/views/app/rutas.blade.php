@extends('layouts.app')
    @section('content')
    <br><br><br><br>
        @foreach ($rowset as $row)
            <div class="row g-0 bg-light position-relative">
                <div class="col-md-6 mb-md-0 p-md-4" id="boton" style="border-right: 0px">
                    <img src="{{ asset('img/'.$row->imagen) }}" class="w-100 mx-auto d-block" alt="{{'img/'.$row->slug}}">
                </div>
                <div class="col-md-6 p-4 ps-md-0" id="boton" style="border-left: 0px">
                    <br>
                    <h4 class="mt-0 nos al">{{$row->nombre}}</h4>
                    <br>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">DURACIÓN: {{ $row->duracion  }}</li>
                        <li class="list-group-item">PUERTO: {{ $row->puerto  }}</li>
                        <li class="list-group-item">PROVINCIA: {{ $row->provincia  }}</li>
                    </ul>
                    <br>
                    <a href="{{ url('ruta/'.$row->slug) }}" class="stretched-link nos">Saber más</a>
                </div>
            </div>
        @endforeach
    <br><br>
    @endsection
