<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario de inicio de sesión
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Crear una instancia de la clase Database y obtener una conexión
    $database = new Database();
    $conn = $database->connect();
    
    // Verificar las credenciales del usuario en la base de datos
    $stmt = $conn->prepare("SELECT id_usuario, nombre, contrasena FROM usuario WHERE correo = ?");
    $stmt->bindParam(1, $correo);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario){
        header('Location: ../index.php?error=true');
        exit;
    }

    if ($usuario['id_usuario'] > 20){
        if(password_verify($contrasena, $usuario['contrasena'])){
            // Las credenciales son correctas, iniciar sesión y redirigir a la página de bienvenida
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nombre'] = $usuario['nombre'];
            header('Location: inicio.php');
            exit;
        }else{
            // Las credenciales son incorrectas, mostrar un mensaje de error
            header('Location: ../index.php?error=true');
            exit;
        }
    }

    if ($usuario && $contrasena === $usuario['contrasena']){
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nombre'] = $usuario['nombre'];
        header('Location: inicio.php');
        exit;
    } else{
        header('Location: ../index.php?error=true');
        exit;
    }
}

?>