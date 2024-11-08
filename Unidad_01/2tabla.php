<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creador tablas</title>
</head>

<body>
    <form action="#" method="post">
        <label for="nFilas">Numero de Filas</label>
        <input type="number" name="nFilas" id="nFilas"><br />
        <label for="nColumna">Numero de Columnas</label>
        <input type="number" name="nColumnas" id="nColumnas"><br />

        <input type="submit" value="Crear" name="crear">
    </form>

    <?php

    // Cuando pulsemos en crear
    if (isset($_POST['crear'])) {

        if (!empty($_POST['nFilas']) and !empty($_POST['nColumnas'])) {
            $nFilas = $_POST['nFilas'];
            $nColumnas = $_POST['nColumnas'];
            //comen
            //Pintamos la tabla
            echo "<table border='1'>";
            $cont=1;
            for ($i = 0; $i < $nFilas; $i++) {
                echo "<tr>";
                for ($j = 0; $j < $nColumnas; $j++) {
                    echo "<td>".$cont++."</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
        else{
            echo "<h3 style='color:red;'>Error, rellenar filas y columnas</h3>";
        }
    }
    ?>

</body>

</html>