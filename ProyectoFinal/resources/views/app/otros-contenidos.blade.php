@extends('layouts.app')

@section('content')

    <br><br><br>
    <p>
        Buenos días montañero. Esperemos que esta pagina les sirva de utilidad. <br>
        Acontinuacion le dejamos con varias imagenes para que pueda ver lo que se puede encontrar si realiza alguna de estas rutas.</p>

        <!--Slider-->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('img/fuenfria.jpeg') }}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('img/laguna-gredos.jpeg') }}" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('img/camino-schmidt.jpg') }}" alt="Third slide">
            </div>
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



    </div>

@endsection
