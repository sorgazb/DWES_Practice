<?php
const MINOMBE = 'Sergio';

//Chequear si se han escrito números
if (!empty($_GET['n1']) and !empty($_GET['n2'])) {
    $n1 = $_GET['n1'];
    $n2 = $_GET['n2'];

    if (isset($_GET['+'])) {
        $resultado = $n1 + $n2;
        $operador = "+";
    } elseif (isset($_GET['-'])) {
        $resultado = $n1 + $n2;
        $operador = "-";
    } elseif (isset($_GET['*'])) {
        $resultado = $n1 * $n2;
        $operador = "*";
    } elseif (isset($_GET['/'])) {
        $resultado = $n1 / $n2;
        $operador = "/";
    }
}
else{
    if(isset($_GET['n1']) or isset($_GET['n2'])){
        $error = 'Error, rellena los números';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>

<body>
    <h1>CALCULADORA DE <?php echo MINOMBE ?></h1>
    <!--action: pagina que trata eñ formulario cuando se hace submit-->
    <form action="#" method="get">
        <label for="n1">Numero 1</label>
        <input type="number" name="n1" id="n1"><br />
        <label for="n2">Numero 2</label>
        <input type="number" name="n2" id="n2"><br />

        <button type="submit" name="+">+</button>
        <button type="submit" name="-">-</button>
        <button type="submit" name="*">*</button>
        <button type="submit" name="/">/</button>
    </form>

    <!--Mostramos el resultado, si se ha calculado-->
    <?php
        if (isset($error)) {
            echo "<h3 style='color:red;'>$error</h3>";
        }
    if (isset($resultado)) {
        // Con comillas dobles al escribir una variable sale directamente su resultado.
        echo "<h3 style='color:red;'> El resultado de $n1 $operador $n2 = $resultado </h3>";
        echo '<h3 style="color:red;"> El resultado de $n1 $operador $n2 = $resultado </h3>';
    }
    ?>

</body>

</html>