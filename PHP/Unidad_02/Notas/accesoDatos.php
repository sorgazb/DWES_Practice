<?php 
require_once 'nota.php';

class AccesoDatos{
    private $nombreFichero;
    private $ficheroAsignaturas;

    function __construct($n, $asig){
        $this->nombreFichero = $n;
        $this->ficheroAsignaturas = $asig;
    }

    public function getNombreFichero(){
        return $this->nombreFichero;
    }

    public function setNombreFichero($nombreFichero){
        $this->nombreFichero = $nombreFichero;
        return $this;
    }

    function insertatNota(Nota $nota){
        try{
            $fichero = fopen($this->nombreFichero, 'a+');
            fwrite($fichero,$nota->getAsignatura().';'.$nota->getTipo().';'.$nota->getDescripcion().';'.$nota->getNota().';'.$nota->getFecha().PHP_EOL);         
        }catch(Throwable $t){
            echo $t->getMessage();
        }finally{
            fclose($fichero);
        }
    }

    function obtenerNotas(){
        $notas = array();
        try{
            if(file_exists($this->nombreFichero)){
                $tmp = file($this->nombreFichero);
                    foreach ($tmp as $linea) {
                        $campos = explode(';', $linea);
                        $notas[] = new Nota($campos[0], $campos[1], $campos[2],$campos[3],$campos[4]);
                    }
            }
        }catch(Throwable $t){
            echo $t->getMessage();
        }
        return $notas;
    }

    function obtenerAsignaturas(){
        $asignaturas = array();
        try{
            if(file_exists($this->ficheroAsignaturas)){
                $tmp = file($this->ficheroAsignaturas);
                foreach ($tmp as $linea) {
                    $asignaturas[] = $linea;
                }
            }
        }catch(Throwable $t){
            echo $t->getMessage();
        }
        return $asignaturas;
    }

    public function getFicheroAsignaturas(){
        return $this->ficheroAsignaturas;
    }

    public function setFicheroAsignaturas($ficheroAsignaturas){
        $this->ficheroAsignaturas = $ficheroAsignaturas;
        return $this;
    }
}

?>