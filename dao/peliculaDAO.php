<?php 
interface PeliculaDAO{
    public function guardarPelicula($id_contenido, $duracion_mins);
    public function eliminarPelicula($id_contenido);
    public function actualizarPelicula($id_contenido, $duracion_mins);
}
?>