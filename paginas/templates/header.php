<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?></title>
    <style>        
        .form {
            color: white;
            display: none;
        }

        .form.active {
            display: block;
        }
    </style>
    <link rel="stylesheet" href="/streaming/css/styles.css">
</head>
<body>
    <header>
        <div class="logo">Mi Streaming</div>
        <nav>
            <ul>
                <?php 
                if(isset($_SESSION['nombre']) && !isset($username) && $_SESSION['correo'] !== "admin@admin"){
                    if(isset($usuariodetalles)){
                        if(($usuariodetalles->getIdPlan() == 3 && $usuarioDAO->getNumPerfiles($_SESSION['id_usuario']) < 2) || ($usuariodetalles->getIdPlan() == 4 && $usuarioDAO->getNumPerfiles($_SESSION['id_usuario']) < 3)){
                            echo '<li><a href="/streaming/paginas/usuario/registroPerfil.php">Crear Perfil</a></li>';
                        }
                    }                    
                    echo '<li><a href="/streaming/paginas/usuario/inicio.php">Seleccionar Perfil</a></li>';                    
                    echo '<li><a href="/streaming/paginas/usuario/logout.php">Cerrar Sesion</a></li>';
                }
                if(isset($_SESSION['nombre']) && isset($username)){
                    echo '<li><a href="/streaming/paginas/usuario/verContenido.php?username='.$username.'">Ver Contenido</a></li>';
                    echo '<li><a href="/streaming/paginas/usuario/inicio.php">Seleccionar Perfil</a></li>';  
                    echo '<li><a href="/streaming/paginas/usuario/logout.php">Cerrar Sesion</a></li>';
                }
                if(isset($_SESSION['nombre']) && $_SESSION['correo'] == "admin@admin"){                    
                    echo '<li><a href="/streaming/paginas/admin/registroContenido.php">Agregar Contenido</a></li>';  
                    echo '<li><a href="/streaming/paginas/usuario/logout.php">Cerrar Sesion</a></li>';
                }
                if(!isset($_SESSION['nombre'])){
                    echo '<li><a href="/streaming/paginas/general/registroUsuario.php">Crear Usuario</a></li>';
                    echo '<li><a href="/streaming/index.php">Iniciar Sesion</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>