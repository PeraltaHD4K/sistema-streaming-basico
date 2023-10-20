<html>
    <head>
        <title>Moderar planes</title>
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

$database = new Database();
$conexion = $database->connect();
$pl = new PlanDAOImp($conexion);
$planes = $pl->getAllPlanes();

echo'<div class="table2-container">';
if (!empty($planes)) {
    $cont = 1;
        echo '<table border="1">';
        echo '<tr><th>Nombre</th><th>Descripcion</th><th>Precio</th><th>Administrar</th></tr>';
        foreach ($planes as $plan) {
            echo '<tr>';
            echo '<td>' . $plan->getNombre() . '</td>';
            echo '<td>' . $plan->getDescripcion() . '</td>';
            echo '<td>$' . $plan->getPrecio() . '</td>';           
            echo '<td><a href="modificarPlan.php?id='.$cont.'">Editar</a></td>';
            $cont++;            
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>Hubo un error al cargar los datos de los planes.</p>';
    }
 echo'</div>';
?>
</html>