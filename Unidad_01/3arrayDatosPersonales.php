<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Datos Personales</title>
</head>
<body>
<form action="#" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre"><br/>
        <label for="estatura">Estatura</label>
        <input type="number" name="estatura" id="estatura" min="0.1" max="2.5" step="0.1"><br/>
        <label for="edad">Edad</label>
        <input type="number" name="edad" id="edad"><br/>
        <label for="soltero">Soltero</label>
        <input type="checkbox" name="soltero" id="soltero"><br/>

        <input type="submit" value="Enviar" name="enviar">
    </form>

    <?php

    // Cuando pulsemos en enviar
    if (isset($_POST['enviar'])) {
        if (!empty($_POST['nombre']) and !empty($_POST['estatura']) and !empty($_POST['edad'])) {
            if(isset($_POST['soltero'])){
                $soltero='Si';
            }else{
                $soltero='No';
            }
            $datosArray = array("nombre"=>$_POST['nombre'],"estatura"=>$_POST['estatura'],"edad"=>$_POST['edad'],"soltero"=>$soltero);

            echo "<p>Nombre: ".$datosArray["nombre"]."<p>";
            echo "<p>Estatura: ".$datosArray["estatura"]."m</p>";
            echo "<p>Edad: ".$datosArray["edad"]." años</p>";
            echo "<p>Soltero: ".$datosArray["soltero"]."</p>";
        }
        else{
            echo "<h3 style='color:red;'>Error, rellenar todos los datos</h3>";
        }
    }
    ?>
</body>
</html>