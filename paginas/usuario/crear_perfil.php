<?php $title = 'Crear Perfil'; include '../templates/header.php'; ?>
    <main id="content">
        <div class="profile-container">
            <h2>Crea un perfil</h2><br>
            <form action="registroPerfil.php" method="post" name="crea_perfil">
                <label for="username">Username: </label>
                <input type="text" id="username" name="username" required><br><br>

                <label for="edad">Edad del perfil: </label>
                <input type="number" id="edad" name="edad" required><br><br>

                <button type="submit">Crear Perfil</button>
            </form>
        </div>
    </main>
</body>
</html>