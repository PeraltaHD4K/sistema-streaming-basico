<?php
require_once('contenidoDAO.php');
require_once("contenido.php");

class contenidoDAOImp implements ContenidoDAO {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function guardarContenido($titulo, $tipo, $clasificacion, $categorias){
        $query = "INSERT INTO contenido (titulo, tipo, clasificacion) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $titulo);
        $stmt->bindParam(2, $tipo);
        $stmt->bindParam(3, $clasificacion);
        $stmt->execute();

        $contenidoId = $this->conexion->lastInsertId();
        foreach ($categorias as $categoriaId) {
            $stmt = $this->conexion->prepare("INSERT INTO categorias_contenido (id_categoria, id_contenido) VALUES (?, ?)");
            $stmt->bindParam(1, $categoriaId);
            $stmt->bindParam(2, $contenidoId);
            $stmt->execute();
        }
        
    }
	
    public function actualizarContenido(){

    }

    public function eliminarContenido(){

    }
}

?>