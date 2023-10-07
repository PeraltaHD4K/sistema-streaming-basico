<?php
class Contenido {
    private $titulo;
    private $tipo;
    private $clasificacion;

    public function __construct($titulo, $tipo, $clasificacion) {
        $this->titulo = $titulo;
        $this->tipo = $tipo;
        $this->clasificacion = $clasificacion;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getClasificacion() {
        return $this->clasificacion;
    }

    public function setClasificacion($clasificacion) {
        $this->clasificacion = $clasificacion;
    }
}

?>