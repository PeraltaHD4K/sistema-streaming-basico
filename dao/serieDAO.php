<?php 
interface SerieDAO{
    public function guardarSerie($id_contenido, $num_temporadas, $num_capitulos);
    public function eliminarSerie($id_contenido);
    public function actualizarSerie($id_contenido, $num_temporadas, $num_capitulos);
}
?>