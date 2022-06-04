@extends('layouts.admin')

@section('content')

    <h3>
        <a href="{{ route("admin") }}" title="Inicio">Inicio</a> <span>| </span>
        <a href="{{ url("admin/rutas") }}" title="rutas">Rutas</a> <span>| </span>
        @if ($row->id)
            <span>Editar {{ $row->nombre }}</span>
        @else
            <span>Nueva ruta</span>
        @endif
    </h3>
    <div class="row">
        @php $accion = ($row->id) ? "actualizar/".$row->id : "guardar" @endphp
        <form class="col s12" method="POST" enctype="multipart/form-data" action="{{ url("admin/rutas/".$accion) }}">
            @csrf
            <div class="col m12 l6">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="titulo" type="text" name="titulo" value="{{ $row->nombre }}">
                        <label for="titulo">Título</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="autor" type="text" name="autor" value="{{ $row->autor }}">
                        <label for="autor">Autor</label>
                    </div>
                    <div class="input-field col s12">
                        @php $fecha = ($row->fecha) ? date("d-m-Y", strtotime($row->fecha)) : date("d-m-Y") @endphp
                        <input id="fecha" type="text" name="fecha" class="datepicker" value="{{ $fecha }}">
                        <label for="fecha">Fecha</label>
                    </div>
                </div>
            </div>
            <div class="col m12 l6 center-align">
                <div class="file-field input-field">
                    <div class="btn">
                        <span>Imagen</span>
                        <input type="file" name="imagen">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
                @if ($row->imagen)
                    {{ Html::image('img/'.$row->imagen, $row->imagen, ['class' => 'responsive-img']) }}
                @endif
            </div>
            <div class="col s12">
                <div class="row">
                   <div class="input-field col s12">
                        <textarea id="texto" class="materialize-textarea" name="texto">{{ $row->descripcion }}</textarea>
                        <label for="texto">Texto</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <a href="{{ url("admin/rutas/") }}" title="Volver">
                        <button class="btn waves-effect waves-light" type="button">Volver</button>
                    </a>
                    <button class="btn waves-effect waves-light" type="submit" name="guardar">Guardar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
