<?php 
session_start();
require_once '../../dao/resenaDAO.php';
require_once '../../dao/resenaDAOImp.php';
require_once '../../config/database.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comentario = $_POST['comentario'];
    $calificacion = $_POST['calificacion'];
    $id_contenido = $_POST['id_contenido'];
    $id_perfil = $_POST['id_perfil'];
    $username = $_POST['username'];
    $titulo = $_POST['titulo'];

    $database = new Database();
    $conexion = $database->connect();

    $resenaDAO = new resenaDAOImp($conexion);
    $resenaDAO->guardarResena($comentario, intval($calificacion), $id_contenido, $id_perfil);

    header('Location: interaccion.php?username='.$username.'&titulo='.$titulo.'');
    exit;
}
?>