<?php
interface ContenidoDAO {
    public function guardarContenido($titulo, $tipo, $clasificacion, $categorias, $direccion_imagen);
    public function actualizarContenido();
    public function eliminarContenido();
    public function getAllContenidos();
    public function getAllSeries();
    public function getAllPeliculas();
}
?>