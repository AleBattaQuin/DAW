<?php
namespace App\Controller;

use App\Helper\ViewHelper;
use App\Helper\DbHelper;
use App\Model\Libros;


class LibroController
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

    //Listado de libros
    public function index(){

        //Permisos
        $this->view->permisos("libros");

        //Recojo los libros de la base de datos
        $rowset = $this->db->query("SELECT * FROM libros ORDER BY fecha DESC");

        //Asigno resultados a un array de instancias del modelo
        $libros = array();

        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($libros,new Libros($row));
        }

        $this->view->vista("admin","libros/index", $libros);

    }

    //Para activar o desactivar
    public function activar($id){

        //Permisos
        $this->view->permisos("libros");

        //Obtengo el libro
        $rowset = $this->db->query("SELECT * FROM libros WHERE id='$id' LIMIT 1");
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $libro = new Libros($row);

        if ($libro->activo == 1){

            //Desactivo el libro
            $consulta = $this->db->exec("UPDATE libros SET activo=0 WHERE id='$id'");

            //Mensaje y redirección
            ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
                $this->view->redireccionConMensaje("admin/libros","green","El libro <strong>$libro->titulo</strong> se ha desactivado correctamente.") :
                $this->view->redireccionConMensaje("admin/libros","red","Hubo un error al guardar en la base de datos.");
        }

        else{

            //Activo el libro
            $consulta = $this->db->exec("UPDATE libros SET activo=1 WHERE id='$id'");

            //Mensaje y redirección
            ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
                $this->view->redireccionConMensaje("admin/libros","green","Los libros <strong>$libro->titulo</strong> se ha activado correctamente.") :
                $this->view->redireccionConMensaje("admin/libros","red","Hubo un error al guardar en la base de datos.");
        }

    }

    //Para mostrar o no en la home
    public function home($id){

        //Permisos
        $this->view->permisos("libros");

        //Obtengo el libro
        $rowset = $this->db->query("SELECT * FROM libros WHERE id='$id' LIMIT 1");
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $libro = new Libros($row);

        if ($libro->home == 1){

            //Quito el libro de la home
            $consulta = $this->db->exec("UPDATE libros SET home=0 WHERE id='$id'");

            //Mensaje y redirección
            ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
                $this->view->redireccionConMensaje("admin/libros","green","El libro <strong>$libro->titulo</strong> ya no se muestra en la home.") :
                $this->view->redireccionConMensaje("admin/libros","red","Hubo un error al guardar en la base de datos.");
        }

        else{

            //Muestro el libro en la home
            $consulta = $this->db->exec("UPDATE libros SET home=1 WHERE id='$id'");

            //Mensaje y redirección
            ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
                $this->view->redireccionConMensaje("admin/libros","green","EL libro <strong>$libro->titulo</strong> ahora se muestra en la home.") :
                $this->view->redireccionConMensaje("admin/libros","red","Hubo un error al guardar en la base de datos.");
        }

    }

    public function borrar($id){

        //Permisos
        $this->view->permisos("libros");

        //Obtengo el libro
        $rowset = $this->db->query("SELECT * FROM libros WHERE id='$id' LIMIT 1");
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $libro = new Libros($row);

        //Borro el libro
        $consulta = $this->db->exec("DELETE FROM libros WHERE id='$id'");

        //Borro la imagen asociada
        $archivo = $_SESSION['public']."img/".$libro->imagen;
        $texto_imagen = "";
        if (is_file($archivo)){
            unlink($archivo);
            $texto_imagen = " y se ha borrado la imagen asociada";
        }

        //Mensaje y redirección
        ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
            $this->view->redireccionConMensaje("admin/libros","green","El libro se ha borrado correctamente$texto_imagen.") :
            $this->view->redireccionConMensaje("admin/libros","red","Hubo un error al guardar en la base de datos.");

    }

    public function crear(){

        //Permisos
        $this->view->permisos("libros");

        //Creo un nuevo usuario vacío
        $libro = new Libro();

        //Llamo a la ventana de edición
        $this->view->vista("admin","libros/editar", $libro);

    }

    public function editar($id){

        //Permisos
        $this->view->permisos("libros");

        //Si ha pulsado el botón de guardar
        if (isset($_POST["guardar"])){

            //Recupero los datos del formulario
            $titulo = filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_STRING);
            $entradilla = filter_input(INPUT_POST, "entradilla", FILTER_SANITIZE_STRING);
            $paginaWeb = filter_input(INPUT_POST, "paginaWeb", FILTER_SANITIZE_STRING);
            $fecha = filter_input(INPUT_POST, "fecha", FILTER_SANITIZE_STRING);
            $texto = filter_input(INPUT_POST, "texto", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //Formato de fecha para SQL
            $fecha = \DateTime::createFromFormat("d-m-Y", $fecha)->format("Y-m-d H:i:s");

            //Genero slug (url amigable)
            $slug = $this->view->getSlug($titulo);

            //Imagen
            $imagen_recibida = $_FILES['imagen'];
            $imagen = ($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : "";
            $imagen_subida = ($_FILES['imagen']['name']) ? '/var/www/html'.$_SESSION['public']."img/".$_FILES['imagen']['name'] : "";
            $texto_img = ""; //Para el mensaje

            if ($id == "nuevo"){

                //Creo un nuevo libro
                $consulta = $this->db->exec("INSERT INTO libros 
                    (titulo, entradilla, paginaWeb, fecha, texto, slug, imagen) VALUES 
                    ('$titulo','$entradilla','$paginaWeb','$fecha','$texto','$slug','$imagen')");

                //Subo la imagen
                if ($imagen){
                    if (is_uploaded_file($imagen_recibida['tmp_name']) && move_uploaded_file($imagen_recibida['tmp_name'], $imagen_subida)){
                        $texto_img = " La imagen se ha subido correctamente.";
                    }
                    else{
                        $texto_img = " Hubo un problema al subir la imagen.";
                    }
                }

                //Mensaje y redirección
                ($consulta > 0) ?
                    $this->view->redireccionConMensaje("admin/libros","green","El libro <strong>$titulo</strong> se creado correctamente.".$texto_img) :
                    $this->view->redireccionConMensaje("admin/libros","red","Hubo un error al guardar en la base de datos.");
            }
            else{

                //Actualizo el libro
                $this->db->exec("UPDATE libros SET 
                    titulo='$titulo',entradilla='$entradilla',paginaWeb='$paginaWeb',
                    fecha='$fecha',texto='$texto',slug='$slug' WHERE id='$id'");

                //Subo y actualizo la imagen
                if ($imagen){
                    if (is_uploaded_file($imagen_recibida['tmp_name']) && move_uploaded_file($imagen_recibida['tmp_name'], $imagen_subida)){
                        $texto_img = " La imagen se ha subido correctamente.";
                        $this->db->exec("UPDATE libros SET imagen='$imagen' WHERE id='$id'");
                    }
                    else{
                        $texto_img = " Hubo un problema al subir la imagen.";
                    }
                }

                //Mensaje y redirección
                $this->view->redireccionConMensaje("admin/libros","green","El libro <strong>$titulo</strong> se guardado correctamente.".$texto_img);

            }
        }

        //Si no, obtengo libro y muestro la ventana de edición
        else{

            //Obtengo el libro
            $rowset = $this->db->query("SELECT * FROM libros WHERE id='$id' LIMIT 1");
            $row = $rowset->fetch(\PDO::FETCH_OBJ);
            $libro = new Libros($row);

            //Llamo a la ventana de edición
            $this->view->vista("admin","libros/editar", $libro);
        }

    }

}