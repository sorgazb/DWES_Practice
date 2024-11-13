<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <h1>CREACION DE ESTANCIA</h1>
    <form action="" method="post">
        <div>
            <label for="dni">DNI:</label><br>
            <input type="text" name="dni" id="dni">
        </div>
        <div>
            <label for="nombreCliente">Nombre Cliente:</label><br>
            <input type="text" name="nombreCliente" id="nombreCliente">
        </div>
        <div>
            <label for="tipoHabitacion">Tipo Habitacion:</label><br>
            <select name="tipoHabitacion" id="tipoHabitacion">
                <option selected="selected">Doble</option>
                <option>Individual</option>
                <option>Suite</option>
            </select>
        </div>
        <div>
            <label for="numNoches">Numero de Noches:</label><br>
            <input type="number" name="numNoches" id="numNoches">
        </div>
        <div>
        <label for="estancia">Estancia:</label><br>
            <select name="estancia" id="estancia">
                <option selected="selected">Diario</option>
                <option>Fin de Semana</option>
                <option>Promocionado</option>
            </select>
        </div>
        <div>
            <label>Pago:</label><br>
            <label for="efectivo">Efectivo</label>
            <input type="radio" name="pago" id="efectivo" value="Efectivo">
            <label for="tarjeta">Tarjerta</label>
            <input type="radio" name="pago" id="tarjeta" value="Tarjerta" checked="checked">
        </div>
        <div>
            <label>Opciones:</label><br>
            <label for="cuna">Cuna</label>
            <input type="checkbox" name="cuna" id="cuna" value="Cuna">
            <label for="camaSupletoria">Cama Supletoria</label>
            <input type="checkbox" name="camaSupletoria" id="camaSupletoria" value="Cama Supletoria">
            <label for="lavanderia">Lavanderia</label>
            <input type="checkbox" name="lavanderia" id="lavanderia" value="Lavanderia">
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