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
	
	//busca ultimos codigos de  documento
	$searchcodigo = "SELECT * FROM tbk_parametro WHERE  tipo_param = 3";
	$resultadocodigo = mysql_query($searchcodigo, $conn);
	
	$i=0;
	
	$factura = 0;
	$guia = 0;
	$boleta =0;
	
	WHILE ($rowparam = mysql_fetch_row($resultadocodigo))
	{
		if ($rowparam[2] =='factura') $factura 	= $rowparam[4] ;
		if ($rowparam[2] =='guia')    $guia		= $rowparam[4] ;
		if ($rowparam[2] =='boleta')  $boleta 	= $rowparam[4] ;
		
		$i++;
	}
	
	$frut 					= $_POST['frut'];
	$adespacho 				= $_POST['adespacho'];
	$enfactura				= $_POST['enfactura'];
	$cbarradespacho 		= $_POST['cbarradespacho'];
	$codigoguia				= $_POST['codigoguia'];
	$rutguia				= $_POST['rutguia']; 
	$nombreguia				= $_POST['nombreguia'];
	$valorunitario			= $_POST['valorunitario'];
	
	/*
	print_r($enfactura);
	echo "<p>";
	print_r($adespacho);
	echo "<p>";

	*/
	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert = "SELECT * FROM tbk_documento WHERE codigo_doc LIKE '%".ltrim($codigofactura)."%' AND tipo_doc = 3 ORDER BY id_doc DESC";
					if ($res = mysql_query($insert,$conn)) $busqueda = 1;
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_documento WHERE rut_cli LIKE '%".trim($nrut)."%' AND tipo_doc = 3 ORDER BY id_doc DESC";
					if ($res = mysql_query($insert,$conn)) $busqueda = 1;
					break;
					
		

			case '3':
					$insert = "SELECT * FROM tbk_documento WHERE SUBSTR(fecha_doc,4,2) LIKE '%".ltrim($marca)."%' AND tipo_doc = 3 ORDER BY id_doc DESC";
					if ($res = mysql_query($insert,$conn)) $busqueda = 1;
					break;
			
			
			case '9':
					//echo "almacenar guia";
					$busqueda = 0;
					
					$insert = "INSERT INTO tbk_guia VALUES (";
					$insert .= "'".$cb."',";
					$insert .= "'".$codigoguia."',";
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
							$update = "UPDATE tbk_parametro SET valor_param =".($guia + 1)." WHERE id_param =3";
							//echo "<p>".$update."<p>";
							$resupdate = mysql_query($update, $conn);
					
							
							// RECORDAR ACTUALIZAR 
							$listado = 1;
							$p=0;
							WHILE ($prod = $cbarradespacho[$p])
							{
								//echo "almacenar guia";
								
								$insert = "INSERT INTO tbk_guiapro VALUES (";
								$insert .= "'".$cb."',";
								$insert .= "'".$codigoguia."',";
								$insert .= "'".$prod."',";
								$insert .= "'".$adespacho[$p]."',";
								$insert .= "'0'";
								$insert .= ")";
							
								if ($resulta = mysql_query($insert, $conn))
								{
									$listado = 1;
									//actualizar tabla factpro
									
									$restante = $enfactura[$p] - $adespacho[$p];
									
									$update = "UPDATE tbk_docpro  SET ";
									$update .= " guia_fp = ".$restante;
									$update .= " WHERE id_doc = ".$cb." AND cbarra_pro = '".trim($prod)."'";
									
									//echo "<p>".$update."<p>";
									
									$resupdate = mysql_query($update, $conn);
									
									
									
									// buscar codigo del producto a registrar
									$buscapro = "SELECT id_pro, codigo_pro  FROM tbk_producto WHERE codigo_pro ='".trim($prod)."'";
									//echo "<p>".$buscapro."</p>";
									$respro =  mysql_query($buscapro,$conn);
									
									$fichaproducto = mysql_fetch_row($respro);
									
									$idpro = $fichaproducto[0];
									
									// buscar codigo del producto
									
									$searchprecio = "SELECT  * FROM tbk_stock WHERE id_pro = ".$idpro;
									//echo "<p>".$searchprecio."</p>";
									$respre  = mysql_query($searchprecio, $conn);
									
									$fichastock = mysql_fetch_row($respre);
									
									$sminimo  = $fichastock[3];
									$salerta  = $fichastock[4];
									$smaximo  = $fichastock[5];
									$sstock   = $fichastock[2];
									
									$productobod = $sstock - $adespacho[$p];
									//echo " <p/>STOCK DEL PRODUCTO =".$sstock." RECEPCIONADO  =".$adespacho[$p]."  TOTAL INVENTARIO = ".$productobod;
									
									//actualizar inventario
									$updateprod = "UPDATE tbk_stock SET ";
									$updateprod.= " stock_stk = ".$productobod;
									
									$updateprod.=" WHERE id_pro =".$idpro;
									
									//echo "<p>".$updateprod."</p>";
									$resupdateprod = mysql_query($updateprod, $conn);
									
									
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
									$insertkdx.= "'1',";
									$insertkdx.= "'".$cb."',";
									$insertkdx.= "'".$codigoguia."',";
									$insertkdx.= "'2',";
									$insertkdx.= "'".$idpro."',";
									$insertkdx.= "'".$frut."',";
									$insertkdx.= "'0',";
									$insertkdx.= "'".$adespacho[$p]."',";
									$insertkdx.= "'".$valorunitario[$p]."')";
									
									//echo $insertkdx;
									if ($reskdx  = mysql_query($insertkdx, $conn)) echo "<p/>OK KARDEX<p/>";
									
								}
								else 	$listado = 0;
								$p++;
							}
							
							
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
	<br/>
	<P/>
	
	<label id='subtitulo'> CREAR GU&Iacute;AS DE DESPACHO</label>
	<br/>
	<label id='comentariogris'>Para crear una gu&iacute;a, busque la factura correspondiente. Si desea listar todos las facturas, haga click en 'buscar c&oacute;digo' con el campo vac&iacute;o.</label>
	<hr/>
	<p/>


	<form name='boleta' action='crearguia.php?cb=<?=$cb?>' method ='POST'>
	

		<table border='0'>
		<tr>
		<td width='400' valign='top'>
		
				<label id='subtitulo'> Seleccionar Factura</label>
				<p/>
				
				<table border='0' cellspacing='5' cellpadding='5' width='450' background='images/logos/fondo_menu.jpg'>
				<tr>
				<td>
					<label id='comentario'>C&oacute;digo</label>
				</td>
				<td valign='top' align='right' width='70'>
						<input type='text' name='nombre' value='<?=limpiar($nombre)?>' size='20' >	
				</td>
				<td/>				
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='boleta.look.value=1; np.submit()'>
				</td>
				</tr>
				
				<tr>
				<td>
					<label id='comentario'>Cliente - RUT</label>
				</td>
				<td valign='top'  width='100' align='right'>
					<input type='text' name='nrut' size='20' value='<?=$nrut?>' >
					<input type='hidden' name='nnombre' value='' size='30' readonly ='readonly'>
				</td>
				<td valign='top' width='16'>
						<a  href="buscarclientefact.php" target="popup"  onClick="window.open(this.href, this.target, 'width=500,height=400'); return false;"><img src='images/buscarcliente.png' border='0'></a>
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='boleta.look.value=2; np.submit()'>
				</td>
				</tr>
					
				</table>

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
							
								
								echo "<tr><td id='data' width='20'><a id='etiquetazul' href='crearguia.php?cb=".$facturaID."'><font size='4'>".$codigodoc."</font></a></td><td id='data'>".$clienteID."</td><td id='data'>".$fechafact."</td><td id='data'>$ ".$total."</td><td id='data'>".$proceso."</td></tr>";
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
			
				<label id='subtitulo'> <?=$proceso?> N�  <?= $codigodoc ?></label>
				<p/>
				
				<fieldset>
				
				<table border='0' cellspacing='5' cellpadding='5' width='400'>
				
				<tr>
				<td  >
					<label id='comentario'> <?=$sfecha?></label>
				</td>
				<td  id='data' align='right' colspan='4'>
					 <label id='comentario'> <font size='4'><?=$proceso?>  N�<br/>   <?=$codigodoc?></font></label>
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
				
					

				<tr><td id='etiqueta'> Producto</td><td id='etiqueta'> Cant.</td><td id='etiqueta' >Disp</td><td id='etiqueta' width='30' >  $<br/> Unitario</td><td id='etiqueta' width='30'> $<br/>Total</td></tr>
				<?php
				
					$find = "SELECT * FROM tbk_docpro WHERE  id_doc = ".$scodigo;
					if ($resf = mysql_query($find, $conn))
					{
						$j=0;
						$subtotal = 0;
						$stockFactura =0;
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
							$stockFactura = $stockFactura + $fguia;
					?>	
						
						<tr>
						<td id='data' width='150'>
							<label id='comentario'><?=nombreprod($fcbarra)?></label>
						</td>

						<td id='data' align='right' width='10'>
							<label id='comentario'><?=$fcantidad?></label>
							
						</td>
						<td id='etiqueta' align='right' >
							<?=$fguia?>
							<input type='hidden' name='enfactura[]' value='<?=$fguia?>'>
						</td>
						<td id='data' align='right' >
							<label id='comentario'>$  
							<?php 

						
								if ($stipodoc == 1) echo $fvalorventa;
								if ($stipodoc == 3) echo $fvalorneto;

								if ($stipodoc == 1) echo "<input type='hidden' name='valorunitario[]' value='".$fvalorventa."'>";
								if ($stipodoc == 3) echo "<input type='hidden' name='valorunitario[]' value='".$fvalorneto."'>";

							?>
							</label>
							
							

						</td>
						<td id='data' align='right' >
						<label id='comentario'>$ 
						<?php 

							if ($stipodoc == 1) echo $fvalorventa * $fcantidad;
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
					
					
					<?php
					// notas -----------------------------------------------------------------
						
					// calcula totales   entre facturas y notas de debito..
					//  la nota de debito aumenta venta. por lo tanto aumenta producto vendido
					// si el precio es diferente.. vale el ultimo precio...
					
					// veamos
					
					
					// Buscando notas de d�bido y credito
					// si no es factura mejor ni busque! jeje
					
					echo "<tr> <td colspan='5'> <hr/></td></tr>";
					
					if ($stipodoc == 3)
					{
						$buscanotas  = "SELECT id_nota, tipo_nota  FROM tbk_nota WHERE id_fact  ='".$cb."' ORDER BY id_nota ASC";
						//echo $buscanotas;
						
						$resnotas  = mysql_query($buscanotas, $conn);
						
						$notas = mysql_num_rows($resnotas);
				
						if ($notas >= 1)
						{
						
							$n=0;
							WHILE ($fichanota  = mysql_fetch_row($resnotas))
							{
								$idnota  = trim($fichanota[0]);
								$tiponota = $fichanota[1];
								
								SWITCH ($tiponota)
								{
									case '0' : break;
									case '1' : 
												echo "<tr><td id='etiqueta' colspan='5'> Nota D&eacute;bito N� ".$idnota."</td>";
												break;
								
								
								
								}
								
								$buscapros  = "SELECT * FROM tbk_notapro WHERE id_nota  ='".$idnota."'";
								$resbp = mysql_query($buscapros, $conn);
								
								$filanota  = mysql_num_rows($resbp);
								$listaproductos  = "";
								
								if ($filanota > 0 )
								{
									$m=0;
									WHILE ($listanota = mysql_fetch_row($resbp))
									{
										$cbarra  	= trim($listanota[2]);
										$listaproductos.= $cbarra.",";
										
										$cantidad 	= $listanota[3];
										$retiro   	= $listanota[4];
										$precio		= $listanota[5];
										
										$pendiente  = $cantidad - $retiro;
										
										$totalcantidad[$cbarra]  = $totalcantidad[$cbarra] +  $cantidad;
										$totalpendiente[$cbarra]  = $totalpendiente[$cbarra]  + $pendiente;
										
										$ultimoprecio[$cbarra] = $precio;
										
										
										
										echo "<tr>";
										echo "<td id='data'>".nombreprod($cbarra)."</td>";
										echo "<td id='data' align='right'>".$cantidad."</td>";
										
										
										echo "<td id='etiqueta' align='right'>".$pendiente."</td>";
										echo "<td id='data' align='right'>$".$precio."</td>";
										echo "<td id='data' />";
										echo "</tr>";
								
										$m++;
									}
								
								}
								
								
								
								$n++;
							}
							
							
							echo "<tr><td colspan='5'> <hr/></td></tr>";
							echo "<tr><td id='etiqueta' colspan='5'> TOTAL POR PRODUCTO(S)</td></tr>";
							
							$a=0;
							$lp = explode(",",$listaproductos);
							$supersubtotal  = 0;
							WHILE ($ip = $lp[$a])
							{
								$subtotaltotal  = $totalcantidad[$ip] *  $ultimoprecio[$ip];
								$supersubtotal  =  $supersubtotal + $subtotaltotal;
								
								echo "<tr>";
								echo "<td id='data' align='left'>".nombreprod($ip)."</td>";
								echo "<td id='data' align='right'>".$totalcantidad[$ip]."</td>";
								echo "<td id='etiqueta' align='right'>".$totalpendiente[$ip]."</td>";
								echo "<td id='data' align='right'>$ ".$ultimoprecio[$ip]."</td>";
								echo "<td id='data' align='right' >$ ".$subtotaltotal."</td>";
								
								$a++;
								/*	
								//  buscar productos de cada nota
								echo $listaproductos."<p/>";;
								print_r($totalcantidad);
								print_r($totalpendiente);
								print_r($ultimoprecio);
								*/
								echo "</tr>";
							}
							
							
							// -----------------------------------------------------------------------
					
							$supersubtotaliva = round((($supersubtotal * $iva)/100),0);
							$supertotal  = $supersubtotal + $supersubtotaliva;
							
							?>	
								<tr>
								<td />
								<td />
								<td />
							
								<td >
									<label id='comentario'>Neto </label>
								</td>
								<td id='etiqueta' align='right'>
									$ <?=$supersubtotal?>
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
									<label id='comentario'>$<?=$supersubtotaliva?></label>
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
									$<?=$supertotal?>
								</td>
								</tr>	
							
						
				<?php
						
						}
					
					}
					
					
					

				?>
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
					
						<label id='subtitulo'>N� Gu&iacute;a <?= $guia?></label>
						<p/>
						
						<fieldset>
						
						<table border='0' cellspacing='5' cellpadding='5' width='400'>
						<tr>
						<td  >
							<label id='comentario'> <?=$sfecha?></label>
						</td>
						<td  id='data' align='right' colspan='3'>
							 <label id='comentario'> N�<br/> <font size='4'>  <?=$guia?></font></label>
						</td>
						</tr>
						
						<tr>
						<td id='data' colspan='4'>
							 <label id='comentario'><?=$fnombrecompleto?> </label>
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
						
							$find = "SELECT * FROM tbk_docpro WHERE  id_doc = ".$scodigo;
							if ($resf = mysql_query($find, $conn))
							{
								$j=0;
								$subtotal = 0;
						
								WHILE ($ficha2 = mysql_fetch_row($resf))
								{
								
									$fcbarra 			= trim($ficha2[1]);
									$ftipodespacho		= $ficha2[2];
									$fcantidad 			= $ficha2[3];
									
									$fvalorunitario 	= $ficha2[4];
									//$fguia			 	= $ficha2[5];
									$fguia				= $totalpendiente[$fcbarra];
								
									$subtotal = $subtotal + ($fcantidad * $fvalorunitario);
								
									
							?>	
								
								<tr>
								<td id='data' width='180'>
									<label id='comentario'><?=nombreprod($fcbarra)?></label>
									<input type='hidden' name='cbarradespacho[]' value='<?=$fcbarra?>'>
								</td>

								<td id='data' align='right' width='10'>
									
									<SELECT name='adespacho[]'>

									<?php
									
											$a=0;
											for ($a =0; $a <= $fguia; $a++)
											{
												echo "<option>".$a."</option>";
																		
											}
									
									
									?>
									</SELECT>
								</td>
							
							<!--
								
								<td id='data' align='right' >
									<label id='comentario'><?=$fvalorunitario?></label>
								</td>
								
								-->
								</tr>
								
							<?php
									$j++;
									
								}
								
								$subtotaliva = round((($subtotal * $iva)/100),0);
							?>
							
						</table>
					
						</fieldset>
						
						
						
						
						<p/>
						<label id='subtitulo'>Datos de quien retira</label>
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
						<table border='0' width='435'>
						<tr>
						<td align='right'>
						
								<table border='0' cellspacing='5' cellpadding='5'>
								<tr>
								<td id='data' valign='bottom' align='center'>
										<a  id='menualternativo' href='home.php'><img src="images/logos/cancelar0.jpg" onmouseover="this.src = 'images/logos/cancelar1.jpg'" onmouseout="this.src = 'images/logos/cancelar0.jpg'" border="0"></img></a><br/>
								</td>
								<td id='data' valign='bottom'  align='center'>
										<a id='menu' href='#' onClick='boleta.look.value="9"; submit()'><img src="images/logos/aceptar0.jpg" onmouseover="this.src = 'images/logos/aceptar1.jpg'" onmouseout="this.src = 'images/logos/aceptar0.jpg'" border="0"></img></a>
								</td>

								</tr>
								</table>
										
								<!--<input type='submit' value='Aceptar' onClick='boleta.look.value=9' > -->
								<input type='hidden' name='codigoguia' value='<?=$guia?>'>
								<input type='hidden' name='frut' value='<?=$frut?>'>
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