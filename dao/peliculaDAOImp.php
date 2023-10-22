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

    public function actualizarPelicula($id_contenido, $duracion_mins){
        $query = "UPDATE pelicula SET duracion_mins = ? 
        WHERE id_contenido = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $duracion_mins);
        $stmt->bindParam(2, $id_contenido);
        $stmt->execute();
    }
    

    public function eliminarPelicula($id_contenido){
        $query = "DELETE FROM pelicula WHERE id_contenido = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $id_contenido);

        $stmt->execute();
    }
}

?>