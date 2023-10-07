<?php
require_once('perfilDAO.php');
require_once("perfil.php");

class perfilDAOImp implements PerfilDAO {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function guardarPerfil($id_usuario, $username, $edad){
        $query = "INSERT INTO perfil (id_usuario, username, edad) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $id_usuario);
        $stmt->bindParam(2, $username);
        $stmt->bindParam(3, $edad);

        $stmt->execute();
    }

    public function TodosPerfiles($id_usuario){

        $query = "SELECT * FROM perfil WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $id_usuario);

        $stmt->execute();
        $perfiles = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // Crear objetos User y agregarlos a la lista
            $perfil = new Perfil($row['id_usuario'], $row['username'], $row['edad']);
            $perfiles[] = $perfil;
        }

        return $perfiles;
    }
		
}

?>