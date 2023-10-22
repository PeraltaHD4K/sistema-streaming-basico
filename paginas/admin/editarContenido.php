<?php
session_start();
include_once ($_SERVER['DOCUMENT_ROOT'].'/streaming/config/rutas.php');
require_once CONFIG_PATH.'database.php';
require_once DAO_PATH.'contenido.php';
require_once DAO_PATH.'contenidoDAOImp.php';
require_once DAO_PATH.'peliculaDAOImp.php';
require_once DAO_PATH.'pelicula.php';
require_once DAO_PATH.'serieDAO.php';
require_once DAO_PATH.'serieDAOImp.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
    exit;
}

if(!($_SESSION['correo'] == "admin@admin")){
    header('Location: ../../index.php');
    exit;
}

$database = new Database();
$conexion = $database->connect();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $tipo = $_POST['tipo'];
    $clasificacion = $_POST['clasificacion'];
    $category = $_POST['categorias'];
    $id_contenido = $_GET['id_contenido'];    
    
    if($_FILES["imagen"]["name"] === "") {
        $direccion_imagen = $_POST['imagen_ruta'];

        $contenidoDAO = new contenidoDAOImp($conexion);
        $contenidoDAO->actualizarContenido($id_contenido, $titulo, $clasificacion, $category, $direccion_imagen);

        if($tipo === "Pelicula"){
            $duracion_mins = $_POST['duracion_mins'];
            $peliculaDAO = new peliculaDAOImp($conexion);
            $peliculaDAO->actualizarPelicula($id_contenido, $duracion_mins);
            echo "Película actualizada con éxito.";
            //header('Location: inicio_admin.php');
            exit;
        }

        $num_temporadas = $_POST['num_temporadas'];
        $num_capitulos = $_POST['num_capitulos'];

        $serieDAO = new serieDAOImp($conexion);
        $serieDAO->actualizarSerie($id_contenido, $num_temporadas, $num_capitulos);
        echo "Serie actualizada con éxito.";
        header('Location: modificacionContenido.php?id_contenido='.$id_contenido);
        exit;
             
    }

    $targetDirectory = ROOT_PATH . IMAGES_CONT_PATH;
    $targetFile = $targetDirectory . basename($_FILES["imagen"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $direccion_imagen = IMAGES_CONT_PATH . basename($_FILES["imagen"]["name"]);

    if(isset($_POST["imagen"])) {
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if($check == false) {
            echo "El archivo no es una imagen válida.";
            exit;
        }
    }

    if (file_exists($targetFile)) {
        echo "El archivo ya existe.";
        exit;
    }

    if ($_FILES["imagen"]["size"] > 2000000) {
        echo "El archivo excede el tamaño permitido.";
        exit;
    }

    if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
        echo "El archivo no es una imagen válida.";
        exit;
    }

    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFile)) {
        $contenidoDAO = new contenidoDAOImp($conexion);
        $contenidoDAO->actualizarContenido($id_contenido, $titulo, $clasificacion, $category, $direccion_imagen);

        if($tipo == "Pelicula") {
            $duracion_mins = $_POST['duracion_mins']; 
            $peliculaDAO = new peliculaDAOImp($conexion);
            $peliculaDAO->actualizarPelicula($id_contenido, $duracion_mins);
            echo "Película actualizada con éxito.";
            //header('Location: inicio_admin.php');
            exit;
        }

        $num_temporadas = $_POST['num_temporadas'];
        $num_capitulos = $_POST['num_capitulos'];

        $serieDAO = new serieDAOImp($conexion);
        $serieDAO->actualizarSerie($id_contenido, $num_temporadas, $num_capitulos);
        echo "Serie actualizada con éxito.";
        header('Location: modificacionContenido.php?id_contenido='.$id_contenido);
        exit;
                        
    } else {
        echo "Hubo un error al subir el archivo.";
        exit;
    }
}
?>
