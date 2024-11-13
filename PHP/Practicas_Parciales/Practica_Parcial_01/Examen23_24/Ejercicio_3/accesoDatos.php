<?php
    require_once 'Estancia.php';

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

        function insertarEstancia(Estancia $e){
            try {
                //Abrir el fichero
                $fichero = fopen($this->nombre, 'a+');
                //Insertar al final
                fwrite($fichero, $e->getDni() . ';' . $e->getNombreCliente() . ';' . $e->getTipoHabitacion() . ';' . $e->getNumNoches() . ';' 
                . $e->getTipoEstancia() . ';' . $e->getTarjeta() .';' . $e->getEfectivo() .';' . $e->getCuna() .';' . $e->getCamaSupletoria() 
                .';' . $e->getLavanderia() .PHP_EOL);
            } catch (Throwable $e) {
                echo $e->getMessage();
            } finally {
                //Cerrar el fichero
                fclose($fichero);
            }
        }

        function obtenerEstancia(){
            $resultado = array();
            try {
                if (file_exists($this->nombre)) { {
                        if (file_exists($this->nombre));
                        $tmp = file($this->nombre);
                        foreach ($tmp as $linea) {
                            $campos = explode(';', $linea);
                            //Creamos el objeto Estancia
                            $resultado[] = new Estancia($campos[0], $campos[1], $campos[2],$campos[3],$campos[4],$campos[5],$campos[6],$campos[7],$campos[8],$campos[9]);
                        }
                    }
                }
            } catch (Throwable $e) {
                echo $e->getMessage();
            }
            return $resultado;
        }
    }
?>