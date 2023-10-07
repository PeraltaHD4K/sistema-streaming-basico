<?php
class Perfil {
    private $id_usuario;
    private $username;
    private $edad;

    public function __construct($id_usuario, $username, $edad) {
        $this->id_usuario = $id_usuario;
        $this->username = $username;
        $this->edad = $edad;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEdad($edad) {
        $this->edad = $edad;
    }

    public function __toString() {
        return "\Perfil" .
            "\nUsername: " . $this->username .
            "\nEdad: " . $this->edad;
    }
}

?>