<?php
class Usuario {
    private $nombre;
    private $apellido_paterno;
    private $apellido_materno;
    private $contrasena;
    private $correo;
    private $id_plan;

    public function __construct($nombre, $apellido_paterno, $apellido_materno, $contrasena, $correo, $id_plan) {
        $this->nombre = $nombre;
        $this->apellido_paterno = $apellido_paterno;
        $this->apellido_materno = $apellido_materno;
        $this->contrasena = $contrasena;
        $this->correo = $correo;
        $this->id_plan = $id_plan;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido_paterno() {
        return $this->apellido_paterno;
    }

    public function getApellido_materno() {
        return $this->apellido_materno;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getIdPlan() {
        return $this->id_plan;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido_paterno($apellido_paterno) {
        $this->apellido_paterno = $apellido_paterno;
    }

    public function setApellido_materno($apellido_materno) {
        $this->apellido_materno = $apellido_materno;
    }

    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function setIdPlan($id_plan) {
        $this->id_plan = $id_plan;
    }

    public function __toString() {
        return "\nUsuario" .
            "\nNombre: " . $this->nombre .
            "\nApellido ´Paterno: " . $this->apellido_paterno .
            "\nApellido Materno: " . $this->apellido_materno .
            "\ncorreo: " . $this->correo;
    }
}

?>
