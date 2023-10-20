<html>
<head>
    <title>Modificar detalles de usuario</title>
</head>

<?php
session_start();
include_once ($_SERVER['DOCUMENT_ROOT'].'/streaming/config/rutas.php');
require_once '../../config/database.php';
require_once '../../dao/usuarioDAO.php';
require_once '../../dao/usuarioDAOImp.php';
include '../templates/header.php';
if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
    exit;
}

if(!($_SESSION['correo'] == "admin@admin")){
    header('Location: ../../index.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id = $_GET["id"];  
}
$database = new Database();
$conexion = $database->connect();
$editUser = new UsuarioDAOimp($conexion);
$usuario = $editUser->getUsuario($id);

?>

<div style="text-align: center;">
       <br><br><br><br><br><br>
           <div class="profile-container2">
               
               <?php
               echo'<h3>Actualizar detalles del usuario: '.$usuario->getNombre().' '.$usuario->getApellido_paterno().' '.$usuario->getApellido_materno().'</h3><br>';
               echo'<form action="updateUser.php" method="post" enctype="multipart/form-data">';
                   echo'<label for="nombre">Nombre:</label>';
                   echo'<input type="text" name="nombre" value ="'.$usuario->getNombre().'"required><br><br>';
                   echo'<label for="ap_paterno">Apellido paterno:</label>';
                   echo'<input type="text" name="ap_paterno" value ="'.$usuario->getApellido_paterno().'" required><br><br>';
                   echo'<label for="ap_materno">Apellido materno:</label>';
                   echo'<input type="text" name="ap_materno" value ="'.$usuario->getApellido_materno().'" required><br><br>';
                   echo'<label for="correo">Correo electronico:</label>';
                   echo'<input type="text" name="correo" value ="'.$usuario->getCorreo().'" required><br><br>';
                   echo'<label for="contrasena">Contraseña:</label>';
                   echo'<input type="text" name="contrasena" value ="'.$usuario->getContrasena().'" required><br><br>';
                   echo'<label for="plan">Id del plan:</label>';
                   echo'<input type="text" name="plan" value ="'.$usuario->getIdPlan().'" required><br><br>';
                   echo '<button type="submit">Modificar usuario</button><br>';
                   echo'<button type="button" class="eliminar-button" onclick="confirmarEliminacion()">ELIMINAR USUARIO</button>';
                ?>
               </form>          
       </div>
</div>
<script>
        function confirmarEliminacion(){
            const confirmacion = confirm("¿Borrar este usuario y sus perfiles del sistema?");
            if (confirmacion) {          
            window.location.href = 'moderarUsuarios.php'; 
        }
    }
    </script>
</body>
</html>