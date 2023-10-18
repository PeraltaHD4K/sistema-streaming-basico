<?php
interface ResenaDAO {
    public function guardarResena($comentario, $calificacion, $id_contenido, $id_perfil);
}
?>