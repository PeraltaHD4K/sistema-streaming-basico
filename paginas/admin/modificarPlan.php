<html>
<head>
    <title>Modificar detalles de un plan</title>
</head>

<?php
session_start();
include_once ($_SERVER['DOCUMENT_ROOT'].'/streaming/config/rutas.php');
require_once '../../config/database.php';
require_once '../../dao/planDAO.php';
require_once '../../dao/planDAOImp.php';
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
$editPlan = new PlanDAOimp($conexion);
$plan = $editPlan->getPlan($id);

?>

<div style="text-align: center;">
       <br><br><br><br><br><br>
           <div class="profile-container2">
               
               <?php
               echo'<h3>Actualizar detalles del plan: '.$plan->getNombre().'</h3><br>';
               echo'<form action="updatePlan.php" method="post" enctype="multipart/form-data">';
                   echo'<label for="nombre">Nombre:</label>';
                   echo'<input type="text" name="nombre" value ="'.$plan->getNombre().'"required><br><br>';
                   echo'<label for="descripcion">Descripcion:</label>';
                   echo'<textarea name="ap_paterno" rows="50" cols="50" required>'
                   .$plan->getDescripcion().' </textarea><br><br>';
                   echo'<label for="precio">Precio:$</label>';
                   echo'<input type="text" name="precio" value ="'.$plan->getPrecio().'" required><br><br>';
                   echo'<button type="submit">Modificar plan</button><br>';
                   echo'<button type="button" class="eliminar-button" onclick="confirmarEliminacion()">ELIMINAR PLAN</button>';
                ?>
               </form>          
       </div>
</div>
<script>
        function confirmarEliminacion(){
            const confirmacion = confirm("¿Borrar este plan del sistema?");
            if (confirmacion) {          
            window.location.href = 'moderarPlanes.php'; 
        }
    }
    </script>
</body>
</html>