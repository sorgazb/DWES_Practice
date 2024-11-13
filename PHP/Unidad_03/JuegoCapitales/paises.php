<?php

    class Paises{
        private $id;
        private $pais;
        private $capital;

        function __construct($i,$p,$c){
            $this->id=$i;
            $this->pais=$p;
            $this->capital=$c;
        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
            return $this;
        }

        public function getPais(){
            return $this->pais;
        }

        public function setPais($pais){
            $this->pais = $pais;
            return $this;
        }
 
        public function getCapital(){
            return $this->capital;
        }

        public function setCapital($capital){
            $this->capital = $capital;
            return $this;
        }
    }
?>