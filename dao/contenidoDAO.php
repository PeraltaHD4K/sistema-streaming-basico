<?php
interface ContenidoDAO {
    public function guardarContenido($titulo, $tipo, $clasificacion, $categorias, $direccion_imagen);
    public function actualizarContenido($id_contenido, $titulo, $clasificacion, $categorias, $direccion_imagen);
    public function eliminarContenido($id_contenido);
    public function getAllContenidos();
    public function getAllSeries();
    public function getAllPeliculas();
}
?>