<?php
    class Trabajo{
        // Atributos de la Clase Trabajo
        private $fechaEntrada,$cliente,$tipoPrenda,$servicio,$importe;

        function __construct($f,$c,$tP,$s,$i){
            $this->fechaEntrada = $f;
            $this->cliente = $c;
            $this->tipoPrenda = $tP;
            $this->servicio = $s;
            $this->importe = $i;
        }

        /**
         * Get the value of fechaEntrada
         */ 
        public function getFechaEntrada()
        {
                return $this->fechaEntrada;
        }

        /**
         * Set the value of fechaEntrada
         *
         * @return  self
         */ 
        public function setFechaEntrada($fechaEntrada)
        {
                $this->fechaEntrada = $fechaEntrada;

                return $this;
        }

        /**
         * Get the value of cliente
         */ 
        public function getCliente()
        {
                return $this->cliente;
        }

        /**
         * Set the value of cliente
         *
         * @return  self
         */ 
        public function setCliente($cliente)
        {
                $this->cliente = $cliente;

                return $this;
        }

        /**
         * Get the value of tipoPrenda
         */ 
        public function getTipoPrenda()
        {
                return $this->tipoPrenda;
        }

        /**
         * Set the value of tipoPrenda
         *
         * @return  self
         */ 
        public function setTipoPrenda($tipoPrenda)
        {
                $this->tipoPrenda = $tipoPrenda;

                return $this;
        }

        /**
         * Get the value of servicio
         */ 
        public function getServicio()
        {
                return $this->servicio;
        }

        /**
         * Set the value of servicio
         *
         * @return  self
         */ 
        public function setServicio($servicio)
        {
                $this->servicio = $servicio;

                return $this;
        }

        /**
         * Get the value of importe
         */ 
        public function getImporte()
        {
                return $this->importe;
        }

        /**
         * Set the value of importe
         *
         * @return  self
         */ 
        public function setImporte($importe)
        {
                $this->importe = $importe;

                return $this;
        }
    }
?>