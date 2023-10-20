<?php
session_start();
require_once '../../config/database.php';
require_once '../../dao/perfilDAO.php';
require_once '../../dao/perfilDAOImp.php';
require_once '../../dao/usuarioDAOImp.php';
require_once '../../dao/usuarioDAO.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
    exit;
}


$database = new Database();
$conexion = $database->connect();

$usuarioDAO = new usuarioDAOImp($conexion);

$usuariodetalles = $usuarioDAO->getUsuario($_SESSION['id_usuario']);

// Obtener todos los perfiles del usuario de la base de datos
$perfilDAO = new perfilDAOImp($conexion);

$perfiles = $perfilDAO->TodosPerfiles($_SESSION['id_usuario']);

$nombre = $_SESSION['nombre'];

$title = "Seleccionar Perfil";
include '../templates/header.php';

 if($_SESSION['id_usuario'] != 1){ 
     ?>
    <h1>Cuenta de <?php echo $nombre; ?>!</h1>
    <main id="content">
        <div class="profile-container">
            
            <h2>Selecciona tu perfil</h2>
            <form action="verContenido.php" method="post" name="profile-form" id="profile-form">
                <label for="profiles">Perfiles:</label>
                <select id="profiles" name="profiles">
                </select><br><br>
                <button type="submit">Seleccionar Perfil</button>
                    <?php
                   
                        foreach ($perfiles as $perfil) {
                        echo '<option value="' . $perfil->getUsername() . '">' . $perfil->getUsername() . '</option>';
                        }
                    }else{
                        echo'<h1>Ingresado como cuenta administrativa</h1>';
                        echo'<h2>Seleccione una de las opciones de arriba para moderar el sistema.</h2>';
                    }
                    
                    ?>
                
            </form>
        </div>
    </main>
</body>
</html>