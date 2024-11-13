<?php
class Nota{
    private $asignatura, $tipo, $descripcion, $nota, $fecha;

    function __construct($asig, $tp, $desc, $nt, $fch){
        $this->asignatura = $asig;
        $this->tipo = $tp;
        $this->descripcion = $desc;
        $this->nota = $nt;
        $this->fecha = $fch;
    }

    public function getAsignatura(){
        return $this->asignatura;
    }

    public function setAsignatura($asignatura){
        $this->asignatura = $asignatura;
        return $this;
    }
 
    public function getTipo(){
        return $this->tipo;
    }
 
    public function setTipo($tipo){
        $this->tipo = $tipo;
        return $this;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
        return $this;
    }

    public function getNota(){
        return $this->nota;
    }

    public function setNota($nota){
        $this->nota = $nota;
        return $this;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
        return $this;
    } 
}
?>