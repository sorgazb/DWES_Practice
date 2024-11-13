<?php
class Contacto
{
        private $indice;
        private $nombre;
        private $tlf;
        private $tipo;
        private $foto;

        function __construct($id, $n, $t, $tp, $f)
        {
                $this->indice = $id;
                $this->nombre = $n;
                $this->tlf = $t;
                $this->tipo = $tp;
                $this->foto = $f;
        }

        public function getNombre()
        {
                return $this->nombre;
        }

        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        public function getTlf()
        {
                return $this->tlf;
        }

        public function setTlf($tlf)
        {
                $this->tlf = $tlf;

                return $this;
        }

        public function getTipo()
        {
                return $this->tipo;
        }

        public function setTipo($tipo)
        {
                $this->tipo = $tipo;

                return $this;
        }

        public function getFoto()
        {
                return $this->foto;
        }

        public function setFoto($foto)
        {
                $this->foto = $foto;

                return $this;
        }

        function __destruct()
        {
                //echo "<h4 style='color: red;'>Producto ".$this->producto." destruido</h4>";
        }
        

        /**
         * Get the value of indice
         */ 
        public function getIndice()
        {
                return $this->indice;
        }

        /**
         * Set the value of indice
         *
         * @return  self
         */ 
        public function setIndice($indice)
        {
                $this->indice = $indice;

                return $this;
        }
}
