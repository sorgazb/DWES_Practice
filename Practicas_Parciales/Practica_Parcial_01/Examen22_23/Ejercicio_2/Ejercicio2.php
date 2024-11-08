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
                <option selected="selected">Empresa</option>
                <option>Particular</option>
                <option>Organismo Público</option>
            </select>
        </div>
        <div>
            <label for="nombreCliente">Nombre Cliente:</label><br>
            <input type="text" name="nombreCliente" id="nombreCliente" placeholder="Nombre Cliente">
        </div>
        <div>
            <label for="email">Email:</label><br>
            <input type="text" name="email" id="email" placeholder="Email Cliente">
        </div>
        <div>
            <label>Tipo de Motor:</label><br>
            <label for="diesel">Diesel</label>
            <input type="radio" name="tipoMotor" id="diesel" value="Diesel">
            <label for="gasolina">Gasolina</label>
            <input type="radio" name="tipoMotor" id="gasolina" value="Gasolina">
            <label for="electrico">Electrico</label>
            <input type="radio" name="tipoMotor" id="electrico" value="Electrico">
        </div>
        <div>
            <label>Opciones:</label><br>
            <label for="climatizador">Climatizador</label>
            <input type="checkbox" name="climatizador" id="climatizador" value="Climatizador">
            <label for="gps">GPS</label>
            <input type="checkbox" name="gps" id="gps" value="GPS">
            <label for="camara">Camara</label>
            <input type="checkbox" name="camara" id="camara" value="Camara">
        </div>
        <div>
            <label for="vehiculo">Selecciona vehiculo:</label><br>
            <select name="vehiculo" id="vehiculo">
                <option selected="selected">Peugeot 407</option>
                <option>Citroen C4</option>
                <option>Volkswagen Golf</option>
            </select>
            <label for="precio">Precio €</label>
            <input type="number" name="precio" id="precio">
        </div>
        <div>
        <label for="promocion">Selecciona Promocion:</label><br>
            <select name="promocion" id="promocion">
                <option selected="selected" value="Sin promocion">Sin promocion</option>
                <option value="PR">Plan Renove (-2000)</option>
                <option value="PGE">Plan Green Energy (-2500)</option>
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