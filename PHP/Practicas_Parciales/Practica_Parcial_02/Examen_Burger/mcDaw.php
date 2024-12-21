<?php
require_once 'controlador.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <h1 style='color:red;'>Mensajes</h1>
    </div>
    <form action="mcDaw.php" method="post">
        <?php
            if(!isset($_SESSION['tienda'])){
        ?>
        <div>
            <h1 style='color:blue;'>Tienda</h1>
            <label for="tienda">Tienda</label><br />
            <select name="tienda">
                <?php
                    $tiendas = $bd->obtenerTiendas();
                    foreach ($tiendas as $t) {
                        echo '<option value="' . $t->getCodigo() . '">'
                            . $t->getNombre() . '</option>';
                    }
                ?>
            </select>
            <button type="submit" name="selTienda">Seleccionar tienda</button>
        </div>
        <?php
            }
        ?>

        <?php
            if(isset($_SESSION['tienda'])){
        ?>
        <div>
            <h1 style='color:blue;'>Añade productos a la cesta</h1>
            <h2 style='color:green;'>Datos Tienda: <?php echo $_SESSION['tienda']->getNombre() .' - '. $_SESSION['tienda']->getTelefono() ?> 
                <button type="submit" name="cambiar">Cambiar Tienda</button>
            </h2>
            <table>
                <tr>
                    <td><label for="producto">Producto</label><br /></td>
                    <td><label for="cantidad">Cantidad</label><br /></td>
                    <td>Añadir a la cesta</td>
                </tr>
                <tr>
                    <td>
                        <select id="producto" name="producto">
                        <?php
                            $productos = $bd->obtenerProductos();
                            foreach ($productos as $p) {
                                echo '<option value="' . $p->getCodigo() . '">'
                                    . $p->getNombre().'-'.$p->getPrecio() . '</option>';
                            }
                        ?>
                        </select>
                    </td>
                    <td><input id="cantidad" type="number" name="cantidad" value="1"/></td>
                    <td><button type="submit" name="agregar">+</button></td>
                </tr>
            </table>
            <div>
                <!-- ÁREA DE ERRORES -->
                <?php
                if (isset($error)) {
                    echo $error;
                }
                ?>
            </div>            
        </div>
        <div>
            <h1 style='color:blue;'>Contenido de la cesta</h1>
            <table  border="1"  rules="all"  width="25%">
                <tr>
                    <td><b>Producto</b></td>
                    <td><b>Cantidad</b></td>
                    <td><b>Precio</b></td>
                </tr>
                <?php
                if(isset($_SESSION['carrito'])){
                    foreach ($_SESSION['carrito'] as $producto) {
                        echo '<tr>';
                        echo '<td>'. $producto->getProducto()->getNombre() .'</td>'; 
                        echo '<td>'. $producto->getCantidad() .'</td>';
                        echo '<td>'. $producto->getProducto()->getPrecio() .'</td>';
                        echo '</tr>';
                    }
                }
                ?>
            </table>   
            <button type="submit" name="crearPedido">Crear Pedido</button>         
        </div>
        <?php
            }
        ?>
    </form>
</body>
</html>