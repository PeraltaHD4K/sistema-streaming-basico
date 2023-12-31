<?php
require_once('contenidoDAO.php');
require_once("contenido.php");
require_once("categoriaDAOImp.php");

class contenidoDAOImp implements ContenidoDAO {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function guardarContenido($titulo, $tipo, $clasificacion, $categorias, $direccion_imagen){
        $query = "INSERT INTO contenido (titulo, tipo, clasificacion, direccion_imagen) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $titulo);
        $stmt->bindParam(2, $tipo);
        $stmt->bindParam(3, $clasificacion);
        $stmt->bindParam(4, $direccion_imagen);
        $stmt->execute();

        $contenidoId = $this->conexion->lastInsertId();
        foreach ($categorias as $categoriaId) {
            $stmt = $this->conexion->prepare("INSERT INTO categorias_contenido (id_categoria, id_contenido) VALUES (?, ?)");
            $stmt->bindParam(1, $categoriaId);
            $stmt->bindParam(2, $contenidoId);
            $stmt->execute();
        }
        
        return $contenidoId;
    }
	
    public function actualizarContenido($id_contenido, $titulo, $clasificacion, $categorias, $direccion_imagen){
        $query = "UPDATE contenido SET titulo = ?, clasificacion = ?, direccion_imagen = ? 
                WHERE id_contenido = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $titulo);
        $stmt->bindParam(2, $clasificacion);
        $stmt->bindParam(3, $direccion_imagen);
        $stmt->bindParam(4, $id_contenido);
        $stmt->execute();
        
        $query = "DELETE FROM categorias_contenido WHERE id_contenido = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $id_contenido);
        $stmt->execute();

        foreach ($categorias as $categoriaId) {
            $stmt = $this->conexion->prepare("INSERT INTO categorias_contenido (id_categoria, id_contenido) VALUES (?, ?)");
            $stmt->bindParam(1, $categoriaId);
            $stmt->bindParam(2, $id_contenido);
            $stmt->execute();
        }
    }

    public function eliminarContenido($id_contenido){
        $query = "DELETE FROM contenido WHERE id_contenido = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $id_contenido);

        $stmt->execute();
    }

    public function getAllContenidos(){
        $query = "SELECT * FROM contenido";
        $stmt = $this->conexion->prepare($query);

        $stmt->execute();
        $contenidos = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $contenido = new Contenido($row['titulo'], $row['tipo'], $row['clasificacion'], $row['direccion_imagen']);
            $contenidos[] = $contenido;
        }

        return $contenidos;
    }
    
    
    public function getAllSeries(){
        $query = "SELECT * FROM contenido";
        $stmt = $this->conexion->prepare($query);

        $stmt->execute();
        $contenidos = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            if($row['tipo'] == 'Serie'){
                $contenido = new Contenido($row['titulo'], $row['tipo'], $row['clasificacion'], $row['direccion_imagen']);
                $contenidos[] = $contenido;
            }
        }
        return $contenidos;
    }
    
     public function getAllPeliculas(){
        $query = "SELECT * FROM contenido";
        $stmt = $this->conexion->prepare($query);

        $stmt->execute();
        $contenidos = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            if($row['tipo'] == 'Pelicula'){
                $contenido = new Contenido($row['titulo'], $row['tipo'], $row['clasificacion'], $row['direccion_imagen']);
                $contenidos[] = $contenido;
            }
        }
        return $contenidos;
    }
    
    public function getAllCategorias($titulo){
        $query = "SELECT id_contenido FROM contenido WHERE titulo = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $titulo);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $id_contenido = $row["id_contenido"];
        }
        
        $consultaCategorias = new categoriaDAOImp($this->conexion);
        $lista = $consultaCategorias->getCategorias($id_contenido);
        $stringCategorias = implode(", ",$lista);
        
        return $stringCategorias;
    }
}

?>