<?php
require_once '../dao/usuarioDAO.php';
require_once '../dao/usuarioDAOImp.php';
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $contrasena = $_POST['contrasena'];
    $correo = $_POST['correo'];
    $id_plan = $_POST['id_plan'];

    $database = new Database();
    $conexion = $database->connect();
    $userDao = new usuarioDAOImp($conexion);
    $userDao->guardarUsuario($nombre, $apellido_paterno, $apellido_materno, $contrasena, $correo, intval($id_plan));

    header('Location: inicio.php');
    exit;
}

include 'crear_usuario.php';
?>
