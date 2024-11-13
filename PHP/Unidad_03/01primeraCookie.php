<?php
    // Recuperamos el valor de la Cookie si está
    if(isset($_COOKIE['miPrimeraC'])){
        $valorCookie = $_COOKIE['miPrimeraC'];
    }
    if(isset($_POST['guardar'])){
        //  Creamos una cookie y le damos el valor del input
        if(!empty($_POST['valor'])){
            //  Ponemos como fecha de caducidad un mes apartir de hoy
            setcookie('miPrimeraC',$_POST['valor'],time()+(60*60*24*30)); // seg-min-horas-dias
            // Recargamos la página para actualizar $COOKIE
            header('location:01primeraCookie.php');
        }
    }
    if(isset($_POST['borrar'])){
        // Borrar cookie. Ponerla como caducada
        setcookie('miPrimeraC','',time()-1);
        // Recargamos la página para actualizar $COOKIE
        header('location:01primeraCookie.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primera Cookie</title>
</head>
<body>
    <form action="" method="post">
        <label>Valor de la Cookie</label>
        <input type="text" name="valor" placeholder="Valor que se almacena en la cookie miPrimeraC" 
        value="<?php echo (isset($valorCookie) ? $valorCookie : '')?>"/>
        <input type="submit" name="guardar" value="Guardar"/>
        <input type="submit" name="borrar" value="Borrar"/>
    </form>
</body>
</html>