<?php

require_once 'Modelo.php';

$bd = new Modelo();

session_start();

if(isset($_POST['cambiar'])){
    session_destroy();
    header('location:mcDaw.php');
}

if(isset($_POST['selTienda'])){
    $codigoTienda = $_POST['tienda'];
    $tienda = $bd->obtenerTiendaCodigo($codigoTienda);
    $_SESSION['tienda'] = $tienda;
}


if(isset($_POST['agregar'])){
    if($_POST['cantidad'] < 1){
        $error = 'Error. La cantidad no puede ser inferior a uno';
    }else{
        if(!isset($_SESSION['carrito'])){
            $productoCodigo = $_POST['producto'];
            $producto = $bd->obtenerProductoCodigo($productoCodigo);
            $cantidad = $_POST['cantidad'];

            $pc = new ProductoEnCesta($producto,$cantidad);

            $_SESSION['carrito'] = array($pc);
        }else{
            $productoCodigo = $_POST['producto'];
            $producto = $bd->obtenerProductoCodigo($productoCodigo);
            $cantidad = $_POST['cantidad'];

            $pc = new ProductoEnCesta($producto,$cantidad);

            $_SESSION['carrito'][] = $pc;
        }
    }
}

if(isset($_POST['crearPedido'])){
    if(empty($_SESSION['carrito'])){
        $error = 'La cesta no puede estar vacia';
    }else{
        if($bd->aniadirPedido($_SESSION['carrito'])){
            session_destroy();
            $datos  = $bd->generarMensaje($bd->obtenerCodigoUltimoPedido());
            $error = 'Pedido n '.$datos[0].' El numero de productos '.$datos[1].' El importe total es '.$datos[2].'euros' ;
        }else{
            $error = 'amai';
        }
    }
}

?>