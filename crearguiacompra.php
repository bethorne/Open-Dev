<?php include("header.php")?>


<?php


	include("functions.php");


	$cb 			= $_GET['cb'];
	$see 			= $_POST['look'];
	$guiaregistrada	= 0;
	$tpomensaje 	= 0;
	$texto			= "";


	$nombre		= $_POST['nombre'];
	if (!empty($nombre)) $codigofactura = $nombre;
	$nrut 		= $_POST['nrut'];
	
	$boton 		= "0";
	
	// guia
	
	
	$nguiac					= $_POST['nguiac'];
	$adespacho 				= $_POST['adespacho'];
	$enfactura				= $_POST['enfactura'];
	$cbarradespacho 		= $_POST['cbarradespacho'];
	$precio 				= $_POST['precio'];
	$codigoguia				= $_POST['codigoguia'];
	$rutguia				= $_POST['rutguia']; 
	$nombreguia				= $_POST['nombreguia'];
	$rutprov 				= $_POST['rutprov'];
	

	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert = "SELECT * FROM tbk_documentocompra WHERE id_docc LIKE '%".ltrim($codigofactura)."%'  ORDER BY id_docc DESC";
					if ($res = mysql_query($insert,$conn)) $busqueda = 1;
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_documentocompra WHERE rut_cli LIKE '".trim($nrut)."'  ORDER BY id_docc DESC";
					if ($res = mysql_query($insert,$conn)) $busqueda = 1;
					break;
					
		

			case '3':
					$insert = "SELECT * FROM tbk_documentocompra WHERE SUBSTR(fecha_docc,4,2) LIKE '%".ltrim($marca)."%'  ORDER BY id_docc DESC";
					if ($res = mysql_query($insert,$conn)) $busqueda = 1;
					break;
			
			
			case '9':
					//echo "almacenar guia";
					$busqueda = 0;
					
					$insert = "INSERT INTO tbk_guiacompra VALUES (";
					$insert .= "'".$cb."',";
					$insert .= "'".$nguiac."',";
					$insert .= "'".date('d-m-Y')."',";
					$insert .= "'1',";
					$insert .= "'".$rutguia."',";
					$insert .= "'".$nombreguia."'";
					$insert .= ")";
					
					//echo "->".$insert."<p/>";
					
					if($resulta = mysql_query($insert, $conn))
					{
							$guiaregistrada = 1;
							$tipomensaje=1;
							$texto = "Gu&iacute;a ingresada  exitosamente";
							
							//actualizar tabla parametro
							// No existe este procedimiento para guias de compra
							
							// RECORDAR ACTUALIZAR 
							$listado = 1;
							$p=0;
							WHILE ($prod = $cbarradespacho[$p])
							{
								//echo "almacenar guia";
								
								$insert = "INSERT INTO tbk_guiaprocompra VALUES (";
								$insert .= "'".$cb."',";
								$insert .= "'".$nguiac."',";
								$insert .= "'".$prod."',";
								$insert .= "'".$adespacho[$p]."',";
								$insert .= "'0'";
								$insert .= ")";
							
								if ($resulta = mysql_query($insert, $conn))
								{
									$listado = 1;
									//actualizar tabla factpro
									
									$restante = $enfactura[$p] - $adespacho[$p];
									
									$update = "UPDATE tbk_docprocompra  SET ";
									$update .= " guia_fpc = ".$restante;
									$update .= " WHERE id_docc = ".$cb." AND cbarra_pro = '".trim($prod)."'";
									
									//echo "<p>".$update."<p>";
									
									$resupdate = mysql_query($update, $conn);
									
									// buscar codigo del producto a registrar
									$buscapro = "SELECT id_pro, codigo_pro  FROM tbk_producto WHERE codigo_pro ='".trim($prod)."'";
									//echo "<p>".$buscapro."</p>";
									$respro =  mysql_query($buscapro,$conn);
									
									$fichaproducto = mysql_fetch_row($respro);
									
									$idpro = $fichaproducto[0];
									
									// buscar stock del producto
									
									$searchstk = "SELECT  * FROM tbk_stock WHERE id_pro = ".$idpro;
									//echo "<p>".$searchprecio."</p>";
									$respre  = mysql_query($searchstk, $conn);
									
									$fichastock = mysql_fetch_row($respre);
									
									$sminimo  = $fichastock[3];
									$salerta  = $fichastock[4];
									$smaximo  = $fichastock[5];
									$sstock   = $fichastock[2];
									
									
									
									$productobod = $sstock + $adespacho[$p];
									//echo " <p/>STOCK DEL PRODUCTO =".$sstock." RECEPCIONADO  =".$adespacho[$p]."  TOTAL INVENTARIO = ".$productobod;
									
									//actualizar inventario
									$updateprod = "INSERT INTO tbk_stock VALUES(";
									$updateprod .= "'".$idpro."',";
									$updateprod .= "'0',";
									$updateprod .= "'".$productobod."',";
									$updateprod .= "'0',";
									$updateprod .= "'0',";
									$updateprod .= "'0'";
									$updateprod .= ")";
									
									if ($resupdateprod = mysql_query($updateprod, $conn))
									{
									
										// OK!
									}
									else
									{
										$updateprod = "UPDATE tbk_stock SET ";
										$updateprod.= " stock_stk = ".$productobod;
										
										$updateprod.=" WHERE id_pro =".$idpro;
										
										//echo "<p>".$updateprod."</p>";
										$resupdateprod = mysql_query($updateprod, $conn);
									}
									// actualiza saldo PEDIDOS
									// ------------------------------------------------------------------------
									$spro = "SELECT * FROM tbk_pedido WHERE id_pro = '".$idpro."'";
									//echo $spro;
									$rpro = mysql_query($spro, $conn);
									$nfilas  = mysql_num_rows($rpro);
									
									if ($nfilas > 0 )
									{
											$fichapro = mysql_fetch_row($rpro);
											$saldo = $fichapro[1];
											
											if ($saldo > 0 )
											{
												$nuevosaldo = $saldo - $despacho;
												
												if ($nuevosaldo  < 0) $nuevosaldo = 0;
											
												//actualizar stock
												$uppro = "UPDATE tbk_pedido SET ";
												$uppro.= " cantidad_pdd = '".$nuevosaldo."' WHERE id_pro = ".$idpro;
												//echo $uppro;
											}
									}

									//echo $uppro;
									if ($respro = mysql_query($uppro, $conn)) echo " <br/> STOCK OK";
									// -----------------------------------------------------------------------
										
									
									//ingresar operacion a kardex
									$fechakdx = date('YmdHi');
									
									$insertkdx = "INSERT tbk_kardex VALUES(";
									$insertkdx.= "'".$fechakdx."',";
									$insertkdx.= "'0',";
									$insertkdx.= "'".$cb."',";
									$insertkdx.= "'".$nguiac."',";
									$insertkdx.= "'2',";
									$insertkdx.= "'".$idpro."',";
									$insertkdx.= "'".$rutprov."',";
									$insertkdx.= "'0',";
									$insertkdx.= "'".$adespacho[$p]."',";
									$insertkdx.= "'".$precio[$p]."')";
									
									//echo $insertkdx;
									if ($reskdx  = mysql_query($insertkdx, $conn)) echo "<p/>OK KARDEX<p/>";
										
								}
								else 	$listado = 0;
								$p++;
							}
					
					
						// ingresada a la guia, debemos actualizar el inventario del producto
						
						
							
								
								
						
						
					}
					else
						{
							$tipomensaje = 0;	
							$texto = "Se ha producido un error en el registro de la gu&iacute;a. Probablemente ya ha sido ingresada.";
							include("mensaje.php");
						}
						
					break;
		}
		//echo "BUSCANDO=".$insert;
		
		
	
			
	}	
		

	if (!empty($cb))
	{
			$insert = "SELECT * FROM tbk_documentocompra WHERE id_docc LIKE '".trim($cb)."'";	
			
			if($respro = mysql_query($insert,$conn))
			{	
				$ficha[]="";
				
			
				$ficha = mysql_fetch_row($respro);
				

				
				$scodigo 	= $ficha[0];
				$scliente	= $ficha[1];
				$stipodoc 	= $ficha[2];
				$sfecha		= $ficha[3];
				//$stotal		= $ficha[4];
				$codigodoc  = $ficha[6];
				
				$tipodocumento ="";
				
				SWITCH($stipodoc)
				{
					case '1' : $tipodocumento = "Boleta"; break;
					case '2' : $tipodocumento = "Gu&iacute;a"; break;
					case '3' : $tipodocumento = "Factura"; break;
				
				
				}

			
			}
	
	}

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>


<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<br/>
	<p/>
	
	<label id='subtitulo'> CREAR GU&Iacute;AS DE RECEPCION</label>
	<br/>
	<label id='comentariogris'>Para crear una gu&iacute;a, busque el documento de compra correspondiente (ya sea factura o boleta). Si desea listar todos los documentos, haga click en 'buscar c&oacute;digo' con el campo vac&iacute;o.</label>
	<hr/>
	<p/>


	<form name='boleta' action='crearguiacompra.php?cb=<?=$cb?>' method ='POST'>
	

		<table border='0'>
		<tr>
		<td width='400' valign='top'>
		
				<label id='subtitulo'> Seleccionar Documento de Compra</label>
				
				<p/>

					<table border='0' cellspacing='5' cellpadding='5' width='450' background='images/logos/fondo_menu.jpg'>
					<tr>
					<td><label id='comentario'>C&oacute;digo</label></td>
					<td valign='top' align='right' width='70'>
							<input type='text' name='nombre' value='<?=limpiar($nombre)?>' size='20' >
					</td>
					<td/>
					<td valign='top' width='16'>
							<input type='image' src='images/lupa.png' onClick='boleta.look.value=1; boleta.submit()'>
					</td>
					</tr>
					
					<tr>
					<td><label id='comentario'>Proveedor</label></td>
					<td valign='top'  width='100' align='right'>
						
						<input type='text' name='nrut' size='20' value='<?=$nrut?>' >
						<input type='hidden' name='nnombre' value='' size='30'>

					</td>
					<td valign='top' width='16'>
							<a  href="buscarproveedorpop.php" target="popup"  onClick="window.open(this.href, this.target, 'width=500,height=400'); return false;"><img src='images/buscarcliente.png' border='0'></a>
					</td>
					<td valign='top' width='16'>
							<input type='image' src='images/lupa.png' onClick='boleta.look.value=2; boleta.submit()'>
					</td>
					</tr>
						
					</table>
				

			
		
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
								$tipodoc = $row[2];
								$fechafact = $row[3];
								$total  = $row[4];
								$estado = $row[5];
								$codigodoc = $row[6];
								
								
								$proceso ="";
								SWITCH($tipodoc)
								{
									case '1' : $proceso = "Boleta"; break;
									case '2' : $proceso = "Gu&iacute;a"; break;
									case '3' : $proceso = "Factura"; break;
								
								
								}
								
								echo "<tr><td id='data' width='20'><a id='etiquetazul' href='crearguiacompra.php?cb=".$facturaID."'><font size='4'>".$codigodoc."</font></a></td><td id='data'>".$clienteID."</td><td id='data'>".$fechafact."</td><td id='data'>$ ".$total."</td><td id='data'>".$proceso."</td></tr>";
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
				
		
	<!--	
		</td>
		<td width='400' valign='top'>
	-->
	<?php if (!empty($cb)) :?>
			
				<?php
				
						//Buscar datos de cliente
						$searchCli = "SELECT * FROM tbk_proveedor WHERE rut_pv = '".$scliente."'";
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
			
				<label id='subtitulo'> <?=$tipodocumento?>  N° <?= $codigodoc ?></label>
				<p/>
				
				<fieldset>
				
				<table border='0' cellspacing='5' cellpadding='5' width='400'>
				
				<tr>
				<td  >
					<label id='comentario'><font size='4'> <?=$sfecha?></font></label>
				</td>
				<td  id='data' align='right' colspan='4'>
					 <label id='comentario'> N°<br/><font size='4'>   <?=$codigodoc?></font></label>
				</td>
				</tr>
				
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
				
					

				<tr><td id='etiqueta'> Producto</td><td id='etiqueta'> Cant.</td><td id='etiqueta' >Pendiente<br/>Recepci&oacute;n</td><td id='etiqueta' width='30' >  $<br/>Unitario</td><td id='etiqueta' width='60' >  $<br/>Total</td></tr>
				<?php
				
					$find = "SELECT * FROM tbk_docprocompra WHERE  id_docc = ".$scodigo;
					if ($resf = mysql_query($find, $conn))
					{
						$j=0;
						$subtotal = 0;
						$stockFactura =0;
						WHILE ($ficha2 = mysql_fetch_row($resf))
						{
						
							$fcbarra 			= $ficha2[1];
							$ftipodespacho		= $ficha2[2];
							$fcantidad 			= $ficha2[3];
							$fvalorunitario 	= $ficha2[4];
							$fguia			 	= $ficha2[5];
							$festado			= $ficha2[6];
							
							
							
							
							//$subtotal = $subtotal + ($fcantidad * $fvalorunitario);
							if ($festado == 0)
							{
								
									$subtotal = $subtotal + ($fcantidad * $fvalorunitario);
								
							}
							$stockFactura = $stockFactura + $fguia;
							
					
							
					?>	
					
					<tr>
					<td id='data' width='180'>
						<?php if ($festado  == 1) echo "<s>" ?>
					
						<label id='comentario'><?=nombreprod($fcbarra)?></label>
						
						<?php if ($festado  == 1) echo "</s>" ?>
					</td>

					<td id='data' align='right' width='10'>
						<?php if ($festado  == 1) echo "<s>" ?>
						
						<label id='comentario'><?=$fcantidad?></label>

						
						<?php if ($festado  == 1) echo "</s>" ?>
					</td>
					<td id='etiqueta' align='right' >
							<?=$fguia?>
							<input type='hidden' name='enfactura[]' value='<?=$fguia?>'>
					</td>
					<td id='data' align='right' >
						<?php if ($festado  == 1) echo "<s>" ?>
						
						<label id='comentario'><?=$fvalorunitario?></label>
						
						<?php if ($festado  == 1) echo "</s>" ?>
					</td>
					<td id='data' align='right' >
						<?php if ($festado  == 1) echo "<s>" ?>
						
						<label id='comentario'><?=$fvalorunitario * $fcantidad?></label>
						
						<?php if ($festado  == 1) echo "</s>" ?>
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
							
						$stotal = $subtotal + $subtotaliva;
					?>
					

						<tr>
						<td />
						<td />
						<td/>
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
						<td/>
					
						<td >
							<label id='comentario'>IVA </label>
						</td>
						<td align='right' >
							<label id='comentario'>$<?=$subtotaliva?></label>
						</td>
						</tr>

						<tr>
						<td />
						<td/>
						<td />
						<td >
							<label id='comentario'>TOTAL </label>
						</td>
						<td id='etiqueta' align='right' >
							$<?=$stotal?>
						</td>
						</tr>					
				</table>
				
				</fieldset>
						
			<?php 	} 
				
					
			?>		
		
		

		
		</td>
		<td valign='top'>

		<?php if (($stockFactura > 0) && ($guiaregistrada == 0)) :?>		

				<?php if (!empty($cb)) :?>
					
						<?php
						
								//Buscar datos de cliente
								$searchCli = "SELECT * FROM tbk_proveedor WHERE rut_pv = '".$scliente."'";
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
					
						<label id='subtitulo'>Nueva Gu&iacute;a</label>
						<p/>
						
						<fieldset>
						
						<table border='0' cellspacing='5' cellpadding='5' width='400'>
						<tr>
						<td  >
								<label id='comentario'><font size='4'> <?=$sfecha?></font></label>
						</td>
						<td  id='data' align='right' colspan='3'>
							 <label id='comentario'> N°<br/> <input type='text' class='num' name='nguiac' size='10'></font></label>
						</td>
						</tr>
						
						<tr>
						<td id='data' colspan='4'>
							 <label id='comentario'><?=$fnombrecompleto?> </label>
							
							<input type='hidden' name='rutprov' value='<?=$frut?>'>
						</td>
						</tr>
						
									<tr>
						<td id='data' colspan='4'>
							 <label id='comentario'><?=$fdir." - ".$fcomuna?> </label>
						</td>
						</tr>
						
						<tr><td height='25' colspan='5'><hr/></td></tr>
						
						
						<tr><td id='etiqueta'> Producto</td><td id='etiqueta' >Disp</td></tr>
						
								
						<?php
						
							$find = "SELECT * FROM tbk_docprocompra WHERE  id_docc = ".$scodigo;
							if ($resf = mysql_query($find, $conn))
							{
								$j=0;
								$subtotal = 0;
						
								WHILE ($ficha2 = mysql_fetch_row($resf))
								{
								
									$fcbarra 			= $ficha2[1];
									$ftipodespacho		= $ficha2[2];
									$fcantidad 			= $ficha2[3];
									
									$fvalorunitario 	= $ficha2[4];
									$fguia			 	= $ficha2[5];
								
									//$subtotal = $subtotal + ($fcantidad * $fvalorunitario);
									$festado			= $ficha2[6];
							
									//$subtotal = $subtotal + ($fcantidad * $fvalorunitario);
									if ($festado == 0) $subtotal = $subtotal + ($fcantidad * $fvalorunitario);
										
											
							?>	
								
								<tr>
								<td id='data' width='180'>
								
									<?php if ($festado  == 1) echo "<s>" ?>
					
									<label id='comentario'><?=nombreprod($fcbarra)?></label>
									
									<?php if ($festado  == 1) echo "</s>" ?>
					
									<input type='hidden' name='cbarradespacho[]' value='<?=$fcbarra?>'>
								</td>

								<td id='data' align='right' width='10'>
									<?php if ($festado  == 0) : ?>
									<SELECT name='adespacho[]'>

									<?php
									
											$a=0;
											for ($a =0; $a <= $fguia; $a++)
											{
												echo "<option>".$a."</option>";
																		
											}
									
									
									?>
									</SELECT>
									
									<?php endif ?>
								</td>
							
							
								
								<td id='data' align='right' >
									<label id='comentario'><?=$fvalorunitario?></label>
									<input type='hidden' name='precio[]' value='<?=$fvalorunitario?>'>
								</td>
								
								
								</tr>
								
							<?php
									$j++;
									
								}
								
								$subtotaliva = round((($subtotal * $iva)/100),0);
							?>
							
						</table>
					
						</fieldset>
						
						
						
						
						<p/>
						<label id='subtitulo'>Datos de quien recepciona </label>
						<p/>
						
						<fieldset>
						<table border='0' cellspacing='5' cellpadding='5' width='400'>						
						<tr>
						<td id='etiqueta'>
							Rut 
						
						</td>
						<td id='data'>
								<input type='text' name='rutguia' value=''>
								Dato no sujeto a validaci&oacute;n
						</td>
						</tr>
						<tr>
						<td id='etiqueta'>
							Nombre
						
						</td>
						<td id='data'>
								<input type='text' name='nombreguia' value='' size='50'>
								
						</td>
						</tr>						
						</table>
						
						</fieldset>
						<?php
						
						}
						
						
					

						?>
						<table border='0' width='430'>
						<tr>
						<td align='right'>
								<table border='0' cellspacing='5' cellpadding='5'>
								<tr>
								<td id='data' valign='bottom' align='center'>
										<a  id='menualternativo' href='home.php'><img src="images/logos/cancelar0.jpg" onmouseover="this.src = 'images/logos/cancelar1.jpg'" onmouseout="this.src = 'images/logos/cancelar0.jpg'" border="0"></img></a><br/>
								</td>
								<td id='data' valign='bottom'  align='center'>
										<a id='menu' href='#' onClick='boleta.look.value=9; submit()'><img src="images/logos/aceptar0.jpg" onmouseover="this.src = 'images/logos/aceptar1.jpg'" onmouseout="this.src = 'images/logos/aceptar0.jpg'" border="0"></img></a>
								</td>

								</tr>
								</table>

								<input type='hidden' name='codigoguia' value='<?=$guia?>'>
								
						</td>
						</tr>
						</table>
						
					
						
				<?php endif ?>
				
		<?php else :?>
		
			<?php
			
						
				if ($guiaregistrada == 1)
				{
							
					include("mensaje.php");
				}
				if ($stockFactura == 0)
				{
				
					$tipomensaje=0;
					$texto = "La Factura se ha retirado por completo por lo que no es posible generar nueva(s)  gu&iacute;a(s)";
					include("mensaje.php");
				}

			?>
		
		<?php endif ?>
		</td>
	<?php endif ?>
		</tr>
		</table>
		
		<input type='hidden' name='look' value=''>
	
	
</form>		





</td>
</tr>
</table>
</center>

<?php include("footer.php")?>