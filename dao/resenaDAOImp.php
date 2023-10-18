<?php
require_once('resenaDAO.php');
require_once("resena.php");

class resenaDAOImp implements ResenaDAO {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function guardarResena($comentario, $calificacion, $id_contenido, $id_perfil){
        $query = "INSERT INTO resena (comentario, calificacion) VALUES (?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $comentario);
        $stmt->bindParam(2, $calificacion);
        $stmt->execute();

        $resenaId = $this->conexion->lastInsertId();

        $query = "INSERT INTO interaccion (id_perfil, id_resena, id_contenido) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $id_perfil);
        $stmt->bindParam(2, $resenaId);
        $stmt->bindParam(3, $id_contenido);
        $stmt->execute();
    }
		
}

?>