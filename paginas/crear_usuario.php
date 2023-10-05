<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Usuario</title>
</head>
<body>
  <h1>Registro de usuario</h1>

  <form action="registroUsuario.php" method="post">
    <fieldset>
        <legend>Informacion de la usuario</legend>
        <label for="nombre">Ingrese su nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre real"><br>
        <label for="nombre">Ingrese su apellido paterno:</label>
        <input type="text" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido paterno"><br>
        <label for="nombre">Ingrese su apellido materno:</label>
        <input type="text" id="apellido_materno" name="apellido_materno" placeholder="Apellido materno"><br>
        <label for="email">Ingrese su correo electronico:</label>
        <input type="email" id="correo" name="correo" placeholder="Correo electrónico"><br>
        <label for="contrasena">Ingrese una contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña">
    </fieldset>
      
    <fieldset>
        <legend>Detalles de suscripcion</legend>
        <label for="plan">Elija un plan de suscripcion:</label>
        <select id="id_plan" name="id_plan">
            <option value=1>Basico</option>
            <option value=2>Estandar con anuncios</option>
            <option value=3>Estandar</option>
            <option value=4>Premium</option>
        </select><br>
    </fieldset>>
    <input type="submit" value="Registrarse">
  </form>
</body>
</html>