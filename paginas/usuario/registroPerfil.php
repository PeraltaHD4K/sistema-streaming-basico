<?php
session_start();
require_once '../../dao/perfilDAO.php';
require_once '../../dao/perfilDAOImp.php';
require_once '../../dao/perfilDAOImp.php';
require_once '../../config/database.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $edad = $_POST['edad'];

    $database = new Database();
    $conexion = $database->connect();

    $perfilDAO = new perfilDAOImp($conexion);
    $perfilDAO->guardarPerfil($_SESSION['id_usuario'], $username, $edad);

    header('Location: inicio.php');
    exit;
}

include 'crear_perfil.php';
?>