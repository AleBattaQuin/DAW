@extends('layouts.admin')

@section('content')
    <br><br><br>
    <h3 style="font-family: Ubuntu; font-weight: bold;">NOTICIAS:</h3>
    <div class="row">
        <!--Nuevo-->
        <article class="col s12 l6">
            <div class="card horizontal admin">
                <div class="card-stacked">
                    <div class="card-content">
                        <i class="grey-text material-icons medium">image</i>
                        <h4 class="grey-text">
                            nueva noticia
                        </h4><br><br>
                    </div>
                    <div class="card-action">
                        <a href="{{ url("admin/noticias/crear") }}" title="Añadir nueva noticia">
                            <button type="button" class="btn btn-lg" id="boton">Nueva Noticia</button>
                        </a>
                    </div>
                </div>
            </div>
        </article>
        @foreach ($rowset as $row)
            <article class="col s12 l6">
                <div class="card horizontal  sticky-action admin">
                    <div class="card-stacked">
                        @if ($row->img)
                            <div class="card-image">
                                {{ Html::image('img/'.$row->img, $row->titulo) }}
                            </div>
                        @endif
                        <div class="card-content">
                            @if (!$row->img)
                                <i class="grey-text material-icons medium">image</i>
                            @endif
                            <h4>
                                {{ $row->titulo }}
                            </h4>
                            <strong>URL amigable:</strong> {{ $row->slug }}<br>
                            <strong>Fecha:</strong> {{ date("d/m/Y", strtotime($row->fecha)) }}
                        </div>
                        <div class="card-action">
                            <a href="{{ url("admin/noticias/editar/".$row->id) }}" title="Editar">
                                <button type="button" class="btn btn-lg" id="boton">Editar</button>
                            </a>
                            <a href="{{ url("admin/noticias/activar/".$row->id) }}" title="{{ Vistas::titulo($row->activo) }}">
                                <button type="button" class="btn btn-lg {{ Vistas::color($row->activo) }}" id="boton">{{ Vistas::icono($row->activo) }}</button>
                            </a>
                            @php
                                $title = ($row->home == 1) ? "Quitar de la home" : "Mostrar en la home";
                                $color = ($row->home == 1) ? "green-text" : "red-text";
                            @endphp
                            <a href="{{ url("admin/noticias/home/".$row->id) }}" title="{{ $title }}">
                                <button type="button" class="btn btn-lg {{ $color }}" id="boton">inicio</button>
                            </a>
                            <a href="#" class="activator" title="Borrar">
                                <button type="button" class="btn btn-lg" id="boton">Borrar</button>
                            </a>
                        </div>
                    </div>
                    <!--Confirmación de borrar-->
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Borrar noticia<i class="material-icons right">close</i></span>
                        <p>
                            ¿Está seguro de que quiere borrar la noticia<strong>{{ $row->titulo }}</strong>?<br>
                            Esta acción no se puede deshacer.
                        </p>
                        <a href="{{ url("admin/noticias/borrar/".$row->id) }}" title="Borrar">
                            <button class="btn waves-effect waves-light" type="button">Borrar</button>
                        </a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@endsection
