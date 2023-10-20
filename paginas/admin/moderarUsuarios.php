<html>
    <head>
        <title>Moderar usuarios</title>
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

$database = new Database();
$conexion = $database->connect();
$usu = new UsuarioDAOImp($conexion);
$usuarios = $usu->getAllUsuarios();


if (!empty($usuarios)) {
    $cont = 2;
        echo '<table border="1">';
        echo '<tr><th>Nombre</th><th>Apellido</th><th>Apellido materno</th><th>Correo electronico</th><th>Contraseña</th><th>Id del plan de suscripcion</th><th>Administrar</th></tr>';
        foreach ($usuarios as $usuario) {
            echo '<tr>';
            echo '<td>' . $usuario->getNombre() . '</td>';
            echo '<td>' . $usuario->getApellido_paterno() . '</td>';
            echo '<td>' . $usuario->getApellido_materno() . '</td>';
            echo '<td>' . $usuario->getCorreo() . '</td>';
            echo '<td>' . $usuario->getContrasena() . '</td>';
            echo '<td>' . $usuario->getIdPlan() . '</td>';
            if(!(($usuario->getNombre()== 'admin') && ($usuario->getCorreo()=='admin@admin'))){
            echo '<td><a href="modificarUsuario.php?id='.$cont.'">Editar</a></td>';
            $cont++;
            }else{
                echo '<td>No aplicable</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>Hubo un error al cargar los datos de los usuarios.</p>';
    }

?>
</html>