<?php
require_once('usuarioDAO.php');
require_once("usuario.php");

class usuarioDAOImp implements UsuarioDAO {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function guardarUsuario($nombre, $apellido_paterno, $apellido_materno, $contrasena, $correo, $id_plan){
        $hashedContrasena = password_hash($contrasena, PASSWORD_DEFAULT);
        $query = "INSERT INTO usuario (nombre, apellido_paterno, apellido_materno, correo, contrasena, id_plan) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $apellido_paterno);
        $stmt->bindParam(3, $apellido_materno);
        $stmt->bindParam(4, $correo);
        $stmt->bindParam(5, $hashedContrasena);
        $stmt->bindParam(6, $id_plan);

        $stmt->execute();
    }

    public function getUsuario($id){
        $query = "SELECT * FROM usuario WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $usuario = new Usuario($row['nombre'], $row['apellido_paterno'], $row['apellido_materno'], $row['correo'], $row['contrasena'], $row['id_plan']);
        
        return $usuario;
    }
    
    public function getNumPerfiles($id_usuario){
        $query = "SELECT * FROM perfil WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $id_usuario);
        $stmt->execute();
        $cont = 0;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $cont = $cont + 1;
        }
        return $cont;
    }
    /*
    public function __destruct() {
        // Cerrar la conexión a la base de datos al destruir el objeto
        $this->conexion->close();
    }	
     * 
     */	
}
?>
