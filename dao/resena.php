<?php
class Resena {
    private $comentario;
    private $calificacion;

    public function __construct($comentario, $calificacion) {
        $this->comentario = $comentario;
        $this->calificacion = $calificacion;
    }

    public function getComentario() {
        return $this->comentario;
    }

    public function getCalificacion() {
        return $this->calificacion;
    }

    public function setComentario($comentario) {
        $this->comentario = $comentario;
    }

    public function setCalificacion($calificacion) {
        $this->calificacion = $calificacion;
    }

    public function __toString() {
        return "\Reseña" .
            "\nComentario: " . $this->comentario .
            "\nCalificacion: " . $this->calificacion;
    }
}

?>