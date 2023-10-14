<?php 
session_start();
require_once '../../config/database.php';
require_once '../../dao/perfilDAO.php';
require_once '../../dao/perfilDAOImp.php';
require_once '../../dao/contenidoDAOImp.php';
require_once '../../dao/contenidoDAO.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../index.php');
    exit;
}

$database = new Database();
$conexion = $database->connect();

$con = new ContenidoDAOImp($conexion);
$contenidos = $con->getAllContenidos();

$username = $_POST["profiles"];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver contenido</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    
    <main>
        <h1>�Hola <?php echo $username;?>!</h1>
        <h2>Contenido disponbile en nuestra plataforma de Streaming: </h2>
        <section class="content">
            <?php 
            foreach($contenidos as $contenido){
                echo '<div class="card">';
                    echo '<img src="pelicula1.jpg" alt="Película 1"><h2>' . $contenido->getTitulo() . '</h2>';
                    echo '<p>Clasificacion: ' . $contenido->getClasificacion() . '</p>';
                echo '</div>';
            }
            ?>
        </section>
    </main>
    <a href="logout.php">Cerrar Sesion</a>
</body>
</html>