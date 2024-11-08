<?php
    if(isset($_POST['guardarPers'])){
        // Comprobar que se han rellenado los datos
        if(empty($_POST['nombre']) or empty($_POST['ape'])){
            // Redirigimos a datos personales
            header('location:datosPers.php');
        }else{
            // Creamos / Modificamos cookie
            setcookie('nombre',($_POST['nombre']));
            setcookie('ape',($_POST['ape']));
            header('location:datosPago.php');
        }
    }

    if(isset($_POST['guardarPago'])){
        if(empty($_POST['tipo'])){
            header('location:datosPago.php');
        }else{
            // Creamos / Modificamos cookie
            setcookie('tipo',($_POST['tipo']));
            header('location:mostrarDatos.php');
        }
    }
?>