<?php
    class Estancia{
        private $dni, $nombreCliente, $tipoHabitacion, $numNoches, $tipoEstancia, $tarjeta, $efectivo, $cuna, $camaSupletoria, $lavanderia;

        function __construct($d,$n,$tH,$nN,$tE,$t,$e,$c,$cS,$l){
            $this->dni = $d;
            $this->nombreCliente = $n;
            $this->tipoHabitacion = $tH;
            $this->numNoches = $nN;
            $this->tipoEstancia = $tE;
            $this->tarjeta = $t;
            $this->efectivo = $e;
            $this->cuna = $c;
            $this->camaSupletoria = $cS;
            $this->lavanderia = $l;
        }

        public function getDni(){
            return $this->dni;
        }

        public function setDni($dni){
            $this->dni = $dni;
            return $this;
        }

        
        public function getNombreCliente(){
            return $this->nombreCliente;
        }

        public function setNombreCliente($nombreCliente){
            $this->nombreCliente = $nombreCliente;
            return $this;
        }

        public function getTipoHabitacion(){
            return $this->tipoHabitacion;
        }
 
        public function setTipoHabitacion($tipoHabitacion){
            $this->tipoHabitacion = $tipoHabitacion;
            return $this;
        }

        public function getNumNoches(){
            return $this->numNoches;
        }

        public function setNumNoches($numNoches){
            $this->numNoches = $numNoches;
            return $this;
        }

        public function getTipoEstancia(){
            return $this->tipoEstancia;
        }

        public function setTipoEstancia($tipoEstancia){
            $this->tipoEstancia = $tipoEstancia;
            return $this;
        }

        public function getTarjeta(){
            return $this->tarjeta;
        }

        public function setTarjeta($tarjeta){
            $this->tarjeta = $tarjeta;
            return $this;
        }

        public function getEfectivo(){
            return $this->efectivo;
        }

        public function setEfectivo($efectivo){
            $this->efectivo = $efectivo;
            return $this;
        }
 
        public function getCuna(){
            return $this->cuna;
        }

        public function setCuna($cuna){
            $this->cuna = $cuna;
            return $this;
        }
 
        public function getCamaSupletoria(){
            return $this->camaSupletoria;
        }

        public function setCamaSupletoria($camaSupletoria){
            $this->camaSupletoria = $camaSupletoria;
            return $this;
        }
 
        public function getLavanderia(){
            return $this->lavanderia;
        }

        public function setLavanderia($lavanderia){
            $this->lavanderia = $lavanderia;
            return $this;
        }
    }
?>