<?php
class Contenido {
    private $titulo;
    private $tipo;
    private $clasificacion;
    private $direccion_imagen;

    public function __construct($titulo, $tipo, $clasificacion, $direccion_imagen) {
        $this->titulo = $titulo;
        $this->tipo = $tipo;
        $this->clasificacion = $clasificacion;
        $this->direccion_imagen = $direccion_imagen;
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

    public function getDireccionImagen() {
        return $this->direccion_imagen;
    }

    public function setDireccionImagen($direccion_imagen) {
        $this->direccion_imagen = $direccion_imagen;
    }
}

?>