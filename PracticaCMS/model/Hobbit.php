<?php
namespace App\Model;

class Hobbit {

    //Variables o atributos
    var $id;
    var $hobbit;
    var $clave;
    var $fecha_acceso;
    var $activo;
    var $hobbits;
    var $libros;

    function __construct($data=null){

        $this->id = ($data) ? $data->id : null;
        $this->hobbit = ($data) ? $data->hobbit : null;
        $this->clave = ($data) ? $data->clave : null;
        $this->fecha_acceso = ($data) ? $data->fecha_acceso : null;
        $this->activo = ($data) ? $data->activo : null;
        $this->hobbits = ($data) ? $data->hobbits : null;
        $this->libros = ($data) ? $data->libros : null;

    }

}