<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Contenido</title>
    <style>
        .form {
            display: none;
        }

        .form.active {
            display: block;
        }
    </style>
</head>
<body>
    <div style="text-align: center;"><span style="font-family: Arial;">
        <h2>Selecciona una opción</h2>
        <input type="radio" id="opcion1" name="opcion" value="opcion1" onclick="mostrarFormulario('form1')">
        <label for="opcion1">Agregar Serie</label>
        <input type="radio" id="opcion2" name="opcion" value="opcion2" onclick="mostrarFormulario('form2')"> 
        <label for="opcion2">Agregar Pelicula</label>

        <div class="form" id="form1">
            <h3>Agregue una serie</h3>
            <form action="registroContenido.php" method="post">
                <input type="hidden" name="formulario" value="serie">
                <label for="titulo">Titulo</label>
                <input type="text" name="titulo"><br><br>
                <label for="clasificacion">Clasificacion</label>
                <input type="text" name="clasificacion"><br><br>
                <label for="categorias">Categoria</label>
                <select multiple name="categorias[]" required>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value=<?php echo $categoria['id_categoria']; ?>><?php echo $categoria['nombre']; ?></option>
                    <?php endforeach; ?>
                </select><br><br>
                <label for="temporadas">Numero de Temporadas</label>
                <input type="text"  name="num_temporadas"><br><br>
                <label for="capitulos">Numero de Capitulos</label>
                <input type="text" name="num_capitulos"><br><br>
                <input type="submit" value="Agregar Serie">
                
            </form>
        </div>

        <div class="form" id="form2">
            <h3>Agruegue una pelicula</h3>
            <form action="registroContenido.php" method="post">
                <input type="hidden" name="formulario" value="pelicula">
                <label for="titulo">Titulo</label>
                <input type="text" name="titulo"><br><br>
                <label for="clasificacion">Clasificacion</label>
                <input type="text" name="clasificacion"><br><br>
                <label for="categorias">Categoria</label>
                <select multiple name="categorias[]" required>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value=<?php echo $categoria['id_categoria']; ?>><?php echo $categoria['nombre']; ?></option>
                    <?php endforeach; ?>
                </select><br><br>
                <label for="duracion_mins">Tiempo de duracion(en minutos)</label>
                <input type="number" name="duracion_mins"><br><br>
                <input type="submit" value="Agregar Pelicula">
            </form>
        </div>
    </span></div>

    <script>
        function mostrarFormulario(formId) {
            const forms = document.querySelectorAll('.form');
            forms.forEach(form => form.classList.remove('active'));

            const selectedForm = document.getElementById(formId);
            selectedForm.classList.add('active');
        }
    </script>
</body>
</html>