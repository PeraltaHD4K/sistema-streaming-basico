<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/streaming/config/rutas.php');
require_once CONFIG_PATH.'database.php';
require_once DAO_PATH.'contenido.php';
require_once DAO_PATH.'contenidoDAOImp.php';
require_once DAO_PATH.'peliculaDAOImp.php';
require_once DAO_PATH.'pelicula.php';

$database = new Database();
$conexion = $database->connect();
$cont = new ContenidoDAOImp($conexion);
$stmt = $conexion->prepare("SELECT id_categoria, nombre FROM categoria");
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
    exit;
}

if ($_SESSION['correo'] != "admin@admin") {
    header('Location: ../../index.php');
    exit;
}

if (!isset($_GET['id_contenido'])) {
    header("Location: inicio_admin.php");
    exit;
}

$database = new Database();
$conexion = $database->connect();
$id_contenido;
$id_perfil;

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id_contenido = $_GET["id_contenido"];
}

$sql = "SELECT contenido.id_contenido, contenido.titulo, contenido.tipo, contenido.clasificacion, contenido.direccion_imagen, pelicula.duracion_mins 
        FROM contenido 
        INNER JOIN pelicula ON contenido.id_contenido = pelicula.id_contenido
        WHERE contenido.id_contenido = '$id_contenido'";

$info_pelicula = $conexion->query($sql);

$sql = "SELECT contenido.id_contenido, contenido.titulo, contenido.tipo, contenido.clasificacion, contenido.direccion_imagen, serie.num_temporadas, serie.num_capitulos 
        FROM contenido 
        INNER JOIN serie ON contenido.id_contenido = serie.id_contenido
        WHERE contenido.id_contenido = '$id_contenido'";

$info_serie = $conexion->query($sql);





$rowserie = $info_serie->fetch(PDO::FETCH_ASSOC);
if ($info_serie->rowCount() > 0) {
    $tituloserie = $rowserie["titulo"];
    $tipo = $rowserie['tipo'];
    $clasificacionserie = $rowserie["clasificacion"];
    $temporadasserie = $rowserie["num_temporadas"];
    $capitulosserie = $rowserie["num_capitulos"];
    $imagenserie = $rowserie["direccion_imagen"];
    $title = $tituloserie;
}
$rowpeli = $info_pelicula->fetch(PDO::FETCH_ASSOC);
if ($info_pelicula->rowCount() > 0) {
    $titulopeli = $rowpeli["titulo"];
    $tipo = $rowpeli['tipo'];
    $clasificacionpeli = $rowpeli["clasificacion"];
    $duracionpeli = $rowpeli["duracion_mins"];
    $imagenpeli = $rowpeli["direccion_imagen"];
    $title = $titulopeli;
}

include '../templates/header.php'
?>
<div class="container">
    <div class="pelicula-info">
        <?php
        if ($info_pelicula->rowCount() > 0) {

            echo '<h1>' . $titulopeli . '</h1>';
            echo '<p>Pelicula';
            echo ' Clasificacion: ' . $clasificacionpeli;
            echo ' Duracion: ' . $duracionpeli . ' mins</p>';
            echo '<p>Categorias: ' . $cont->getAllCategorias($titulopeli) . '.</p><br>';
            echo '<img src="' . PROJECT_PATH . $imagenpeli . '" alt="' . $titulopeli . '">';

        } elseif ($info_serie->rowCount() > 0) {

            echo '<h1>' . $tituloserie . '</h1>';
            echo '<p>Serie';
            echo ' Clasificacion: ' . $clasificacionserie;
            echo ' Temporadas: ' . $temporadasserie;
            echo ' Capitulos: ' . $capitulosserie . '</p>';
            echo '<p>Categorias: ' . $cont->getAllCategorias($tituloserie) . '.</p><br>';
            echo '<img src="' . PROJECT_PATH . $imagenserie . '" alt="' . $tituloserie . '">';

        }


        ?>

    </div>
    <h2>Modificar detalles del contenido:</h2>
    <div class="resenas">
        <?php
        echo '<div class="formulario-resena">';
        echo '<form action="editarContenido.php?id_contenido='.$id_contenido.'." method="post"  enctype="multipart/form-data">';
        echo '<input type="hidden" name="id_contenido" value="' . $id_contenido . '">';
        if ($info_serie->rowCount() > 0) {
            echo '<input type="hidden" name="tipo" value="'.$tipo.'">';
            echo '<label for="titulo">Titulo: </label>';
            echo '<input type="text" name="titulo" value ="' . $tituloserie . '" required><br><br>';
            echo '<label for="clasificacion">Clasificacion: </label>';
            echo '<input type="text" name="clasificacion" value ="' . $clasificacionserie . '" required><br><br>';
            ?>
            <label for="categorias">Categoria: </label>
            <select multiple name="categorias[]" required>
                <?php foreach ($categorias as $categoria): ?>
                    <option value=<?php echo $categoria['id_categoria']; ?>><?php echo $categoria['nombre']; ?></option>
                <?php endforeach;
                echo '</select><br><br>';


                echo '<label for="temporadas">Numero de Temporadas: </label>';
                echo '<input type="number"  name="num_temporadas" value="' . $temporadasserie . '" required><br><br>';
                echo '<label for="capitulos">Numero de Capitulos: </label>';
                echo '<input type="number" name="num_capitulos" value="' . $capitulosserie . '" required><br><br>';
                echo $imagenserie.'<br><br>';
        } else {
            echo '<input type="hidden" name="tipo" value="'.$tipo.'">';
            echo '<label for="titulo">Titulo: </label>';
            echo '<input type="text" name="titulo" value ="' . $titulopeli . '" required><br><br>';
            echo '<label for="clasificacion">Clasificacion: </label>';
            echo '<input type="text" name="clasificacion" value ="' . $clasificacionpeli . '" required><br><br>';
            ?>
                <label for="categorias">Categoria: </label>
                <select multiple name="categorias[]" required>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value=<?php echo $categoria['id_categoria']; ?>><?php echo $categoria['nombre']; ?></option>
                    <?php endforeach;
                    echo '</select><br><br>';
                    echo '<label for="duracion_mins">Tiempo de duracion(en minutos): </label>';
                    echo '<input type="number" name="duracion_mins" value="' . $duracionpeli . '"><br><br>';
                    echo $imagenpeli.'<br><br>';
        }
        ?>                
        <label for="imagen">Cambiar portada:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*"><br><br>
        <?php
        echo '<button type="submit" name="modificar">Modificar contenido</button>';
        echo '</form>';
        echo '</div>';
        ?>

        <script>
            function confirmarModificacion() {
                const confirmacion = confirm("�Desea modificar este contenido del sistema?");
                if (confirmacion) {
                    window.location.href = 'moderarContenido.php';
                }
            }
        </script>

    </div>
</div>
</body>

</html>