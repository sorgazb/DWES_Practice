<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Ejercicio 1</title>
</head>
<body>
    <?php
        if(isset($_POST['enviar'])){
            $datosCliente = array();

            $datosCliente["TipoCliente"] = $_POST['tipoCliente'];
            $datosCliente["NombreCliente"] = $_POST['nombreCliente'];
            $datosCliente["Email"] = $_POST['email'];
            $datosCliente["Motor"] = $_POST['tipoMotor'];

            if(isset($_POST['climatizador'])){
                $datosCliente["Climatizador"] = 1;
            }
            if(isset($_POST['gps'])){
                $datosCliente["GPS"] = 1;
            }
            if(isset($_POST['camara'])){
                $datosCliente["Camara"] = 1;
            }

            $datosCliente["Coche"] = $_POST['vehiculo'];
            $datosCliente["Precio"] = $_POST['precio'];
            $datosCliente["Promocion"] = $_POST['promocion'];
        }
    ?>
    <table border="1px solid">
        <?php
            foreach ($datosCliente as $dato => $valor) {
                echo '<tr>';
                echo "<th>$dato</th>";
                echo "<td>$valor</td>";
                echo '</tr>';
            }
            ?>
    </table>
</body>
</html>