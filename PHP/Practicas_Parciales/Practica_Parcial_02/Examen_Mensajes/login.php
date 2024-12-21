<?php
    require_once 'controlador.php';

    if(isset($_SESSION['empleado'])){
        //Redirigimos si ya estamos logueados
        header('location:mensajes.php');
    }
    require_once 'controlador.php';
?>
<!doctype html>
<html>
      <head>
        <meta charset="utf-8">
        <title>Examen 22_23</title>
       </head>
     <body>     	
 			<div> 
                <h1 style='color:red;'>mostrar mensaje si es necesario</h1>
                <?php
                    if(isset($error)){
                        echo '<div>'.$error.'</div>';
                    }
                ?> 
            </div>    
        	<form action="login.php" method="post">              	
            		<h1>Login</h1>    
            		<div> 
                		<label for="usuario">Id de Empleado</label><br/>           		
                        <input type="text" id="usuario" name="usuario"/>  
                    </div>
                    <div> 
                        <label for="ps">Contraseña</label><br/>                           
                        <input type="password" id="ps"   name="ps"/>      
                    </div>                               
                    <br/><button type="submit" name="acceder">Acceder</button>                        
      		</form>           
	</body>
</html>