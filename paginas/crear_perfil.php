<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Perfil</title>
</head>
<body>
    <div style="text-align: center;"><span style="font-family: Arial;">
        <h2>Crea un perfil</h2>
        <form action="registroPerfil.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"><br><br>
            <label for="edad">Edad del perfil</label>
            <input type="number" id="edad" name="edad"><br><br>
            <input type="submit" value="Crear perfil">
        </form>
    </span></div>
</body>
</html>