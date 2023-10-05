<?php
session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: ../index.php');
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $username; ?>!</h1>

    <a href="crear_perfil.html">Crear Perfil</a><br><br>
    <a href="contenido.html ">Ver Contenido</a><br><br>
    <a href="agregar_contenido.html">Agregar Contenido</a><br><br>
    <a href="hacer_reseña.html">Hacer una reseña</a><br><br>
    <a href="index.php">Regresar</a>
</body>
</html>