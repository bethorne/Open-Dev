<?php include("header.php")?>


<?php



function limpiar($string )
{

	$string 	= str_replace("\'","",$string); 
	
	return  trim($string);
}



	$cb 		= $_GET['cb'];
	$see 		= $_POST['look'];


	$cantidad	= $_POST['cantidad'];	
	$irut		= $_POST['irut'];	
	$iobs		= $_POST['iobs'];	

	

	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				

					
			case '9':

					$flag = 1;
					
					if ($irut == '') $flag = 0;
					if ($cantidad == '') $flag = 0;
					if ($iobs == '') $flag = 0;
					
					
					if ($flag == 1)
						{
						// insertar en tabla inventario
						$fechakdx = date('Y-m-d H:i');

						$insertar =" INSERT INTO tbk_gasto VALUES (";
						$insertar .= "'',";
						$insertar .= "'".$fechakdx."',";
						$insertar .= "'".$cantidad."',";
						$insertar .= "'".$iobs."',";
						$insertar .= "'".$irut."'";
						$insertar .= ")";
						
						if ($res = mysql_query($insertar, $conn))
						{
							$tipomensaje=1;
							$texto = "El gasto ha sido registrado exitosamente";
							include("mensaje.php");
							
						
						}
					}
					else
					{
							$tipomensaje=0;
							$texto = "El gasto no ha sido registrado. Revise que ning&uacute;n campo est&eacute; vac&iacute;o. Si  el problema persiste, comun&iacute;quese con el administrador del sistema.";
							include("mensaje.php");
							
					
					}
			}
	}
	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>


<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'>GASTOS / SALIDAS </label>
	<br/>
	<label id='comentariogris'>Registro de salida de caja para efectos de cuadratura</label>
	<hr/>
	<p/>


	<form name='np' action='gastonuevo.php?cb=<?=$cb?>' method ='POST'>
	

	<table border='0'>
	<tr>
	<td width='800' valign='top'>

					<p/>

					<p/>
			
					<fieldset>
					
					<table border='0' cellspacing='5' cellpadding='5' width='750'>
					<tr>
					<td id='etiqueta'  width='100'>
						Cantidad Contabilizada
					</td>
					<td id='data'>
						<input type='text' class='num' name='cantidad' value='' size='10'>
					</td>
					<td id='etiqueta'  width='100'>
						Responsable del registro
					</td>
					<td id='data'>
							<SELECT name='irut'>
							<option />
							
							<?php
							
								$search ="SELECT * FROM tbk_user ORDER BY nombres_bk ASC";
								$res = mysql_query($search, $conn);
								
								$nfilas2  = mysql_num_rows($res);
								
								if ($nfilas2 > 0 )
								{
									$i=0;
									WHILE ($fichaemp = mysql_fetch_row($res))
									{
																	
										$erut = $fichaemp[1];
										$enombres =  $fichaemp[2]." ".$fichaemp[3]." ".$fichaemp[4];
									
										if ($erut != 'admin')
										{
											echo "<option value='".$erut."'>".$enombres."</option>";
										}
										$i++;	
									}
								}
								
							
							
							?>
							</SELECT>
					</td>
					</tr>
					<tr>
					<td id='etiqueta'  width='100'>
						Motivo/ Observaciones
					</td>
					<td id='data' colspan='3'>
						<textarea name='iobs' cols='100'></textarea>
					</td>
					
					</table>
					
					</fieldset>
					
	</td>

	</tr>
	</table>
	

	<p/>
	
	<table border='0'>
	<tr>

	<td>
	
			<table border='0' width='400'>
			<tr>
			<td align='right'>
					<table border='0'>
					<tr>
					<td>
						
						<input type='hidden' name='look' value=''>
					
					</td>
					</tr>
					</table>
				
			</td>
			</tr>
			</table>
	</td>
	
	</tr>
	<tr>
	<td align='right'> 
	
			<table border='0' width='800'>
			<tr>
			<td align='right'>
					<table border='0'>
					<tr>
					<td>
						
						<input type='hidden' name='idpro' value='<?=$idpro?>'>
						
						<!-- <input type='image'  src='images/Flecha_azul.jpg'  onClick='javascript: submit()'>-->
						
						<input type='button' value='Limpiar' onClick='np.cbarra.value=""; np.nombre.value=""; np.marca.value="";np.modelo.value=""'>
						<input type='Submit' value='Aceptar' onClick ='np.look.value ="9"; submit()'>
						
						
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