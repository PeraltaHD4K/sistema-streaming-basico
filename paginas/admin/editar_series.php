<?php 
session_start();
include_once ($_SERVER['DOCUMENT_ROOT'].'/streaming/config/rutas.php');
require_once OTROS_PATH.'paginar.php';
require_once CONFIG_PATH.'database.php';
require_once DAO_PATH.'perfilDAO.php';
require_once DAO_PATH.'perfilDAOImp.php';
require_once DAO_PATH.'contenidoDAOImp.php';
require_once DAO_PATH.'contenidoDAO.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
    exit;
}

if ($_SESSION['correo'] != "admin@admin") {
    header('Location: ../../index.php');
    exit;
}

$database = new Database();
$conexion = $database->connect();

$con = new ContenidoDAOImp($conexion);
$contenidos = $con->getAllContenidos();

// Configura la codificación de caracteres a UTF-8
$conexion->query("SET NAMES 'utf8'");

// Obtiene el número de página actual o establece el valor predeterminado en 1
$pagina = (isset($_GET['page'])) ? $_GET['page'] : 1; 

// Obtiene el número de enlaces o establece el valor predeterminado en 5
$enlaces = (isset($_GET['enlaces'])) ? $_GET['enlaces'] : 5;

// Consulta SQL para obtener datos de la tabla 'libros'
$consulta = "SELECT serie.id_serie, contenido.id_contenido, contenido.titulo, contenido.tipo, contenido.clasificacion, contenido.direccion_imagen, 
GROUP_CONCAT(categoria.nombre) AS nombres_categorias, serie.num_temporadas, serie.num_capitulos 
FROM contenido 
INNER JOIN serie ON contenido.id_contenido = serie.id_contenido 
LEFT JOIN categorias_contenido ON contenido.id_contenido = categorias_contenido.id_contenido 
LEFT JOIN categoria ON categorias_contenido.id_categoria = categoria.id_categoria 
GROUP BY contenido.titulo, contenido.tipo, contenido.clasificacion, contenido.direccion_imagen, serie.num_temporadas, serie.num_capitulos";

// Crea una instancia de la clase Paginar
$paginar = new Paginar($conexion, $consulta);

// Obtiene los datos paginados según la página actual
$resultados = $paginar->getDatos($pagina);

$title = "Editar Series";

include '../templates/header.php';
?>    
    
    <h1>Administracion de series</h1>
    <h2>Seleccione una serie para modificar, varias para eliminar: </h2>
    <div class="container">
            <div class="col-md-12 ">
                <h1 style="text-align:center">Series registradas: </h1>
                <?php
                if (isset($_GET['error'])) {
                    echo '<p style="color: red; text-align: center;">'.$_GET['error'].'</p>';
                }
                ?>

                <!-- Muestra los enlaces de paginación -->
                <ul class="pager">
                    <?php echo $paginar->crearLinks($enlaces); ?>
                </ul>

                <!-- Muestra la tabla de resultados -->
                <form action="editar-eliminar.php" method="POST" onsubmit="return confirmarEliminacion()">
                    <input type="hidden" name="formulario" value="serie">
                    <table class="table table-hover table-condensed table-bordered ">
                        <thead>
                            <tr style="background:#337ab7; color:white;">
                                <th width="30%">Seleccion</th>
                                <th width="30%">Titulo</th>
                                <th width="30%">Clasificacion</th>
                                <th width="30%">Imagen</th>
                                <th width="30%">Categorias</th>
                                <th width="30%">Temporadas</th>
                                <th width="30%">Capitulos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($resultados->datos); $i++): ?>
                                <tr>
                                    <td><input type="checkbox" name="seleccionados[]" value="<?php echo intval($resultados->datos[$i]['id_contenido']); ?>"></td>
                                    <td><?php echo $resultados->datos[$i]['titulo']; ?></td>
                                    <td><?php echo $resultados->datos[$i]['clasificacion']; ?></td>
                                    <td><?php echo $resultados->datos[$i]['direccion_imagen']; ?></td>
                                    <td><?php echo $resultados->datos[$i]['nombres_categorias']; ?></td>
                                    <td><?php echo $resultados->datos[$i]['num_temporadas']; ?></td>
                                    <td><?php echo $resultados->datos[$i]['num_capitulos']; ?></td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                    <button type="submit" name="editar" value="editar">Editar</button>
                    <button type="submit" name="eliminar" value="eliminar">Eliminar</button>
                </form>
                <!-- Muestra los enlaces de paginación al final de la página -->
                <ul class="pagination">
                    <?php echo $paginar->crearLinks($enlaces); ?>
                </ul>
            </div>
        </div>
        <script>
            function confirmarEliminacion() {
                // Verifica si el botón de eliminar está presente en el formulario
                var botonEliminar = document.querySelector('button[name="eliminar"]');
                
                // Si el botón de eliminar está presente y ha sido clickeado, muestra la ventana de confirmación
                if (botonEliminar && botonEliminar.clicked) {
                    return confirm("�Desea borrar este contenido del sistema?");
                }
                // Si el botón de eliminar no ha sido clickeado, permite enviar el formulario sin confirmación
                return true;
            }

            // Agrega un evento clic al botón de eliminar para marcarlo como clickeado
            var botonEliminar = document.querySelector('button[name="eliminar"]');
            if (botonEliminar) {
                botonEliminar.addEventListener('click', function() {
                    this.clicked = true;
                });
            }
        </script>
</body>
</html>