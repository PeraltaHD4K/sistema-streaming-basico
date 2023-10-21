<?php
interface UsuarioDAO {
    public function guardarUsuario($nombre, $apellido_paterno, $apellido_materno, $contrasena, $correo, $id_plan);
    public function getUsuario($id);
    public function getAllUsuarios();
    public function getNumPerfiles($id_usuario);
}
?>
