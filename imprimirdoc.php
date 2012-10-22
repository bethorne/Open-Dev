<?php include("header.php")?>


<?php


	include("functions.php");


	$cb 		= $_GET['cb'];
	$see 		= $_POST['look'];


	$erut		= $_POST['erut'];
	if (!empty($erut)) $codigofactura = $erut ;
	$nrut 		= $_POST['nrut'];
	
	
	
	$boton 		= "0";
	
	// pago de cuota
	
	$pagofactura 	= $_POST['FFID'];
	$pagocliente 	= $_POST['FUID'];
	$pagocuotas 	=  $_POST['quotas'];
	$pagomonto  	= $_POST['montopago'];
	$pagofecha  	= $_POST['FFECHA'];
	
	
	// echo " SE HA PAGADO BAJO LOS SIGUIENTES TERMINOS: ".$pagofactura." por ".$pagocliente." la cantidad de ".$pagomonto." correspondientes a ".$pagocuotas." cuotas<p/>";
	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert = "SELECT * FROM tbk_documento WHERE codigo_doc LIKE '".trim($codigofactura)."%' AND tipo_doc = 3 AND codigo_doc  <> '' ORDER BY id_doc DESC";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_documento WHERE rut_cli LIKE '".trim($nrut)."%' AND tipo_doc IN (3) AND codigo_doc  <> '' ORDER BY id_doc DESC";
					break;
					
		

			case '3':
					$insert = "SELECT * FROM tbk_doc WHERE SUBSTR(fecha_doc,4,2) LIKE '".trim($marca)."%' AND tipo_doc IN (3) AND codigo_doc  <> '' ORDER BY id_doc DESC";
					break;
			
			
			case '9':
					//echo "almacenando pago de cuotas";
					
					$insert = "INSERT INTO tbk_pago_cuota VALUES (";
					$insert .= "'".$pagofactura."',";
					$insert .= "'".$pagocliente."',";
					$insert .= "'".$pagocuotas."',";
					$insert .= "'".$pagomonto."',";
					$insert .= "'".$pagofecha."'";
					$insert .= ")";
					
					//echo "->".$insert."<p/>";
					
					if($resulta = mysql_query($insert, $conn))
					{
						echo "<table border='0' width='880' bgcolor='#ddffdd'><tr><td align='right'> <table border='0'><tr><td><img src='images/alerta.gif'></td><td><label id='alerta'> Pago de cuota(s)  realizado  exitosamente</label></td></tr></table> </td></tr></table>";
					}
					else
						{
							echo "<table border='0' width='880' bgcolor='#ffdddd'><tr><td align='right'> <table border='0'><tr><td><img src='images/alerta.gif'></td><td><label id='alerta'> Se ha producido un error en el registro del pago de la cuota</label></td></tr></table> </td></tr></table>";
						}
					
					
					// RECORDAR ACTUALIZAR 
					
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
			$insert = "SELECT * FROM tbk_documento WHERE id_doc LIKE '".trim($cb)."'";	
			
			if($respro = mysql_query($insert,$conn))
			{	
				$ficha[]="";
				
			
				$ficha = mysql_fetch_row($respro);
				

				
				$scodigo 	= $ficha[0];
				$scliente	= $ficha[1];
				$stipodoc 	= $ficha[2];
				$sfecha		= $ficha[3];
				$stotal		= $ficha[4];
				$codigodoc  = $ficha[6];
				$obs		= $ficha[8];
				
				$proceso ="";
				SWITCH($stipodoc)
				{
					case '1' : $proceso = "Boleta"; break;
					case '2' : $proceso = "Gu&iacute;a"; break;
					case '3' : $proceso = "Factura"; break;
							
							
							
				}
							

			
			}
	
	}

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>


<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> IMPRESION DE DOCUMENTO DE VENTA :: FACTURA</label>
	<br/>
	<label id='comentariogris'> Complete uno de los campos para realizar la b&uacute;squeda. Si desea listar todos los documentos de venta, haga click en 'buscar c&oacute;digo' con el campo vac&iacute;o.</label>
	<hr/>
	<p/>


	<form name='boleta' action='imprimirdoc.php?cb=<?=$cb?>' method ='POST'>
	

	<table border='0' width='400'>
	<tr>
	<td width='400' valign='top'>
	

	
			<label id='subtitulo'> Buscar y seleccionar documento de venta </label>
			<p/>
			
			<fieldset>
			    <!--
				<table border='0' cellspacing='5' cellpadding='5' width='390' >
				<tr>
				<td valign='top' align='right' width='70'>
						<input type='text' name='nombre' value='<?=limpiar($nombre)?>' size='10' >
						<br/>
						<label id='comentario'>por c&oacute;digo</label>
						
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/binoculares.gif' onClick='boleta.look.value=1; np.submit()'>
				</td>
				<td valign='top'  width='100' align='right'>
					<a  href="buscarclientefact.php" target="popup"  onClick="window.open(this.href, this.target, 'width=500,height=400'); return false;"><img src='images/lupa.png' border='0'></a>
					<input type='text' name='nrut' size='20' value='<?=$nrut?>' readonly ='readonly'>
					
					<input type='hidden' name='nnombre' value='' size='30' readonly ='readonly'>
					<br/>
					<label id='comentario'>por cliente</label>
					
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/binoculares.gif' onClick='boleta.look.value=2; np.submit()'>
				</td>
				</tr>
					
				</table>
				-->
				
				<p/>
				
				<table border='0' cellspacing='5' cellpadding='5' width='430' background='images/logos/fondo_menu.jpg'>
				<tr>
				<td>
					<label id='comentario'>C&oacute;digo Factura</label>
				</td>
				<td valign='top' align='right' width='100'>
						<input type='text' name='erut' value='<?=limpiar($erut)?>' size='14' >
				</td>
				<td/>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='boleta.look.value=1; np.submit()'>
				</td>
				</tr>
				
				<tr>
				<td>
					<label id='comentario'>Cliente</label>
				</td>
				<td valign='top'  width='100' align='right'>
						<input type='text' name='nrut' value='<?=$nrut?>'  size='14'>						
				</td>
				<td>
						<a  href="buscarclientefact.php" target="popup"  onClick="window.open(this.href, this.target, 'width=500,height=400'); return false;"><img src='images/buscarcliente.png' border='0'></a>
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='boleta.look.value=2; np.submit()'>
				</td>

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
							$facturaID = $row[0];
							$clienteID = $row[1];
							$tipodoc   = $row[2];
							$fechafact = $row[3];
							$total     = $row[4];
							$estado    = $row[5];
							$codigodoc = $row[6];
							
							$proceso ="";
							SWITCH($tipodoc)
							{
								case '1' : $proceso = "Boleta"; break;
								case '2' : $proceso = "Gu&iacute;a"; break;
								case '3' : $proceso = "Factura"; break;
							
							
							
							}
							
							echo "<tr><td id='data' width='20'><a id='etiquetazul' href='generapdf.php?cb=".$facturaID."' target='_blank'><font size='4'>".$codigodoc."</font></a></td><td id='data'>".$clienteID."</td><td id='data'>".$fechafact."</td><td id='data'>$ ".$total."</td><td id='data'>".$proceso."</td></tr>";
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
			
			<center>
			
			<!-- impresion de documento -->
			<?php if (!empty($cb)) :?>
		
			<?php
			
					//Buscar datos de cliente
					$searchCli = "SELECT * FROM tbk_cliente WHERE rut_cli = '".$scliente."'";
					$resultaCli = mysql_query($searchCli, $conn);
					$i=0;
					While ($row = mysql_fetch_row($resultaCli))
						{
							$frut 		= $row[0];
							$fnombre 	= $row[1];
							$fpaterno  	= $row[2];
							$fmaterno 	= $row[3];
							$fnombrecompleto = "(".$frut.") ".$fnombre." ".$fpaterno." ".$fmaterno; 
							
							$fdir 		= $row[4];
							$fcomuna 	= $row[5];
							$fregion 	= $row[6];
							$ffono		 = $row[7];
							
							$i++;
						}
					
						//echo "ACA:: ".$searchCli." NOMBRE COMPLETO ".$fombrecompleto;
			
			?>
		
		
			<!--
			<label id='subtitulo'><?=$proceso?> N° <?= $codigodoc ?></label>
			<p/>
			-->
	
			<fieldset>
			
			<table border='0' cellspacing='5' cellpadding='5' width='400'>
			<tr>
			<td  id='data'>
				<label id='comentario'><font size='4'> <i> <?=$sfecha?></i></font></label>
			</td>
			<td  id='data' align='right' colspan='4'>
				 <label id='comentario'> <font size='4'> <?=$proceso?> N°<br/><?=$codigodoc?></font></label>
			</td>
			</tr>
			
			<tr><td height='25' colspan='5'><hr/></td></tr>
					
					
			<tr>
			<td id='data' colspan='5'>
				 <label id='comentario'><?=$fnombrecompleto?> </label>
			</td>
			</tr>
			
						<tr>
			<td id='data' colspan='5'>
				 <label id='comentario'><?=$fdir." - ".$fcomuna?> </label>
			</td>
			</tr>
			
			<tr><td height='25' colspan='5'><hr/></td></tr>
		
			
			<tr><td id='etiqueta'> Producto</td><td id='etiqueta'> Cant.</td><td id='etiqueta'>Pendiente<br/>Despacho</td><td id='etiqueta' width='50' >  $<br/> Unitario</td><td id='etiqueta' width='60'> $<br/>Total</td></tr>
					
			<?php
			
				$find = "SELECT * FROM tbk_docpro WHERE  id_doc = ".$scodigo;
				if ($resf = mysql_query($find, $conn))
				{
					$j=0;
					$subtotal = 0;
					
					// fijemos estos valores generales para a factura y sus notas
					$totalcantidad[] =0;
					$totalpendiente[] =0;
					$ultimoprecio[]=0;
					
					
					
					WHILE ($ficha2 = mysql_fetch_row($resf))
					{
					
							$fcbarra 			= trim($ficha2[1]);
							$ftipodespacho		= $ficha2[2];
							$fcantidad 			= $ficha2[3];
							//$fvalorunitario 	= $ficha2[4];
							$fguia			 	= $ficha2[5];
							$festado			= $ficha2[6];

							
							$totalcantidad[$fcbarra]  	=  $totalcantidad[$fcbarra] 	+ $fcantidad;
							$totalpendiente[$fcbarra]  	=  $totalpendiente[$fcbarra] 	+ $fguia;
							
							
					
							//buscar valor neto
							$buscaneto = "SELECT * FROM tbk_producto_valor WHERE cbarra_pro  ='".$fcbarra."'";
							if ($resneto = mysql_query($buscaneto, $conn))
							{
								$fprod = mysql_fetch_row($resneto);
								//obteniendo neto
								$fvalorneto 	= $fprod[4];
								$fvalorventa 	= $fprod[3];
							}
							
							
							
							//$subtotal = $subtotal + ($fcantidad * $fvalorunitario);
							if ($festado == 0)
							{
								if ($stipodoc == 1)
								{
									$subtotal = $subtotal + ($fcantidad * $fvalorventa);
									$ultimoprecio[$fcbarra] = $fvalorventa;
								}
								if ($stipodoc == 2)
								{
									$subtotal = $subtotal + ($fcantidad * $fvalorneto);
									$ultimoprecio[$fcbarra] = $fvalorneto;
								}
								if ($stipodoc == 3)
								{
									$subtotal = $subtotal + ($fcantidad * $fvalorneto);
									$ultimoprecio[$fcbarra] = $fvalorneto;
								}
							}
							$stockFactura = $stockFactura - $fguia;
				?>	
					
							<tr>
							<td id='data' width='180'>
								<label id='comentario'><?=nombreprod($fcbarra)?></label>
							</td>

							<td id='data' align='right' width='10'>
								<label id='comentario'><?=$fcantidad?></label>
							</td>
							<td id='data' align='right' width='10'>
								<label id='comentario'><?=$fguia?></label>
							</td>
							<td id='data' align='right' >
								<label id='comentario'>$ 
								<?php 

									if ($stipodoc == 1) echo $fvalorventa;
									if ($stipodoc == 2) echo $fvalorneto;
									if ($stipodoc == 3) echo $fvalorneto;

									

								?>
								</label> 
							</td>
							<td id='data' align='right' >
								<label id='comentario'>$ 
								<?php 

									if ($stipodoc == 1) echo $fvalorventa * $fcantidad;
									if ($stipodoc == 2) echo $fvalorneto * $fcantidad;
									if ($stipodoc == 3) echo $fvalorneto * $fcantidad;

									

								?>
								</label> 
							</td>
							
							</tr>
							
					<?php
							$j++;
								
					}
							if ($stipodoc == 3) 
							{
								// el iva se calcula solo para la factura  se trabaja con el NETO
								$subtotaliva = round((($subtotal * $iva)/100),0);
							}
							else $subtotaliva = 0;
					?>
					

						<tr>
						<td />
						<td />
						<td />
					
						<td >
							<label id='comentario'>Neto </label>
						</td>
						<td id='etiqueta' align='right'>
							$ <?=$subtotal?>
						</td>
						</tr>	
						
						<tr>
						<td />
						<td />
						<td />
						<td >
							<label id='comentario'>IVA </label>
						</td>
						<td align='right' >
							<label id='comentario'>$<?=$subtotaliva?></label>
						</td>
						</tr>

						<tr>
						<td />
						<td />
						<td />
						<td >
							<label id='comentario'>TOTAL </label>
						</td>
						<td id='etiqueta' align='right' >
							$<?=$stotal?>
						</td>
						</tr>	


						<tr>
						<td colspan='5' id ='data'>
							Observaciones:<br/>
							<ul>
								<i><?=$obs?></i>
							</ul>
							
						</td>
						</tr>
						</table>
						
				<?php
				
				}
				
				?>
				
			<?php endif ?>
			</fieldset>
	
		

	</td>

	</tr>
	</table>
	<input type='hidden' name='look' value=''>	
	</form>
	
</td>
</tr>
</table>


<?php include("footer.php");?>