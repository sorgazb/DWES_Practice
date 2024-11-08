<?php
    // Mostrar el Array $_SESSION
    echo '<h4>Valor de $_SESSION <u>antes</u> de hacer el session_strar</h4>';
    echo var_dump($_SESSION);
    // Antes de trabajar con sesiones hay que llamar al a session_star()
    session_start();
    // Mostrar el Array $_SESSION
    echo '<h4>Valor de $_SESSION <u>despues</u> de hacer el session_strar</h4>';
    echo var_dump($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo 'Id Sesion: '.session_id();
        echo '<br/>Nombre Sesion: '.session_name();
        // Crear una variable en la sesion
        $_SESSION['nombre'] = 'Sergio';
    ?>
</body>
</html>