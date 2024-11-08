<?php
require_once 'accesoDatos.php';
$ad = new AccesoDatos('notas.dat','asignaturas.dat');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Mis Notas PHP</h1>
    <form action="#" method="post">
        <div>
            <label for="asignaturas">Asignatura:</label><br>
            <select name="asignaturas" id="asignaturas">
            <?php 
            $arrayAsig = $ad->obtenerAsignaturas();
            foreach ($arrayAsig as $asignatura) {
                echo "<option>".$asignatura."</option>";
            }
            ?>
            </select>
        </div>

        <br>

        <div>
            <label>Tipo:</label><br>
            <label for="examen">Examen</label>
            <input type="radio" id="examen" name="tipo" value="examen" />
            <label for="tarea">Tarea</label>
            <input type="radio" id="tarea" name="tipo" value="tarea" />
        </div>

        <br>

        <div>
            <label for="descripcion">Descripcion:</label><br>
            <textarea name="descripcion" id="descripcion" placeholder="Añade un comentario"></textarea>
        </div>

        <br>

        <div>
            <label for="nota">Calificacion:</label><br>
            <input type="number" name="nota" id="nota" min="0.1" max="10" step="0.01">
        </div>

        <br>

        <div>
            <label for="fecha">Fecha Nota:</label><br>
            <input type="date" id="fecha" name="fecha" value="<?php echo date(('Y-m-d'));?>"/>
        </div>

        <br>

        <input type="submit" name="aniadir" value="Añadir Nota" />
    </form>

    <?php
        if (isset($_POST['aniadir'])) {
            if (empty($_POST['asignaturas']) or empty($_POST['tipo']) or empty($_POST['descripcion']) or empty($_POST['nota']) or empty($_POST['fecha'])) {
                echo '<h3 style="color:red;">Error, hay campos vacios</h3>';
            }else{
                $fecha = date("d-m-Y",strtotime($_POST['fecha']));
                $nota = new Nota($_POST['asignaturas'],$_POST['tipo'],$_POST['descripcion'],$_POST['nota'],$fecha);
                $ad->insertatNota($nota);

                echo '<h3>Notas</h3>';
                echo '<table border="1px">';
                echo '<tr><th>Asignatura</th><th>Tipo</th><th>Descripcion</th><th>Nota</th><th>Fecha</th></tr>';
        
                
        
                $notas = $ad->obtenerNotas();
                foreach($notas as $n){
                    echo '<tr>';
                    echo '<td>'.$n->getAsignatura().'</td>';
                    echo '<td>'.$n->getTipo().'</td>';
                    echo '<td>'.$n->getDescripcion().'</td>';
                    echo '<td>'.$n->getNota().'</td>';
                    echo '<td>'.$n->getFecha().'</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
        }
    ?>
</body>

</html>