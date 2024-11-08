<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <h1>Tintoreria La Morada</h1>

    <fieldset>
        <legend>Registrar Trabajo</legend>
        <form action="" method="post">
            <!-- Con este div trataremos el input de fecha -->
            <div>
                <label for="fechaEntrada">Fecha de Entrada</label><br>
                <input type="date" id="fechaEntrada" name="fechaEntrada" value="<?php echo date(('Y-m-d')); ?>" />
            </div>
            <!-- Con este div tratamos el input del Nombre Cliente -->
            <div>
                <label for="nombreCliente">Cliente</label><br>
                <input type="text" name="nombreCliente" id="nombreCliente" placeholder="Introduce Nombre Cliente">
            </div>
            <!-- Con este div tratamos el input de Tipo de Prenda -->
            <div>
                <label for="tipoPrenda">Tipo de Prenda</label><br>
                <select name="tipoPrenda" id="tipoPrenda">
                    <option selected="selected">Textil</option>
                    <option>Fiesta</option>
                    <option>Cuero</option>
                    <option>Hogar</option>
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
                <input type="number" name="importe" id="importe" placeholder="Introduce el importe">
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
            }
        }

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