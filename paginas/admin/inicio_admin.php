<?php
session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
    exit;
}

if(!($_SESSION['correo'] == "admin@admin")){
    header('Location: ../../index.php');
    exit;
}

$nombre = $_SESSION['nombre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Admin</title>
</head>
<body>
    <h1>Bienvenido <?php echo $nombre; ?>!</h1>
    <a href="registroContenido.php">Agregar Contenido</a><br><br>
    <a href="../logout.php">Cerrar Sesion</a>
</body>
</html>