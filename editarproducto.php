<?php include("header.php")?>


<?php

function limpiar($string )
{
	$string = str_replace("\'","",$string); 
	return $string;
}


	$cb = $_GET['cb'];
	
	
	if (!empty($cb))
	{
		$searchpro  = "SELECT * FROM tbk_producto WHERE codigo_pro ='".$cb."'";
		$respro = mysql_query($searchpro, $conn);
		
		$fichapro  = mysql_fetch_row($respro);
		
		

		$idpro = $fichapro[0];
		$nombre= $fichapro[2];
		$cbarra1 = $fichapro[1];
		$cbarra2 = $fichapro[9];
		$cbarra3 = $fichapro[10];
		$marca = $fichapro[4];
		$modelo = $fichapro[5];
		$desc1 = $fichapro[6];
		$fam = $fichapro[7];
		$subfam = $fichapro[8];

		
	
	}
	else
	{

		$nombre= $_POST['nombre'];
		$cbarra1 = $_POST['cbarra1'];
		$cbarra2 = $_POST['cbarra2'];
		$cbarra3 = $_POST['cbarra3'];
		$marca = $_POST['marca'];
		$modelo = $_POST['modelo'];
		$desc1 = $_POST['desc1'];
		$um1 = $_POST['um1'];
		$valor1 = $_POST['valor1'];
		$fam = $_POST['fam'];
		$subfam = $_POST['subfam'];
		$comentario = $_POST['comentario'];
	}
	$boton = "0";
	
	
	$tarea = $_POST['tarea'];
	
	

	
	if (!empty($tarea))
	{

		$insert = "UPDATE tbk_producto SET ";
		$insert.= "nombre_pro = '".limpiar($nombre)."',";
		$insert.= "descripcion_pro = '".limpiar($comentario)."',";
		$insert.= "marca_pro = '".limpiar($marca)."',";
		$insert.= "modelo_pro = '".limpiar($modelo)."',";
		$insert.= "id_fam = '".$fam."',";
		$insert.= "asc_fam = '".$subfam."',";
		$insert.= "codigo2_pro = '".limpiar($cbarra2)."',";
		$insert.= "codigo3_pro = '".limpiar($cbarra3)."'";
		
		$insert.= " WHERE codigo_pro  = '".$cbarra1."'";
		
		//echo $insert;
	
		if ($resup = mysql_query($insert,$conn))
		{
		
			$tipomensaje=1;
			$texto = "Ficha de Producto ha sido actualizado exitosamente";
			include("mensaje.php");
			
		
		
		}
		else
		{
			$tipomensaje=0;
			$texto = "Ficha de Producto no ha sido actualizado. Comun&iacute;quese con el administrador para mayor informaci&oacute;n.";
			include("mensaje.php");
		
		}
		
		$buscarid = "SELECT id_pro FROM tbk_producto WHERE codigo_pro ='".$cbarra1."'";
		$resid = mysql_query($buscarid);

		$fichapro = mysql_fetch_row($resid);

		$idpro = $fichapro[0];	
			
			
		$insert =" INSERT INTO tbk_producto_um VALUES('".$idpro."','".$um1."')";
		
		 if ($resum = mysql_query($insert,$conn))
		 {
			//echo "Ook INSERT:".$insert;
		 }
		 else
		 {
			// actualizar unidad de medida
			$insert = "UPDATE tbk_producto_um SET ";
			$insert.= "id_um = '".$um1."'";	
			$insert.= "  WHERE id_pro  = '".$idpro."'";
			
			$resum = mysql_query($insert,$conn);
			
			//echo "ok UPDATE ".$insert;
		}
		
	}	
		


	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>


<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >



	<form name='np' action='editarproducto.php' method ='POST'>
	
	
	<label id='subtitulo'> Ficha Producto</label>
	<br/>
	<label id='comentariogris'> Modifique  los campos del registro de desee actualizar.</label>
	<hr/>
	<p/>
	
	
	<table border='0' width='800'>
	<tr>
	<td  valign='top' >

						<fieldset>
				<table border='0' cellspacing='5' cellpadding='5' >
			
				<tr>
				<td id='data'>
						<input type='text'  name='cbarra1' value='<?=$cbarra1?>' size='16' readonly = "readonly">
				</td>
				<td id='data'>
						<input type='text'  name='cbarra2' value='<?=$cbarra2?>' size='16'>
				</td>
				<td id='data'>
						<input type='text'  name='cbarra3' value='<?=$cbarra3?>' size='16'>
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'>C&oacute;digo Producto</td>
				<td id='etiqueta'>C&oacute;digo Alternativo 1</td>
				<td id='etiqueta'>C&oacute;digo Alternativo 2</td>
				</table>
			
			</fieldset>
			
			<fieldset>
				<table border='0' cellspacing='5' cellpadding='5' width='800' >
				<tr>
				<td>
						<table border='0' width='400'>
						<tr>
						<td id='etiqueta'>Nombre Producto</td>
						<td id='data'>
								<input type='text' name='nombre' value='<?=limpiar($nombre)?>' size='30'>
						
						</td>
						</tr>
						
						<tr>
						<td id='etiqueta'>Marca</td>
						<td id='data'>
								<input type='text' name='marca' value='<?=$marca?>' size='30'>
						
						</td>
						</tr>
						
						<tr>
						<td id='etiqueta'>Modelo</td>		
						<td id='data'>
								<input type='text' name='modelo' value='<?=$modelo?>' size='30'>
						
						</td>
						</tr>
						</table>
				</td>
				<td>
						<table border='0' width='400'>
						<tr>
						<td id='etiqueta'> Familia</td>
						<td id='data'>
								<SELECT name='fam' onChange ="submit()">
									<option/>
								<?php
									
									$searchfam =  "SELECT * FROM tbk_familia WHERE asc_fam  = 0 ORDER BY nombre_fam ASC";
									$resfam  = mysql_query($searchfam, $conn);
									
									$f=0;
									WHILE($rowfam  = mysql_fetch_row($resfam))
									{
									
										$idfam 		= $rowfam[0];
										$nombrefam 	= $rowfam[1];
										
										
										echo "<option value='".$idfam."'";
										if ($idfam == $fam) echo "SELECTED";
										
										echo ">".$nombrefam."</option>";
										
										$f++;
									}
								
									
								
								?>
									
								</SELECT>
						
						</td>
						</tr>
						
						<tr>
						<td id='etiqueta'> SubFamilia</td>
						<td  id='data'>
						
								
								<SELECT name='subfam'>
									
									<?php
									
										if (!empty($fam))
										{
													$searchsub = "SELECT  * FROM tbk_familia WHERE asc_fam ='".$fam."' ORDER BY nombre_fam ASC";
													$ressub = mysql_query($searchsub, $conn);
													
													
													$a=0;
													WHILE ($rowsub = mysql_fetch_row($ressub))
													{
														$nombresub  = $rowsub[1];
														$idsub  = $rowsub[0];
													
														echo "<option value='".$idsub."'>".$nombresub."</option>";
														
														$a++;
											
													}
										
										
										}
							
									?>
								</SELECT>
						
						</td >
						</tr>
						
						<tr>
						<td id='etiqueta'> Unidad de Medida</td>
						<td id='data'>
						
								<SELECT name='um1'>
								<option />
								<?php
								
									if (!empty($idpro))
									{
										$searchum="SELECT * FROM tbk_producto_um WHERE id_pro = '".$idpro."'";
										//echo $searchum;
										$resum = mysql_query($searchum, $conn);
										
										
										$filasum = mysql_num_rows($resum);
										
										$unidadmedidapro = 0;
										if ($filasum > 0) 
											{
												$fichaump = mysql_fetch_row($resum);
												$unidadmedidapro = $fichaump[1];
											}
									
									}
									$searchum="SELECT * FROM tbk_unidad_medida ORDER BY nombre_um ASC";
									$resum = mysql_query($searchum, $conn);
									
									$u=0;
									WHILE ($ums = mysql_fetch_row($resum))
									{
										$idum = $ums[0];
										$nombreum = $ums[1];
										
									
										echo "<option value='".$idum."'";
										
										if ($idum  == $unidadmedidapro) echo "SELECTED";
										
										echo ">".$nombreum."</option>"; 
									
										$u++;
									}



								?>						
								</SELECT>
						
						</td>
						</tr>
						</table>
				</td>
				</tr>
				</table>
			
			</fieldset>

	</td>
	</tr>
	
	<!--
	<tr>
	
	<td valign='top' align='left'>
		

				<fieldset>
					
					<table border='0' cellspacing='5' cellpadding='5' >
					<tr>
					<td id='data'>
							<textarea name='comentario' cols='45'><?=limpiar($comentario)?></textarea>
					
					</td>
					</tr>
					<tr>
						<td id='etiqueta'> Comentario</td>
					</tr>
				
					</table>
				</fieldset>
					
	</td>
	</tr>
	-->

	
	<tr>
	<td align='right'> 
	
			<table border='0' width='800'>
			<tr>
			<td align='right'>
					<table border='0'>
					<tr>
					<td>
						
						<input type='hidden' name='id' value='<?=$idpro?>'>
						
						<!-- <input type='image'  src='images/Flecha_azul.jpg'  onClick='javascript: submit()'>-->
						<input type='hidden' name ='tarea' value=''>
						<input type='button' value='Limpiar' onClick='np.cbarra.value=""; np.nombre.value=""; np.marca.value="";np.modelo.value=""'>
						<input type='Submit' value='Aceptar' onClick ='np.tarea.value ="1"; submit()'>
						
						
					</td>
					</tr>
					</table>
				
			</td>
			</tr>
			</table>
	</td>
	
	</tr>
	</table>
			
			
	<p/>
	

	
	
	</form>





</td>
</tr>
</table>
</center>

<?php include("footer.php")?>