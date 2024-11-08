<?php
// Añadir un contador de aciertos y de fallos
// guardando los datos en la sesion
// Consideramos que pasar es un fallo
session_start();

require_once 'accesoDatos.php';
$ad = new AccesoDatos('capitales.dat');

// Si se pulsa en salir se destruye la sesion
if(isset($_GET['salir'])){
    session_destroy();
    session_unset();
    header('location:inicio.php');
}

// Si no hay nombre no se puede jugar
if(!isset($_SESSION['nombre'])){
    header('location:inicio.php');
}


$paises = $ad->obtenerPaises();
if (!isset($_POST['validar']) || isset($_POST['pasar'])) {
    $nRandom = rand(0, sizeof($paises) - 1);
    $pais = $paises[$nRandom];
    $nombre = $pais->getPais();
    $idPais = $pais->getId();

    if(isset($_POST['pasar'])){
        if(isset($_SESSION['fallos'])){
            $_SESSION['fallos'] ++;
        }else{
            $_SESSION['fallos'] = 1;
        }
    }
} else {
    $paisAnt;
    foreach ($paises as $p) {
        if ($p->getId() == $_POST['validar']) {
            $paisAnt = $p;
            break;
        }
    }
    $nombre = $paisAnt->getPais();
    $idPais = $paisAnt->getId();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego Capitales</title>
</head>

<body>
    <h1>JUEGO CAPITAL</h1>
    <h2>Esta jugando : <?php echo $_SESSION['nombre'] ?></h2>
    <a href="index.php?salir=1">Salir</a>
    <table>
        <tr>
            <td>
                <form action="" method="post">
                    <div>
                        <label for="capital" style="font-weight: bold;">¿Cual es la capital de <?php echo $nombre ?> ?</label><br>
                        <input type="text" id="capital" name="capital">
                    </div>

                    <div>
                        <button type="submit" value="<?php echo $idPais ?>" name="validar">Validar</button>
                        <button type="submit" name="pasar">Pasar</button>
                    </div>

                </form>
            </td>
            <td>
                <?php
                    if(isset($_SESSION['aciertos'])){
                        $aciertos = $_SESSION['aciertos'];
                    }else{
                        $aciertos = 0;
                    }
                    if(isset($_SESSION['fallos'])){
                        $fallos = $_SESSION['fallos'];
                    }else{
                        $fallos = 0;
                    }
                ?>
                <h2 style="color:green">Aciertos:<?php echo $aciertos ?></h2>
                <h2 style="color:red">Fallos:<?php echo $fallos ?></h2>
            </td>
        </tr>
    </table>


    <?php
    if (isset($_POST['validar'])) {
        if (empty($_POST['capital'])) {
            echo '<h3> Error introduzca algo </h3>';
        } else {
            $idPaisBusc = $_POST['validar'];
            $capitalAdv;
            foreach ($paises as $p) {
                if ($p->getId() == $idPaisBusc) {
                    $capitalAdv = $p->getCapital();
                    break;
                }
            }
            $capitalIntro = strtoupper($_POST['capital']);
            if ($capitalIntro == $capitalAdv) {
                echo '<h3 style="color:Green;">Correcto</h3>';
                // Incrementamos aciertos
                if(isset($_SESSION['aciertos'])){
                    $_SESSION['aciertos'] ++;
                }else{
                    $_SESSION['aciertos'] = 1;
                }
               header('location:index.php');
            } else {
                echo '<h3 style="color:red;">Incorrecto</h3>';
                // Incrementamos fallos
                if(isset($_SESSION['fallos'])){
                    $_SESSION['fallos'] ++;
                }else{
                    $_SESSION['fallos'] = 1;
                }
                header('location:index.php');
            }
        }
    }
    ?>
</body>

</html>