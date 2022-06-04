@extends('layouts.admin')

@section('content')
    <br><br><br><br>
    <h3 style="font-family: Ubuntu">Iniciar Sesión</h3>
    <br>
    <div class="row">
        <form method="POST" action="{{ route('autenticar') }}">
            @csrf
            <div class="row">
                <div>
                    <label for="email">E-mail</label>
                    <input id="email" type="text" name="email" value="" placeholder="email@email.es">
                </div>
                <div>
                    <label for="password">Contraseña</label>
                    <input id="password" type="password" name="password" value="" placeholder="abcD123?">

                </div>
                <div>
                    <br>
                    <a href="" title="Cambiar contraseña">
                        <button type="button" class="btn btn-lg" id="boton">Cambiar contraseña</button>
                    </a>
                    <a href="{{ route('registro') }}" title="Registrarse">
                        <button type="button" class="btn btn-lg" id="boton">Registrarse</button>
                    </a>
                    <button type="submit" class="btn btn-lg" id="boton">Acceder</button>
                </div>
            </div>
        </form>
    </div>
@endsection
