<?php
    require_once 'paises.php';

    class AccesoDatos{

        private $nombreFichero;

        function __construct($nF){
            $this->nombreFichero = $nF;            
        }

        public function getNombreFichero(){
            return $this->nombreFichero;
        }

        public function setNombreFichero($nombreFichero){
            $this->nombreFichero = $nombreFichero;
            return $this;
        }

        function obtenerPaises(){
            $paises = array();
            try{
                if(file_exists($this->nombreFichero)){
                    $tmp = file($this->nombreFichero,FILE_IGNORE_NEW_LINES);
                        foreach ($tmp as $linea) {
                            $campos = explode(';', $linea);
                            $paises[] = new Paises($campos[0], $campos[1], $campos[2]);
                        }
                }
            }catch(Throwable $t){
                echo $t->getMessage();
            }
            return $paises;
        }
    }
?>