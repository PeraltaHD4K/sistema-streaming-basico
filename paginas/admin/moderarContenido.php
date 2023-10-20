<?php 
session_start();
include_once ($_SERVER['DOCUMENT_ROOT'].'/streaming/config/rutas.php');
require_once '../../config/database.php';
require_once '../../dao/perfilDAO.php';
require_once '../../dao/perfilDAOImp.php';
require_once '../../dao/contenidoDAOImp.php';
require_once '../../dao/contenidoDAO.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
    exit;
}

if ($_SESSION['correo'] != "admin@admin") {
    header('Location: ../../index.php');
    exit;
}

$database = new Database();
$conexion = $database->connect();

$con = new ContenidoDAOImp($conexion);
$contenidos = $con->getAllContenidos();

$title = "Moderar contenido";

include '../templates/header.php';
?>    
    
    <h1>Administracion de contenido</h1>
    <h2>Seleccione el contenido a modificar: </h2>
    <div class="container">
        <div class="content-container">
            <?php 
            foreach($contenidos as $contenido){
                echo '<a href="modificacionContenido.php?titulo='.$contenido->getTitulo().'" class="card" style="text-decoration:none">';
                    echo '<img src="'. PROJECT_PATH . $contenido->getDireccionImagen() .'" alt="'.$contenido->getTitulo().'">';
                    echo '<h2>' . $contenido->getTitulo() . '</h2>';
                    echo '<p>Clasificacion: ' . $contenido->getClasificacion() . '</p>';
                echo '</a>';
            }
            ?>
        </div>
        
    </div>
    
    <a href="logout.php">Cerrar Sesion</a>
</body>
</html>