<?php 
class Pelicula {
    private $id_contenido;
    private $duracion_mins;

    public function __construct($id_contenido, $duracion_mins) {
        $this->id_contenido = $id_contenido;
        $this->duracion_mins = $duracion_mins;
    }

    public function getIdContenido() {
        return $this->id_contenido;
    }

    public function setIdContenido($id_contenido) {
        $this->id_contenido = $id_contenido;
    }

    public function getDuracionMins() {
        return $this->duracion_mins;
    }

    public function setDuracionMins($duracion_mins) {
        $this->duracion_mins = $duracion_mins;
    }
}

?>