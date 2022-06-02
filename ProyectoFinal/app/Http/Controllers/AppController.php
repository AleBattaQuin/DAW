<?php

namespace App\Http\Controllers;
use App\Models\Noticia;
use App\Models\Ruta;

class AppController extends Controller
{

    public function index()
    {
        //Obtengo las noticias a mostrar en la home
        $rowset = Noticia::where('activo', 1)->where('home', 1)->orderBy('fecha', 'DESC')->get();

        return view('app.index',[
            'rowset' => $rowset,
        ]);

        //Obtengo las rutas a mostrar en la home
        $rowset = Ruta::where('activo', 1)->where('home', 1)->orderBy('duracion', 'DESC')->get();

        return view('app.index',[
            'rowset' => $rowset,
        ]);
    }

    public function noticias()
    {
        //Obtengo las noticias a mostrar en el listado de noticias
        $rowset = Noticia::where('activo', 1)->orderBy('fecha', 'DESC')->get();

        return view('app.noticias',[
            'rowset' => $rowset,
        ]);
    }

    public function noticia($slug)
    {
        //Obtengo la noticia o muestro error
        $row = Noticia::where('activo', 1)->where('slug', $slug)->firstOrFail();

        return view('app.noticia',[
            'row' => $row,
        ]);
    }

    public function rutas()
    {
        //Obtengo las rutas a mostrar en el listado de noticias
        $rowset = Ruta::where('activo', 1)->orderBy('duracion', 'DESC')->get();

        return view('app.rutas',[
            'rowset' => $rowset,
        ]);
    }

    public function ruta($slug)
    {
        //Obtengo la ruta o muestro error
        $row = Ruta::where('activo', 1)->lwhere('slug', $slug)->firstOrFail();

        return view('app.ruta',[
            'row' => $row,
        ]);

    }


    public function otroscontenidos()
    {
        return view('app.otros-contenidos');
    }
}
