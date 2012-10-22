<?php include("header.php")?>


<?php



function limpiar($string )
{

	$string 	= str_replace("\'","",$string); 
	
	return  trim($string);
}



	$cb 		= $_GET['cb'];
	$see 		= $_POST['look'];


	$nombre		= $_POST['nombre'];
	$cbarra 	= $_POST['cbarra'];
	$cantidad	= $_POST['cantidad'];	
	$irut		= $_POST['irut'];	
	$idpro		= $_POST['idpro'];	
	$iobs		= $_POST['iobs'];	

	

	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert = "SELECT * FROM tbk_producto WHERE nombre_pro LIKE '%".ltrim($nombre)."%'";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_producto WHERE codigo_pro LIKE '%".trim($cbarra)."'";
					break;

					
			case '9':

					// insertar en tabla inventario
					$fechakdx = date('YmdHi');

					$insertar =" INSERT INTO tbk_producto_merma VALUES (";
					$insertar .= "'".$fechakdx."',";
					$insertar .= "'".$idpro."',";
					$insertar .= "'".$cantidad."',";
					$insertar .= "'".$irut."',";
					$insertar .= "'".$iobs."'";
					$insertar .= ")";
					
					if ($res = mysql_query($insertar, $conn))
					{
					
						// actualizar stock del producto
						$insert = "INSERT INTO tbk_stock VALUES (";
						$insert .= "'".$idpro."',";
						$insert .= "'".$cantidad."',";
						$insert .= "'0',";
						$insert .= "'0',";
						$insert .= "'0'";
						$insert .= "')";
						
						if ($resstock  = mysql_query($insert, $conn))
						{
							
							// exito.. no decimos nada
						}
						else
						{
							//si hay error entonces actualicemos
							
							//buscar stock del producto
							$search="SELECT stock_stk FROM tbk_stock WHERE id_pro ='".$idpro."'";
							$res = mysql_query($search, $conn);
							
							$fichast = mysql_fetch_row($res);
							
							$stock = $fichast[0];
							
							$nuevostock = $stock - $cantidad;
							
							$update = "UPDATE tbk_stock SET ";
							$update.= " stock_stk ='".$nuevostock."' ";
							$update.= " WHERE id_pro ='".$idpro."'";
							
							$resup = mysql_query($update, $conn);
							
							
							
						}
						
						//ingresar operacion a kardex
						
										
						$insertkdx = "INSERT tbk_kardex VALUES(";
						$insertkdx.= "'".$fechakdx."',";
						$insertkdx.= "'7',";
						$insertkdx.= "'',";
						$insertkdx.= "'',";
						$insertkdx.= "'7',";
						$insertkdx.= "'".$idpro."',";
						$insertkdx.= "'".$irut."',";
						$insertkdx.= "'0',";
						$insertkdx.= "'".$cantidad."',";
						
						$insertkdx.= "'')";
										
										//echo $insertkdx;
						if ($reskdx  = mysql_query($insertkdx, $conn)) echo "<p/>OK KARDEX<p/>";
										
							$tipomensaje = 1;
							$texto = "La merma del producto ha sido registrada exitosamente. Este registro ahora  es parte del Kardex del producto.";
							include("mensaje.php");
						
					}	
					else
					{
							$tipomensaje = 0;
							$texto = "No fue posible ingresar la merma del producto. Consulte con el administrador para mayor informaci&oacute;n.";
							include("mensaje.php");
					
					}
					


					break;
		}
		//echo "BUSCANDO=".$insert;
		
		if($res = mysql_query($insert,$conn))
		{
			$busqueda = 1;
			
		}
			
		else
		{
		
			$busqueda = 0;
		}
			
			
	}	
		

	if (!empty($cb))
	{
			$insert = "SELECT * FROM tbk_producto WHERE codigo_pro LIKE '".trim($cb)."'";	
			if($respro = mysql_query($insert,$conn))
			{	
				$ficha[]="";
				
			
				$ficha = mysql_fetch_row($respro);
				
				$idpro 		= $ficha[0];
				$fnombre 	= $ficha[2];
				$fcbarra 	= $ficha[1];
				$fdesc 		= $ficha[3];
				$fmarca 	= $ficha[4];
				$fmodelo 	= $ficha[5];
				$fcodigo2   = $ficha[9];
				$fcodigo3   = $ficha[10];
				
			
			}
	
	}

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>


<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'>MERMA DE  PRODUCTO</label>
	<br/>
	<label id='comentariogris'> Complete uno de los campos para realizar la b&uacute;squeda. Si desea listar todos los productos, haga click en 'buscar nombre' con el campo vac&iacute;o.</label>
	<hr/>
	<p/>


	<form name='np' action='merma_nuevo.php?cb=<?=$cb?>' method ='POST'>
	

	<table border='0'>
	<tr>
	<td width='800' valign='top'>
	
			<label id='subtitulo'> Resultado B&uacute;queda </label>
			<p/>
			
				<table border='0' cellspacing='5' cellpadding='5' width='450' background='images/logos/fondo_menu.jpg' >
				<tr>
				<td>
					<label id='comentario'>Nombre</label>
				</td>
				<td valign='top' align='right' width='100'>
						<input type='text' name='nombre' value='<?=limpiar($nombre)?>' size='20' >					
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='np.look.value=1; np.submit()'>
				</td>
				</tr>
				
				<tr>
				<td>
					<label id='comentario'>C&oacute;digo</label>
				</td>
				<td valign='top'  width='100' align='right'>
						<input type='text' name='cbarra' value='<?=$cbarra?>'  size='20'>
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='np.look.value=2; np.submit()'>
				</td>
				</tr>


				</table>

			<p/>
			<fieldset>
				<table border='0' cellspacing='5' cellpadding='5' width='600' >
				<?php
				
					if ($busqueda == 1)
					{
						$i=0;
						While ($row = mysql_fetch_row($res))
						{
							
							$snombre = $row[2];
							$scbarra = $row[1];
							$smarca  = $row[4];
							$smodelo = $row[5];
							
							echo "<tr><td id='etiqueta' width='5'><img src='images/flechita.gif' border='0'></td><td id='data' width='20'><a id='etiquetazul' href='merma_nuevo.php?cb=".$scbarra."'>".$scbarra."</a></td><td id='data'>".$snombre."</td><td id='data'>".$smarca."</td><td id='data'>".$smodelo."</td></tr>";
							$i++;
						}
					}
					else
					{
						echo "<tr><td id='etiqueta'>Recuerde colocar s&oacute;lo letras y n&uacute;meros</td></tr>";
					}
				
				
				?>
				
					</table>
			
			</fieldset>
			
			<p/>
			
			
	</td>
	</tr>
	
	<tr>
	<td width='800' valign='top'>
	<?php if (!empty($cb)) :?>
		
			<label id='subtitulo'> Ficha Producto</label>
			<p/>
			
			<fieldset>
			
				
			<table border='0' cellspacing='5' cellpadding='5' >
			<tr>
				<td id='data'>
					 <?=$fcbarra?>
				</td>
				<td id='data'>
					 <?=$fcodigo2?>
				</td>
				<td id='data'>
					 <?=$fcodigo3?>
				</td>
			</tr>
			
			<tr>
				<td id='etiqueta'> C&oacute;digo producto</td>
				<td id='etiqueta'> C&oacute;digo alternativo 1</td>
				<td id='etiqueta'> C&oacute;digo alternativo 2</td>
			</tr>
			</table>
			
			<br/>
			
			<table border='0' cellspacing='5' cellpadding='5' width='750'>
			<tr>
				<td id='data'>
					 <?=$fnombre?>
				</td>
				<td id='data'>
					 <?=$fmarca?>
				</td>
				<td id='data'>
					 <?=$fmodelo?>
				</td>
				<td id='data'>
					 <?=$fdesc?>
				</td>
			</tr>
			
			<tr>
				<td id='etiqueta' align='left'>NOMBRE</td>
				<td id='etiqueta' align='left'>MARCA</td>
				<td id='etiqueta' align='left'>MODELO</td>
				<td id='etiqueta' align='left'>DESCRIPCION</td>
				
			</tr>
			</table>
			
			</fieldset>
			
			<?php
			
				$find = "SELECT * FROM tbk_pedido WHERE  id_pro = ".trim($idpro);
				
				if ($resf = mysql_query($find, $conn))
				{
				
					$ficha2 = mysql_fetch_row($resf);
					
					
					$pendiente = $ficha2[1];
					

				?>	
					<p/>
					<label id='subtitulo'>Merma de producto </label>
					<p/>
			
					<fieldset>
					
					<table border='0' cellspacing='5' cellpadding='5' width='750'>
					<tr>
					<td id='etiqueta'  width='100'>
						Cantidad Mermada
					</td>
					<td id='data'>
						<input type='text' class='num' name='cantidad' value='' size='5'>
					</td>
					<td id='etiqueta'  width='100'>
						Responsable del Registro
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
						Observaciones
					</td>
					<td id='data' colspan='3'>
						<textarea name='iobs' cols='100'></textarea>
					</td>
					
					</table>
					
					</fieldset>
					
		<?php 	} ?>	
					
	
	<?php endif ?>
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