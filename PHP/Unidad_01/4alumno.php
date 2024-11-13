<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="#" method="post">
        <div>
            <label for="nombre">Nombre</label><br>
            <input type="text" id="nombre" name="nombre" />
        </div>
        <div>
            <label for="curso">Curso</label><br>
            <select name="curso" id="curso">
                <option value="Primero DAW">1ºDAW</option>
                <option selected="selected">2ºDAW</option>
                <option>1ºDAM</option>
                <option>2ºDAM</option>
            </select>
        </div>
        <div>
            <label for="asig">Asignatura</label><br>
            <select name="asig[]" id="asig" multiple="multiple">
                <option>DWES</option>
                <option>DIC</option>
                <option>PROG</option>
                <option>BD</option>
            </select>
        </div>
        <div>
            <label>Sexo</label><br>
            <label for="hombre">Hombre</label>
            <input type="radio" id="hombre" name="sexo" value="hombre" />
            <label for="mujer">Mujer</label>
            <input type="radio" id="mujer" name="sexo" value="mujer" />
        </div>
        <div>
            <label>Otros</label><br>
            <label for="becaM">BECA MEC</label>
            <input type="checkbox" id="becaM" name="otros[]" value="Beca Mec" />
            <label for="transporte">Transporte</label>
            <input type="checkbox" id="transporte" name="otros[]" value="Transporte" />
            <label for="delegado">Delegado</label>
            <input type="checkbox" id="delegado" name="otros[]" value="Delegado" />
        </div>

        <input type="submit" name="enviar" value="Enviar" />
        <input type="reset" value="Reset" />
    </form>
    <?php
    if (isset($_POST['enviar'])) {
        if (!empty($_POST['nombre'])) {
            echo "Nombre:" . $_POST['nombre'];
            echo "<br/>Curso:" . $_POST['curso'];
            if (isset($_POST['asig'])) {
                echo "<br/>Asignaturas:";
                foreach ($_POST['asig'] as $a) {
                    echo $a . ' ';
                }
            }
            if (isset($_POST['sexo']))
                echo "<br/>Sexo:" . $_POST['sexo'];
            if (isset($_POST['otros'])) {
                echo "<br/>Otros:";
                foreach ($_POST['otros'] as $o) {
                    echo $o . ' ';
                }
            }
        } else {
            echo "<h3 style='color:red'>Error, debes rellenar los campos</h3>";
        }
    }
    ?>
</body>
</html>