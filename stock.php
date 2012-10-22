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
	$boton 		= "0";
	


	$nombre		= $_POST['nombre'];
	$cbarra 	= $_POST['cbarra'];
	$marca 		= $_POST['marca'];
	$modelo 	= $_POST['modelo'];
	$um1 		= $_POST['um1'];
	$valor1 	= $_POST['valor1'];
	$fam 		= $_POST['fam'];
	$subfam 	= $_POST['subfam'];
	$boton 		= "0";
	
	
	SWITCH($ax)
	{
	
	case '1':
		
		$estock = $_POST['efffstock'];
		$emin = $_POST['efffmin'];
		$emax = $_POST['efffmax'];
		$ealerta = $_POST['efffalerta'];
		$idpro = $_POST['idpro'];
		
		$insert = "INSERT INTO tbk_stock VALUES (";
		$insert.= $idpro.",";
		$insert.= "'',";
		$insert.= $estock.",";
		$insert.= $emin.",";
		$insert.= $ealerta.",";
		$insert.= $emax.")";
	
		
		
		//echo $insert;
		
		if ($resup = mysql_query($insert, $conn))
		{
		
			$tipomensaje = 1;
			$texto = "Ingreso y actualizaci&oacute;n ha sido realizada existosamente";
			include("mensaje.php");
			
		}

		
	
	case '2':
	
	
	
		$estock = $_POST['efffstock'];
		$emin = $_POST['efffmin'];
		$emax = $_POST['efffmax'];
		$ealerta = $_POST['efffalerta'];
		$idpro = $_POST['idpro'];
		
		
		$update = "UPDATE tbk_stock SET ";
		$update.= "stock_stk =".$estock.",";
		$update.= "minimo_stk =".$emin.",";
		$update.= "alerta_stk =".$ealerta.",";
		$update.= "maximo_stk =".$emax." ";
	
		$update.= " WHERE id_pro = '".$idpro."'";
		
		//echo $update;
		
		if ($resup = mysql_query($update, $conn))
		{
		
			$tipomensaje = 1;
			$texto = "Actualizaci&oacute;n ha sido realizada existosamente";
			include("mensaje.php");
			
		}
		else
		{
			$tipomensaje = 0;
			$texto = "Error en la Actualizaci&oacute;n. ";
			include("mensaje.php");
		}
		break;
		
			
	}
	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert = "SELECT * FROM tbk_producto WHERE nombre_pro LIKE '%".ltrim($nombre)."%'";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_producto WHERE codigo_pro LIKE '".trim($cbarra)."'";
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
				
			
			}
	
	}


	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>


<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >



	
	

	<table border='0'>
	<tr>
	<td width='800' valign='top'>
	
		<form name='np' action='stock.php' method ='POST'>
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
				<table border='0' cellspacing='5' cellpadding='5' width='750' >

				<?php
				
					if ($busqueda == 1)
					{
						echo "				
						<tr>
						<td/>
						<th id='etiqueta'> CODIGO</th>
						<th id='etiqueta'> NOMBRE</th>
						<th  id='etiqueta'> MARCA</th>
						<th id='etiqueta'> MODELO</th>
						<th id='etiqueta'> PRECIO NETO</th>
						<th id='etiqueta'> PRECIO EFECTIVO</th>
						
						</tr>";
						$i=0;
						While ($row = mysql_fetch_row($res))
						{
							$sid 	 = $row[0];
							$snombre = $row[2];
							$scbarra = $row[1];
							$smarca  = $row[4];
							$smodelo = $row[5];
							
							
							// valor producto
							
							$searchprecio = "SELECT  * FROM tbk_stock WHERE id_pro = ".$sid;
							$respre  = mysql_query($searchprecio, $conn);
							
							$fichastock = mysql_fetch_row($respre);
							
							$sminimo  = $fichastock[3];
							$salerta  = $fichastock[4];
							$smaximo  = $fichastock[5];
							$sstock   = $fichastock[2];
							
							echo "<tr><td id='data' width='20'><a id='etiquetazul' href='stock.php?cb=".$scbarra."'>".$scbarra."</a></td><td id='data'>".$snombre."</td><td id='data'>".$smarca."</td><td id='data'>".$smodelo."</td><td id='data'>".$sminimo."</td><td id='data'>".$salerta."</td><td id='data'>".$smaximo."</td><td id='data'>".$sstock."</td></tr>";
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
			

	
	<!-- formulario de edicion -->
	<?php if (!empty($cb)) :?>
		
		
			
			<label id='subtitulo'> Ficha Producto </label>
			<p/>
			
			<fieldset>
			
			<table border='0' cellspacing='5' cellpadding='5' width='750'>
			<tr>

			<td id='data'>
				<?=$fnombre?>
				 
			</td>
			<td id='data'>
				<?=$fcbarra?>
				
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
			<td id='etiqueta' >
				Nombre
			</td>
			<td id='etiqueta'>
				C. Barra
			</td>
			<td id='etiqueta'>
				Marca
			</td>
			<td id='etiqueta'>
				Modelo
			</td>
			<td id='etiqueta'>
				Descripci&oacute;n
			</td>

			</tr>
			</table>
			
			</fieldset>
			
			<?php
			
				$find = "SELECT * FROM tbk_producto_valor WHERE  id_pro= ".$idpro;
				if ($resf = mysql_query($find, $conn))
				{
				
					$ficha2 = mysql_fetch_row($resf);
					
					$unitario= $ficha2[2];
					$efectivo = $ficha2[3];
					$credito =$ficha2[4];

				?>	
					<p/>
					
	</td>
	</tr>
	
	<tr>
	<td width='800' valign='top'>
	
					<label id='subtitulo'> Valor producto </label>
					<p/>
			
					<fieldset>
					
					<table border='0' cellspacing='5' cellpadding='5' width='750'>
					<tr>
					<td id='etiqueta' width='100'>
						Valor Unitario
					</td>
					<td id='data'>
						$ <?=$unitario?>
					</td>
					</tr>
					
					<tr>
					<td id='etiqueta' width='100'>
						Valor Efectivo
					</td>
					<td id='data'>
						$ <?=$efectivo?>
					</td>
					</tr>
					
					<tr>
					<td id='etiqueta' width='100'>
						Valor Cr&eacute;dito
					</td>
					<td id='data'>
						$ <?=$credito?>
					</td>
					</tr>
					</table>
					
					</fieldset>
					
					
					<input type='hidden' name='idpro' value='<?=$idpro?>'>
					
					
					
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
					
										
					if ($fffstock =="")
					{
						$ax = 1;
					}
					else
					{
						$ax = 2;
					}
				?>	
				
				    <form name='edita' action='stock.php?cb=<?=$cb?>' method ='POST'>
					
						<p/>
						<label id='subtitulo'> Ficha Stock </label>
						<p/>
				
						<fieldset>
						
						<table border='0' cellspacing='5' cellpadding='5' width='300'>
						<tr>


						<td id='data'>
							<input type='text' class="num" name='efffmin' value='<?=$fffmin?>' size='9'>
						</td>
						<td id='data'>
							<input type='text'  class="num"   name='efffalerta' value='<?=$fffalerta?>' size='9'>
						</td>
						<td id='data'>
							<input type='text' class="num" name='efffmax' value='<?=$fffmax?>' size='9'>
						</td>
						<td id='data'>
							<input type='text'  class="num"   name='efffstock' value='<?=$fffstock?>' size='9'>
						</td>
						</tr>
						
						<tr>

						<td id='etiqueta' width='100'>
							M&iacute;nimo
						</td>
						<td id='etiqueta' width='100'>
							M&iacute;nimo de Alerta
						</td>
						<td id='etiqueta' width='100'>
							M&aacute;ximo
						</td>
						<td id='etiqueta' width='100'>
							Stock
						</td>
						</tr>
						</table>
						
						<p/>
						
						<table border='0' width='750'>
						<tr>
						<td align='right'>
								<table border='0'>
								<tr>
								<td>
									
									<input type='hidden' name='ax' value='<?=$ax?>'>
									<input type='text' name='idpro' value='<?=$idpro?>'>
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