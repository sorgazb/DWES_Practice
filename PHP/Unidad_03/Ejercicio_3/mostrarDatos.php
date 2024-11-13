<?php
    $nombre =(isset($_COOKIE['nombre'])?$_COOKIE['nombre']:'');
    $ape =(isset($_COOKIE['ape'])?$_COOKIE['ape']:'');
    $tipo =(isset($_COOKIE['tipo'])?$_COOKIE['tipo']:'');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Datos</title>
</head>
<body>
    <h3>Nombre: <?php echo $nombre?></h3>
    <h3>Apellido: <?php echo $ape?></h3>
    <h3>Tipo Pago: <?php echo $tipo?></h3>
    <a href="datosPers.php">Inicio</a>
</body>
</html>