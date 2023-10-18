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

$title = "Administrador";
include '../templates/header.php';
?>
    <h1>Bienvenido <?php echo $nombre; ?>!</h1>
</body>
</html>