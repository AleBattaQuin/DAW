@extends('layouts.admin')

@section('content')

    <br><br><br>

    <h3 style="font-family: Ubuntu; font-weight: bold;">
        USUARIO:
        @if ($row->id)
            <span>Editar {{ $row->titulo }}</span>
        @else
            <span>Nueva usuario</span>
        @endif
    </h3>
    <div class="row">
        @php $accion = ($row->id) ? "actualizar/".$row->id : "guardar" @endphp
        <form class="col m12 l6" method="POST" action="{{ url("admin/usuarios/".$accion) }}">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <label for="nombre">Nombre</label><br>
                    <input id="nombre" type="text" name="nombre" value="{{ $row->nombre }}">
                </div>
                <div class="input-field col s12">
                    <label for="email">E-mail</label><br>
                    <input id="email" type="text" name="email" value="{{ $row->email }}">

                </div>
                @php $clase = ($row->id) ? "hide" : "" @endphp
                <div class="input-field col s12 {{ $clase }}" id="password">
                    <input id="password" type="password" name="password" value="">
                    <label for="password">Contraseña</label>
                </div>
                @if ($row->id)
                    <p>
                        <label for="cambiar_clave">
                            <input id="cambiar_clave" name="cambiar_clave" type="checkbox">
                            <span>Pulsa para cambiar la clave</span>
                        </label>
                    </p>
                @else
                    <input type="hidden" name="cambiar_clave" value="1">
                @endif
            </div>
            <div class="row">
                <p>Permisos</p>
                <p>
                    <label for="rutas">
                        <input id="rutas" name="rutas" type="checkbox" {{ ($row->rutas == 1) ? "checked" : "" }}>
                        <span>Rutas</span>
                    </label>
                </p>
                <p>
                    <label for="noticias">
                        <input id="noticias" name="noticias" type="checkbox" {{ ($row->noticias == 1) ? "checked" : "" }}>
                        <span>Noticias</span>
                    </label>
                </p>
                <p>
                    <label for="usuarios">
                        <input id="usuarios" name="usuarios" type="checkbox" {{ ($row->usuarios == 1) ? "checked" : "" }}>
                        <span>Usuarios</span>
                    </label>
                </p>
                <div class="input-field col s12">
                    <a href="{{ url("admin/usuarios") }}" title="Volver">
                        <button type="button" class="btn btn-lg" id="boton">Volver</button>
                    </a>
                    <button type="submit" name="guardar" class="btn btn-lg" id="boton">Guardar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
