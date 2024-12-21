<?php
    require_once 'Modelo.php';

    $bd = new Modelo();

    session_start();

    if(isset($_POST['acceder'])){
        if(empty($_POST['usuario']) or empty($_POST['ps'])){
            $error = 'Error. Debes rellenar los campos Usuario y Contraseña';
        }else{
            $resultado = $bd->hacerLogin($_POST['usuario'],$_POST['ps']);
            if($resultado == 'Ok'){
                //Obtenemos el usuario y lo alamacenamos en la sesion
                $empleado = $bd->obtenerUsuarioConcreto($_POST['usuario'],$_POST['ps']);
                $_SESSION['empleado'] = $empleado;
            }else{
                $error = $resultado;
            }
        }
    }

    if(isset($_POST['cerrar'])){
        session_destroy();
        header('location:login.php');
    }

    if(isset($_POST['Enviar'])){
        if(!empty($_POST['asunto']) and !empty($_POST['mensaje'])){
            $idEmpleado = $_SESSION['empleado']->getIdEmp();
            $idDepartamento = $_POST['para'];
            $asunto = $_POST['asunto'];
            $mensaje = $_POST['mensaje'];
            $empleadosDeparamento = $bd->obtenerEmpleadosDepartamento($idDepartamento);
            if(!empty($empleadosDeparamento)){
                if($bd->mandarMensaje($idEmpleado,$idDepartamento,$asunto,$mensaje,$empleadosDeparamento)){
                    $error = 'Mensaje enviado correctamente';
                }else{
                    $error = 'Error. Algo ha fallado a la hora de mandar el mensaje';
                }
            }
        }else{
            $error = 'Error debes rellenar los campos asunto y mensaje.';
        }
    }
?>