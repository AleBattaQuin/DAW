<?php
namespace App\Controller;

use App\Model\Libros;
use App\Helper\ViewHelper;
use App\Helper\DbHelper;


class AppController
{
    var $db;
    var $view;

    function __construct()
    {
        //Conexión a la BBDD
        $dbHelper = new DbHelper();
        $this->db = $dbHelper->db;

        //Instancio el ViewHelper
        $viewHelper = new ViewHelper();
        $this->view = $viewHelper;
    }

    public function index(){

        //Consulta a la bbdd
        $rowset = $this->db->query("SELECT * FROM libros WHERE activo=1 AND home=1 ORDER BY fecha DESC");

        //Asigno resultados a un array de instancias del modelo
        $libros = array();
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($libros,new Libros($row));
        }

        //Llamo a la vista
        $this->view->vista("app", "index", $libros);
    }

    public function acercade(){

        //Llamo a la vista
        $this->view->vista("app", "acerca-de");

    }

    public function libros(){

        //Consulta a la bbdd
        $rowset = $this->db->query("SELECT * FROM libros WHERE activo=1 ORDER BY fecha DESC");

        //Asigno resultados a un array de instancias del modelo
        $libros = array();
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($libros,new Libros($row));
        }

        //Llamo a la vista
        $this->view->vista("app", "libros", $libros);

    }

    public function libro($slug){

        //Consulta a la bbdd
        $rowset = $this->db->query("SELECT * FROM libros WHERE activo=1 AND slug='$slug' LIMIT 1");

        //Asigno resultado a una instancia del modelo
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $libros = new Libros($row);

        //Llamo a la vista
        $this->view->vista("app", "libro", $libros);

    }
}