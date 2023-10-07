<?php
session_start();
require_once '../config/database.php';
require_once '../dao/perfilDAO.php';
require_once '../dao/perfilDAOImp.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../index.php');
    exit;
}


$database = new Database();
$conexion = $database->connect();

// Obtener todos los perfiles del usuario de la base de datos
$perfilDAO = new perfilDAOImp($conexion);

$perfiles = $perfilDAO->TodosPerfiles($_SESSION['id_usuario']);

$nombre = $_SESSION['nombre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
    <h1>Cuenta de <?php echo $nombre; ?>!</h1>
    <ul>
        <?php foreach ($perfiles as $perfil): ?>
            <li>Nombre de Perfil: <a href="inicio.php"><?php echo $perfil->getUsername(); ?></a></li><br>
        <?php endforeach; ?>
    </ul>
    <a href="registroPerfil.php">Crear Perfil</a><br><br>
    <a href="logout.php">Cerrar Sesion</a>
</body>
</html>