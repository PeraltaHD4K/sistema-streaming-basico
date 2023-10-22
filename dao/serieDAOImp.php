<?php
require_once('contenidoDAO.php');
require_once("contenido.php");

class serieDAOImp implements SerieDAO {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function guardarSerie($id_contenido, $num_temporadas, $num_capitulos){
        $query = "INSERT INTO serie (id_contenido, num_temporadas, num_capitulos) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $id_contenido);
        $stmt->bindParam(2, $num_temporadas);
        $stmt->bindParam(3, $num_capitulos);

        $stmt->execute();
    }

    public function actualizarSerie($id_contenido, $num_temporadas, $num_capitulos){
        $query = "UPDATE serie SET num_temporadas = ?, num_capitulos = ? 
        WHERE id_contenido = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $num_temporadas);
        $stmt->bindParam(2, $num_capitulos);
        $stmt->bindParam(3, $id_contenido);
        $stmt->execute();
    }
    

    public function eliminarSerie($id_contenido){
        $query = "DELETE FROM serie WHERE id_contenido = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $id_contenido);

        $stmt->execute();
    }
}

?>