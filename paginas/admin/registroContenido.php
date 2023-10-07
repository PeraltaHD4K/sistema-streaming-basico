<?php
session_start();
require_once '../../config/database.php';
require_once '../../dao/contenidoDAO.php';
require_once '../../dao/contenidoDAOImp.php';

$database = new Database();
$conexion = $database->connect();

$stmt = $conexion->prepare("SELECT id_categoria, nombre FROM categoria");
$stmt->execute();

$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $titulo = $_POST['titulo'];
    $clasificacion = $_POST['clasificacion'];
    $category = $_POST['$categorias'];

    if($_POST['formulario'] === "serie"){
        $num_temporadas = $_POST['num_temporadas'];
        $num_capitulos = $_POST['num_capitulos'];
        
        $contenidoDAO = new contenidoDAOImp($conexion);
        $contenidoDAO->guardarContenido($titulo, "Serie", $clasificacion, $category);
        header('Location: inicio_admin.php');
        exit;
    }

    header('Location: inicio_admin.php');
    exit;
}

include 'agregar_contenido.php';
?>