<?php
require_once 'ticket.php';

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


        function insertarProducto(Ticket $t){
            try{
                //Abrir el fichero
                $fichero = fopen($this->nombre,'a+');
                //Insertar al final
                fwrite($fichero,$t->getProducto().';'.$t->getPrecioUni().';'.$t->getCantidad().';'.$t->getTotal().PHP_EOL);
            }catch(Throwable $e){
                echo $e->getMessage();
            }finally{
                //Cerrar el fichero
                if(isset($fichero)){
                    fclose($fichero);
                }
            }

        }

        function obtenerProducto(){
            $resultado = [];
            try{
                if(file_exists($this->nombre)){
                    //Cargamos el fichero en un Array
                    $tmp = file($this->nombre);
                    foreach($tmp as $linea){
                        $campos=explode(';',$linea);
                        //Creamos el objeto ticket
                        $t=new Ticket($campos[0],$campos[1],$campos[2]);
                        //añadimos $t al array de objeto resultado
                        $resultado[]=$t;
                    }
                }
            }
            catch(Throwable $e){
                echo $e->getMessage();
            }
            return $resultado;
        }
    }
?>