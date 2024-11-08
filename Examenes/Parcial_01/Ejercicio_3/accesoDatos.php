<?php
    require_once 'Trabajo.php';

    class AccesoDatos{
        private $nombre;

        function __construct($n){
            $this->nombre = $n;
        }
    
        public function getNombre(){
            return $this->nombre;
        }
    
        public function setNombre($nombre){
            $this->nombre = $nombre;
            return $this;
        }

        function insertarTrabajo(Trabajo $t){
            try {
                //Abrir el fichero
                $fichero = fopen($this->nombre, 'a+');
                //Insertar al final
                fwrite($fichero, $t->getFechaEntrada() . ';' . $t->getCliente() . ';' . $t->getTipoPrenda() . ';' . $t->getServicio() . ';' 
                . $t->getImporte().PHP_EOL);
            } catch (Throwable $e) {
                echo $e->getMessage();
            } finally {
                //Cerrar el fichero
                fclose($fichero);
            }
        }
    }
?>