<?php
namespace App\Controller;

use App\Helper\ViewHelper;
use App\Helper\DbHelper;
use App\Model\Hobbit;


class HobbitController
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

    public function admin(){

        //Compruebo permisos
        $this->view->permisos();

        //LLamo a la vista
        $this->view->vista("admin","index");

    }

    public function entrar(){

        //Si ya está autenticado, le llevo a la página de inicio del panel
        if (isset($_SESSION['hobbit'])){

            $this->admin();

        }
        //Si ha pulsado el botón de acceder, tramito el formulario
        else if (isset($_POST["acceder"])){



            //Recupero los datos del formulario
            $campo_hobbit = filter_input(INPUT_POST, "hobbit", FILTER_SANITIZE_STRING);
            $campo_clave = filter_input(INPUT_POST, "clave", FILTER_SANITIZE_STRING);

            //Busco al usuario en la base de datos
            $rowset = $this->db->query("SELECT * FROM hobbits WHERE hobbit='$campo_hobbit' AND activo=1 LIMIT 1");

            //Asigno resultado a una instancia del modelo
            $row = $rowset->fetch(\PDO::FETCH_OBJ);
            $hobbit = new Hobbit($row);

            //Si existe el usuario
            if ($hobbit){
                //Compruebo la clave
                if (password_verify($campo_clave,$hobbit->clave)) {

                    //Asigno el usuario y los permisos la sesión
                    $_SESSION["hobbit"] = $hobbit->hobbit;
                    $_SESSION["hobbits"] = $hobbit->hobbits;
                    $_SESSION["libros"] = $hobbit->libros;

                    //Guardo la fecha de último acceso
                    $ahora = new \DateTime("now", new \DateTimeZone("Europe/Madrid"));
                    $fecha = $ahora->format("Y-m-d H:i:s");
                    $this->db->exec("UPDATE hobbits SET fecha_acceso='$fecha' WHERE hobbit='$campo_hobbit'");

                    //Redirección con mensaje
                    $this->view->redireccionConMensaje("admin","green","Bienvenido al panel de administración.");
                }
                else{
                    //Redirección con mensaje
                    $this->view->redireccionConMensaje("admin","red","Contraseña incorrecta.");
                }
            }
            else{
                //Redirección con mensaje
                $this->view->redireccionConMensaje("admin","red","No existe ningún usuario con ese nombre.");
            }
        }
        //Le llevo a la página de acceso
        else{
            $this->view->vista("admin","hobbits/entrar");
        }

    }

    public function salir(){

        //Borro al usuario de la sesión
        unset($_SESSION['hobbit']);

        //Redirección con mensaje
        $this->view->redireccionConMensaje("admin","green","Te has desconectado con éxito.");

    }

    //Listado de usuarios
    public function index(){

        //Permisos
        $this->view->permisos("hobbits");

        //Recojo los usuarios de la base de datos
        $rowset = $this->db->query("SELECT * FROM hobbits ORDER BY hobbit ASC");

        //Asigno resultados a un array de instancias del modelo
        $hobbits = array();
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($hobbits,new Hobbit($row));
        }

        $this->view->vista("admin","hobbits/index", $hobbits);

    }

    //Para activar o desactivar
    public function activar($id){

        //Permisos
        $this->view->permisos("hobbits");

        //Obtengo el usuario
        $rowset = $this->db->query("SELECT * FROM hobbits WHERE id='$id' LIMIT 1");
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $hobbit = new Hobbit($row);

        if ($hobbit->activo == 1){

            //Desactivo el usuario
            $consulta = $this->db->exec("UPDATE hobbits SET activo=0 WHERE id='$id'");

            //Mensaje y redirección
            ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
                $this->view->redireccionConMensaje("admin/hobbits","green","El usuario <strong>$hobbit->hobbit</strong> se ha desactivado correctamente.") :
                $this->view->redireccionConMensaje("admin/hobbits","red","Hubo un error al guardar en la base de datos.");
        }

        else{

            //Activo el usuario
            $consulta = $this->db->exec("UPDATE hobbits SET activo=1 WHERE id='$id'");

            //Mensaje y redirección
            ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
                $this->view->redireccionConMensaje("admin/hobbits","green","El usuario <strong>$hobbit->hobbit</strong> se ha activado correctamente.") :
                $this->view->redireccionConMensaje("admin/hobbits","red","Hubo un error al guardar en la base de datos.");
        }

    }

    public function borrar($id){

        //Permisos
        $this->view->permisos("hobbits");

        //Borro el usuario
        $consulta = $this->db->exec("DELETE FROM hobbits WHERE id='$id'");

        //Mensaje y redirección
        ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
            $this->view->redireccionConMensaje("admin/hobbits","green","El usuario se ha borrado correctamente.") :
            $this->view->redireccionConMensaje("admin/hobbits","red","Hubo un error al guardar en la base de datos.");

    }

    public function crear(){

        //Permisos
        $this->view->permisos("hobbits");

        //Creo un nuevo usuario vacío
        $hobbit = new Hobbit();

        //Llamo a la ventana de edición
        $this->view->vista("admin","hobbits/editar", $hobbit);

    }

    public function editar($id){

        //Permisos
        $this->view->permisos("hobbits");

        //Si ha pulsado el botón de guardar
        if (isset($_POST["guardar"])){

            //Recupero los datos del formulario
            $hobbit = filter_input(INPUT_POST, "hobbit", FILTER_SANITIZE_STRING);
            $clave = filter_input(INPUT_POST, "clave", FILTER_SANITIZE_STRING);
            $hobbits = (filter_input(INPUT_POST, 'hobbits', FILTER_SANITIZE_STRING) == 'on') ? 1 : 0;
            $libros = (filter_input(INPUT_POST, 'libros', FILTER_SANITIZE_STRING) == 'on') ? 1 : 0;
            $cambiar_clave = (filter_input(INPUT_POST, 'cambiar_clave', FILTER_SANITIZE_STRING) == 'on') ? 1 : 0;

            //Encripto la clave
            $clave_encriptada = ($clave) ? password_hash($clave,  PASSWORD_BCRYPT, ['cost'=>12]) : "";

            if ($id == "nuevo"){

                //Creo un nuevo usuario
                $this->db->exec("INSERT INTO hobbits (hobbit, clave, libros, hobbits) VALUES ('$hobbit','$clave_encriptada',$libros,$hobbits)");

                //Mensaje y redirección
                $this->view->redireccionConMensaje("admin/hobbits","green","El usuario <strong>$hobbit</strong> se creado correctamente.");
            }
            else{

                //Actualizo el usuario
                ($cambiar_clave) ?
                    $this->db->exec("UPDATE hobbits SET hobbit='$hobbit',clave='$clave_encriptada',libros=$libros,hobbits=$hobbits WHERE id='$id'") :
                    $this->db->exec("UPDATE hobbits SET hobbit='$hobbit',libros=$libros,hobbits=$hobbits WHERE id='$id'");

                //Mensaje y redirección
                $this->view->redireccionConMensaje("admin/hobbits","green","El usuario <strong>$hobbit</strong> se actualizado correctamente.");
            }
        }

        //Si no, obtengo usuario y muestro la ventana de edición
        else{

            //Obtengo el usuario
            $rowset = $this->db->query("SELECT * FROM hobbits WHERE id='$id' LIMIT 1");
            $row = $rowset->fetch(\PDO::FETCH_OBJ);
            $hobbit = new Hobbit($row);

            //Llamo a la ventana de edición
            $this->view->vista("admin","hobbits/editar", $hobbit);
        }

    }


}