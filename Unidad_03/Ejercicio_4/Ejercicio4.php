<?php
    // Si hemos pulsado el Boton de Añadir lo primero que debemos es comprobar si todos los campos estan rellenos.
    if(isset($_POST['aniadir'])){
        if(!empty($_POST['fechaEvento']) and !empty($_POST['horaEvento']) and !empty($_POST['asuntoEvento'])){
            $datosEvento = array();
            $datosEvento ['fechaEvento'] = $_POST['fechaEvento'];
            $datosEvento ['horaEvento'] = $_POST['horaEvento'];
            $datosEvento ['asuntoEvento'] = $_POST['asuntoEvento'];
            aniadirEvento($datosEvento);
            header('location:Ejercicio4.php');
        }else{
            echo '<h3>Error. Debes rellenar todos los campos.</h3>';
        }
    }

    // Si hemos pulsado algun boton de eliminar recuperamos el Array de eventos y borramos el que corresponda
    // con el indice del que deseamos borrar.
    if(isset($_POST['eliminar'])){
        $indice = $_POST['eliminar'];
        $eventos = recuperarEventos();
        unset($eventos[$indice]);
        $eventos = array_values($eventos);
        guardarEventosCookie($eventos);
        header('location:Ejercicio4.php');
    }

    // Funcion que nos permite introducir al Array de Eventos los datos que hemos recogido
    function aniadirEvento($datosEvento){
        $eventos = recuperarEventos();
        $eventos [] = ['fechaEvento' => $datosEvento ['fechaEvento'], 'horaEvento' => $datosEvento ['horaEvento'], 'asuntoEvento' => $datosEvento ['asuntoEvento']];
        guardarEventosCookie($eventos);
    }

    // Funcion que nos devuelve los eventos que esten almacenados en el Array de la Cookie,
    // en caso de que la Cookie no exista nos devuelve un array vacio.
    function recuperarEventos(){
        if(isset($_COOKIE['cookieEventos'])){
            return unserialize($_COOKIE['cookieEventos']);
        }else{
            $eventos = array();
            return $eventos;
        }
    }

    // Si no existe la Cookie la crea con una fecha de expiracion de 1 mes, 
    // y si ya existe actualiza su contenido.
    function guardarEventosCookie($eventos){
        setcookie('cookieEventos',serialize($eventos),time()+(60*60*24*30));
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<body>
    <h1>Calendario de Eventos</h1>
    <!-- Tabla en la que mostraremos los datos almacenados en el Array de la Cookie -->
    <table>
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Asunto</th>
        </tr>
        <?php
            $listaEventos = recuperarEventos();
            foreach ($listaEventos as $indice => $evento) {
                // Cambiamos la Fecha del Evento al formato de fecha d/m/Y.
                $fechaEvento = date("d/m/Y",strtotime($evento['fechaEvento']));
                $horaEvento = $evento['horaEvento'];
                $asuntoEvento = $evento['asuntoEvento'];
                echo "<tr>";
                echo "<td> $fechaEvento </td>";
                echo "<td> $horaEvento </td>";
                echo "<td> $asuntoEvento </td>";
                // Para trabajar con el boton de Eliminar Evento es necesario que creemos un formulario
                // para poder comprobar el si se ha pulsado el boton y con el inidice del bucle podamos
                // eliminar el evento seleccionado.
                echo "<td>
                        <form action = '' method = 'post'>
                            <button type='submit' value='$indice' name='eliminar'>Eliminar</button>
                        </form>
                </td>";
                echo"</tr>";
            }
        ?>
    </table>

    <!-- Formulario en que introduciremos los eventos. -->
    <form action="" method="post">
        <input type="date" name="fechaEvento" id="fechaEvento">
        <input type="time" name="horaEvento" id="horaEvento">
        <input type="text" name="asuntoEvento" id="asuntoEvento">
        <input type="submit" value="Añadir" name="aniadir">
    </form>
</body>
</html>