@extends('layouts.admin')

@section('content')
    <br><br><br><br>


    <h3 style="font-family: Ubuntu; font-weight: bold;">
        RUTAS:
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
                        <label for="nombre">Nombre:</label><br>
                        <input id="nombre" type="text" name="nombre" value="{{ $row->nombre }}" placeholder="Título de la ruta">
                    </div>
                    <div class="input-field col s12">
                        <label for="provincia">Provincia:</label><br>
                        <input id="provincia" type="text" name="provincia" value="{{ $row->provincia }}" placeholder="Madrid">
                    </div>
                    <div class="input-field col s12">
                        <label for="puerto">Puerto:</label><br>
                        <input id="puerto" type="text" name="puerto" value="{{ $row->puerto }}" placeholder="Navacerrada">
                    </div>
                    <div class="input-field col s12">
                        <label for="duracion">Duración:</label><br>
                        <input id="duracion" type="text" name="duracion" value="{{ $row->duracion }}" placeholder="2h y 30 min">
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
                    <img class="d-block w-100" src="{{ asset('img/'.$row->imagen) }}" width="300px" alt="{{ $row->slug }}">
                @endif
            </div>
            <div class="col s12">
                <div class="row">
                    <div class="input-field col s12">
                        <label for="mapa">Mapa:</label><br><br>
                        <textarea id="mapa" class="form-control" name="mapa" placeholder="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12082.455990728336!2d-4.0600000000000005!3d40.7924995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd416cb0bcc81441%3A0x49a1d960068ef633!2sPuerto%20de%20la%20Fuenfria!5e0!3m2!1ses!2ses!4v1654356648089!5m2!1ses!2ses">
                            {{ $row->mapa }}</textarea>
                    </div>
                    <div class="input-field col s12">
                        <label for="descripcion">Descripción:</label><br><br>
                        <textarea id="descripcion" class="form-control" name="descripcion">{{ $row->descripcion }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <a href="{{ url("admin/rutas/") }}" title="Volver">
                        <button class="btn btn-lg" id="boton" type="button">Volver</button>
                    </a>

                    <button class="btn btn-lg" id="boton" type="submit" name="guardar">Guardar</button>

                </div>
            </div>
        </form>
    </div>
@endsection
