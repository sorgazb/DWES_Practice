<?php
    $nombreCliente = (isset($_POST['nombreCliente']) ? $_POST['nombreCliente'] : '');
    $email = (isset($_POST['email']) ? $_POST['email'] : '');
    $precio = (isset($_POST['precio']) ? $_POST['precio'] : '');

    function comprobarSelectTipoCliente($opcion){
        if(!isset($_POST['tipoCliente']) and $opcion == 'Empresa'){ // Tiene que tener valor por defecto Empresa
            return 'selected="selected"';
        }if(isset($_POST['tipoCliente']) and $_POST['tipoCliente'] == $opcion){
            return 'selected="selected"';
        }
    }

    function comprobarCheckBox($opcion){
        if(isset($_POST['climatizador']) and $_POST['climatizador'] == $opcion){
            return 'checked="checked"';
        }if(isset($_POST['gps']) and $_POST['gps'] == $opcion){
            return 'checked="checked"';
        }if(isset($_POST['camara']) and $_POST['camara'] == $opcion){
            return 'checked="checked"';
        }
    }

    function comprobarCheckMotor($opcion){
        if(isset($_POST['tipoMotor']) and $_POST['tipoMotor'] == $opcion){
            return 'checked="checked"';
        }
    }

    function comprobarSelectVehiculo($opcion){
        if(!isset($_POST['vehiculo']) and $opcion == 'Peugeot 407'){ // Tiene que tener valor por defecto un vehiculo
            return 'selected="selected"';
        }if(isset($_POST['vehiculo']) and $_POST['vehiculo'] == $opcion){
            return 'selected="selected"';
        }
    }

    function comprobarSelectPromocion($opcion){
        if(!isset($_POST['promocion']) and $opcion == 'Sin promocion'){ // Tiene que tener valor por defecto Sin promocion
            return 'selected="selected"';
        }if(isset($_POST['promocion']) and $_POST['promocion'] == $opcion){
            return 'selected="selected"';
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
    <h1>Presupuesto de compra de vehículo</h1>
    <form action="" method="post">
        <div>
            <label for="tipoCliente">Tipo de cliente:</label><br>
            <select name="tipoCliente" id="tipoCliente">
                <option <?php echo comprobarSelectTipoCliente('Empresa')?> >Empresa</option>
                <option <?php echo comprobarSelectTipoCliente('Particular')?> >Particular</option>
                <option <?php echo comprobarSelectTipoCliente('Organismo Público')?> >Organismo Público</option>
            </select>
        </div>
        <div>
            <label for="nombreCliente">Nombre Cliente:</label><br>
            <input type="text" name="nombreCliente" id="nombreCliente" placeholder="Nombre Cliente" value="<?php echo $nombreCliente ?>">
        </div>
        <div>
            <label for="email">Email:</label><br>
            <input type="text" name="email" id="email" placeholder="Email Cliente" value="<?php echo $email ?>">
        </div>
        <div>
            <label>Tipo de Motor:</label><br>
            <label for="diesel">Diesel</label>
            <input type="radio" name="tipoMotor" id="diesel" value="Diesel" <?php echo comprobarCheckMotor('Diesel')?>>
            <label for="gasolina">Gasolina</label>
            <input type="radio" name="tipoMotor" id="gasolina" value="Gasolina" <?php echo comprobarCheckMotor('Gasolina')?>>
            <label for="electrico">Electrico</label>
            <input type="radio" name="tipoMotor" id="electrico" value="Electrico" <?php echo comprobarCheckMotor('Electrico')?>>
        </div>
        <div>
            <label>Opciones:</label><br>
            <label for="climatizador">Climatizador</label>
            <input type="checkbox" name="climatizador" id="climatizador" value="Climatizador" <?php echo comprobarCheckBox('Climatizador')?>>
            <label for="gps">GPS</label>
            <input type="checkbox" name="gps" id="gps" value="GPS" <?php echo comprobarCheckBox('GPS')?>>
            <label for="camara">Camara</label>
            <input type="checkbox" name="camara" id="camara" value="Camara" <?php echo comprobarCheckBox('Camara')?>>
        </div>
        <div>
            <label for="vehiculo">Selecciona vehiculo:</label><br>
            <select name="vehiculo" id="vehiculo">
                <option <?php echo comprobarSelectVehiculo('Peugeot 407')?>>Peugeot 407</option>
                <option <?php echo comprobarSelectVehiculo('Citroen C4')?>>Citroen C4</option>
                <option <?php echo comprobarSelectVehiculo('Volkswagen Golf')?>>Volkswagen Golf</option>
            </select>
            <label for="precio">Precio €</label>
            <input type="number" name="precio" id="precio" value="<?php echo $precio ?>">
        </div>
        <div>
        <label for="promocion">Selecciona Promocion:</label><br>
            <select name="promocion" id="promocion">
                <option <?php echo comprobarSelectPromocion('Sin promocion')?> value="Sin promocion">Sin promocion</option>
                <option <?php echo comprobarSelectPromocion('PR')?> value="PR">Plan Renove (-2000)</option>
                <option <?php echo comprobarSelectPromocion('PGE')?> value="PGE">Plan Green Energy (-2500)</option>
            </select>
        </div>
        <input type="submit" name="enviar" value="Enviar" />
    </form>

    <?php
        if(isset($_POST['enviar'])){
            $datosCorrectos = true;
            // Primero comprobamos si los campos nombre, email y precio estan vacios
            if(empty($_POST['nombreCliente'])){
                $datosCorrectos = false;
                echo '<h3>Error. El campo Nombre Cliente no puede estar vacio</h3>';
            }
            if(empty($_POST['email'])){
                $datosCorrectos = false;
                echo '<h3>Error. El campo Email no puede estar vacio</h3>';
            }
            if(empty($_POST['precio'])){
                $datosCorrectos = false;
                echo '<h3>Error. El campo Precio no puede estar vacio</h3>';
            }

            //  Si se ha seleccionado Motor de tipo Diesel o Gasolina el usuario no podra seleccionar el Plan Green Energy
            // Primero comprobamos si se ha rellenado el tipo de motor del vehiculo
            if(isset($_POST['tipoMotor'])){
                if(($_POST['tipoMotor'] == 'Diesel' or $_POST['tipoMotor'] == 'Gasolina') and $_POST['promocion'] == 'PGE'){
                    $datosCorrectos = false;
                    echo '<h3>Error. Para poder aplicar el Plan Green Energy (PGE) debe seleccionar el Motor Electrico.</h3>';
                }
            }else{
                $datosCorrectos = false;
                echo '<h3>Error. Debe seleccionar el tipo de Motor del Vehiculo</h3>';
            }

            // Si el tipo de cliente es Organismo publico el precio del vehiculo no puede superar los 15000 euros
            // Pero primero debemos comprobar que el precio del vehiculo no esta vacio
            if(!empty($_POST['precio'])){
                if($_POST['tipoCliente'] == 'Organismo Público' and $_POST['precio'] > 15000){
                    $datosCorrectos = false;
                    echo '<h3>Error. Si el cliente es un Organismo Público el precio del vehiculo no puede superar los 15000 euros.</h3>';
                }
            }

            if($datosCorrectos == true){
                $email = $_POST['email'];
                $presupuesto = $_POST['precio'] - obtenerDescuentoPromocion();
                echo "<h3>Datos correctos. Su presupuesto sera enviado a la direccion de correo: $email . El importe de este presupuesto es de $presupuesto euros. </h3>";
            }
        }

        function obtenerDescuentoPromocion(){
            if($_POST['promocion'] == 'PGE'){
                return 2500;
            }else if($_POST['promocion'] == 'PR'){
                return 2000;
            }else if($_POST['promocion'] == 'Sin promocion'){
                return 0;
            }
        }
    ?>

</body>
</html>