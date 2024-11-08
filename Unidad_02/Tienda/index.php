<?php
require_once 'accesoDatos.php';

// Creamos una instancia de acceso a datos
$ad = new AccesoDatos('ticket.txt');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1 style="color: lawngreen;">Mi Tienda PHP</h1>
    <form action="#" method="post">
        <div>
            <label for="produc">Seleccion de Productos</label><br>
            <select name="produc" id="produc">
                <option>Sandia-3</option>
                <option>Mandarina-1</option>
                <option>Naranja-1</option>
                <option>Melon-4</option>
                <option>Tomate-2</option>
                <option>Kiwi-2</option>
                <option>Pera-8</option>
                <option>Manzana-2</option>
            </select>
        </div>

        <div>
            <label for="cantidad">Cantidad</label><br>
            <input type="number" id="cantidad" name="cantidad" value="1">
        </div>

        <input type="submit" name="aniadir" value="Añadir" />
    </form>

    <?php
    if(isset($_POST['aniadir'])){
        $datosProductos = explode('-',$_POST['produc']);
        $t = new Ticket($datosProductos[0],$datosProductos[1],$_POST['cantidad']);

        // Introducir el ticket en la venta
        $ad->insertarProducto($t);

        echo '<h3>Productos</h3>';
        echo '<table border="1px">';
        echo '<tr><th>Productos</th><th>Precio Unidad</th><th>Cantidad</th><th>Total</th></tr>';

        

        $productos = $ad->obtenerProducto();
        foreach($productos as $p){
            echo '<tr>';
            echo '<td>'.$p->getProducto().'</td>';
            echo '<td>'.$p->getPrecioUni().'</td>';
            echo '<td>'.$p->getCantidad().'</td>';
            echo '<td>'.$p->getTotal().'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    ?>
</body>

</html>