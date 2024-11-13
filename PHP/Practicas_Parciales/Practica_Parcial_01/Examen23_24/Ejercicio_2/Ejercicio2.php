<?php
    $dni = (isset($_POST['dni']) ? $_POST['dni'] : '');
    $nombreCliente = (isset($_POST['nombreCliente']) ? $_POST['nombreCliente'] : '');
    $numNoches = (isset($_POST['numNoches']) ? $_POST['numNoches'] : '');

    function comprobarSelectTipoHabitacion($opcion){
        if(!isset($_POST['tipoHabitacion']) and $opcion == 'Doble'){ // Tiene que tener valor por defecto Doble
            return 'selected="selected"';
        }if(isset($_POST['tipoHabitacion']) and $_POST['tipoHabitacion'] == $opcion){
            return 'selected="selected"';
        }
    }

    function comprobarSelectTipoEstancia($opcion){
        if(!isset($_POST['tipoHabitacion']) and $opcion == 'Diario'){ // Tiene que tener valor por defecto Diario
            return 'selected="selected"';
        }if(isset($_POST['tipoHabitacion']) and $_POST['tipoHabitacion'] == $opcion){
            return 'selected="selected"';
        }
    }

    function comprobarCheckBox($opcion){
        if(isset($_POST['cuna']) and $_POST['cuna'] == $opcion){
            return 'checked="checked"';
        }if(isset($_POST['camaSupletoria']) and $_POST['camaSupletoria'] == $opcion){
            return 'checked="checked"';
        }if(isset($_POST['lavanderia']) and $_POST['lavanderia'] == $opcion){
            return 'checked="checked"';
        }
    }

    function comprobarCheck($opcion){
        if(!isset($_POST['pago']) and $opcion == 'Tarjeta'){ // Tiene que tener valor por defecto Tarjeta
            return 'checked="checked"';
        }if(isset($_POST['pago']) and $_POST['pago'] == $opcion){
            return 'checked="checked"';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <h1>CREACION DE ESTANCIA</h1>
    <form action="" method="post">
        <div>
            <label for="dni">DNI:</label><br>
            <input type="text" name="dni" id="dni" value="<?php echo $dni ?>">
        </div>
        <div>
            <label for="nombreCliente">Nombre Cliente:</label><br>
            <input type="text" name="nombreCliente" id="nombreCliente" value="<?php echo $nombreCliente ?>">
        </div>
        <div>
            <label for="tipoHabitacion">Tipo Habitacion:</label><br>
            <select name="tipoHabitacion" id="tipoHabitacion">
                <option <?php echo comprobarSelectTipoHabitacion('Doble')?>>Doble</option>
                <option <?php echo comprobarSelectTipoHabitacion('Individual')?>>Individual</option>
                <option <?php echo comprobarSelectTipoHabitacion('Suite')?>>Suite</option>
            </select>
        </div>
        <div>
            <label for="numNoches">Numero de Noches:</label><br>
            <input type="number" name="numNoches" id="numNoches" value="<?php echo $numNoches ?>">
        </div>
        <div>
        <label for="estancia">Estancia:</label><br>
            <select name="estancia" id="estancia">
                <option <?php echo comprobarSelectTipoEstancia('Diario')?>>Diario</option>
                <option <?php echo comprobarSelectTipoEstancia('Fin de Semana')?>>Fin de Semana</option>
                <option <?php echo comprobarSelectTipoEstancia('Promocionado')?>>Promocionado</option>
            </select>
        </div>
        <div>
            <label>Pago:</label><br>
            <label for="efectivo">Efectivo</label>
            <input type="radio" name="pago" id="efectivo" value="Efectivo" <?php echo comprobarCheck('Efectivo')?>>
            <label for="tarjeta">Tarjerta</label>
            <input type="radio" name="pago" id="tarjeta" value="Tarjeta" <?php echo comprobarCheck('Tarjeta')?>>
        </div>
        <div>
            <label>Opciones:</label><br>
            <label for="cuna">Cuna</label>
            <input type="checkbox" name="cuna" id="cuna" value="Cuna" <?php echo comprobarCheckBox('Cuna')?>>
            <label for="camaSupletoria">Cama Supletoria</label>
            <input type="checkbox" name="camaSupletoria" id="camaSupletoria" value="Cama Supletoria" <?php echo comprobarCheckBox('Cama Supletoria')?>>
            <label for="lavanderia">Lavanderia</label>
            <input type="checkbox" name="lavanderia" id="lavanderia" value="Lavanderia" <?php echo comprobarCheckBox('Lavanderia')?>>
        </div>
        <input type="submit" name="crear" value="Crear Estancia"/>
        <input type="submit" name="ver" value="Ver Estancias"/>
    </form>
    <?php
        if(isset($_POST['crear'])){

            $datosCorrectos = true;

            if(empty($_POST['dni'])){
                $datosCorrectos = false;
                echo '<h3>Error. El campo DNI Cliente no puede estar vacio.</h3>';
            }
            if(empty($_POST['nombreCliente'])){
                $datosCorrectos = false;
                echo '<h3>Error. El campo Nombre Cliente no puede estar vacio.</h3>';

            }if(empty($_POST['numNoches'])){
                $datosCorrectos = false;
                echo '<h3>Error. El campo Numero Noches no puede estar vacio.</h3>';
            }

            if($_POST['pago'] == 'Efectivo' and $_POST['numNoches'] > 2){
                $datosCorrectos = false;
                echo '<h3>Error. El pago en Efectivo no se puede utilizar cuando la estancia es superior a 2 noches.</h3>';
            }

            if(isset($_POST['cuna']) and isset($_POST['camaSupletoria'])){
                $datosCorrectos = false;
                echo '<h3>Error. No se pueden incluir cuna y cama supletoria en la misma habitacion.</h3>';
            }

            if($datosCorrectos == true){
                $precioHabitacion = obtenerPrecioEstancia();
                echo "<h3>Entrada correcta. El importee de esta estancia es de $precioHabitacion</h3>";
            }
        }

        function obtenerPrecioEstancia(){
            $precioFinal = 0;
            $porcentaje = 1;
            if($_POST['estancia'] == 'Fin de Semana'){
                $porcentaje = 1.10;
            }if($_POST['estancia'] == 'Promocionado'){
                $porcentaje = 0.9;
            }

            if($_POST['tipoHabitacion'] == 'Individual'){
                $precioFinal = (45 * $_POST['numNoches']) * $porcentaje;
            }if($_POST['tipoHabitacion'] == 'Doble'){
                $precioFinal = (55 * $_POST['numNoches']) * $porcentaje;
            }if($_POST['tipoHabitacion'] == 'Suite'){
                $precioFinal = (75 * $_POST['numNoches']) * $porcentaje;
            }
            return $precioFinal;

        }
    ?>
</body>
</html>