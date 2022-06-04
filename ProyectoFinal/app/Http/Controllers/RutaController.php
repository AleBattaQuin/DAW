<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruta;
use App\Http\Requests\RutaRequest;
use App\Helpers\Funciones;


class RutaController extends Controller
{
    public function __construct()
    {
        /**
         * Asigno el middleware auth al controlador,
         * de modo que sea necesario estar al menos autenticado
         */
        $this->middleware('auth');
    }
    /**
     * Mostrar un listado de elementos
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Página a mostrar
        $pagina = ($request->pagina) ? $request->pagina : 1;

        //Obtengo todas las rutas ordenadas por fecha más reciente
        $rowset = Ruta::orderBy("duracion","DESC")->get();

        return view('admin.rutas.index',[
            'rowset' => $rowset,
        ]);
    }

    /**
     * Mostrar el formulario para crear un nuevo elemento
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        //Creo un nuevo usuario vacío
        $row = new Ruta();

        return view('admin.rutas.editar',[
            'row' => $row,
        ]);
    }

    /**
     * Guardar un nuevo elemento en la bbdd
     *
     * @param  \App\Http\Requests\RutaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(RutaRequest $request)
    {
        $row = Ruta::create([
            'puerto' => $request->puerto,
            'duracion' => $request->duracion,
            'slug' => Funciones::getSlug($request->nombre),
            'nombre' => $request->nombre,
            'provincia' => $request->provincia,
            'descripcion' => $request->descripcion,
            'mapa' => $request->mapa,
        ]);

        //Imagen
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $nombre = $archivo->getClientOriginalExtension();
            $archivo->move(public_path()."/img/", $nombre);
            Ruta::where('id', $row->id)->update(['imagen' => $nombre]);
            $texto = " e imagen subida.";
        }
        else{
            $texto = ".";
        }

        return redirect('admin/rutas')->with('success', 'Ruta <strong>'.$request->nombre.'</strong> creada'.$texto);
    }

    /**
     * Mostrar el formulario para editar un elemento
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        //Obtengo la ruta o muestro error
        $row = Ruta::where('id', $id)->firstOrFail();

        return view('admin.rutas.editar',[
            'row' => $row,
        ]);
    }


    /**
     * Actualizar un elemento en la bbdd
     *
     * @param  \App\Http\Requests\RutaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(RutaRequest $request, $id)
    {
        $row = Ruta::findOrFail($id);

        Ruta::where('id', $row->id)->update([
            'puerto' => $request->puerto,
            'duracion' => $request->duracion,
            'slug' => Funciones::getSlug($request->nombre),
            'nombre' => $request->nombre,
            'provincia' => $request->provincia,
            'descripcion' => $request->descripcion,
            'mapa' => $request->mapa,
        ]);

        //Imagen
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $nombre = $archivo->getClientOriginalExtension();
            $archivo->move(public_path()."/img/", $nombre);
            Ruta::where('id', $row->id)->update(['imagen' => $nombre]);
            $texto = " e imagen subida.";
        }
        else{
            $texto = ".";
        }

        return redirect('admin/rutas')->with('success', 'Ruta <strong>'.$request->titulo.'</strong> guardada'.$texto);
    }

    /**
     * Activar o desactivar elemento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activar($id)
    {
        $row = Ruta::findOrFail($id);
        $valor = ($row->activo) ? 0 : 1;
        $texto = ($row->activo) ? "desactivada" : "activada";

        Ruta::where('id', $row->id)->update(['activo' => $valor]);

        return redirect('admin/rutas')->with('success', 'Ruta <strong>'.$row->titulo.'</strong> '.$texto.'.');
    }

    /**
     * Mostrar o no elemento en la home.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function home($id)
    {
        $row = Ruta::findOrFail($id);
        $valor = ($row->home) ? 0 : 1;
        $texto = ($row->home) ? "no se muestra en la home" : "se muestra en la home";

        Ruta::where('id', $row->id)->update(['home' => $valor]);

        return redirect('admin/rutas')->with('success', 'Ruta <strong>'.$row->nombre.'</strong> '.$texto.'.');
    }

    /**
     * Borrar elemento (e imagen asociada si existe).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function borrar($id)
    {
        $row = Ruta::findOrFail($id);

        Ruta::destroy($row->id);

        //Borrar imagen
        $imagen = public_path()."/img/".$row->imagen;
        if (file_exists($imagen)){
            unlink($imagen);
        }

        return redirect('admin/rutas')->with('success', 'Ruta <strong>'.$row->nombre.'</strong> borrada.');
    }
}
