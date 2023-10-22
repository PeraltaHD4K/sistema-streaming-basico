<?php
session_start();
include_once ($_SERVER['DOCUMENT_ROOT'].'/streaming/config/rutas.php');
require_once CONFIG_PATH.'database.php';
require_once DAO_PATH.'contenidoDAO.php';
require_once DAO_PATH.'contenidoDAOImp.php';
require_once DAO_PATH.'serieDAO.php';
require_once DAO_PATH.'serieDAOImp.php';
require_once DAO_PATH.'peliculaDAO.php';
require_once DAO_PATH.'peliculaDAOImp.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
    exit;
}

if(!($_SESSION['correo'] == "admin@admin")){
    header('Location: ../../index.php');
    exit;
}

if(!isset($_POST['seleccionados'])){
    $mensajeError = "Debes seleccionar almenos un elemento";
    if($_POST['formulario'] == "pelicula"){
        header("Location: editar_peliculas.php?error=".$mensajeError."");
        exit;
    }
    header("Location: editar_series.php?error=".$mensajeError."");
    exit;
}

$database = new Database();
$conexion = $database->connect();

if (isset($_POST['editar'])) {
    // Verificar si solo se seleccionó un registro para editar
    if (count($_POST['seleccionados']) == 1) {
        $id = $_POST['seleccionados'][0];
        // Redirigir a la página de edición con el ID del registro seleccionado
        header("Location: modificacionContenido.php?id_contenido=$id");
        exit();
    } else {
        // Mostrar un mensaje de error si se seleccionan más de un registro
        $mensajeError = "Solo puedes editar un registro a la vez.";
    }
}

if (isset($_POST['eliminar'])) {
    // Verificar si al menos se seleccionó un registro para eliminar
    if (count($_POST['seleccionados']) > 0) {
        $contenidoDAO = new contenidoDAOImp($conexion);

        $peliculaDAO = new peliculaDAOImp($conexion);
        $serieDAO = new serieDAOImp($conexion);
        foreach ($_POST['seleccionados'] as $id) {
            // Eliminar el registro con el ID $id de la base de datos
            if($_POST['formulario'] == "pelicula"){
                $peliculaDAO->eliminarPelicula($id);
                $contenidoDAO->eliminarContenido($id);
            }else{
                $serieDAO->eliminarSerie($id);
                $contenidoDAO->eliminarContenido($id);
            }
            
        }
        // Recargar la página después de eliminar
        if($_POST['formulario'] == "pelicula"){
            header("Location: editar_peliculas.php");
            exit;
        }
        header("Location: editar_series.php");
        exit;
    } else {
        // Mostrar un mensaje de error si no se selecciona ningún registro para eliminar
        $mensajeError = "Debes seleccionar al menos un registro para eliminar.";
    }
}

if (isset($mensajeError)) {
    if($_POST['formulario'] == "pelicula"){
        header("Location: editar_peliculas.php?error=".$mensajeError."");
        exit;
    }
    header("Location: editar_series.php?error=".$mensajeError."");
    exit;
}


?>