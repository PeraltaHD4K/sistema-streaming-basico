<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../index.php');
    exit;
}


$database = new Database();
$conn = $database->connect();

// Obtener todos los perfiles del usuario de la base de datos
$stmt = $conn->prepare("SELECT username FROM perfil WHERE id_usuario = ?");
$stmt->bindParam(1, $_SESSION['id_usuario']);
$stmt->execute();
$perfiles = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <h1>Bienvenido, <?php echo $nombre; ?>!</h1>
    <ul>
        <?php foreach ($perfiles as $perfil): ?>
            <li>Nombre de Perfil: <?php echo $perfil['username']; ?></li><br>
        <?php endforeach; ?>
    </ul>
    <a href="crear_perfil.html">Crear Perfil</a><br><br>
    <a href="contenido.html ">Ver Contenido</a><br><br>
    <a href="agregar_contenido.html">Agregar Contenido</a><br><br>
    <a href="hacer_reseña.html">Hacer una reseña</a><br><br>
    <a href="logout.php">Cerrar Sesion</a>
</body>
</html>