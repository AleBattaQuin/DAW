@extends('layouts.admin')

@section('content')
    <br><br><br>
    <h3 style="font-family: Ubuntu">RUTAS:</h3>
    <div class="row">
        <!--Nuevo-->
        <article class="col s12 l6">
            <div class="card horizontal admin">
                <div class="card-stacked">
                    <div class="card-content">
                        <i class="grey-text material-icons medium">image</i>
                        <h4 class="grey-text">
                            nueva ruta
                        </h4><br><br>
                    </div>
                    <div class="card-action">
                        <a href="{{ url("admin/rutas/crear") }}" title="Añadir nueva ruta">
                            <button type="button" class="btn btn-lg" id="boton">Nueva ruta</button>
                        </a>
                    </div>
                </div>
            </div>
        </article>
        @foreach ($rowset as $row)
            <article class="col s12 l6">
                <div class="card horizontal  sticky-action admin">
                    <div class="card-stacked">
                        @if ($row->imagen)
                            <div class="card-image">
                                <img class="d-block w-100" src="{{ asset('img/'.$row->imagen) }}" width="300px" alt="{{ $row->slug }}">
                            </div>
                        @endif
                        <div class="card-content">
                            @if (!$row->imagen)
                                <i class="grey-text material-icons medium">image</i>
                            @endif
                            <h4>
                                {{ $row->nombre }}
                            </h4>
                            <strong>URL amigable:</strong> {{ $row->slug }}<br>
                            <strong>Fecha:</strong> {{ date("d/m/Y", strtotime($row->fecha)) }}
                        </div>
                        <div class="card-action">
                            <a href="{{ url("admin/rutas/editar/".$row->id) }}" title="Editar">
                                <button type="button" class="btn btn-lg" id="boton">Editar</button>
                            </a>
                            <a href="{{ url("admin/rutas/activar/".$row->id) }}" title="{{ Vistas::titulo($row->activo) }}">
                                <button type="button" class="btn btn-lg {{ Vistas::color($row->activo) }}" id="boton">{{ Vistas::icono($row->activo) }}</button>
                            </a>
                            @php
                                $title = ($row->home == 1) ? "Quitar de la home" : "Mostrar en la home";
                                $color = ($row->home == 1) ? "green-text" : "red-text";
                            @endphp
                            <a href="{{ url("admin/rutas/home/".$row->id) }}" title="{{ $title }}">
                                <button type="button" class="btn btn-lg {{ $color }}" id="boton">inicio</button>
                            </a>
                            <a href="#" class="activator" title="Borrar">
                                <button type="button" class="btn btn-lg" id="boton">Borrar</button>
                            </a>
                        </div>
                    </div>
                    <!--Confirmación de borrar-->
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Borrar ruta<i class="material-icons right">close</i></span>
                        <p>
                            ¿Está seguro de que quiere borrar la ruta<strong>{{ $row->nombre }}</strong>?<br>
                            Esta acción no se puede deshacer.
                        </p>
                        <a href="{{ url("admin/rutas/borrar/".$row->id) }}" title="Borrar">
                            <button class="btn waves-effect waves-light" type="button">Borrar</button>
                        </a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@endsection
