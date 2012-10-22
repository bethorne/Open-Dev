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
	
	
	
	SWITCH($ax)
	{
	
	case '1':
		
		$preciocosto= $_POST['preciocosto'];
		$flete 		= $_POST['flete'];
		$ivap 		= $_POST['ivap'];
		//$alcredito 	= $_POST['alcredito'];
		$margen		= $_POST['margen'];
		$efectivo 	= $_POST['efectivo'];
		$neto	 	= $_POST['neto'];
		
		
		$idpro = $_POST['idpro'];
		$cbarrap = $_POST['cbarrap'];
		
		$insert = "INSERT INTO tbk_producto_valor VALUES (";
		$insert.= $idpro.",";
		$insert.= "'".$cbarrap."',";
		$insert.= "'".$preciocosto."',";
		$insert.= "'".$efectivo."',";
		$insert.= "'".$neto."',";
		$insert.= "'".$flete."',";
		$insert.= "'".$ivap."',";
		$insert.= "'0',";
		$insert.= "'".$margen."'";
		
		$insert.= ")";
	
		
		
		//echo $insert;
		
		if ($resup = mysql_query($insert, $conn))
		{
		
			$tipomensaje = 1;
			$texto = "Ingreso y actualizaci&oacute;n ha sido realizada existosamente";
			include("mensaje.php");
			
		}
		else
		{
			$tipomensaje = 0;
			$texto = "Error en la Actualizaci&oacute;n del precio del producto. ";
			include("mensaje.php");
		}
		break;
		
	
	case '2':
	
	
	
		$preciocosto= $_POST['preciocosto'];
		$flete 		= $_POST['flete'];
		$ivap		= $_POST['ivap'];
		//$alcredito 	= $_POST['alcredito'];
		$margen		= $_POST['margen'];
		$efectivo 	= $_POST['efectivo'];
		$neto		= $_POST['neto'];
		
		$idpro = $_POST['idpro'];
		
		$update = "UPDATE tbk_producto_valor SET ";
		$update.= " precio_costo_pv ='".$preciocosto."',";
		$update.= " precio_efectivo_pv ='".$efectivo."',";
		$update.= " precio_neto_pv ='".$neto."',";
		$update.= " flete_pv ='".$flete."',";
		$update.= " iva_pv ='".$ivap."',";
		$update.= " recargo_credito_pv ='0',";
		$update.= " margen_pv ='".$margen."' ";
	
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
			$texto = "Error en la Actualizaci&oacute;n del precio del producto. ";
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
					$insert = "SELECT * FROM tbk_producto WHERE codigo_pro LIKE '%".trim($cbarra)."%'";
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


	<label id='subtitulo'> FIJAR VALOR PRODUCTO</label>
	<br/>
	<label id='comentariogris'> Modifique los campos para actualizar el registro.</label>
	<hr/>
	<p/>
	
	

	<table border='0'>
	<tr>
	<td width='800' valign='top'>
	
		<form name='np' action='productovalor.php' method ='POST'>
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
							$sid	 = $row[0];
							$snombre = $row[2];
							$scbarra = $row[1];
							$smarca  = $row[4];
							$smodelo = $row[5];
							
							
							// valor producto
							
							$searchprecio = "SELECT  * FROM tbk_producto_valor WHERE id_pro = ".$sid;
							$respre  = mysql_query($searchprecio, $conn);
							
							$fichaprecio = mysql_fetch_row($respre);
							
							$valorunitario  = $fichaprecio[3];
							$valorventa  = $fichaprecio[4];
							
							
							echo "<tr><td id='data' width='5'><a  href='productovalor.php?cb=".$scbarra."'><img src='images/flechita.gif' border='0'></a></td><td id='data' width='20'><a id='etiquetazul' href='productovalor.php?cb=".$scbarra."'>".$scbarra."</a></td><td id='data'>".$snombre."</td><td id='data'>".$smarca."</td><td id='data'>".$smodelo."</td><td id='data' align='right'>$ ".$valorventa."</td><td id='data' align='right'>$ ".$valorunitario."</td></tr>";
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
			</td>
			<td id='data'>
				<?=$fdesc?>
			</td>
			</tr>
			
			<tr>
			<td id='etiqueta' width='100'>
				Nombre
			</td>
			<td id='etiqueta'>
				C&oacute;digo
			</td>
			<td id='etiqueta'>
				Marca
			</td>
			<td id='etiqueta'>
				Modelo
			</td>
			<td id='etiqueta'>
				Descripci&oacute;n

			</tr>
			</table>
			
			</fieldset>
		
	</td>
	</tr>
	
	
	<tr>
	<td width='750' valign='top'>
			<?php
			
				//buscar iva de parametros
				$findIVA = "SELECT valor_param FROM tbk_parametro WHERE  id_param= 1";
				$resIVA = mysql_query($findIVA, $conn);
				
				$ficha = mysql_fetch_row($resIVA);
				
				$iva = $ficha[0];
				
				
				
				$find = "SELECT * FROM tbk_producto_valor WHERE  id_pro= ".$idpro;
				if ($resf = mysql_query($find, $conn))
				{
				
					$ficha2 = mysql_fetch_row($resf);
					
					$preciocosto = $ficha2[2];
					$efectivo = $ficha2[3];
					$neto = $ficha2[4];
					$flete =$ficha2[5];
					$ivap = $ficha2[6];
					$alcredito = $ficha2[7];
					$margen = $ficha2[8];
					
					if(($preciocosto =="") && ($efectivo ==""))
					{
						$ax = 1;
					}
					else
					{
						$ax = 2;
					}
				?>	
					<p/>
					
					<form name='edita' action='productovalor.php?cb=<?=$cb?>' method ='POST'>
					<label id='subtitulo'> Valor producto </label>
					<p/>
			
					<fieldset>
					
					<table border='0' width='700'>
					<tr>
					<td width='50%'>
							<table border='0' cellspacing='5' cellpadding='5' >
							<tr>
							<td id='etiqueta' width='100'>
								Valor Unitario ($)
							</td>
							<td id='data'>
								<input type='text' name='preciocosto' value='<?=$preciocosto?>' size='10'>
							</td>
							</tr>
							
							<tr>
							<td id='etiqueta' width='100'>
								Valor Flete (%)
							</td>
							<td id='data'>
								<input type='text' c name='flete' value='<?=$flete?>' size='10'>
							</td>
							</tr>
							
							<tr>
							<td id='etiqueta' width='100'>
								Valor IVA (%)
							</td>
							<td id='data'>
								<input type='text'  name='ivap'  value='<?=$iva?>' size='10'>
							</td>
							</tr>
							
							<!--
							<tr>
							<td id='etiqueta' width='100'>
								Recarga Al Cr&eacute;dito (%)
							</td>
							<td id='data'>
								<input type='text' name='alcredito' value='<?=$alcredito?>' size='10'>
							</td>
							</tr>
							-->
							
							<tr>
							<td id='etiqueta' width='100'>
								Margen Utilidad (%)
							</td>
							<td id='data'>
								<input type='text' name='margen' value='<?=$margen?>' size='10'>
							</td>
							</tr>
							
							</table>
					</td>
					<td width='50%' valign='top'>
							<table border='0' cellspacing='5' cellpadding='5' >
							
														
							<tr>
							<td  width='100'>
								 <input type='button' value='Calcular Precio' onClick='calcularprecio()'>
							</td>

							</tr>
							

							
							<tr>
							<td id='etiqueta' width='100'>
								Precio Neto
							</td>
							<td id='data'>
								<input type='text' class='num' name='neto' value='<?=$neto?>' size='10'>
							</td>
							</tr>
							
							<tr>
							<td id='etiqueta' width='100'>
								Precio Venta
							</td>
							<td id='data'>
								<input type='text'  class='num' name='efectivo' value='<?=$efectivo?>' size='10'>
							</td>
							</tr>
							</table>
					
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
				?>	
					<p/>
					<label id='subtitulo'> Ficha Stock </label>
					<p/>
			
					<fieldset>
					
					<table border='0' cellspacing='5' cellpadding='5' width='750'>
					<tr>
					<td id='data'>
						<?=$fffmin?>
					</td>
					<td id='data'>
						<?=$fffalerta?>
					</td>
					<td id='data'>
						<?=$fffmax?>
					</td>
					<td id='data'>
						<?=$fffstock?>
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
								<input type='hidden' name='cbarrap' value='<?=$fcbarra?>'>
								<input type='hidden' name='ax' value='<?=$ax?>'>
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