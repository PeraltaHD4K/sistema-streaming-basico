<?php
    class Paginar {
    
        // Propiedades privadas de la clase
        private $conexion;
        private $limite = 5; // Número de resultados por página
        private $pagina; // Página actual
        private $consulta; // Consulta SQL para obtener datos
        private $total; // Número total de resultados en la consulta

        // Constructor de la clase
        public function __construct($conex, $cons) {     
            $this->conexion = $conex;
            $this->consulta = $cons;
            
            // Obtiene el número total de resultados de la consulta
            $respuesta = $this->conexion->query($this->consulta);
            $this->total = $respuesta->rowCount();   
        }

        // Método para obtener datos paginados
        public function getDatos($p) {     
            $this->pagina = $p;
            $inicio = ($this->pagina - 1) * $this->limite ;
                
            // Ajusta el inicio de la página si es menor a 0
            if($inicio < 0){
                $inicio = 0;
                $this->pagina = 1;
            }

            // Ajusta el inicio de la página si es mayor al total de resultados
            if($inicio > ($this->total - $this->limite)){
                $inicio = $this->total - $this->limite;
                $this->pagina = $this->pagina - 1;
            }

            if($this->total < $this->limite){
                $consultar = $this->consulta;
                $respuesta = $this->conexion->query($consultar); 
            }else{
                // Construye la nueva consulta con límite y realiza la consulta
                $consultar = $this->consulta.' LIMIT '.$inicio.','.$this->limite;
                $respuesta = $this->conexion->query($consultar);
            }

            // Almacena los resultados en un array asociativo
            $resultados = array(); // Inicializa $resultados como un array vacío

            // Verifica si hay resultados antes de iniciar el bucle
            if ($respuesta) {
                while($row = $respuesta->fetch(PDO::FETCH_ASSOC)) {
                    $resultados[]  = $row;
                }
            }
                    
            // Crea un objeto estándar con la información paginada
            $result = new stdclass();
            $result->pagina = $this->pagina;
            $result->limite = $this->limite;
            $result->total = $this->total;
            $result->datos = $resultados;

            return $result;
        }

        // Método para generar los enlaces de paginación
        public function crearLinks($enlaces) {
            $ultimo  = ceil($this->total / $this->limite);
            $comienzo = (($this->pagina - $enlaces) > 0) ? $this->pagina - $enlaces : 1;
            $fin  = (($this->pagina + $enlaces) < $ultimo) ? $this->pagina + $enlaces : $ultimo;
            $clase = ($this->pagina == 1) ? "disabled" : "";
            $html = '<li class="'.$clase.'"><a href="?limit='.$this->limite.'&page='.($this->pagina-1).'">&laquo;</a></li>';
                
            // Agrega enlaces adicionales si es necesario
            if($comienzo > 1) {
                $html  .= '<li><a href="?limit='.$this->limite.'&page=1">1</a></li>';
                $html  .= '<li class="disabled"><span>...</span></li>';
            }
                
            // Agrega enlaces numerados
            for($i = $comienzo ; $i <= $fin; $i++) {
                $clase  = ( $this->pagina == $i ) ? "active" : "";
                $html  .= '<li class="'.$clase.'"><a href="?limit='.$this->limite.'&page='.$i.'">'.$i.'</a></li>';
            }
                
            // Agrega enlaces adicionales si es necesario
            if($fin < $ultimo) {
                $html  .= '<li class="disabled"><span>...</span></li>';
                $html  .= '<li><a href="?limit='.$this->limite.'&page='.$ultimo.'">'.$ultimo.'</a></li>';
            }
                
            $clase  = ( $this->pagina == $ultimo ) ? "disabled" : "enabled";
            $html  .= '<li class="'.$clase.'"><a href="?limit='.$this->limite.'&page='.($this->pagina+1).'">&raquo;</a></li>';
            return $html;
        }
    }
?>