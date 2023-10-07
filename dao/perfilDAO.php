<?php
interface PerfilDAO {
    public function guardarPerfil($id_usuario, $username, $edad);
    public function TodosPerfiles($id_usuario);
}
?>