<?php
    class Ticket{
        private $producto;
        private $precioUni;
        private $cantidad;
        private $total;

        function __construct($p,$pU,$c){ 
            $this->producto=$p;
            $this->precioUni=$pU;
            $this->cantidad=$c;
            $this->total=$pU*$c;
        }

        public function getProducto(){
                return $this->producto;
        }

        public function setProducto($producto){
                $this->producto = $producto;

                return $this;
        }

        public function getPrecioUni(){
                return $this->precioUni;
        }

        public function setPrecioUni($precioUni){
                $this->precioUni = $precioUni;

                return $this;
        }

        public function getCantidad(){
                return $this->cantidad;
        }


        public function setCantidad($cantidad){
                $this->cantidad = $cantidad;

                return $this;
        }

        public function getTotal(){
                return $this->total;
        }

        public function setTotal($total){
                $this->total = $total;

                return $this;
        }

        function __destruct(){
            //echo "<h4 style='color: red;'>Producto ".$this->producto." destruido</h4>";
        }

    }
?>