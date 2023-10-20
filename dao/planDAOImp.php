<?php
require_once('planDAO.php');
require_once("plan.php");

class planDAOImp implements planDAO {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function getPlan($id){
        
        $query = "SELECT * FROM detalles_plan WHERE id_plan = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $plan = new Plan($row['nombre'], $row['descripcion'], $row['precio']);
        
        return $plan;
    
    }
    
    public function getAllPlanes() {
        $query = "SELECT * FROM detalles_plan";
        $result = $this->conexion->prepare($query);        
        $result->execute();
        $planes = [];
         
        if ($result) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $plan = new Plan($row['nombre'], $row['descripcion'], $row['precio']);
                $planes[] = $plan;
            }
            
        }                    
        return $planes;
    }
}
?>