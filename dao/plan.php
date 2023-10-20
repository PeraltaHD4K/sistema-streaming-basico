<?php
class Plan {
    private $nombre;
    private $descripcion;
    private $precio;

    public function __construct($nombre, $descripcion, $precio) {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }
    
     public function getPrecio() {
        return $this->precio;
    }
    
     public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    
     public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function __toString() {
        return "\Plan" .
            "\nNombre: " . $this->nombre .
            "\nDescripcion: " . $this->descripcion .
            "\nPrecio: " . $this->precio;
    }
}
?>