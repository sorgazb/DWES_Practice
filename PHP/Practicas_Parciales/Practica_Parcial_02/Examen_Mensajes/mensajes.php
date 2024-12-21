<?php
	require_once 'controlador.php';

	if(!isset($_SESSION['empleado'])){
		header('localtion:login.php');
	}

?>

<!doctype html>
<html>
      <head>
        <meta charset="utf-8">        
        <title>Examen 22_23</title>
       </head>
     <body>
     		
     		<div> 
                <h1 style='color:red;'>Mensajes:</h1> 
				<?php
					if(isset($error)){
						echo '<h2 style="color:red;">'.$error.'</h2>';
					}
				?>
            </div>    
        	<form action="mensajes.php" method="post">              	
            		<h1 style="color:blue;">Nuevo Mensaje</h1>
					<?php
						if(isset($_SESSION['empleado'])){
					?> 
            		<h2 style="color:blue"><?php echo 'Empleado: '.$_SESSION['empleado']->getNombre().' - DNI: '.$_SESSION['empleado']->getDni().'- Departamento: '.$bd->obtenerDepartamentoConcreto($_SESSION['empleado']->getDepartamento())->getNombre().'' ?></h2>  
					<?php
						}
					?>            		
            		<hr/> 
            		<div> 
                		<label for="para">Para</label><br/>           		
                        <select id="para" name="para">
							<?php
								$departamentos = $bd->obtenerDepartamentos();
								foreach ($departamentos as $d) {
									echo '<option value="' . $d->getIdDep() . '">'
										. $d->getNombre() . '</option>';
								}
							?>
                        </select>  
                    </div>  
            		<div> 
                		<label for="asunto">Asunto</label><br/>           		
                        <input type="text" id="asunto" name="asunto" size="50" maxlength="50"/>  
                    </div>
                    <div> 
                		<label for="mensaje">Mensaje</label><br/>           		
                        <input type="text" id="mensaje" name="mensaje"  size="100" maxlength="100"/>  
                    </div>                               
                    <br/><button type="submit" name="Enviar">Enviar</button>
                    <button type="submit" name="cerrar">Cerrar Sesión</button>
                    <hr/> 
            		<h1 style="color:blue;">Bandeja de Entrada</h1> 
            		<hr/>   
            		<table width="100%">
            			<tr>
            				<th align="left">Id</th>
            				<th align="left">De</th>
            				<th align="left">Para Departamento</th>
            				<th align="left">Fecha</th>
            				<th align="left">Asunto</th>
            				<th align="left">Mensaje</th>
            			</tr>
						<?php
						$mensajesRecibidos = 
							$bd->obtenerMensajesRecidos($_SESSION['empleado']->getIdEmp());
						foreach($mensajesRecibidos as $m){
							echo '<tr>';
							echo '<td align="left">'.$m->getIdMen().'</td>';
            				echo '<td align="left">'.
							$m->getDeEmpleado()->getNombre().'</td> '; 
							echo '<td align="left">'.
							$m->getParaDepartamento()->getNombre().'</td> ';          				
            				echo '<td align="left">'.
							date('d/m/Y',strtotime($m->getFechaEnvio())).'</td>';
            				echo '<td align="left">'.$m->getAsunto().'</td>';
            				echo '<td align="left">'.$m->getMensaje().'</td>';
							echo '</tr>';
						}
						?>
            		</table>
            		<h1 style="color:blue;">Bandeja de Salida</h1> 
            		<hr/>   
            		<table width="100%">
            			<tr>
            				<th align="left">Id</th>
            				<th align="left">Para</th>            				
            				<th align="left">Fecha</th>
            				<th align="left">Asunto</th>
            				<th align="left">Mensaje</th>
            			</tr>
						<?php
							$mensajes = $bd->obtenerMensajesEnviados($_SESSION['empleado']->getIdEmp());
							foreach ($mensajes as $mensaje) {
								echo '<tr>';
								echo '<td>'.$mensaje->getIdMen().'</td>';
								echo '<td>'.$bd->obtenerDepartamentoConcreto(($mensaje->getParaDepartamento()))->getNombre().'</td>';
								echo '<td>'.$mensaje->getFechaEnvio().'</td>';
								echo '<td>'.$mensaje->getAsunto().'</td>';
								echo '<td>'.$mensaje->getMensaje().'</td>';
								echo'</tr>';
							}
						?>
            		</table>                              
      		</form>     
		      
	</body>
</html>
