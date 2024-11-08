<?php
    if(isset($_POST['aceptar'])){
        setcookie('aceptar',true,time()+(60*60*24*365));
        header('location:datosPers.php');
    }
    // Comprobar si acepta cookies
    if(isset($_COOKIE['aceptar']) and $_COOKIE['aceptar']){
        $nombre = (isset($_COOKIE['nombre']) ? $_COOKIE['nombre'] : '');
        $ape = (isset($_COOKIE['ape']) ? $_COOKIE['ape'] : '');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Personales</title>
</head>
<body>
    <form action="tratarCookies.php" method="post">
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre"
            value="<?php echo $nombre ?>">
        </div>
        <div>
            <label for="ape">Apellidos</label>
            <input type="text" id="ape" name="ape" placeholder="Apellidos"
            value="<?php echo $ape ?>">
        </div>
        <input type="submit" value="Guardar y continuar" name="guardarPers">
    </form>
</body>
</html>

<?php
}
else{
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <h3>Este sitio trabaja con Cookies.</h3>
        <form action="" method="post">
            <input type="submit" value="Aceptar" name="aceptar">
            <input type="submit" value="Rechazar" name="Rechazar">
        </form>
    </body>
    </html>
<?php
    
}
?>