<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <h1>Presupuesto de compra de vehículo</h1>
    <form action="Ejercicio1_datos.php" method="post">
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
</body>
</html>
