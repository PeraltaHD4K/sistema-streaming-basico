<?php
interface ContenidoDAO {
    public function guardarContenido($titulo, $tipo, $clasificacion, $categorias);
    public function actualizarContenido();
    public function eliminarContenido();
}
?>