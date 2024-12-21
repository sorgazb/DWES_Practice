<?php

    require_once 'Modelo.php';
    
    $bd = new Modelo();

    session_start();

    if($bd->getConexion() == null){
        $error = 'Error. No hay conexion con la BD';
    }

    $modalidades = $bd->obtenerModalidades();

    if(isset($_POST['selModalidad'])){
        if(!empty($_POST['modalidad'])){
            $modalidad = $bd->obtenerModalidad($_POST['modalidad']);
            if($modalidad != null){
                $_SESSION['modalidad'] = $modalidad;
            }else{
                $error = 'Error. No se puede obtener la modalidad';
            }
            
        }
    }

    if(isset($_POST['selAlumno'])){
        if(!empty($_POST['alumno'])){
            $alumno = $bd->obtenerAlumno($_POST['alumno']);
            if($alumno != null){
                if($alumno->getModalidad() == $_SESSION['modalidad']->getId()){
                    $_SESSION['alumno'] = $alumno;
                }else{
                    $error = 'Error. No se puede obtener al alumno';
                }
            }else{
                $error = 'Error. No se puede obtener al alumno';
            }
            
        }
    }

    if(isset($_POST['cambiarM'])){
        session_destroy();
        header('location:skills.php');
    }

    if(isset($_POST['cambiarA'])){
        unset($_SESSION['alumno']);
        header('location:skills.php');
    }

    if(isset($_POST['guardar'])){
        if(!empty($_POST['puntos']) and !empty($_POST['comentario'])){
            $prueba = $bd->obtenerPrueba($_POST['prueba']);
            if($_POST['puntos'] > $prueba->getPuntuacion()){
                $error = 'Error. No puedes superar la puntuacion maxima de la prueba.';
            }else{
                $correccion = $bd->obtenerCorreccion($_POST['prueba'],$_SESSION['alumno']->getId());
                if($correccion != null){
                    $error = 'Error. Esa prueba del alumno ya ha sido corregida';
                }else{
                    if($bd->realizarCorrecion($_SESSION['alumno']->getId(),$_POST['prueba'],$_POST['puntos'],$_POST['comentario'])){
                        $_SESSION['alumno'] = $bd->obtenerAlumno($_SESSION['alumno']->getId());
                    }else{
                        $error = 'No se pudo realizar la correcion';
                    }
                }
            }
        }else{
            $error = 'Error. Debes rellenar los campos puntos y comentario';
        }
    }

    if(isset($_POST['finalizar'])){
        $pruebasAlumno = $bd->obtenerPruebasModalidad($_SESSION['modalidad']->getId());
        $correcciones = $bd->obtenerCorrecionesAlumno($_SESSION['alumno']->getId());
        if(sizeof($pruebasAlumno) != sizeof($correcciones)){
            $error = 'Error. No se puede finalizar la correccion, ya que no se han corregido todas las pruebas del alumno';
        }else{
            if($bd->finalizarCorreciones($_SESSION['alumno']->getId())){
                $error = 'Correccion Finalizada';
                $_SESSION['alumno'] = $bd->obtenerAlumno($_SESSION['alumno']->getId());
            }else{
                $error = 'Error. No se pudo finalizar la correccion';
            }
        }
    }
?>