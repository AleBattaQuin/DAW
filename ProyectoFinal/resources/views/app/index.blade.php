@extends('layouts.app')

@section('content')

    <!-- BODY ---------------------------------------------------------------------------------------------------------------------------------------------->

    <br><br>

    <!-- BLOQUE 1 RUTA RECOMENDADA ------------------------------------------------>

    <div class="row justify-content-center">

        <!--IZQ FOTO-->
        <div class="col-4" id="fondo" style="border-right: 0px;"><img src="../ProyectoFinal/public/img/image%203.svg" alt="camino" class="mx-auto d-block"></div>

        <!--DCH RUTAS-->
        <div class="col-4" id="fondo" style="border-left: 0px;">

            <br>

            <p style="text-align: center;" class="nos">RUTAS RECOMENDADAS</p>

            <div style="text-align: center;" >

                <a href="{{ url('ruta/puerto de la fuenfría') }}"><button type="button" class="btn btn-lg" id="boton">PENSAR</button></a>
                <a href="{{ url('ruta/Puerto de la Fuenfría') }}"><button type="button" class="btn btn-lg" id="boton">PENSAR</button></a>
                <a href="{{ url('ruta/Puerto de la Fuenfría') }}"><button type="button" class="btn btn-lg" id="boton">PENSAR</button></a>

            </div>

        </div>

    </div>

    <br><br>
    <!-- BLOQUE 2 ------------------------------------------------>
    <div class="row justify-content-center">

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12082.455990728336!2d-4.0600000000000005!3d40.7924995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd416cb0bcc81441%3A0x49a1d960068ef633!2sPuerto%20de%20la%20Fuenfria!5e0!3m2!1ses!2ses!4v1653862237580!5m2!1ses!2ses" width="500" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

    </div>
    <br><br>
    <!-- BLOQUE 3 IZQUIERDA -------------------------------------->
    <div class="row justify-content-around">
        <!-- IZQUIERDA -------------------------------------->

        <div class="col-4" id="fondo">
            <br>
            <button type="button" class="btn btn-lg" id="boton">GALERIA</button>
            <br><br>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    @foreach ($rowset as $row)
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ 'img/'.$row->imagen }}" width="300px" alt="{{ $row->slug }}">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <br>
        </div>
        <!-- DERECHA -------------------------------------->

        @foreach ($rowset as $row)
        <div class="col-4" id="fondo">
            <br>
            <a href="{{ route('noticias') }}" style="text-align: center;"><button type="button" class="btn btn-lg" id="boton">NOTICIAS</button></a>
            <br><br>
            <div>
                <div class="row g-0 bg-light position-relative" id="fondo-noticia">
                    <div class="col-md-6 mb-md-0 p-md-4">
                        {{ Html::image('img/'.$row->imagen) }}
                    </div>
                    <div class="col-md-6 p-4 ps-md-0">
                        <h5 class="mt-0">{{ $row->titulo  }}</h5>
                        <ul class="list-group list-group-flush">
                            <p>{{ $row->entradilla  }}</p>
                        </ul>
                        <br>
                        <a href="{{ url('noticia/'.$row->slug) }}" class="stretched-link">Saber más</a>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
    <br><br>

@endsection
