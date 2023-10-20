<?php $title = 'Agregar Contenido'; include '../templates/header.php'; ?>
    <div style="text-align: center;">
        <h2>Selecciona una opción</h2>
        <input type="radio" id="opcion1" name="opcion" value="opcion1" onclick="mostrarFormulario('form1')">
        <label style="color:white" for="opcion1">Agregar Serie</label>
        <input type="radio" id="opcion2" name="opcion" value="opcion2" onclick="mostrarFormulario('form2')"> 
        <label style="color:white" for="opcion2">Agregar Pelicula</label>

        <div class="form" id="form1">
            <div class="profile-container">
                <h3>Agregue una serie</h3><br>
                <form action="registroContenido.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="formulario" value="serie">
                    <label for="titulo">Titulo</label>
                    <input type="text" name="titulo" required><br><br>
                    <label for="clasificacion">Clasificacion</label>
                    <input type="text" name="clasificacion" required><br><br>
                    <label for="categorias[]">Categoria</label>
                    <select multiple name="categorias[]" required>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value=<?php echo $categoria['id_categoria']; ?>><?php echo $categoria['nombre']; ?></option>
                        <?php endforeach; ?>
                    </select><br><br>
                    <label for="temporadas">Numero de Temporadas</label>
                    <input type="number"  name="num_temporadas" required><br><br>
                    <label for="capitulos">Numero de Capitulos</label>
                    <input type="number" name="num_capitulos" required><br><br>
                    <label for="imagen">Imagen de la Serie:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*" required><br><br>
                    <button type="submit">Agregar Serie</button>                    
                </form>
            </div>            
        </div>

        <div class="form" id="form2">
            <div class="profile-container">
                <h3>Agruegue una pelicula</h3><br>
                <form action="registroContenido.php" method="post" enctype="multipart/form-data">
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
                    <label for="imagen">Imagen de la Película:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*" required><br><br>
                    <button type="submit">Agregar Pelicula</button>
                </form>
            </div>            
        </div>
    </div>

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