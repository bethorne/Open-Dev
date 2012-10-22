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
		case '1' :
					//echo "Nueva familia de productos";
					
					if (!empty($nuevaum))
					{
						$insert= "INSERT INTO tbk_unidad_medida VALUES (";
						$insert.="'',";
						$insert.= "'".$nuevaum."',";
						$insert.= "''";
						$insert.= ")";
						
						//echo $insert;
						if ($resfam = mysql_query($insert, $conn))
						{
							$texto = "Nueva Unidad de Medida ha sido agregada exitosamente.";
							$tipomensaje = 1 ;
							include("mensaje.php");
						
						}
						
					}
					else
						{
							$texto = "Unidad de Medida no ha sido registrado. Consulte con el adminstrador para mayor informaci&oacute;n.";
							$tipomensaje = 0 ;
							include("mensaje.php");
						}
					break;
					
					
					
		case '2' :
					//echo "Editando familia de productos";
					
					if (!empty($editaum))
					{
						$updatefam  = "UPDATE tbk_unidad_medida SET nombre_um  ='".$editaum."' WHERE id_um = ".$codigoum;
						if ($resfam = mysql_query($updatefam, $conn))
						{
							$texto = "Unidad de Medida ha sido actualizado exitosamente.";
							$tipomensaje = 1 ;
							include("mensaje.php");
						
						}
						
					}
					else
						{
							$texto = "Unidad de Medida no puede ser vac&iacute;o";
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



<table border='0' width='750' cellpadding='1' cellspacing='1'>
<tr>
<td>

	<table border='0' width='750' cellpadding='5' cellspacing='5'>
	<tr>
	<td>
		<fieldset>
		
			<table border='0' width='750' cellpadding='5' cellspacing='5' height='380'>
			<tr>
			<td valign='top'>
				 <label >Unidades de Medida</label>
				 <p/>
				 
				 <DIV style="OVERFLOW: scroll; overflow-x:hidden; WIDTH: 350px; HEIGHT: 200px; BACKGROUND-COLOR:#ffffff">
					<table border='0' cellpadding='2' cellspacing='5' width='320'>
					<tr>
						<th id='etiqueta'> Borrar</th>
						<th id='etiqueta'> Editar</th>
						<th id='etiqueta'> Seleccionar</th>
					</tr>
					
					<?php
				 
						$searchfam = "SELECT * FROM tbk_unidad_medida WHERE 1 ORDER BY nombre_um ASC";
						$resfam = mysql_query($searchfam, $conn);
						
						$f=0;
						WHILE ($rowfam  = mysql_fetch_row($resfam))
						{
							$idum = $rowfam[0];
							$nombreum = $rowfam[1];

							$estilo = "data3";

							
							echo "<tr><td id='".$estilo."' align='center'><a name='".$idum."'><a href='unidadesdemedida.php?um=".$idum."&t=2'><img src='images/erase.jpg' border='0'></a></td><td align='center' id='".$estilo."'> <a href='unidadesdemedida.php?um=".$idum."&t=1'><img src='images/editar.jpg' border='0'></a> </td><td id='".$estilo."'>". $nombreum."  </td></tr>";
							
							$f++;
						}
						
						
						if ($t == 1)
						{
						
							$searchum = "SELECT * FROM tbk_unidad_medida WHERE id_um=".$um;
							$resum = mysql_query($searchum, $conn);
							
							
						
							$fichaum = mysql_fetch_row($resum);
							
							$nombreunidadmedida = $fichaum[1];
						
						}

					?>
					</table>
				 </DIV>
				 
				 <p/>
				 
				<form name='umedida' action='unidadesdemedida.php' method='POST'>
				 
				<table border='0' width='350'>
				<tr>
				<td id='etiqueta' colspan='2'>
					Nueva Unidad de Medida
				</td>
				</tr>
				<tr>
				<td>
						<input type='text' name='nuevaum' value='' size='30'>
						<input type='hidden' name='tarea' value='' size='3'>
				 
				</td>
				<td align='right'><input type='submit' value='Aceptar' onClick='umedida.tarea.value="1"'> </td>
				</tr>
				</table>
				
				
				<table border='0' width='350'>
				<tr>
				<td id='etiqueta' colspan='2'>
					Edici&oacute;n Unidad de Medida
				
				</td>
				</tr>
				<tr>
				<td>
						<input type='text' name='editaum' value='<?=$nombreunidadmedida ?>' size='30'>
						<input type='hidden' name='codigoum' value='<?=$um?>' size='3'>
				 
				</td>
				<td align='right'>
						
						<input type='submit' value='Aceptar' onClick='umedida.tarea.value="2"'>
				</td>
				</tr>
				</table>
				 
				</form>
			
			</td>
			<td width='400' valign='top'>
			
					<?php if ($t==2) :?>
				
					<fieldset>
						 <label id='subtitulo'>Confirmaci&oacute;n de Eliminaci&oacute;n</label>
						<p/>
						<table border='0'>
						<tr>
						<td id='data3'>	
								<?php
								$searchum = "SELECT * FROM tbk_unidad_medida WHERE id_um=".$um;
								$resum = mysql_query($searchum, $conn);
							
							
						
								$fichaum = mysql_fetch_row($resum);
							
								$nombreunidadmedida = $fichaum[1];
								
								
								?>
								
								¿Est&aacute; seguro que desea eliminar <b><u><?=$nombreunidadmedida ?></u></b> como Unidad de Medida?
						</td>
						</tr>
						<tr>
						<td align='right'>
							<table border='0' cellspacing='5' cellpadding='5'>
							<tr>
							<td id='data' height='30'>
								<a id='etiquetazul' href='unidadesdemedida.php'> Cancelar</a>
							</td>
							<td id='data'>
								<a id='etiquetazul' href='unidadesdemedida.php?um=<?=$um?>&t=9'> Confirmar</a>
							</td>
							</tr>
							</table>
						</td>
						</tr>
						</table>
					
					</fieldset>
				
				
				
					<?php endif ?>
			
			
			</td>
					
			</tr>
			</table>
		
		</fieldset>
	
	</td>

	</tr>
	</table>




</td>
</tr>
</table>



<?php include("footer.php")?>