<?php
    require_once 'controlador.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <h1 style='color:red;'>Mensajes</h1>
        <?php
            if(isset($error)){
                echo '<h2 style="color:red;">'.$error.'</h2>';
            }
        ?>
    </div>
    <?php
        if($bd->getConexion() != null){
    ?>
    <form action="skills.php" method="post">
        <?php
            if(!isset($_SESSION['modalidad'])){
        ?>
        <div>
            <h1 style='color:blue;'>Modalidad</h1>
            <label for="tienda">Modalidad</label><br />

            <select name="modalidad">
                <?php
                    if(!empty($modalidades)){
                        foreach ($modalidades as $m) {
                            echo '<option value="' . $m->getId() . '">'
                                . $m->getModalidad() .'</option>';
                        }
                    }
                ?>
            </select>
            <button type="submit" name="selModalidad">Seleccionar Modalidad</button>
        </div>
        <?php
            }
        ?>

        <?php
            if(isset($_SESSION['modalidad'])){
                if(!isset($_SESSION['alumno'])){
        ?>
        <div>
            <h1 style='color:blue;'>Alumno</h1>
            <label for="tienda">Alumno</label><br />
            <select name="alumno">
                <?php
                    $alumnos = $bd->obtenerAlumnosModalidad($_SESSION['modalidad']->getId());
                    foreach ($alumnos as $a) {
                        echo '<option value="' . $a->getId() . '">'
                        . $a->getNombre() .'</option>';
                    } 
                ?>
            </select>
            <button type="submit" name="selAlumno">Seleccionar Alumno</button>
        </div>
        <?php
                }
        ?>
        <?php
            if(isset($_SESSION['alumno'])){
        ?>
        <div>
            <h1 style='color:blue;'>Corrección</h1>
            <h2 style='color:green;'><?php echo $_SESSION['modalidad']->getModalidad().' - '. $_SESSION['alumno']->getNombre().' - '.$_SESSION['alumno']->getPuntuacion();
            if($_SESSION['alumno']->getFinalizado()){
                echo 'Finalizado';
            }else{
                echo '(Provisional)';
            } ?>
                <button type="submit" name="cambiarM">Cambiar Modalidad</button>
                <button type="submit" name="cambiarA">Cambiar Alumno</button>
            </h2>
            <table>
                <tr>
                    <td><label for="prueba">Prueba</label><br /></td>
                    <td><label for="puntos">Puntos</label><br /></td>
                    <td><label for="comentario">Comentario</label></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <select id="prueba" name="prueba">
                            <?php
                                $pruebas = $bd->obtenerPruebasModalidad($_SESSION['modalidad']->getId());
                                foreach ($pruebas as $p) {
                                    echo '<option value="' . $p->getId() . '">'
                                        . $p->getDescripcion().' - '.$p->getPuntuacion() .'</option>';
                                }
                            ?>
                        </select>
                    </td>
                    <td><input id="puntos" type="number" name="puntos" value="1" /></td>
                    <td><input id="comentario" type="text" name="comentario" placeholder="Comentario" /></td>
                    <td><button type="submit" name="guardar">Guardar</button></td>
                </tr>
            </table>
        </div>
        <div>
            <h1 style='color:blue;'>Calificaciones del alumno</h1>
            <table border="1" rules="all" width="50%">
                <tr>
                    <td><b>Prueba</b></td>
                    <td><b>Puntos Asignados</b></td>
                    <td><b>Puntos Obtenidos</b></td>
                    <td><b>Comentario</b></td>
                </tr>
                <?php
                    $correcciones = $bd->obtenerCorrecionesAlumno($_SESSION['alumno']->getId());
                    foreach ($correcciones as $correccion) {
                        echo '<tr>'; 
                        echo '<td>'.$bd->obtenerPrueba($correccion->getPrueba())->getDescripcion().'</td>';
                        echo '<td>'.$bd->obtenerPrueba($correccion->getPrueba())->getPuntuacion().'</td>';
                        echo '<td>'.$correccion->getPuntos().'</td>';
                        echo '<td>'.$correccion->getComentario().'</td>';
                        echo '</tr>';
                    }
                ?>
            </table>
            <button type="submit" name="finalizar">Finalizar Corrección</button>
        </div>
        <?php
            }
            }
        ?>
    </form>
    <?php
        }
    ?>
        <div>
        <h1 style='color:blue;'>Ganadores</h1>
        <table border="1" rules="all" width="50%">
            <tr>
                <td><b>Modalidad</b></td>
                <td><b>Nombre</b></td>
                <td><b>Puntuación</b></td>
            </tr>
            <?php
            $ganadores = $bd->obtenerGanadores();
            foreach ($ganadores as $g) {
                echo '<tr>';
                echo '<td>' . $g[0] . '</td>';
                echo '<td>' . $g[1] . '</td>';
                echo '<td>' . $g[2]. '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</body>

</html>