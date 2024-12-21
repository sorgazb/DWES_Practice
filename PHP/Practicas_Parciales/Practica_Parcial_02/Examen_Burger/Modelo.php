<?php

require_once 'Producto.php';
require_once 'ProductoEnCesta.php';
require_once 'Tienda.php';

class Modelo{

    private $conexion=null;

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

    /**
     * Get the value of conexion
     */ 
    public function getConexion(){
        return $this->conexion;
    }

    /**
     * Set the value of conexion
     *
     * @return  self
     */ 
    public function setConexion($conexion){
        $this->conexion = $conexion;
        return $this;
    }

    public function obtenerTiendas(){
        $resultado = array();
        try{
            $textoConsulta = 'SELECT * from tienda';
            $consulta = $this->conexion->query($textoConsulta);
            if($consulta){
                while($fila = $consulta->fetch()){
                    $resultado [] = new Tienda($fila['codigo'],$fila['nombre'],$fila['telefono']);
                }
            }
        }catch(\Throwable $th){
            echo $th->getMessage();
        }
        return $resultado;
    }

    public function obtenerTiendaCodigo($codigo){
        $resultado = null;
        try{
            $textoConsulta = 'SELECT * from tienda where codigo=?';
            $consulta = $this->conexion->prepare($textoConsulta);
            $params = array($codigo);
            if($consulta->execute($params)){
                if($fila = $consulta->fetch()){
                    $resultado = new Tienda($fila['codigo'],$fila['nombre'],$fila['telefono']);
                }
            }
        }catch(\Throwable $th){
            echo $th->getMessage();
        }
        return $resultado;
    }

    public function obtenerProductos(){
        $resultado = array();
        try{
            $textoConsulta = 'SELECT * from producto';
            $consulta = $this->conexion->query($textoConsulta);
            if($consulta){
                while($fila = $consulta->fetch()){
                    $resultado [] = new Producto($fila['codigo'],$fila['nombre'],$fila['precio']);
                }
            }
        }catch(\Throwable $th){
            echo $th->getMessage();
        }
        return $resultado;
    }

    public function obtenerProductoCodigo($codigo){
        $resultado = null;
        try{
            $textoConsulta = 'SELECT * from producto where codigo=?';
            $consulta = $this->conexion->prepare($textoConsulta);
            $params = array($codigo);
            if($consulta->execute($params)){
                if($fila = $consulta->fetch()){
                    $resultado = new Producto($fila['codigo'],$fila['nombre'],$fila['precio']);
                }
            }
        }catch(\Throwable $th){
            echo $th->getMessage();
        }
        return $resultado;
    }

    public function aniadirPedido($carrito){
        $resultado = false;
        $linea = 1;
        try{
            $this->conexion->beginTransaction();

            $consulta = $this->conexion->prepare('INSERT into pedido values(null,curdate(),?)');
            $params = array($_SESSION['tienda']->getCodigo());
            if($consulta->execute($params) and $consulta->rowCount()==1){
                foreach($carrito as $producto){
                    $consulta = $this->conexion->prepare('INSERT into detalle values(?,
                    (SELECT max(codigo) from pedido),
                    ?,?,?)');
                    $params = array($linea,$producto->getProducto()->getCodigo(),$producto->getCantidad(),$producto->getProducto()->getPrecio());
                    $linea ++;
                    if($consulta->execute($params) and $consulta->rowCount()==1){
                    }
                    else{
                        $this->conexion->rollBack();
                    }
                }
                $this->conexion->commit();
                $resultado=true;
            }
        }
        catch (\PDOException $e) {
            $this->conexion->rollBack();
            echo $e->getMessage();
        }
        catch (\Throwable $th) {
            echo $th->getMessage();
        }
        return $resultado;
    }

    public function obtenerCodigoUltimoPedido(){
        $resultado = null;
        try{
            $textoConsulta = 'SELECT max(codigo) from pedido';
            $consulta = $this->conexion->query($textoConsulta);
            if($consulta){
                if($fila = $consulta->fetch()){
                    $resultado = $fila[0];
                }
            }
        }catch(\Throwable $th){
            echo $th->getMessage();
        }
        return $resultado;
    }

    public function generarMensaje($codigo){
        $resultado = array();
        try{
            $consulta = $this->conexion->prepare('CALL datosPedido(?)');
            $params = array($codigo);
            if($consulta->execute($params)){
                // Tratamos el primer select del procedimiento
                if($fila = $consulta->fetch()){
                    $resultado [] = $fila[0];
                    $resultado [] = $fila[1];
                    $resultado [] = $fila[2];
                }
            }
        }catch(\Throwable $th){
            echo $th->getMessage();
        }

        return $resultado;
    }

}

?>