<?php

    $colorFondoPHP = '#FFFFFF';
    $colorTextoPHP = '#000000';

    if(isset($_POST['guardar'])){  
        setcookie('cookieFondo',$_POST['colorFondo']);
        setcookie('cookieTexto',$_POST['colorTexto']);
        header('location:03Ejercicio2.php');
    }

    if(isset($_COOKIE['cookieFondo']) && isset($_COOKIE['cookieTexto'])){
        $colorFondoPHP = $_COOKIE['cookieFondo'];
        $colorTextoPHP = $_COOKIE['cookieTexto'];
    }

    if(isset($_POST['borrar'])){
        setcookie('cookieFondo','',time()-1);
        setcookie('cookieTexto','',time()-1);
        header('location:03Ejercicio2.php');
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookies Colores</title>
    <style>
        *{
            background-color: <?php echo $colorFondoPHP?>;
            color: <?php echo $colorTextoPHP?>;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <div>
            <label for="colorFondo">Color de fondo</label>
            <input type="color" name="colorFondo" value="<?php echo $colorFondoPHP?>"/>
        </div>
        <div>
            <label for="colorTexto">Color de texto</label>
            <input type="color" name="colorTexto" value="<?php echo $colorTextoPHP?>"/>
        </div>
        <input type="submit" value="Guardar" name="guardar">
        <input type="submit" value="Borrar Cookies" name="borrar">
    </form>
</body>
</html>