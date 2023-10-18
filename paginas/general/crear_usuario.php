<?php $title = 'Crear  Usuario'; include '../templates/header.php'; ?>
  <h1>Registro de usuario</h1>
  <div class="signin-container">

  </div>
  <form action="registroUsuario.php" method="post">
    <fieldset>
        <legend style="color:white">Informacion de la usuario</legend>
        <label style="color:white" for="nombre">Ingrese su nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre real"><br>
        <label style="color:white" for="nombre">Ingrese su apellido paterno:</label>
        <input type="text" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido paterno"><br>
        <label style="color:white" for="nombre">Ingrese su apellido materno:</label>
        <input type="text" id="apellido_materno" name="apellido_materno" placeholder="Apellido materno"><br>
        <label style="color:white" for="email">Ingrese su correo electronico:</label>
        <input type="email" id="correo" name="correo" placeholder="Correo electrónico"><br>
        <label style="color:white" for="contrasena">Ingrese una contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña">
    </fieldset>
      
    <fieldset>
        <legend style="color:white">Detalles de suscripcion</legend>
        <label style="color:white" for="plan">Elija un plan de suscripcion:</label>
        <select id="id_plan" name="id_plan">
            <option value=1>Basico</option>
            <option value=2>Estandar con anuncios</option>
            <option value=3>Estandar</option>
            <option value=4>Premium</option>
        </select><br>
    </fieldset>
    <input type="submit" value="Registrarse">
  </form>
</body>
</html>