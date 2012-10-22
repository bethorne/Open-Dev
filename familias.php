<?php include("header.php")?>

<?php


	$fam  		= $_GET['fam'];
	$subfam  	= $_GET['subfam'];
	$t			= $_GET['t'];

	$tarea				= $_POST['tarea'];
	$nuevonombrefam 	= $_POST['nuevonombrefam'];
	$editanombrefam 	= $_POST['editanombrefam'];
	$codigofam			= $_POST['codigofam'];
	
	$nuevonombresubfam 	= $_POST['nuevonombresubfam'];
	$editanombresubfam 	= $_POST['editanombresubfam'];
	$codigosubfam		= $_POST['codigosubfam'];
	
	
	SWITCH ($tarea)
	{
		case '1' :
					//echo "Nueva familia de productos";
					
					if (!empty($nuevonombrefam))
					{
						$insert= "INSERT INTO tbk_familia VALUES (";
						$insert.="'',";
						$insert.= "'".$nuevonombrefam."',";
						$insert.= "''";
						$insert.= ")";
						if ($resfam = mysql_query($insert, $conn))
						{
							$texto = "Nueva Familia de Productos ha sido agregada exitosamente.";
							$tipomensaje = 1 ;
							include("mensaje.php");
						
						}
						
					}
					else
						{
							$texto = "Nombre de Familia de Productos no puede ser vac&iacute;o";
							$tipomensaje = 0 ;
							include("mensaje.php");
						}
					break;
					
					
					
		case '2' :
					//echo "Editando familia de productos";
					
					if (!empty($editanombrefam))
					{
						$updatefam  = "UPDATE tbk_familia SET nombre_fam  ='".$editanombrefam."' WHERE id_fam = ".$codigofam;
						if ($resfam = mysql_query($updatefam, $conn))
						{
							$texto = "Nombre de Familia de Productos ha sido actualizado exitosamente.";
							$tipomensaje = 1 ;
							include("mensaje.php");
						
						}
						
					}
					else
						{
							$texto = "Nombre de Familia de Productos no puede ser vac&iacute;o";
							$tipomensaje = 0 ;
							include("mensaje.php");
						}
					break;
					
					
					
	    case '3' :
					//echo "Nueva subfamilia de productos";
					
					if (!empty($nuevonombresubfam))
					{
						$insert= "INSERT INTO tbk_familia VALUES (";
						$insert.="'',";
						$insert.= "'".$nuevonombresubfam."',";
						$insert.= "'".$codigofam."'";
						$insert.= ")";
						
						//echo $insert;
						if ($resfam = mysql_query($insert, $conn))
						{
							$texto = "Nueva Subamilia de Productos ha sido agregada exitosamente.";
							$tipomensaje = 1 ;
							include("mensaje.php");
						
						}
						
					}
					else
						{
							$texto = "Nombre de Subfamilia de Productos no puede ser vac&iacute;o";
							$tipomensaje = 0 ;
							include("mensaje.php");
						}
					break;
		case '4' :
					//echo "Editando familia de productos";
					
					if (!empty($editanombresubfam))
					{
						$updatefam  = "UPDATE tbk_familia SET nombre_fam  ='".$editanombresubfam."' WHERE id_fam = ".$codigosubfam;
						if ($resfam = mysql_query($updatefam, $conn))
						{
							$texto = "Nombre de Subfamilia de Productos ha sido actualizado exitosamente.";
							$tipomensaje = 1 ;
							include("mensaje.php");
						
						}
						
					}
					else
						{
							$texto = "Nombre de Subfamilia de Productos no puede ser vac&iacute;o";
							$tipomensaje = 0 ;
							include("mensaje.php");
						}
					break;
	
	
	
	
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
				 <label >Familias</label>
				 <p/>
				 
				 <DIV style="OVERFLOW: scroll; overflow-x:hidden; WIDTH: 350px; HEIGHT: 200px; BACKGROUND-COLOR:#ffffff">
					<table border='0' cellpadding='2' cellspacing='5' width='320'>
					<tr>
						<th id='etiqueta'> Borrar</th>
						<th id='etiqueta'> Editar</th>
						<th id='etiqueta'> Seleccionar</th>
					</tr>
					
					<?php
				 
						$searchfam = "SELECT * FROM tbk_familia WHERE asc_fam = 0 ORDER BY nombre_fam ASC";
						$resfam = mysql_query($searchfam, $conn);
						
						$f=0;
						WHILE ($rowfam  = mysql_fetch_row($resfam))
						{
							$idfam = $rowfam[0];
							$nomfam = $rowfam[1];
							
							if (($fam == $idfam) &&  $t == 2)  $nombrefam = $nomfam;
								
							$estilo = "";
							if (($fam == $idfam)) 
							{
								$estilo = "etiqueta";
							}
							else
							{
								$estilo  = "";
							}
							
							echo "<tr><td id='' align='center'><a name='".$idfam."'><a href='eliminarfamilia.php?fam=".$idfam."'><img src='images/erase.jpg' border='0'></a></td><td align='center' id='".$estilo."'> <a href='familias.php?fam=".$idfam."&t=2#".$idfam."'><img src='images/editar.jpg' border='0'></a> </td><td id='".$estilo."'> <a id='mainmenu' href='familias.php?fam=".$idfam."#".$idfam."'>".$nomfam."</a>  </td></tr>";
							
							$f++;
						}
						

					?>
					</table>
				 </DIV>
				 
				 <p/>
				 
				<form name='familia' action='familias.php?fam=<?=$fam?>&subfam=<?=$subfam?>' method='POST'>
				 
				<table border='0' width='350'>
				<tr>
				<td id='etiqueta' colspan='2'>
					Nueva Familia de Productos
				</td>
				</tr>
				<tr>
				<td>
						<input type='text' name='nuevonombrefam' value='' size='30'>
						<input type='hidden' name='tarea' value='' size='3'>
				 
				</td>
				<td align='right'><input type='submit' value='Aceptar' onClick='familia.tarea.value="1"'> </td>
				</tr>
				</table>
				
				
				<table border='0' width='350'>
				<tr>
				<td id='etiqueta' colspan='2'>
					Edici&oacute;n Nombre de Familia de Productos
				
				</td>
				</tr>
				<tr>
				<td>
						<input type='text' name='editanombrefam' value='<?=$nombrefam?>' size='30'>
						<input type='hidden' name='codigofam' value='<?=$fam?>' size='3'>
				 
				</td>
				<td align='right'>
						
						<input type='submit' value='Aceptar' onClick='familia.tarea.value="2"'>
				</td>
				</tr>
				</table>
				 
				</form>
			
			</td>
			<td  valign='top'>
				<label id='subtitulo'>Subfamilias </label>
				 <p/>

				 <DIV style="OVERFLOW: scroll; overflow-x:hidden; WIDTH: 350px; HEIGHT: 200px; BACKGROUND-COLOR:#ffffff">
				 
					<table border='0' cellpadding='2' cellspacing='2' width='320'>
					<tr>
						<th id='etiqueta'> Borrar</th>
						<th id='etiqueta'> Editar</th>
						<th id='etiqueta'> Seleccionar</th>
					</tr>
					<?php
				 
					  if (!empty($fam))
					  {	
						$searchfam = "SELECT * FROM tbk_familia WHERE asc_fam = ".$fam." ORDER BY nombre_fam ASC";
						$resfam = mysql_query($searchfam, $conn);
						
						$f=0;
						WHILE ($rowfam  = mysql_fetch_row($resfam))
						{
							$idfam = $rowfam[0];
							$nomfam = $rowfam[1];
							$ascfam = $rowfam[2];
							
							if (($subfam == $idfam) &&  ($t == 4)) $nombresubfam = $nomfam;
							
							$estilo = "";
							if (($subfam == $idfam)) 
							{
							
								$estilo = "etiqueta";
							}
							else
							{
								$estilo  = "";
							}
							
							
							echo "<tr><td id='".$estilo."' align='center'><a href='eliminarsubfamilia.php?fam=".$idfam."'><img src='images/erase.jpg' border='0'></a></td> <td id='".$estilo."' align='center'> <a href='familias.php?fam=".$ascfam."&subfam=".$idfam."&t=4#".$ascfam."'><img src='images/editar.jpg' border='0'></a></td> <td id='".$estilo."'> <a id='mainmenu' href='familias.php?fam=".$ascfam."&subfam=".$idfam."#".$ascfam."'>".$nomfam."</a> </td></tr>";
							
							$f++;
						}
						
					   }
					?>
					
					</table>
				 </DIV>
				 <p/>
				 
				<form name='subfamilia' action='familias.php?fam=<?=$fam?>&subfam=<?=$subfam?>' method='POST'>
				 
				  
				<table border='0' width='350'>
				<tr>
				<td id='etiqueta' colspan='2'>
					Nueva Subfamilia de Productos
				</td>
				</tr>
				<tr>
				<td>
						<input type='text' name='nuevonombresubfam' value='' size='30'>
						<input type='hidden' name='tarea' value='' size='3'>
				 
				</td>
				<td align='right'><input type='submit' value='Aceptar' onClick='subfamilia.tarea.value="3"'> </td>
				</tr>
				</table>
				
				
				<table border='0' width='350'>
				<tr>
				<td id='etiqueta' colspan='2'>
					Edici&oacute;n Nombre Subfamilia
				
				</td>
				</tr>
				<tr>
				<td>
						<input type='text' name='editanombresubfam' value='<?=$nombresubfam?>' size='30'>
						<input type='hidden' name='codigosubfam' value='<?=$subfam?>' size='3'>
						<input type='hidden' name='codigofam' value='<?=$fam?>' size='3'>
				 
				</td>
				<td align='right'>
						
						<input type='submit' value='Aceptar' onClick='subfamilia.tarea.value="4"'>
				</td>
				</tr>
				</table>
				 
				 </form>
			
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