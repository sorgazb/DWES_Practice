<?php
require_once 'accesoDatos.php';
// Creamos una instancia de acceso a datos
$ad = new AccesoDatos('agenda.dat');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Agenda PHP</title>
    <style>
        img {
            height: 50px;
            width: 50px;
        }
    </style>
</head>

<body>
    <h1 style="color: lawngreen;">Mi Agenda PHP</h1>
    <form action="#" method="post" enctype="multipart/form-data">
        <div>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo (!empty($_POST['nombre']) ? ($_POST['nombre']) : ''); ?>">
        </div>

        <div>
            <label for="tlf">Telefono</label>
            <input type="text" id="tlf" name="tlf" pattern="[0-9]{3} [0-9]{3} [0-9]{3}" value="<?php echo (!empty($_POST['tlf']) ? ($_POST['tlf']) : ''); ?>">
        </div>

        <div>
            <label>Tipo</label><br>
            <label for="amigo">Amigo</label>
            <input type="radio" id="amigo" name="tipo" value="amigo" checked="checked" />
            <label for="familiar">Familiar</label>
            <input type="radio" id="familiar" name="tipo" value="familiar"
                <?php echo ((isset($_POST['tipo']) and $_POST['tipo'] == 'familia') ? 'checked="checked"' : '') ?> />
            <label for="otro">Otro</label>
            <input type="radio" id="otro" name="tipo" value="otro"
                <?php echo ((isset($_POST['tipo']) and $_POST['tipo'] == 'otro') ? 'checked="checked"' : '') ?> />
        </div>

        <div>
            <label for="foto">Foto</label><br>
            <input type="file" id="foto" name="foto">
        </div>

        <input type="submit" name="crear" value="Crear" />
    </form>

    <?php
    if (isset($_POST['crear'])) {
        if (empty($_POST['nombre']) or empty($_POST['tlf']) or empty($_FILES['foto']['name'])) {
            echo '<h3 style="color:red;">Error, hay campos vacios</h3>';
        } else {
            $id = $ad->obtenerID();
            $nombreF = 'img/' . time() . $_FILES['foto']['name'];
            $c = new Contacto($id, $_POST['nombre'], $_POST['tlf'], $_POST['tipo'], $nombreF);

            if (existeContacto($_POST['tlf'], $ad)) {
                echo '<h3 style="color:red;">Error, ya existe ese contacto</h3>';
                $contactoExistente = devolverContacto($_POST['tlf'], $ad);
                echo '<table border="1px">';
                echo '<tr><th>ID</th><th>Nombre</th><th>Teléfono</th><th>Tipo</th><th>Foto</th></tr>';
                echo '<tr>';
                echo '<td>' . $contactoExistente->getIndice() . '</td>';
                echo '<td>' . $contactoExistente->getNombre() . '</td>';
                echo '<td>' . $contactoExistente->getTlf() . '</td>';
                echo '<td>' . $contactoExistente->getTipo() . '</td>';
                echo '<td><img src="' . $contactoExistente->getFoto() . '"/></td>';
                echo '</tr>';
                echo '</table>';
            } else {
                $ad->insertarContacto($c);
                $destino = $nombreF;
                $origen = $_FILES['foto']['tmp_name'];
                move_uploaded_file($origen, $destino);
            }
        }
    }

    // Mostrar Contactos de la Agenda:
    $contactos = $ad->obtenerContacto();
    echo '<h3>Contactos</h3>';
    echo '<table border="1px">';
    echo '<tr><th>ID</th><th>Nombre</th><th>Teléfono</th><th>Tipo</th><th>Foto</th></tr>';
    foreach ($contactos as $c) {
        echo '<tr>';
        echo '<td>' . $c->getIndice() . '</td>';
        echo '<td>' . $c->getNombre() . '</td>';
        echo '<td>' . $c->getTlf() . '</td>';
        echo '<td>' . $c->getTipo() . '</td>';
        echo '<td><img src="' . $c->getFoto() . '"/></td>';
        echo '</tr>';
    }
    echo '</table>';

    function existeContacto($tlf, $ad)
    {
        $contactos = $ad->obtenerContacto();
        $existe = false;
        foreach ($contactos as $c) {
            if ($c->getTlf() == $tlf) {
                $existe = true;
            }
        }
        return $existe;
    }

    function devolverContacto($tlf, $ad)
    {
        $contacto = null;
        $contactos = $ad->obtenerContacto();
        foreach ($contactos as $c) {
            if ($c->getTlf() == $tlf) {
                $contacto = new Contacto($c->getIndice(), $c->getNombre(), $c->getTlf(), $c->getTipo(), $c->getFoto());
            }
        }
        return $contacto;
    }
    ?>

</body>

</html>