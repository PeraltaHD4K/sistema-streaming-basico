<?php $title = 'Streaming'; include 'paginas/templates/header.php'; ?>
    <h1 style="text-align: center;">
      <span style="font-weight: normal; font-family: Arial;">Bienvenido a la plataforma de streaming</span>
    </h1>
    <br>
    <?php
    if (isset($_GET['error'])) {
        echo '<p style="color: red; text-align: center;">Credenciales incorrectas. Por favor, intenta de nuevo.</p>';
    }
    ?>
    <main id="content">
        <div class="profile-container">
            <h2>Iniciar Sesión</h2><br>
            <form action="paginas/general/login.php" method="POST" name="inicio_sesion">
                <label for="correo">Correo electronico:</label>
                <input type="text" id="correo" name="correo" required><br><br>

                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required><br><br>

                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
    </main>
  </body>

</html>