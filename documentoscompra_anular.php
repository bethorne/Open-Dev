<?php include("header.php")?>


<?php


	include("functions.php");


	$cb 		= $_GET['cb'];
	$see 		= $_POST['look'];


	$nombre		= $_POST['nombre'];
	if (!empty($nombre)) $codigofactura = $nombre ;
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
					$insert = "SELECT * FROM tbk_documentocompra WHERE id_docc LIKE '".trim($codigofactura)."%'AND estado_docc  <= 1 ORDER BY id_docc DESC";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_documentocompra WHERE rut_cli LIKE '".trim($nrut)."%' AND estado_docc  <= 1 ORDER BY id_docc DESC";
					break;
					
		

			case '3':
					$insert = "SELECT * FROM tbk_documentocompra WHERE SUBSTR(fecha_docc,4,2) LIKE '".trim($marca)."%'  AND estado_docc  <= 1 ORDER BY id_docc DESC";
					break;
			
			
			case '9':
					// anular documento
					// si es boleta / guia : se elimina directamente
					// si es factura, solo se elimina si no tiene documentos asociados
					
// anulando factura... pero no antes de preguntar si tiene guias asociadas
					
					$buscarguias = "SELECT COUNT(id_fact) FROM tbk_guiacompra WHERE id_fact =".$cb;
					$resbuscar = mysql_query($buscarguias, $conn);
					
					$qguias = mysql_fetch_row($resbuscar);
					$cantidad = $qguias[0];
					
					echo $buscarguias."<p/>".$cantidad."<p/>";		
					
					if ($cantidad == 0)
					{
							$deletevale = "UPDATE tbk_documentocompra SET  estado_docc = 9 WHERE id_docc =".$cb;
							echo "<p/>".$deletevale."<p/>";
							
							
							
							if ($resvale = mysql_query($deletevale, $conn))
							{
									// agregar productos a stock	
									// agregar registro a KARDEX
									
									// buscar tipo  de documento a anular
									$buscaTIPO = "SELECT tipo_docc FROM tbk_documentocompra WHERE id_docc ='".$cb."'";
									echo $buscaTIPO."<p>";
									$resTIPO = mysql_query($buscaTIPO, $conn);
										
									$fichaproducto = mysql_fetch_row($resTIPO);
										
									$tipodoc = $fichaproducto[0];
									
									
									// ubicar productos del documento de venta 
									$buscaprods = "SELECT  * FROM tbk_docprocompra WHERE id_docc =".$cb;
									echo $buscaprods;
									
									$resprods  = mysql_query($buscaprods, $conn);
									
									$i=0;
									WHILE ($row  = mysql_fetch_row($resprods))
									{
										$cbarrapro	= $row[1];
										$cantidad 	= $row[3];
										$precio 	= $row[4];
										$pendiente	= $row[5];
										
										$cantidadarestaurar = $cantidad - $pendiente;
										
										echo "<p> Producto reestablecido :: ".$cbarrapro." <p>";
										
										// reestablecer a STOCK la cantidad vendida
										
										//buscando codigo interno del producto
										$buscaID = "SELECT id_pro FROM tbk_producto WHERE codigo_pro ='".$cbarrapro."'";
										$resID = mysql_query($buscaID, $conn);
										
										$fichaproducto = mysql_fetch_row($resID);
										
										$idpro = $fichaproducto[0];
										// -------------------------------------------------------------------------------
										
										// este proceso sólo se realiza si  no hay guias a facturar
										// reponer en STOCK
										$searchprecio = "SELECT  * FROM tbk_stock WHERE id_pro = ".$idpro;
											
										//echo "<p>".$searchprecio."</p>";
											
										$respre  = mysql_query($searchprecio, $conn);
											
										$fichastock = mysql_fetch_row($respre);
										$sstock   = $fichastock[2];
															
										$productobod = $sstock -  $cantidadarestaurar;
										//echo " <p/>STOCK DEL PRODUCTO =".$sstock." RECEPCIONADO  =".$adespacho[$p]."  TOTAL INVENTARIO = ".$productobod;
															
										//actualizar inventario
										$updateprod = "UPDATE tbk_stock SET ";
										$updateprod.= " stock_stk = ".$productobod;
															
										$updateprod.=" WHERE id_pro =".$idpro;
															
										//echo "<p>".$updateprod."</p>";
										$resupdateprod = mysql_query($updateprod, $conn);
										
										// --------------------------------------------------	
												
											
										// ingresar a KARDEX		
										$fechakdx = date('YmdHi');
					
										$insertkdx = "INSERT tbk_kardex VALUES(";
										$insertkdx.= "'".$fechakdx."',";
										$insertkdx.= "'3',";
										$insertkdx.= "'".$cb."',";
										$insertkdx.= "'',";
										$insertkdx.= "'".$tipodoc."',";
										$insertkdx.= "'".$idpro."',";
										$insertkdx.= "'',";
										$insertkdx.= "'".$cantidad."',";
										$insertkdx.= "'".$cantidadarestaurar."',";
										
										$insertkdx.= "'".$precio."')";
										
										echo $insertkdx;
										if ($reskdx  = mysql_query($insertkdx, $conn)) echo "<p/>OK KARDEX<p/>";
										
										
										$texto = "El documento ha sido anulado exitosamente.";
										$tipomensaje = 1;
										include("mensaje.php");
									
										$cb="";
									}
							}
							else
								{
									$texto = "El documento no ha sido anulado. Posiblemente tiene otros documentos asociados  (Gu&iacute;as, Notas, etc). Consulte con su administrador para m&aacute;s informaci&oacute;n.";
									$tipomensaje = 0;
									include("mensaje.php");
								}
							
							// RECORDAR ACTUALIZAR 
					}
					else
					{
						$texto = "El documento no ha sido eliminado. Posiblemente tiene otros documentos asociados  (Gu&iacute;as, Notas, etc). Consulte con su administrador para m&aacute;s informaci&oacute;n.";
						$tipomensaje = 0;
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
			$insert = "SELECT * FROM tbk_documentocompra WHERE id_docc LIKE '".trim($cb)."'";	
			
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
	<p/>
	
	<label id='subtitulo'>DOCUMENTO DE COMPRA PARA ANULAR</label>
	<br/>
	<label id='comentariogris'> Complete uno de los campos para realizar la b&uacute;squeda. Si desea listar todos los documentos, haga click en 'buscar c&oacute;digo' con el campo vac&iacute;o.</label>
	<hr/>
	<p/>


	<form name='boleta' action='documentoscompra_anular.php?cb=<?=$cb?>' method ='POST'>
	

	<table border='0'>
	<tr>
	<td width='400' valign='top'>
	
			<label id='subtitulo'> Buscar y seleccionar documento </label>
			<p/>

			
				<table border='0' cellspacing='5' cellpadding='5' width='450' background='images/logos/fondo_menu.jpg' >
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
					<label id='comentario'>Proveedor</label>
				</td>
				<td valign='top'  width='100' align='right'>
					
					<input type='text' name='nrut' size='20' value='<?=$nrut?>' >
					
					<input type='hidden' name='nnombre' value='' size='30' >

					
				</td>
				<td valign='top' width='16'>
						<a  href="buscarproveedorpop.php" target="popup"  onClick="window.open(this.href, this.target, 'width=500,height=400'); return false;"><img src='images/buscarcliente.png' border='0'></a>
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='boleta.look.value=2; np.submit()'>
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
							
							echo "<tr><td id='data' width='20'><a id='etiquetazul' href='documentoscompra_anular.php?cb=".$facturaID."' ><font size='4'>".$codigodoc."</font></a></td><td id='data'>".$clienteID."</td><td id='data'>".$fechafact."</td><td id='data'>$ ".$total."</td><td id='data'>".$proceso."</td></tr>";
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
		
			<label id='subtitulo'> <?=$proceso?> N° <?= $codigodoc ?></label>
			<p/>
			
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
		
			
			<tr><td id='etiqueta'> Producto</td><td id='etiqueta'> Cantidad</td><td id='etiqueta' width='30' >Pendiente<br/>Recepci&oacute;n</td><td id='etiqueta' width='30' >  $ Unitario</td><td id='etiqueta' width='60' >  $ Total</td></tr>
					
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
						$fadespacho			= $ficha2[5];
						$festado			= $ficha2[6];
					
						if ($festado == 0) $subtotal = $subtotal + ($fcantidad * $fvalorunitario);
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
					<td id='data' align='right' width='10'>
						<?php if ($festado  == 1) echo "<s>" ?>
						
						<label id='comentario'><?=$fadespacho?></label>
						
						<?php if ($festado  == 1) echo "</s>" ?>
					</td>
					<td id='data' align='right' >$ 
						<?php if ($festado  == 1) echo "<s>" ?>
						
						<label id='comentario'><?=$fvalorunitario?></label>
						
						<?php if ($festado  == 1) echo "</s>" ?>
					</td>
					<td id='data' align='right' >$ 
						<?php if ($festado  == 1) echo "<s>" ?>
						
						<label id='comentario'><?=$fvalorunitario * $fcantidad?></label>
						
						<?php if ($festado  == 1) echo "</s>" ?>
					</td>
					</tr>
					
				<?php
						$j++;
						
					}
					
					$subtotaliva = round((($subtotal * $iva)/100),0);
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
						<label id='comentario'>$ <?=$subtotaliva?></label>
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
						$ <?=$stotal?>
					</td>
					</tr>

					<tr>
					<td colspan='5' id ='data'>
						Observaciones:<br/>
						<ul>
							<i><?=$obs?></i>
						</ul>
						
					
					</tr>
			</table>
			
			</fieldset>
			
			<fieldset>
				
				<table border='0'>
				<tr>
				<td id='etiqueta'>
					<label id='comentariogris' > Documentos asociados : </label>
				
				</td>
				<td>
					<?php
						// listado  documentos asociados
						
						$buscadocs = "SELECT  * FROM tbk_guiacompra WHERE  id_fact=".$cb;
						//echo $buscadocs;
						
						$resdocs = mysql_query($buscadocs, $conn);
						
						$nfilas = 0;
						$nfilas = mysql_num_rows($resdocs);
						
						if ($nfilas > 0)
						{
							$j=0;
							WHILE ($rowdocs = mysql_fetch_row($resdocs))
							{
								$gfact = $rowdocs[0];
								$gguia  = $rowdocs[1];
								$gfecha = $rowdocs[2];
								$gestado = $rowdocs[3];
								$grutguia = $rowdocs[4];
								$gnombreguia = $rowdocs[5];
								
								echo "<a id='etiqueta' href='guiascompra.php?cb=".$gguia."' target='_blank'> ".$gguia." |  </a>";
							
								$j++;
							}
						
						
						
						}
					
					
					?>
					
				</td>
				</tr>
				</table>
				
			</fieldset>
			
		<?php 	} 
			
				
		?>	
	</td>
	<td valign='top' align='right'>

			
			<label id='subtitulo'> ¿Está seguro que desea anular este documento?</label>
			<p/>
			
	
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


			
	</td>
	<?php endif ?>


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
	</table>
			
			
	<p/>
	

	
	</form>		





</td>
</tr>
</table>
</center>

<?php include("footer.php")?>