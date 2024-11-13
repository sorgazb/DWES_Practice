<?php
    function comprobarCheck($texto){
        if(!isset($_COOKIE['tipo']) and $texto == 'transferencia'){
            return 'checked="checked"';
        }
        if(isset($_COOKIE['tipo']) and $_COOKIE['tipo'] == $texto){
            return 'checked="checked"';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Pago</title>
</head>
<body>
    <form action="tratarCookies.php" method="post">
        <div>
            <input type="radio" name="tipo" <?php echo comprobarCheck('transferencia')?> value="transferencia"/>Transferencia
            <input type="radio" name="tipo" <?php echo comprobarCheck('contrarrembolso')?> value="contrarrembolso"/>Contrarrembolso
        </div>
        <input type="submit" value="Guardar y continuar" name="guardarPago">
    </form>
</body>
</html>