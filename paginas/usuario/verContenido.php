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

$database = new Database();
$conexion = $database->connect();

$con = new ContenidoDAOImp($conexion);
$contenidos = $con->getAllContenidos();

if(isset($_POST['profiles'])){
    $username = $_POST["profiles"];
}

if(isset($_GET['username'])){
    $username = $_GET["username"];
}


$title = "Ver Contenido";

include '../templates/header.php';
?>    
    
    <h1>�Hola <?php echo $username;?>!</h1>
    <h2>Contenido disponbile en nuestra plataforma de Streaming: </h2>
    <div class="container">
        <div class="content-container">
            <?php 
            foreach($contenidos as $contenido){
                echo '<a href="interaccion.php?username='.$username.'&titulo='.$contenido->getTitulo().'" class="card" style="text-decoration:none">';
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