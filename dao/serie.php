<?php 
class Serie {
    private $id_contenido;
    private $num_temporadas;
    private $num_capitulos;

    public function __construct($id_contenido, $num_temporadas, $num_capitulos) {
        $this->id_contenido = $id_contenido;
        $this->num_temporadas = $num_temporadas;
        $this->num_capitulos = $num_capitulos;
    }

    public function getIdContenido() {
        return $this->id_contenido;
    }

    public function setIdContenido($id_contenido) {
        $this->id_contenido = $id_contenido;
    }

    public function getNumTemporadas() {
        return $this->num_temporadas;
    }

    public function setNumTemporadas($num_temporadas) {
        $this->num_temporadas = $num_temporadas;
    }

    public function getNumCapitulos() {
        return $this->num_capitulos;
    }

    public function setNumCapitulos($num_capitulos) {
        $this->num_capitulos = $num_capitulos;
    }
}
?>