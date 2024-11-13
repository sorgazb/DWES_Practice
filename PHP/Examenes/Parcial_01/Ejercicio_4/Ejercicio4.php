<?php

require_once 'accesoDatos.php';
// Creamos una instancia de acceso a datos
$ad = new AccesoDatos('tintoreria.dat');


    // Recordamos todos los datos establecidos en el fichero
    $fechaEntrada = (isset($_POST['fechaEntrada']) ? $_POST['fechaEntrada'] : date(('Y-m-d')));
    $nombreCliente = (isset($_POST['nombreCliente']) ? $_POST['nombreCliente'] : '');
    $importe = (isset($_POST['importe']) ? $_POST['importe'] : '');

    // Funcion que nos permite recordar el ultimo elemento seleccionado de la lista de Tipos de Prendas
    function comprobarSelect($opcion){
        if(!isset($_POST['tipoPrenda']) and $opcion == 'Textil'){ // Tiene que tener valor por defecto Textil
            return 'selected="selected"';
        }if(isset($_POST['tipoPrenda']) and $_POST['tipoPrenda'] == $opcion){
            return 'selected="selected"';
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>

<body>
    <h1>Tintoreria La Morada</h1>

    <fieldset>
        <legend>Registrar Trabajo</legend>
        <form action="" method="post">
            <!-- Con este div trataremos el input de fecha -->
            <div>
                <label for="fechaEntrada">Fecha de Entrada</label><br>
                <input type="date" id="fechaEntrada" name="fechaEntrada" value="<?php echo $fechaEntrada ?>" />
            </div>
            <!-- Con este div tratamos el input del Nombre Cliente -->
            <div>
                <label for="nombreCliente">Cliente</label><br>
                <input type="text" name="nombreCliente" id="nombreCliente" placeholder="Introduce Nombre Cliente" value="<?php echo $nombreCliente ?>">
            </div>
            <!-- Con este div tratamos el input de Tipo de Prenda -->
            <div>
                <label for="tipoPrenda">Tipo de Prenda</label><br>
                <select name="tipoPrenda" id="tipoPrenda">
                    <option <?php echo comprobarSelect('Textil')?>>Textil</option>
                    <option <?php echo comprobarSelect('Fiesta')?>>Fiesta</option>
                    <option <?php echo comprobarSelect('Cuero')?>>Cuero</option>
                    <option <?php echo comprobarSelect('Hogar')?>>Hogar</option>
                </select>
            </div>
            <!-- Con este div tratamos el input de Servicio -->
            <div>
                <label>Servicio</label><br>
                <label for="limpieza">Limpieza</label>
                <input type="checkbox" name="limpieza" id="limpieza" value="Limpieza">
                <label for="planchado">Planchado</label>
                <input type="checkbox" name="planchado" id="planchado" value="Planchado">
                <label for="desmanchado">Desmanchado</label>
                <input type="checkbox" name="desmanchado" id="desmanchado" value="Desmanchado">
            </div>
            <!-- Con este div tratamos el input de Importe -->
            <div>
                <label for="importe">Importe</label><br>
                <input type="number" name="importe" id="importe" placeholder="Introduce el importe" value="<?php echo $importe ?>">
            </div>
            <input type="submit" name="guardar" value="Guardar">
        </form>
    </fieldset>

    <?php


        if(isset($_POST['guardar'])){

            // Variable booleana que nos infroma si el formulario cumple las validaciones establecidad
            $datosCorrectos = true;

            // Comprobamos que los campos de fecha, nombreCliente, tipoPrenda e importe no esten vacios
            if(empty($_POST['fechaEntrada'])){
                $datosCorrectos = false;
                echo '<h3>Error. El campo Fecha Entrada no puede estar vacio.</h3>';
            }
            if(empty($_POST['nombreCliente'])){
                $datosCorrectos = false;
                echo '<h3>Error. El campo Nombre Cliente no puede estar vacio.</h3>';

            }if(empty($_POST['importe'])){
                $datosCorrectos = false;
                echo '<h3>Error. El campo Importe no puede estar vacio.</h3>';
            }if(empty($_POST['tipoPrenda'])){
                $datosCorrectos = false;
                echo '<h3>Error. El campo Tipo de Prenda no puede estar vacio.</h3>';
            }

            // Comprobamos que al menos uno de los servicios este marcado
            if(!isset($_POST['limpieza']) and !isset($_POST['planchado']) and !isset($_POST['desmanchado'])){
                $datosCorrectos = false;
                echo '<h3>Error. Al menos un servicio debe estar marcado.</h3>';
            }

            // Hacemos la comprobacion de que las prendas de Cuero no pueden ser planchadas
            if(isset($_POST['planchado']) and $_POST['tipoPrenda'] == 'Cuero'){
                $datosCorrectos = false;
                echo '<h3>Error. El Servicio de Planchado no está disponible para las prendas de Cuero.</h3>';
            }

            // Si el importe no esta vacio y la prenda es de Fiesta el importe debe ser como minimo de 50€
            if(!empty($_POST['importe'])){
                if($_POST['tipoPrenda'] == 'Fiesta' and $_POST['importe'] < 50){
                    $datosCorrectos = false;
                    echo '<h3>Error. Para las Prendas de Fiesta el importe minimo es de 50€</h3>';
                }
            }

            // Si todos los datos son correctos mostramos al Usuario el mensaje confirmando el Servicio.
            if($datosCorrectos == true){
                $prenda = $_POST['tipoPrenda'];
                $cadenaServicios = implode('/',generarListadoServicios());
                echo '<h3>Datos Correctos</h3>';
                echo "<h3>Prenda: $prenda</h3>";
                echo "<h3>Servicio: $cadenaServicios</h3>";
                $fecha = date("d/m/Y",strtotime($fechaEntrada));
                $t = new Trabajo($fecha,$nombreCliente,$prenda,$cadenaServicios,$importe);
                $ad->insertarTrabajo($t);
            }

        }

        $trabajos = $ad->obtenerTrabajos();
        echo '<h3>Trabajos</h3>';
        echo '<table border="1px">';
        echo '<tr><th>Fecha Entrada</th><th>Nombre Cliente</th><th>Tipo Prenda</th><th>Servicios</th><th>Importe</th></tr>';
        foreach ($trabajos as $t) {
            echo '<tr>';
            echo '<td>' . $t->getFechaEntrada() . '</td>';
            echo '<td>' . $t->getCliente() . '</td>';
            echo '<td>' . $t->getTipoPrenda() . '</td>';
            echo '<td>' . $t->getServicio() . '</td>';
            echo '<td>' . $t->getImporte() . '</td>';
            echo '</tr>';
        }   
        echo '</table>';

        // Funcion que nos devuelve un array en el que apareceran los servicos que ha solicitado el Cliente
        function generarListadoServicios(){
            $arrayServicios = array();
            if(isset($_POST['limpieza'])){
                $arrayServicios["limpieza"] = "Limpieza";
            }if(isset($_POST['planchado'])){
                $arrayServicios["planchado"] = "Planchado";
            }if(isset($_POST['desmanchado'])){
                $arrayServicios["desmanchado"] = "Desmanchado";
            }
            return $arrayServicios;
        }


    ?>
</body>

</html>