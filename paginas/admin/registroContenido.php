<?php
session_start();
include_once ($_SERVER['DOCUMENT_ROOT'].'/streaming/config/rutas.php');
require_once '../../config/database.php';
require_once '../../dao/contenidoDAO.php';
require_once '../../dao/contenidoDAOImp.php';
require_once '../../dao/serieDAO.php';
require_once '../../dao/serieDAOImp.php';
require_once '../../dao/peliculaDAO.php';
require_once '../../dao/peliculaDAOImp.php';

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

$stmt = $conexion->prepare("SELECT id_categoria, nombre FROM categoria");
$stmt->execute();

$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $titulo = $_POST['titulo'];
    $clasificacion = $_POST['clasificacion'];
    $category = $_POST['categorias'];
    

    // Manejar el archivo de imagen
    $targetDirectory = ROOT_PATH . IMAGES_CONT_PATH; // Directorio donde se almacenarán las imágenes subidas
    $targetFile = $targetDirectory . basename($_FILES["imagen"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $direccion_imagen = IMAGES_CONT_PATH . basename($_FILES["imagen"]["name"]);

     // Verificar si el archivo de imagen es realmente una imagen
    if(isset($_POST["imagen"])) {
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if($check == false) {
            echo "El archivo no es una imagen válida.";
            exit;
        }
    }

    // Verificar si el archivo ya existe
    if (file_exists($targetFile)) {
        echo "El archivo ya existe.";
        exit;
    }

    // Limitar el tamaño del archivo (en este ejemplo, 2 MB)
    if ($_FILES["imagen"]["size"] > 2000000) {
        echo "El archivo excede el tamaño permitido.";
        exit;
    }

    if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
        echo "El archivo no es una imagen válida.";
        exit;
    }

    if($_POST['formulario'] === "serie"){
        $num_temporadas = $_POST['num_temporadas'];
        $num_capitulos = $_POST['num_capitulos'];

        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFile)) {
            // El archivo se ha subido correctamente
            $contenidoDAO = new contenidoDAOImp($conexion);
            $lastContenidoId = $contenidoDAO->guardarContenido($titulo, "Serie", $clasificacion, $category, $direccion_imagen);

            $serieDAO = new serieDAOImp($conexion);
            $serieDAO->guardarSerie($lastContenidoId, $num_temporadas, $num_capitulos);

            echo "Película registrada con éxito.";
            header('Location: inicio_admin.php');
            exit;                
        } else {
            echo "Hubo un error al subir el archivo.";
        }      
    }

    if($_POST['formulario'] === "pelicula"){
        $duracion_mins = $_POST['duracion_mins']; 

        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFile)) {
            // El archivo se ha subido correctamente
            $contenidoDAO = new contenidoDAOImp($conexion);
            $lastContenidoId = $contenidoDAO->guardarContenido($titulo, "Pelicula", $clasificacion, $category, $direccion_imagen);

            $peliculaDAO = new peliculaDAOImp($conexion);
            $peliculaDAO->guardarPelicula($lastContenidoId, $duracion_mins);

            echo "Película registrada con éxito.";
            header('Location: inicio_admin.php');
            exit;                
        } else {
            echo "Hubo un error al subir el archivo.";
        }
    }

    header('Location: inicio_admin.php');
    exit;
}

include 'agregar_contenido.php';
?>