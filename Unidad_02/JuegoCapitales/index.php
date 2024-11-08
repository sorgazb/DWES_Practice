<?php
require_once 'accesoDatos.php';
$ad = new AccesoDatos('capitales.dat');
$paises = $ad->obtenerPaises();
if (!isset($_POST['validar']) || isset($_POST['pasar'])) {
    $nRandom = rand(0, sizeof($paises) - 1);
    $pais = $paises[$nRandom];
    $nombre = $pais->getPais();
    $idPais = $pais->getId();
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
            } else {
                echo '<h3 style="color:red;">Incorrecto</h3>';
            }
        }
    }
    ?>
</body>

</html>