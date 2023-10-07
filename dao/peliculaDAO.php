<?php 
interface PeliculaDAO{
    public function guardarPelicula($id_contenido, $duracion_mins);
    public function mostrarPeliculas();
}
?>