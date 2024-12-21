<?php

    require_once 'Modalidad.php';
    require_once 'Prueba.php';
    require_once 'Alumno.php';
    require_once 'Correccion.php';

    class Modelo{

        private $conexion = null;

        function __construct(){
            try{
                $this->conexion = new PDO('mysql:host=localhost;port=3306;dbname=skills','root','admin');
            }catch(\Throwable $th){
                echo $th->getMessage();
            }
        }

        public function getConexion(){
            return $this->conexion;
        }

        public function setConexion($conexion){
            $this->conexion = $conexion;
            return $this;
        }

        public function obtenerModalidades(){
            $resultado = array();
            try{
                $consulta = $this->conexion->query('SELECT * from modalidad');
                while($fila = $consulta->fetch()){
                    $resultado [] = new Modalidad($fila['id'],$fila['modalidad']);
                }
            }catch(\Throwable $th){
                echo $th->getMessage();
            }
            return $resultado;
        }

        public function obtenerModalidad($id){
            $resultado = null;
            try{
                $consulta = $this->conexion->prepare('SELECT * from modalidad where id=?');
                $params = array($id);
                if($consulta->execute($params)){
                    if($fila = $consulta->fetch()){
                        $resultado = new Modalidad($fila['id'],$fila['modalidad']);
                    }
                }
            }catch(\Throwable $th){
                echo $th->getMessage();
            }
            return $resultado;
        }

        public function obtenerAlumnosModalidad($modalidad){
            $resultado = array();
            try{
                $consulta = $this->conexion->prepare('SELECT * from alumno where modalidad=?');
                $params = array($modalidad);
                if($consulta->execute($params)){
                    while($fila = $consulta->fetch()){
                        $resultado [] = new Alumno($fila['id'],$fila['nombre'],$fila['modalidad'],$fila['puntuacion'],$fila['finalizado']);
                    }
                }
            }catch(\Throwable $th){
                echo $th->getMessage();
            }
            return $resultado;
        }

        public function obtenerAlumno($id){
            $resultado = null;
            try{
                $consulta = $this->conexion->prepare('SELECT * from alumno where id=?');
                $params = array($id);
                if($consulta->execute($params)){
                    if($fila = $consulta->fetch()){
                        $resultado = new Alumno($fila['id'],$fila['nombre'],$fila['modalidad'],$fila['puntuacion'],$fila['finalizado']);
                    }
                }
            }catch(\Throwable $th){
                echo $th->getMessage();
            }
            return $resultado;
        }

        public function obtenerPruebasModalidad($modalidad){
            $resultado = array();
            try{
                $consulta = $this->conexion->prepare('SELECT * from prueba where modalidad=?');
                $params = array($modalidad);
                if($consulta->execute($params)){
                    while($fila = $consulta->fetch()){
                        $resultado [] = new Prueba($fila['id'],$fila['modalidad'],$fila['fecha'],$fila['descripcion'],$fila['puntuacion']);
                    }
                }
            }catch(\Throwable $th){
                echo $th->getMessage();
            }
            return $resultado;
        }

        public function obtenerPrueba($prueba){
            $resultado = null;
            try{
                $consulta = $this->conexion->prepare('SELECT * from prueba where id=?');
                $params = array($prueba);
                if($consulta->execute($params)){
                    if($fila = $consulta->fetch()){
                        $resultado = new Prueba($fila['id'],$fila['modalidad'],$fila['fecha'],$fila['descripcion'],$fila['puntuacion']);
                    }
                }
            }catch(\Throwable $th){
                echo $th->getMessage();
            }
            return $resultado;
        }

        public function obtenerCorreccion($prueba,$alumno){
            $resultado = null;
            try{
                $consulta = $this->conexion->prepare('SELECT * from correccion where prueba=? and alumno=?');
                $params = array($prueba,$alumno);
                if($consulta->execute($params)){
                    if($fila = $consulta->fetch()){
                        $resultado = new Correccion($fila['alumno'],$fila['prueba'],$fila['puntos'],$fila['comentario']);
                    }
                }
            }catch(\Throwable $th){
                echo $th->getMessage();
            }
            return $resultado;
        }

        public function realizarCorrecion($idAlumno,$idPrueba,$puntos,$comentario){
            $resultado = false;
            try{
                $this->conexion->beginTransaction();
                $consulta = $this->conexion->prepare('INSERT into correccion values
                (?,?,?,?)');
                $params = array($idAlumno,$idPrueba,$puntos,$comentario);
                if($consulta->execute($params)){
                    if($consulta->rowCount() == 1){
                        $consulta = $this->conexion->prepare('UPDATE alumno set puntuacion=
                        (puntuacion+?) where id=?');
                        $params = array($puntos,$idAlumno);
                        if($consulta->execute($params) and $consulta->rowCount()==1){
                            $this->conexion->commit();
                            $resultado=true;
                        }
                        else{
                            $this->conexion->rollBack();
                        }
                    }
                }
            }catch (PDOException $e) {
                $this->conexion->rollBack();
                echo $e->getMessage();
            }catch (\Throwable $th) {
                echo $th->getMessage();
            }
            return $resultado;
        }

        public function obtenerCorrecionesAlumno($idAlumno){
            $resultado = array();
            try{
                $consulta = $this->conexion->prepare('SELECT * from correccion where alumno=?');
                $params = array($idAlumno);
                if($consulta->execute($params)){
                    while($fila = $consulta->fetch()){
                        $resultado [] = new Correccion($fila['alumno'],$fila['prueba'],$fila['puntos'],$fila['comentario']);
                    }
                }
            }catch(\Throwable $th){
                echo $th->getMessage();
            }
            return $resultado;
        }

        public function finalizarCorreciones($idAlumno){
            $resultado=false;
            try {     
                $consulta=$this->conexion->prepare('UPDATE alumno set finalizado=true where id = ?');
                $params=array($idAlumno); 
                if($consulta->execute($params)){
                    $resultado=true;
                }
            }
            catch (\PDOException $e) {
                echo $e->getMessage();
            }
            catch (\Throwable $th) {
                echo $th->getMessage();
            }
            return $resultado;
        }

        public function obtenerGanadores(){
            $resultado = array();
            try {
                $consulta = $this->conexion->prepare('CALL obtenerGanadores()');
                if ($consulta->execute()) {
                    while ($fila = $consulta->fetch()) {
                        $resultado[] = array($fila[0],$fila[1],$fila[2]);
                    }
                }
            } catch (\Throwable $th) {
                //throw $th;
                echo $th->getMessage();
            }
            return $resultado;  
        }

    }

?>