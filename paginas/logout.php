<?php
// Iniciar la sesión
session_start();

// Destruir todas las variables de sesión
session_destroy();

// Redirigir a la página de inicio de sesión
header("location: ../index.php");
exit;
?>