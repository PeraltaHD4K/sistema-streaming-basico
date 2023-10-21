<?php
require_once('categoriaDAO.php');
require_once('categoria.php');

class categoriaDAOImp implements CategoriaDAO{
    private $conexion;
    
     public function __construct($conexion) {
        $this->conexion = $conexion;
    }
    
    public function getCategorias($id_contenido){
        $query = "SELECT * FROM categorias_contenido WHERE id_contenido = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $id_contenido);
        $stmt->execute();
        $id_categoria = [];
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $id_categoria[] = $row["id_categoria"];
        }
   
        $listaCategorias = [];
        
        for($cont = 0; $cont < sizeof($id_categoria); $cont++){    
            $query2 = "SELECT nombre FROM categoria WHERE id_categoria = ?";
            $stmt2 = $this->conexion->prepare($query2);
            $id_catActual = $id_categoria[$cont];
            $stmt2->bindParam(1, $id_catActual);
            $stmt2->execute();
            while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                $catego = new Categoria($row2['nombre']);
                $listaCategorias[] = $catego->getCategoria();
                }
        }
        
       return $listaCategorias;
    }   
    
}
?>