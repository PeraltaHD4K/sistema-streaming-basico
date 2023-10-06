<!DOCTYPE html>
<html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Streaming</title>
  </head>

  <body>
    <h1 style="text-align: center;">
      <span style="font-weight: normal; font-family: Arial;">Bienvenido a la plataforma de streaming</span>
    </h1>
    <br>
    <?php
    if (isset($_GET['error'])) {
        echo '<p style="color: red; text-align: center;">Credenciales incorrectas. Por favor, intenta de nuevo.</p>';
    }
    ?>
    <form action="paginas/login.php" method="POST" name="inicio_sesion">
      <div style="text-align: center;">
        <label for="correo">
          <span style="font-family: Arial;">Correo electronico:</span>
        </label>
        <input id="correo" name="correo" required type="text">
        <br>
        <br>
        <label for="contrasena">
          <span style="font-family: Arial;">Contraseña:</span>
        </label>
        <input id="contrasena" name="contrasena" required type="password">
        <br>
        <br>
        <input value="Iniciar Sesión" type="submit">
      </div>
    </form>
    <div style="text-align: center;" class="register-link"> 
      ¿No tienes una cuenta? <a href="paginas/registroUsuario.php">Regístrate aquí</a> 
    </div>
  </body>

</html>