@extends('layouts.admin')

@section('content')
    <br><br><br><br>


    <h3 style="font-family: Ubuntu; font-weight: bold;">
        NOTICIAS:
        @if ($row->id)
            <span>Editar {{ $row->titulo }}</span>
        @else
            <span>Nueva noticia</span>
        @endif
    </h3>


    <div class="row">
        @php $accion = ($row->id) ? "actualizar/".$row->id : "guardar" @endphp
        <form class="col s12" method="POST" enctype="multipart/form-data" action="{{ url("admin/noticias/".$accion) }}">
            @csrf
            <div class="col m12 l6">
                <div class="row">
                    <div class="input-field col s12">
                        <label for="titulo">Título:</label><br>
                        <input id="titulo" type="text" name="titulo" value="{{ $row->titulo }}" placeholder="Título de la noticia">
                    </div>
                    <div class="input-field col s12">
                        <label for="autor">Autor:</label><br>
                        <input id="autor" type="text" name="autor" value="{{ $row->autor }}" placeholder="Nombre y Apellido">
                    </div>
                    <div class="input-field col s12">
                        <label for="fecha">Fecha:</label><br>
                        @php $fecha = ($row->fecha) ? date("d-m-Y", strtotime($row->fecha)) : date("d-m-Y") @endphp
                        <input id="fecha" type="text" name="fecha" class="datepicker" value="{{ $fecha }}">
                    </div>
                </div>
            </div>
            <div class="col m12 l6 center-align">

                <div class="file-field input-field">
                    <div class="btn">
                        <span>Imagen</span>
                        <input type="file" name="img">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
                @if ($row->img)
                    {{ Html::image('img/'.$row->img, $row->titulo, ['class' => 'responsive-img']) }}
                @endif
            </div>
            <div class="col s12">
                <div class="row">
                    <div class="input-field col s12">
                        <label for="entradilla">Entradilla:</label><br><br>
                        <textarea id="entradilla" class="form-control" name="entradilla">{{ $row->entradilla }}</textarea>
                    </div>
                    <div class="input-field col s12">
                        <label for="texto">Texto:</label><br><br>
                        <textarea id="texto" class="form-control" name="texto">{{ $row->texto }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <a href="{{ url("admin/noticias/") }}" title="Volver">
                        <button class="btn btn-lg" id="boton" type="button">Volver</button>
                    </a>

                    <button class="btn btn-lg" id="boton" type="submit" name="guardar">Guardar</button>

                </div>
            </div>
        </form>
    </div>
@endsection
