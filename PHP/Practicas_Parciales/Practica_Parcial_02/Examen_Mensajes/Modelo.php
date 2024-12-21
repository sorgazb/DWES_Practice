<?php
    require_once 'Empleado.php';
    require_once 'Mensaje.php';
    require_once 'Departamento.php';

    class Modelo{

        private $conexion = null;
    
        public function __construct(){
            try {
                $config = $this->obtenerDatos();
                if($config!=null){
                    //Establecer conexión con la bd
                    $this->conexion = new PDO('mysql:host='.$config['urlBD'].
                                    ';port='.$config['puerto'].';dbname='.$config['nombreBD'],
                        $config['usBD'],
                        $config['psUS']);
                }
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        }
    
        private function obtenerDatos(){
            $resultado = array();
            if(file_exists('.config')){
                $datosF = file('.config',FILE_IGNORE_NEW_LINES);
                foreach($datosF as $linea){
                    $campos = explode('=',$linea);
                    $resultado[$campos[0]] = $campos[1];
                }
            }
            else{
                return null;
            }
            return $resultado;
        }

        public function getConexion(){
            return $this->conexion;
        }

        public function setConexion($conexion){
            $this->conexion = $conexion;
            return $this;
        }

        public function hacerLogin($usuario,$password){
            $resultado = 'Ok';
            try{
                $consulta = $this->conexion->prepare('SELECT login(?,?)');
                $params = array($usuario,$password);
                if($consulta->execute($params)){
                    if($fila = $consulta->fetch()){
                        $codigo = $fila[0];
                        if($codigo == 0){
                            $resultado = 'Error. El usuario o la Contraseña no coinciden';
                        }
                    }
                }
            }catch (\Throwable $th) {
                echo $th->getMessage();
            }
            return $resultado;
        }

        public function obtenerUsuarioConcreto($usuario,$password){
            $resultado = null;
            try{
                $consulta = $this->conexion->prepare('SELECT * from empleado where idEmp=? and dni=?');
                $params = array($usuario,$password);
                if($consulta->execute($params)){
                    if($fila = $consulta->fetch()){
                        $resultado = new Empleado($fila['idEmp'],$fila['dni'],$fila['nombreEmp'],$fila['$fechaNac'],$fila['departamento'],$fila['$cambiarPs']);
                    }
                }
            }catch(\Throwable $th){
                echo $th->getMessage();
            }
            return $resultado;
        }

        public function obtenerDepartamentoConcreto($id){
            $resultado = null;
            try{
                $consulta = $this->conexion->prepare('SELECT * from departamento where idDep=?');
                $params = array($id);
                if($consulta->execute($params)){
                    if($fila = $consulta->fetch()){
                        $resultado = new Departamento($fila['idDep'],$fila['nombre']);
                    }
                }
            }catch(\Throwable $th){
                echo $th->getMessage();
            }
            return $resultado;
        }

        public function obtenerDepartamentos(){
            $resultado = array();
            try{
                $textoConsulta = 'SELECT * from departamento';
                $consulta = $this->conexion->query($textoConsulta);
                if($consulta){
                    while($fila = $consulta->fetch()){
                        $resultado [] = new Departamento($fila['idDep'],$fila['nombre']);
                    }
                }
            }catch(\Throwable $th){
                echo $th->getMessage();
            }
            return $resultado;
        }

        public function mandarMensaje($idEmpleado,$idDepartamento,$asunto,$mensaje,$empleadosDepartamento){
            $resultado = false;
            try{
                $this->conexion->beginTransaction();

                $consulta = $this->conexion->prepare('INSERT into mensaje values(default,?,?,?,curdate(),?)');
                $params = array($idEmpleado,$idDepartamento,$asunto,$mensaje);
                if($consulta->execute($params) and $consulta->rowCount() == 1){
                    $idMensaje = $this->conexion->lastInsertId();
                    foreach ($empleadosDepartamento as $empleado) {
                        $consulta = $this->conexion->prepare('INSERT into para values(?,?,false)');
                        $params = array($idMensaje,$empleado->getIdEmp());
                        if($consulta->execute($params) and $consulta->rowCount() == 1){

                        }else{
                            $this->conexion->rollBack();
                        }
                    }
                    $this->conexion->commit();
                    $resultado = true;
                }
            }catch (\PDOException $e) {
                $this->conexion->rollBack();
                echo $e->getMessage();
            }catch (\Throwable $th) {
                echo $th->getMessage();
            }
            return $resultado;
        }

        public function obtenerEmpleadosDepartamento($idDepartamento){
            $resultado = array();
            try{
                $textoConsulta = 'SELECT * from empleado where departamento=?';
                $consulta = $this->conexion->prepare($textoConsulta);
                $params = array($idDepartamento);
                if($consulta->execute($params)){
                    while($fila = $consulta->fetch()){
                        $resultado [] = new Empleado($fila['idEmp'],$fila['dni'],$fila['nombreEmp'],$fila['fechaNac'],$fila['departamento'],$fila['cambiarPs']);
                    }
                }
            }catch(\Throwable $th){
                echo $th->getMessage();
            }
            return $resultado;
        }

        public function obtenerMensajesEnviados($idEmpleado){
            $resultado = array();
            try{
                $textoConsulta = 'SELECT * from mensaje where deEmpleado=?';
                $consulta = $this->conexion->prepare($textoConsulta);
                $params = array($idEmpleado);
                if($consulta->execute($params)){
                    while($fila = $consulta->fetch()){
                        $resultado [] = new Mensaje($fila['idMen'],$fila['deEmpleado'],$fila['paraDepartamento'],$fila['asunto'],$fila['fechaEnvio'],$fila['mensaje']);
                    }
                }
            }catch(\Throwable $th){
                echo $th->getMessage();
            }
            return $resultado;
        }

        function obtenerMensajesRecidos($empleado){
            $resultado = array();
            try{
                $consulta = $this->conexion->prepare(
                    'SELECT * 
                        from para as p 
                        inner join mensaje as m using(idMen)
                        inner join empleado as e on m.deEmpleado = e.idEmp 
                        inner join departamento as d on m.paraDepartamento = d.idDep
                        where p.paraEmpleado = ?');
                $params = array($empleado);
                if($consulta->execute($params)){
                    while($fila=$consulta->fetch()){
                        $m = new Mensaje($fila['idMen'],
                        new Empleado($fila['idEmp'],$fila['dni'],$fila['nombreEmp'],
                            $fila['fechaNac'],$fila['departamento'],$fila['cambiarPs']),
                        new Departamento($fila['paraDepartamento'],
                        
                                                    $fila['nombre']),
                        $fila['asunto'],$fila['fechaEnvio'],$fila['mensaje']);
                        $resultado[]=$m;
                    }
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return $resultado;
        }
    
    }
?>