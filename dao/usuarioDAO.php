<?php
interface UsuarioDAO {
    public function guardarUsuario($nombre, $apellido_paterno, $apellido_materno, $contrasena, $correo, $id_plan);
}
?>
