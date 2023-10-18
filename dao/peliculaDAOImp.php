<?php
require_once('peliculaDAO.php');
require_once("pelicula.php");

class peliculaDAOImp implements PeliculaDAO {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function guardarPelicula($id_contenido, $duracion_mins){
        $query = "INSERT INTO pelicula (id_contenido, duracion_mins) VALUES (?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $id_contenido);
        $stmt->bindParam(2, $duracion_mins);

        $stmt->execute();
    }
}

?>