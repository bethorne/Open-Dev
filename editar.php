<?php include("header.php")?>


<?php



function limpiar($string )
{

	$string 	= str_replace("\'","",$string); 
	
	return $string;
}



	$cb 		= $_GET['cb'];
	$see 		= $_POST['look'];
	$ax			= $_POST['ax'];

	$nombre		= $_POST['nombre'];
	$cbarra 	= $_POST['cbarra'];
	$marca 		= $_POST['marca'];
	$modelo 	= $_POST['modelo'];
	$um1 		= $_POST['um1'];
	$valor1 	= $_POST['valor1'];
	$fam 		= $_POST['fam'];
	$subfam 	= $_POST['subfam'];
	$boton 		= "0";
	
	
	
	if ($ax == 2)
	{
	
		$enombre = $_POST['enombre'];
		$ecbarra = $_POST['ecbarra'];
		$emarca = $_POST['emarca'];
		$emodelo = $_POST['emodelo'];
		$edesc = $_POST['edesc'];
		
		$update = "UPDATE tbk_producto SET";
		$update.= " nombre_pro ='".limpiar($enombre)."',";
		$update.= " descripcion_pro ='".limpiar($edesc)."',";
		$update.= " marca_pro ='".limpiar($emarca)."',";
		$update.= " modelo_pro ='".limpiar($emodelo)."'";
		
			
		$update.= " WHERE cbarra_pro = '".$ecbarra."'";
		
		//echo $update;
	
		if ($resup = mysql_query($update, $conn))
		{
		
			$tipomensaje = 1;
			$texto = "Actualizaci&oacute;n ha sido realizada existosamente";
			include("mensaje.php");
			$cb = $ecbarra;
		}
		else
		{
			$tipomensaje = 0;
			$texto = "Error en la Actualizaci&oacute;n. ";
			include("mensaje.php");
		}
	
	}
	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert = "SELECT * FROM tbk_producto WHERE nombre_pro LIKE '".trim($nombre)."%'";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_producto WHERE cbarra_pro LIKE '".trim($cbarra)."'";
					break;
					
		

			case '3':
					$insert = "SELECT * FROM tbk_producto WHERE marca_pro LIKE '".trim($marca)."%'";
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
			$insert = "SELECT * FROM tbk_producto WHERE cbarra_pro LIKE '".trim($cb)."'";	
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
				
			
			}
	
	}


	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>


<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >


	<label id='subtitulo'> EDITAR FICHA PRODUCTO</label>
	<br/>
	<label id='comentariogris'> Modifique la informaci&oacute;n de  los campos de la ficha.</label>
	<hr/>
	<p/>
	
	

	<table border='0'>
	<tr>
	<td width='400' valign='top'>
	
		<form name='np' action='editar.php' method ='POST'>
			<label id='subtitulo'> Resultado B&uacute;queda </label>
			<p/>
			
			<fieldset>
			
				<table border='0' cellspacing='5' cellpadding='5' width='390' >
				<tr>
				<td valign='top' align='right' width='100'>
						<input type='text' name='nombre' value='<?=limpiar($nombre)?>' size='10' >
						<br/>
						<label id='comentario'>por nombre</label>
						
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/binoculares.gif' onClick='np.look.value=1; np.submit()'>
				</td>
				<td valign='top'  width='100' align='right'>
						<input type='text' name='cbarra' value='<?=$cbarra?>'  size='14'>
						<br/>
						<label id='comentario'>por c&oacute;digo barra</label>
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/binoculares.gif' onClick='np.look.value=2; np.submit()'>
				</td>
				<td valign='top'  width='100' align='right'>
						<input type='text' name='marca' value='<?=$marca?>'  size='10'>
						<br/>
						<label id='comentario'> marca</label>
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/binoculares.gif' onClick='np.look.value=3; np.submit()'>
				</td>
				<td />
				</tr>
					
				</table>
			
			</fieldset>
			<p/>
			<fieldset>
				<table border='0' cellspacing='5' cellpadding='5' width='400' >
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
							
							echo "<tr><td id='etiqueta' width='5'><img src='images/doble-flecha-izquierda.gif' border='0'></td><td id='data' width='20'><a id='etiquetazul' href='editar.php?cb=".$scbarra."'>".$scbarra."</a></td><td id='data'>".$snombre."</td><td id='data'>".$smarca."</td><td id='data'>".$smodelo."</td></tr>";
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
			
			<input type='hidden' name='look' value=''>
				
			</form>
			
			<!-- FIN FORMULARIO DE BUSQUEDA -->
			
	</td>
	<td width='400' valign='top'>
	
	<!-- formulario de edicion -->
	<?php if (!empty($cb)) :?>
		
			<form name='edita' action='editar.php' method ='POST'>
			
			<label id='subtitulo'> Ficha Producto </label>
			<p/>
			
			<fieldset>
			
			<table border='0' cellspacing='5' cellpadding='5' width='300'>
			<tr>
			<td id='etiqueta' width='100'>
				Nombre
			</td>
			<td id='data'>
				 <input type='text' name='enombre' value="<?=$fnombre?>">
				 
			</td>
			</tr>
			
			<tr>
			<td id='etiqueta'>
				C. Barra
			</td>
			<td id='data'>
				<?=$fcbarra?>
				<br/>
				<label id='mini'><i>No modificable</i></label>
				<input type='hidden' name='ecbarra' value='<?=$fcbarra?>'>
			</td>
			</tr>
			
			<tr>
			<td id='etiqueta'>
				Marca
			</td>
			<td id='data'>
				 <input type='text' name="emarca" value="<?=$fmarca?>">
			</td>
			
			</tr>
			
			<tr>
			<td id='etiqueta'>
				Modelo
			</td>
			<td id='data'>
				 <input type='text' name="emodelo" value="<?=$fmodelo?>">
			</td>
			</tr>
			
			<tr>
			<td id='etiqueta'>
				Descripci&oacute;n
			</td>
			<td id='data'>
				 <textarea name='edesc' rows='4' cols='23'><?=$fdesc?></textarea>
			</td>
			</tr>
			</table>
			
			</fieldset>
			
			<?php
			
				$find = "SELECT * FROM tbk_producto_valor WHERE  id_pro = ".$idpro;
				if ($resf = mysql_query($find, $conn))
				{
				
					$ficha2 = mysql_fetch_row($resf);
					
					$ffpu = $ficha2[1];
					$ffpv = $ficha2[2];
				?>	
					<p/>
					<label id='subtitulo'> Valor producto </label>
					<p/>
			
					<fieldset>
					
					<table border='0' cellspacing='5' cellpadding='5' width='300'>
					<tr>
					<td id='etiqueta' width='100'>
						Valor Unitario
					</td>
					<td id='data'>
						<?=$ffpu?>
					</td>
					</tr>
					
					<tr>
					<td id='etiqueta' width='100'>
						Valor Venta
					</td>
					<td id='data'>
						<?=$ffpv?>
					</td>
					</tr>
					</table>
					
					</fieldset>
					
		<?php 	} 
			
				$find = "SELECT * FROM tbk_stock WHERE  id_pro = ".$idpro;
				if ($resst = mysql_query($find, $conn))
				{
				
					$ficha3 = mysql_fetch_row($resst);
					
					$fffum 		= $ficha3[1];
					$fffstock 	= $ficha3[2];
					$fffmin 	= $ficha3[3];
					$fffalerta 	= $ficha3[4];
					$fffmax 	= $ficha3[5];
				?>	
					<p/>
					<label id='subtitulo'> Ficha Stock </label>
					<p/>
			
					<fieldset>
					
					<table border='0' cellspacing='5' cellpadding='5' width='300'>
					<tr>
					<td id='etiqueta' width='100'>
						Stock
					</td>
					<td id='data'>
						<?=$fffstock?>
					</td>
					</tr>
					
					<tr>
					<td id='etiqueta' width='100'>
						M&iacute;nimo
					</td>
					<td id='data'>
						<?=$fffmin?>
					</td>
					</tr>
					
					<tr>
					<td id='etiqueta' width='100'>
						M&iacute;nimo de Alerta
					</td>
					<td id='data'>
						<?=$fffalerta?>
					</td>
					</tr>
					
					<tr>
					<td id='etiqueta' width='100'>
						M&aacute;ximo
					</td>
					<td id='data'>
						<?=$fffmax?>
					</td>
					</tr>
					</table>
					
					<p/>
					
					<table border='0' width='300'>
					<tr>
					<td align='right'>
							<table border='0'>
							<tr>
							<td>
								
								<input type='hidden' name='ax' value='2'>
								<input type='submit' value='Aceptar'>
							
							</td>
							</tr>
							</table>
						
					</td>
					</tr>
					</table>
					
					</fieldset>
					
					</form>
					
		<?php 	} ?>
	
	<?php endif ?>
	</td>

	</tr>
	</table>
	

	<p/>
	
	<table border='0'>
	<tr>
	<!--
	<td width='400' valign='top'>
		
				<label id='subtitulo'> Clasficaci&oacute;n </label>
				<p/>
				

				<fieldset>
					
					<table border='0' cellspacing='5' cellpadding='5' >
					<tr>
					<td id='etiqueta'>
							Clase / Familia
					</td>
					<td>
							<SELECT name='fam'>
								<option/>
								<option>familia 1</option>
								<option>familia 2</option>
								<option>familia 3</option>
								<option>familia 4</option>
							</SELECT>
					
					</td>
					</tr>
						
					<tr>
					<td id='etiqueta'>
							Subclase / Subfamilia
					</td>
					<td>
							<SELECT name='subfam'>
								<option/>
								<option>subfamilia 1</option>
								<option>subfamilia 2</option>
								<option>subfamilia 3</option>
								<option>subfamilia 4</option>
							</SELECT>
					
					</td>
					</tr>
				
					</table>
				</fieldset>
					
	</td>
	-->
	<td>
	
			
	</td>
	
	</tr>
	</table>
			
			
	<p/>
	

	






</td>
</tr>
</table>
</center>

<?php include("footer.php")?>