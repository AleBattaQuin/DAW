@extends('layouts.app')

@section('content')
    <br><br><br><br>
    <div class="row">

            <img src="{{ asset('img/'.$row->img) }}" width="500px" alt="{{'img/'.$row->titulo}}" class="center">

            <br><br><br><br><br>

            <p class="parrafos">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>

            <br><br>


    </div>

@endsection
