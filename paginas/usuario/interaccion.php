<?php
session_start();
include_once ($_SERVER['DOCUMENT_ROOT'].'/streaming/config/rutas.php');
require_once '../../config/database.php';
require_once '../../dao/contenido.php';
require_once '../../dao/contenidoDAOImp.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
    exit;
}

if(!isset($_GET['username'])){
    header('Location: inicio.php');
    exit;
}

if (!isset($_GET['titulo'])){
    header("Location: verContenido.php?username='$username'");
    exit;
}

$database = new Database();
$conexion = $database->connect();
$cont = new ContenidoDAOImp($conexion);
$id_contenido;
$id_perfil;

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $username = $_GET["username"];
    $titulo = $_GET["titulo"];    

    $sql = "SELECT id_contenido FROM contenido WHERE titulo = '$titulo'";
    $id_contenido = intval($conexion->query($sql)->fetchColumn());

    $sql = "SELECT id_perfil FROM perfil WHERE username = '$username'";
    $id_perfil = intval($conexion->query($sql)->fetchColumn());

    $sql = "INSERT INTO interaccion (id_perfil, id_contenido) VALUES ('$id_perfil', '$id_contenido')";

    if ($conexion->query($sql) == true) {

    } else {
        echo "Error al crear el registro: " . print_r($conexion->errorInfo());
    }    
}

$sql = "SELECT contenido.id_contenido, contenido.titulo, contenido.tipo, contenido.clasificacion, contenido.direccion_imagen, pelicula.duracion_mins 
        FROM contenido 
        INNER JOIN pelicula ON contenido.id_contenido = pelicula.id_contenido
        WHERE contenido.titulo = '$titulo'";

$info_pelicula = $conexion->query($sql);

$sql = "SELECT contenido.id_contenido, contenido.titulo, contenido.tipo, contenido.clasificacion, contenido.direccion_imagen, serie.num_temporadas, serie.num_capitulos 
        FROM contenido 
        INNER JOIN serie ON contenido.id_contenido = serie.id_contenido
        WHERE contenido.titulo = '$titulo'";

$info_serie = $conexion->query($sql);

$sql = "SELECT perfil.username, resena.comentario
        FROM interaccion
        INNER JOIN perfil ON interaccion.id_perfil = perfil.id_perfil
        LEFT JOIN resena ON interaccion.id_resena = resena.id_resena
        WHERE interaccion.id_contenido = '$id_contenido' AND interaccion.id_resena IS NOT NULL";

$resenas = $conexion->query($sql);

$resenado = false;

$title = $titulo;
include '../templates/header.php'
?>
    <div class="container">
        <div class="pelicula-info">
            <?php            
            if ($info_pelicula->rowCount() > 0){
                while($row = $info_pelicula->fetch(PDO::FETCH_ASSOC)){    
                    echo '<h1>'.$row["titulo"].'</h1>';
                    echo '<p>'.$row["tipo"];
                    echo ' Clasificacion: '.$row["clasificacion"];
                    echo ' Duracion: '.$row["duracion_mins"].' mins</p>';
                    echo '<p>Categorias: '.$cont->getAllCategorias($row["titulo"]).'.</p><br>';
                    echo '<img src="'.PROJECT_PATH.$row["direccion_imagen"].'" alt="'.$row["titulo"].'">';
                }
            }elseif ($info_serie->rowCount() > 0) {
                while($row = $info_serie->fetch(PDO::FETCH_ASSOC)){
                    echo '<h1>'.$row["titulo"].'</h1>';
                    echo '<p>'.$row["tipo"];
                    echo ' Clasificacion: '.$row["clasificacion"];
                    echo ' Temporadas: '.$row["num_temporadas"];
                    echo ' Capitulos: '.$row["num_capitulos"].'</p>';
                    echo '<p>Categorias: '.$cont->getAllCategorias($row["titulo"]).'.</p><br>';
                    echo '<img src="'.PROJECT_PATH.$row["direccion_imagen"].'" alt="'.$row["titulo"].'">';
                }
            }
            ?>
        </div>
        <div class="resenas">
            <h2>Reseñas</h2>
            <?php 
            if ($resenas->rowCount() > 0){
                while($row = $resenas->fetch(PDO::FETCH_ASSOC)){
                    if($row["comentario"] !== null){
                        echo '<div class="resena">';
                        echo '<p>Reseña de '.$row["username"].': ';
                        echo $row["comentario"].'</p>';
                        echo '</div>';
                        if($row['username'] == $_GET['username']){
                            echo '<button class="editar">Editar</button>';
                            $resenado = true;
                        }
                    }                   
                }
            }else{
                echo "No se encontraron reseñas.";
            }

            if(!$resenado){
                echo '<div class="formulario-modificar">';
                    echo '<h3>Escribe tu reseña</h3>';
                    echo '<form action="registroResena.php" method="post" id="reseña-form" name="crea_resena">';
                        echo '<input type="hidden" name="id_contenido" value="'.$id_contenido.'">';
                        echo '<input type="hidden" name="id_perfil" value="'.$id_perfil.'">';
                        echo '<input type="hidden" name="username" value="'.$username.'">';
                        echo '<input type="hidden" name="titulo" value="'.$titulo.'">';
                        echo '<textarea required name="comentario" id="resena-text" rows="4" cols="50" placeholder="Escribe tu reseña aquí"></textarea><br>';
                        echo '<label for="calificacion">Punte el contenido con el numero de estrellas: </label><br>';
                        echo '<input type="radio" id="1" name="calificacion" value=1>';
                        echo '<label for="1">☆</label><br>';
                        echo '<input type="radio" id="2" name="calificacion" value=2>';
                        echo '<label for="2">☆☆</label><br>';
                        echo '<input type="radio" id="3" name="calificacion" value=3>';
                        echo '<label for="3">☆☆☆</label><br>';
                        echo '<input type="radio" id="4" name="calificacion" value=4 checked="checked">';
                        echo '<label for="4">☆☆☆☆</label><br>';
                        echo '<input type="radio" id="5" name="calificacion" value=5>';
                        echo '<label for="5">☆☆☆☆☆</label><br>';
                        echo '<button type="submit">Enviar Reseña</button>';
                    echo '</form>';
                echo '</div>';
            }
            ?>           
        </div>        
    </div>
</body>
</html>
