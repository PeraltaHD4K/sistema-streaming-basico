<?php 
interface SerieDAO{
    public function guardarSerie($id_contenido, $num_temporadas, $num_capitulos);
    public function mostrarSeries();
}
?>