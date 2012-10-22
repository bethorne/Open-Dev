<?php include("header.php")?>

<?php


	$um 				= $_GET['um'];
	$t					= $_GET['t'];

	$tarea				= $_POST['tarea'];
	$nuevaum			= $_POST['nuevaum'];
	$editaum			= $_POST['editaum'];
	$codigoum		 	= $_POST['codigoum'];
	

	
	
	SWITCH ($tarea)
	{
					
		case '2' :
					
					if (!empty($editaum))
					{
						$updatefam  = "UPDATE tbk_parametro SET valor_param ='".$editaum."' WHERE id_param = ".$codigoum;
						if ($resfam = mysql_query($updatefam, $conn))
						{
						
							if ($codigoum == 1)
							{
								echo "<label id='comentariogris'>Actualizando precios de productos, por favor espere...</label><br/>";
								$buscaprecios ="SELECT id_pro, precio_efectivo_pv, precio_neto_pv, iva_pv FROM tbk_producto_valor ORDER BY id_pro ASC";
								$res = mysql_query($buscaprecios, $conn);
								
								$p=0;
								WHILE ($linea = mysql_fetch_row($res))
								{
									$idpro = $linea[0];
									$efectivo = $linea[1];
									$neto = $linea[2];
									$iva = $linea[3];
									
									
									//echo "=>".$idpro."/".$efectivo."/".$neto."/".$iva."<br>";
									
									$valoriva  = round((($neto * $editaum) / 100),0);
									
									$nuevoefectivo  = $neto  +  $valoriva;
									
									$update = "UPDATE tbk_producto_valor SET";
									$update .=" precio_efectivo_pv = '".$nuevoefectivo."',";
									$update .=" iva_pv = '".$editaum."'";
									$update .=" WHERE id_pro ='".$idpro."'";
									
									$resup = mysql_query($update,$conn);
									
									$p++;
									
								}
								echo "<label id='comentariogris'>Precios actualizados</label>.<br/>";
							}
							
							$texto = "El Par&aacute;metro  ha sido actualizado exitosamente.";
							$tipomensaje = 1 ;
							include("mensaje.php");
							echo "<p/>";
						
						}
						
					}
					else
						{
							$texto = "El parámetro no puede ser vac&iacute;o";
							$tipomensaje = 0 ;
							include("mensaje.php");
						}
					break;
					
	
	}
	
	//eilimar una unidad de medida
	if ($t == 9)
	{
			$searchump= "SELECT COUNT(id_pro) FROM tbk_producto_um WHERE id_um=".$um;
			
			//echo "<p>".$searchump."<p/>";
			$resump = mysql_query($searchump, $conn);
			
			$linea = mysql_fetch_row($resump);
			
			$cantidad = $linea[0];
			
			if ($cantidad == 0)
			{
			
						$updatefam  = "DELETE FROM tbk_unidad_medida  WHERE id_um = ".$um;
						//echo $updatefam;
						if ($resfam = mysql_query($updatefam, $conn))
						{
							$texto = "Unidad de Medida ha sido eliminada exitosamente.";
							$tipomensaje = 1 ;
							include("mensaje.php");
						
						}
						else
						{
							$texto = "Unidad de Medida no ha sido eliminada. Consulte el administrador para mayor informaci&oacute;n.";
							$tipomensaje = 0 ;
							include("mensaje.php");
						
						}
			}
			else
						{
							$texto = "Unidad de Medida no ha sido eliminada. Existen productos que actualmente la utilizan por lo tanto no puede ser eliminada.";
							$tipomensaje = 0 ;
							include("mensaje.php");
						
						}
			
	
	
	}
?>



<table border='0' width='800' cellpadding='1' cellspacing='1'>
<tr>
<td >
	
	<label id='subtitulo'>Par&aacute;metros del Sistema</label>
	<br/>
	<label id='comentariogris'>Configuraciones que el sistema requiere para su correcto funcionamiento. <br/>Se aconseja <i><u>m&aacute;xima precauci&oacute;n</u></i> en la modificaci&oacute;n de estos valores .</label>
	<p/>
	
	<center>
	<table border='0' width='600' cellpadding='5' cellspacing='5'>
	<tr>
	<td id='data' align='center'>
		
		
			<table border='0' width='350' cellpadding='5' cellspacing='5' height='300'>
			<tr>
			<td valign='top'>

				 
				<DIV style="OVERFLOW: scroll; overflow-x:hidden; WIDTH: 360px; HEIGHT: 200px; BACKGROUND-COLOR:#ffffff">
					<table border='0' cellpadding='2' cellspacing='5' width='340'>
					<tr>
				
						<th id='etiqueta'> Editar</th>
						<th id='etiqueta'> Seleccionar</th>
					</tr>
					
					<?php
				 
						$searchfam = "SELECT * FROM tbk_parametro WHERE 1 ORDER BY id_param ASC";
						$resfam = mysql_query($searchfam, $conn);
						
						$f=0;
						WHILE ($rowfam  = mysql_fetch_row($resfam))
						{
							$id= $rowfam[0];
							$nombre = $rowfam[2];
							$valor = $rowfam[4];

							$estilo = "data3";
							if ($id == $um) $estilo = "data4";

							
							echo "<tr><td align='center' id='data3'> <a href='parametros.php?um=".$id."&t=1'><img src='images/editar.jpg' border='0'></a> </td><td id='".$estilo."'>". $nombre."  </td></tr>";
							
							$f++;
						}
						
						
						if ($t == 1)
						{
						
							$searchum = "SELECT * FROM tbk_parametro WHERE id_param=".$um;
							$resum = mysql_query($searchum, $conn);
							
							
						
							$fichaum = mysql_fetch_row($resum);
							
							$nombreunidadmedida = $fichaum[4];
						
						}

					?>
					</table>
				</DIV>
				 
				<p/>
				 
				<form name='umedida' action='parametros.php' method='POST'>
			
				
				<table border='0' width='364'>
				<tr>
				<td id='data4' colspan='2'>
					Edici&oacute;n Valor Par&aacute;metro
				
				</td>
				</tr>
				<tr>
				<td id='data4'>
						<input type='text' class='num' name='editaum' value='<?=$nombreunidadmedida ?>' size='15'>
						<input type='hidden' name='codigoum' value='<?=$um?>' size='3'>
						<input type='hidden' name='tarea' value='' size='3'>
				 
				</td>
				<td id='data4' align='right' >
						
						<input type='submit' value='Aceptar' onClick='umedida.tarea.value="2"'>
				</td>
				</tr>
				</table>
				 
				</form>
			
			</td>	

			
					
			</tr>
			</table>
		

	
	</td>
	<td id='data4' valign='top'>
			<img src='images/alerta.gif'><p/>
			... Y no olvide... <p/> <b>CERRAR EL SISTEMA Y TODOS SUS TERMINALES</b> en ejecuci&oacute;n ... <p/> ... y vuelva a ingresar al sistema para que los cambios tomen efecto.
	
	</td>

	</tr>
	</table>
	</center>



</td>
</tr>
</table>



<?php include("footer.php")?>