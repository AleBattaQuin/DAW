<?php
namespace App;

//Inicializo sesión para poder traspasar variables entre páginas
session_start();

//Incluyo los controladores que voy a utilizar para que seran cargados por Autoload
use App\Controller\AppController;
use App\Controller\LibroController;
use App\Controller\HobbitController;


/*
 * Asigno a sesión las rutas de las carpetas public y home, necesarias tanto para las rutas como para
 * poder enlazar imágenes y archivos css, js
 */
$_SESSION['public'] = '/PracticaCMS/public/';
$_SESSION['home'] = $_SESSION['public'].'index.php/';

//Defino y llamo a la función que autocargará las clases cuando se instancien
spl_autoload_register('App\autoload');

function autoload($clase,$dir=null){

    //Directorio raíz de mi proyecto
    if (is_null($dir)){
        $dirname = str_replace('/public', '', dirname(__FILE__));
        $dir = realpath($dirname);
    }

    //Escaneo en busca de la clase de forma recursiva
    foreach (scandir($dir) as $file){
        //Si es un directorio (y no es de sistema) accedo y
        //busco la clase dentro de él
        if (is_dir($dir."/".$file) AND substr($file, 0, 1) !== '.'){
            autoload($clase, $dir."/".$file);
        }
        //Si es un fichero y el nombr conicide con el de la clase
        else if (is_file($dir."/".$file) AND $file == substr(strrchr($clase, "\\"), 1).".php"){
            require($dir."/".$file);
        }
    }

}

//Para invocar al controlador en cada ruta
function controlador($nombre=null){

    switch($nombre){
        default: return new AppController;
        case "libros": return new LibroController;
        case "hobbits": return new HobbitController;
    }

}

//Quito la ruta de la home a la que me están pidiendo
$ruta = str_replace($_SESSION['home'], '', $_SERVER['REQUEST_URI']);

//Encamino cada ruta al controlador y acción correspondientes
switch ($ruta){

    //Front-end
    case "":
    case "/":
        controlador()->index();
        break;
    case "acerca-de":
        controlador()->acercade();
        break;
    case "libros":
        controlador()->libros();
        break;

    case (strpos($ruta,"libro/") === 0):
        controlador()->libro(str_replace("libro/","",$ruta));
        break;

    //Back-end
    case "admin":
    case "admin/entrar":
        controlador("hobbits")->entrar();
        break;
    case "admin/salir":
        controlador("hobbits")->salir();
        break;
    case "admin/hobbits":
        controlador("hobbits")->index();
        break;
    case "admin/hobbits/crear":
        controlador("hobbits")->crear();
        break;
    case (strpos($ruta,"admin/hobbits/editar/") === 0):
        controlador("hobbits")->editar(str_replace("admin/hobbits/editar/","",$ruta));
        break;
    case (strpos($ruta,"admin/hobbits/activar/") === 0):
        controlador("hobbits")->activar(str_replace("admin/hobbits/activar/","",$ruta));
        break;
    case (strpos($ruta,"admin/hobbits/borrar/") === 0):
        controlador("hobbits")->borrar(str_replace("admin/hobbits/borrar/","",$ruta));
        break;
    case "admin/libros":

        controlador("libros")->index();
        break;
    case "admin/libros/crear":
        controlador("libros")->crear();
        break;
    case (strpos($ruta,"admin/libros/editar/") === 0):
        controlador("libros")->editar(str_replace("admin/libros/editar/","",$ruta));
        break;
    case (strpos($ruta,"admin/libros/activar/") === 0):
        controlador("libros")->activar(str_replace("admin/libros/activar/","",$ruta));
        break;
    case (strpos($ruta,"admin/libros/home/") === 0):
        controlador("libros")->home(str_replace("admin/libros/home/","",$ruta));
        break;
    case (strpos($ruta,"admin/libros/borrar/") === 0):
        controlador("libros")->borrar(str_replace("admin/libros/borrar/","",$ruta));
        break;
    case (strpos($ruta,"admin/") === 0):
        controlador("hobbits")->entrar();
        break;

    //Resto de rutas
    default:
        controlador()->index();
}