<?php include("header-zero.php")?>


<?php

function limpiar($string )
{
	$string = str_replace("\'","",$string); 
	return $string;
}


	$nombre		= limpiar($_POST['nombre']);
	$cbarra1 	= $_POST['cbarra1'];
	$cbarra2 	= $_POST['cbarra2'];
	$cbarra3 	= $_POST['cbarra3'];
	$marca 		= limpiar($_POST['marca']);
	$modelo 	= limpiar($_POST['modelo']);
	$desc1 		= limpiar($_POST['desc1']);
	$um1		= $_POST['um1'];
	$valor1 	= $_POST['valor1'];
	$fam 		= $_POST['fam'];
	$subfam 	= $_POST['subfam'];
	$comentario = $_POST['comentario'];
	
	$boton = "0";
	
	
	
	$sminimo  	= $_POST['sminimo'];
	$salerta	= $_POST['salerta'];
	$smaximo	= $_POST['smaximo'];
	$sactual	= $_POST['sactual'];
	
	
	$tarea = $_POST['tarea'];
	
	

	
	if (!empty($tarea))
	{
		
		if($nombre ==''|| $marca =='' || $modelo =='' || $fam =='' || $subfam =='' ){
			$tipomensaje= 2;
			$texto='Debe completar todos los campos';
			include("mensaje.php");
			}
			
		else{
		
		
		if ($cbarra1 != '' )
		{
			include("conector/conector.php");
			
			
			 
			$insert = "INSERT INTO tbk_producto VALUES(";
			$insert.= "'',";
			$insert.= "'".limpiar($cbarra1)."',";
			$insert.= "'".limpiar($nombre)."',";
			$insert.= "'".limpiar($comentario)."',";
			$insert.= "'".limpiar($marca)."',";
			$insert.= "'".limpiar($modelo)."',";
			$insert.= "'',";
			$insert.= "'".$fam."',";
			$insert.= "'".$subfam."',";
			$insert.= "'".limpiar($cbarra2)."',";
			$insert.= "'".limpiar($cbarra3)."'";
			
			$insert.= ")";
			
			if($res = mysql_query($insert,$conn))
			{
				
				
				$tipomensaje = 1;
				$texto ="Producto almacenado exitosamente";
				include("mensaje.php");
				header ("Location: elegirproductocompra.php?pos=1&nuewwro=$nombre");
				
				
				$idpro = mysql_insert_id();
				$boton= "1";
				$new = 0;
				
				$insert2 = "INSERT INTO tbk_producto_valor VALUES(";
				$insert2.= $idpro.",";
				$insert2.= $valor1.",";
				$insert2.= "0)";
				
				//echo $insert2;
				if ($res = mysql_query($insert2,$conn))
				{
					// precio almacenado exitosamente
				}
				else
				{
				
						// precio no almacenad
				}
				
				
				// unidad  de medida
				$insert2 = "INSERT INTO tbk_producto_um VALUES(";
				$insert2.= "'".$idpro."',";
				$insert2.= "'".$um1."'";
				$insert2.= ")";
				
				//echo $insert2;
				
				$res = mysql_query($insert2,$conn);
				
			}
			else
				{
					echo "<table border='0' width='800' bgcolor='#ffdddd'><tr><td align='right'> <table border='0'><tr><td><img src='images/alerta.gif'></td><td><label id='alerta'> Este codigo de Barra ya fue asignado a otro producto</label></td></tr></table> </td></tr></table>";
					$boton= "0";
				
				}
				
		}	
		else
		{
			$tipomensaje= 0;
			$texto='Alerta. Producto no ha sido almacenado.<Br/>El c&oacute;digo principal del producto no puede ser vac&iacute;o';
			include("mensaje.php");
		}
	
		}
	}	



	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>


<center>
<table border='0' width='850' height='400'>
<tr>
<td valign='top' >



	<form name='np' action='nuevo_productocompra.php' method ='POST' onSubmit="alert('Has pulsado enviar.'); return false;">
	
	
	<label id='subtitulo'> Nuevo Producto</label>
	<br/>
	<label id='comentariogris'> Complete todos los campos para ingresar el registro.</label>
	<hr/>
	<p/>
	
	
	<table border='0' width='800'>
	<tr>
	<td  valign='top' >

			
			<fieldset>
				<table border='0' cellspacing='5' cellpadding='5' >
			
				<tr>
				<td id='data'>
						<input type='text'  name='cbarra1' value='<?=$cbarra1?>' size='16'>
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
										$resum = mysql_query($searchum, $conn);
										
										$fichaump = mysql_fetch_row($resum);
										
										$unidadmedidapro = $fichaump[1];
							
									
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
<!--
	<tr>
	<td align='right'>
			<fieldset>
			<table border='0' cellpadding='5' cellspacing='5'>
			<tr>
				<td id='etiqueta' align='right'>
							<label id='titulo'>$</label>
							
				</td>
				<td id='data'>
						<input type='text' name='valor1' value='<?=$valor1?>' size='10' autocomplete = off>	
					
				</td>
			</tr>
			
			<tr>
				<td/>
				<td id='etiqueta'> Precio Unitario</td>
			
			</tr>
			</table>
			
			</fieldset>
		
			
			
	</td>
	</tr>
	
-->
	<!--
	
	<tr>
	<td align='left'>
		<fieldset>
			<table border='0' cellpadding='5' cellspacing='5'>
			<tr>
				<td id='data'><input type='text' name='sminimo' value='<?=$sminimo?>'></td>
				<td id='data'><input type='text' name='salerta' value='<?=$salerta?>'></td>
				<td id='data'><input type='text' name='smaximo' value='<?=$smaximo?>'></td>
				<td id='data' rowspan='3'><input type='text' class='num' name='sactual' value='<?=$sactual?>' size='17'></td>
			</tr>
			<tr>
				<td id='etiqueta'> Stock M&iacute;nimo</td>
				<td id='etiqueta'> Stock de Alerta</td>
				<td id='etiqueta'> Stock M&aacute;ximo</td>
			
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
						
						<table border='0' cellspacing='5' cellpadding='5'>
								<tr>
								<td id='data' valign='bottom' align='center'>
										<a  id='menualternativo' href='home.php'><img src="images/logos/cancelar0.jpg" onmouseover="this.src = 'images/logos/cancelar1.jpg'" onmouseout="this.src = 'images/logos/cancelar0.jpg'" border="0"></img></a><br/>
								</td>
								<td id='data' valign='bottom'  align='center'>
										<a id='menu' href='#' onClick ='np.tarea.value ="1"; submit()'><img src="images/logos/aceptar0.jpg" onmouseover="this.src = 'images/logos/aceptar1.jpg'" onmouseout="this.src = 'images/logos/aceptar0.jpg'" border="0"></img></a>
								</td>

								</tr>
						</table>
						<input type='hidden' name ='tarea' value=''>
						<input type='hidden' name='id' value='<?=$idpro?>'>
						
						<!-- <input type='image'  src='images/Flecha_azul.jpg'  onClick='javascript: submit()'>-->
						<!--
						<input type='button' value='Limpiar' onClick='np.cbarra.value=""; np.nombre.value=""; np.marca.value="";np.modelo.value=""'>
						<input type='Submit' value='Aceptar' onClick ='np.tarea.value ="1"; submit()'>
						-->
						
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