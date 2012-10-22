<?php include("header.php")?>



<table border='0' height='300' width='550'>
<tr>
<td>
<?php
	

	$cb				= $_POST['cb'];
	$nrut			= $_POST['nrut'];
	$tipodoc		= $_POST['tipodoc'];
		$tipo		= $_POST['tipo'];
			$forma		= $_POST['forma'];
	$codigodoc		= $_POST['codigodoc'];
	
	$subtotalvale 	= $_POST['subtotalvale'];
	$descuentovale 	= $_POST['descuentovale'];
	$totalvale 		= $_POST['totalvale'];
	
	$cuotas			= $_POST['cuotas'];
	$valorcuota		= $_POST['valorcuota'];
	
	$diadepago 		= $_POST['diadepago'];
	$mesdepago 		= $_POST['mesdepago'];
	$aniodepago 	= $_POST['aniodepago'];
	$forma			= $_POST['forma'];
	$tipo_venta		=$_POST['tipo'];	
	if($tipo_venta==1)
	{
		$cuotas=1;
		}
		else
		$cuotas			= $_POST['cuotas'];

		$fechaab = date('d-m-Y H:i');
	$diasdepago = $diadepago."-".$mesdepago."-".$aniodepago;
	
	
				 include("conector/conector.php");
$insertar_abono="INSERT INTO tbk_abono ( rut_cli, id_fact, fecha_ab,tipo_ab, tipoefectivo_ab,abono_ab,numerodoc_ab) VALUES ( '$nrut', '$codigodoc', '$fechaab', $tipo_venta, '$forma',$totalvale,'$cb')";
		 mysql_query($insertar_abono) or die(mysql_error());
				
							
							
		
	
	
	
	// actualizando tipo de documento
	
	$update = "UPDATE tbk_documento SET  estado_doc = 0,tipo_venta=".$tipo_venta.",forma_pago=".$forma.", tipo_doc = ".$tipodoc.", codigo_doc = ".$codigodoc." WHERE id_doc=".$cb;
	
	echo $update;
	
	
	if (!empty($cb))
	{
			if ($insertfac = mysql_query($update,$conn))
			{
				//echo " <br/>-  factura ingresada exitosamente ";
				
				//factura en parametros
				
				$updateF = "UPDATE tbk_parametro Set valor_param = ".$codigodoc;
				
				if ($tipodoc == '4' ) $updateF.= " WHERE id_param = 7";
				if ($tipodoc == '3' ) $updateF.= " WHERE id_param = 2";
				if ($tipodoc == '2' ) $updateF.= " WHERE id_param = 3";
				if ($tipodoc == '1' ) $updateF.= " WHERE id_param = 4";
				
				
				if ($resupdateF = mysql_query($updateF,$conn)) echo " ";
				//echo "Actualizar =".$updateF;
				
				
				// --------------------------------------------------------------
				//  Si esta factura es producto de un conjunto de guias de venta, éstas deben darse de baja
				
				$searchgv = "SELECT * FROM tbk_documento WHERE id_doc = ".$cb;
				$resgv = mysql_query($searchgv, $conn);
				
				$a=0;
				WHILE ($rowgv = mysql_fetch_row($resgv))
				{
					$guiasafacturar  = $rowgv[9];
					$rutCli = $rowgv[1];
					$totaldocumento  = $rowgv[4];
					$a++;
				}
				
				//echo "GUIAS A FACTURAR :: ".$guiasafacturar;
				
				$cadaguia = explode(",",$guiasafacturar);
				$elementos = count($cadaguia);
				
				$b=0;
				WHILE($b < $elementos)
				{
				
					$codigoguia = $cadaguia[$b];
					
					$updateguia = "UPDATE tbk_documento SET estado_doc = 0, guias_doc ='".$cb."' WHERE id_doc = ".$cadaguia[$b];
					//echo "<br> ".$updateguia;
					
					if ($resup = mysql_query($updateguia, $conn)) 
					{
						echo "<br> + Guia ".$cadaguia[$b]." ha sido actualizada  exitosamente";
					}
					
					
					
				
					$b++;
				}
				
				
				// --------------------------------------------------------------
				
				// Guardar productos de la factura
				/*
				$p=0;
				WHILE (!empty($codigo[$p]))
				{
				
						$pcodigo 		= $codigo[$p];
						$pdespacho 		= $despacho[$p];
						$pproducto 		= $producto[$p];
						$pcantidad 		= $cantidad[$p];
						$pvalor 		= $valor[$p];
						
						
						$insertP = "INSERT INTO tbk_factpro VALUES(";
						$insertP .= "'".$cfactura."',";
						$insertP .= "'".$pcodigo ."',";
						$insertP .= "'".$pdespacho ."',";
						$insertP .= "'".$pcantidad ."',";
						$insertP .= "'".$pvalor ."',";
						$insertP .= "'".$pcantidad ."'";
						$insertP .= ")";
						
						//echo $insertP;
						
						if($resultadoP = mysql_query($insertP, $conn)) echo "<p>productos guardados exitosamente<p/>";
						
						
						
						
					$p++;
				}
				*/
				
				
				// --------------------------------------------------------------------------------------------------
				// almacena descuento a documento
				if ($descuentovale > 0)
				{
					$insertd = "INSERT INTO tbk_descuento VALUE (";
					$insertd .= "'',";
					$insertd .= "'".$cb."',";
					$insertd .= "'".$rutUsuario."',";
					$insertd .= "'".$descuentovale."'";
					$insertd .= ")";
					
					echo $insertd;
					
					if ($resd = mysql_query($insertd, $conn))
					{
						echo "<p>OK DESCUENTO</p>";
					}
				}
				
				// ---------------------------------------------------------------------------------------------------
				
				if ($tipodoc != 2)
				{	
						// Guarda forma de pago
						// -------------------------------------------
						
							$insertPG = "INSERT INTO tbk_pago VALUES(";
							$insertPG .= "'".$cb."',";
							$insertPG .= "'".$nrut ."',";
							$insertPG .= "'".$total ."',";
							$insertPG .= "'".$documento."',";
							$insertPG .= "'".$cuotas ."',";
							$insertPG .= "'".$valorcuota."',";
							$insertPG .= "'".$diasdepago."',";
							$insertPG .= "'".date('d-m-Y')."'";


							
							$insertPG .= ")";
								
								//echo $insertPG;
								// metodo de pago  guardado
							if($resultadoPG = mysql_query($insertPG, $conn)) echo "<p/> <img src='images/logos/pago.jpg'><p/>";
							
						
						
						
						
						$cs = 1;
						
						
						$nuevoyear = (int)($aniodepago);
						$nuevomes = (int)($mesdepago) ;
						
						for ($cs =0; $cs <= $cuotas; $cs++)
						{
							
							if ($cs == 0)
							{

								$next = $diadepago."-".$mesdepago."-".$aniodepago;
							}
							
							if ($cs > 1)
							{
								$nuevomes++;
								
								
								if ($nuevomes <= 9)
								{
									$mesdepago = "0".$nuevomes;
								}
								if ($nuevomes > 9)
								{
									$mesdepago = (string)$nuevomes;
								}
								
								if ($nuevomes >= 13)
								{
									$nuevomespago = $nuevomes - 12;
									if ($nuevomespago <= 9)
									{
										$mesdepago = "0".$nuevomespago;
									}
									if ($nuevomespago > 9)
									{
										$mesdepago = (string)$nuevomespago;
									}
									$aniodepago = $nuevoyear + 1;
								}
								
								
								$next = $diadepago."-".$mesdepago."-".$aniodepago;
								
								//echo "<p>".$next."</p>";
							}
						
							$insertPG = "INSERT INTO tbk_pago_cuota VALUES(";
							$insertPG .= "'".$cb."',";
							$insertPG .= "'".$nrut ."',";
							$insertPG .= "'".$cuotas ."',";
							$insertPG .= "'".$valorcuota."',";
							$insertPG .= "'".$next."',";
							$insertPG .= "'',";
							$insertPG .= "'0',";
							$insertPG .= "'0',";
							$insertPG .= "'".$valorcuota."'";


							
							$insertPG .= ")";
								
								//echo $insertPG;
								// cuotas
							if($resultadoPG = mysql_query($insertPG, $conn)) echo "<img src='images/logos/cuota.jpg'> ";
							
							
							
							
							
							
							
							
							
						}
					
					
							
					
					
					
				}
				
				if ($tipodoc == 2)
				{
					// esto quiere decir que se está vendiendo con guia, por tanto, si existe credito a cliente, aca se descuenta el valor de la guia
					
					//Buscando credito para el cliente
					// si no lo tiene no hace nada, la factura asume el valor de pago... como  siempre
					
					$buscacred = "SELECT * FROM tbk_credito WHERE rut_cli='".$rutCli."'";
					$rescred = mysql_query($buscacred, $conn);
					
					$nfilas1  = mysql_num_rows($rescred);
					
					if ($nfilas1 > 0)
					{
						$fichacred = mysql_fetch_row($rescred);
						$saldocredito = $fichacred[2];
						
						$nuevosaldo  = $saldocredito  - $totaldocumento;
						
						$updatecre = "UPDATE tbk_credito SET ";
						$updatecre.= " saldo_cre  = ".$nuevosaldo;
						$updatecre.= " WHERE rut_cli  = '".$rutCli."'";
						
						//echo " <p/>UPDATECRE :: ".$updatecre."<p/>";
						
						$rescred = mysql_query($updatecre, $conn);
						
						
					
					
					}
					
					// como guía, ésta representa  un movimiento de caja, que luego será  concreto via facturacion de las mismas
					
					$fechakardex = date('d-m-Y H:i');
					$insertar =" INSERT INTO tbk_abono VALUES (";
					$insertar .="'',";
					$insertar .="'".$rutCli."',";
					$insertar .="'".$cb."',";
					$insertar .="'".$fechakardex."',";
					$insertar .="'2',";
					$insertar .="'',";
					$insertar .="'',";
					$insertar .="'0',";
					$insertar .="'".$totaldocumento."',";
					$insertar .="'',";
					$insertar .="'2',";
					$insertar .="''";
										
					$insertar .= ")";
					
					echo "GUARDANDO GUIA EN ABONO ";
					$res = mysql_query($insertar, $conn);
				
				}
				
					
				// ingresa registro al kardex  y a stock
				// para ello debemos encontrar los productos que pertenecen a este vale
				// y registrarlos en el kardex uno por uno
							
				$buscapro  = "SELECT * FROM tbk_docpro WHERE id_doc =".$cb;
				//echo $buscapro;
							
				$respro = mysql_query($buscapro, $conn);
				
				$i=0;
				echo "<br/>";	
				WHILE ($rowitem = mysql_fetch_row($respro))
				{
				
					$cbarrapro  = $rowitem[1];
					$despacho = $rowitem[2];
					$cantidad = $rowitem[3];
					$precio  = $rowitem[4];
					$pendiente = $rowitem[5];
					
					//buscando codigo interno del producto
					
					$buscaID = "SELECT id_pro FROM tbk_producto WHERE codigo_pro ='".$cbarrapro."'";
					$resID = mysql_query($buscaID, $conn);
					
					$fichaproducto = mysql_fetch_row($resID);
					
					$idpro = $fichaproducto[0];
					
					// si la factura es producto de una facturacion de guias
					if (empty($guiasafacturar))
					{
						// este proceso sólo se realiza si  no hay guias a facturar
						// descontar del STOCK
						$searchprecio = "SELECT  * FROM tbk_stock WHERE id_pro = ".$idpro;
						
						//echo "<p>".$searchprecio."</p>";
						
						$respre  = mysql_query($searchprecio, $conn);
						
						$fichastock = mysql_fetch_row($respre);

						$sminimo  = $fichastock[3];
						$salerta  = $fichastock[4];
						$smaximo  = $fichastock[5];
						$sstock   = $fichastock[2];
										
						$productobod = $sstock - $despacho;
						//echo " <p/>STOCK DEL PRODUCTO =".$sstock." RECEPCIONADO  =".$adespacho[$p]."  TOTAL INVENTARIO = ".$productobod;
										
						//actualizar inventario
						$updateprod = "UPDATE tbk_stock SET ";
						$updateprod.= " stock_stk = ".$productobod;
										
						$updateprod.=" WHERE id_pro =".$idpro;
										
										//echo "<p>".$updateprod."</p>";
						$resupdateprod = mysql_query($updateprod, $conn);
					}
					else
					{
							// este procedimiento se realiza para que quede registro de  la factura, pero en cuanto al kardex no genera movimento alguno
							echo "ESTA FACTURA NO GENERA EFECTOS EN KARDEX..";
							$cantidad  = 0;
							$despacho  = 0;
					
					}
							
						
					// ingresar a KARDEX		
					$fechakdx = date('d-m-Y H:i');
					
									$insertkdx = "INSERT tbk_kardex VALUES(";
									$insertkdx.= "'".$fechakdx."',";
									$insertkdx.= "'1',";
									$insertkdx.= "'".$cb."',";
									$insertkdx.= "'',";
									$insertkdx.= "'".$tipodoc."',";
									$insertkdx.= "'".$idpro."',";
									$insertkdx.= "'".$nrut."',";
									$insertkdx.= "'".$cantidad."',";
									$insertkdx.= "'".$despacho."',";
									$insertkdx.= "'".$precio."')";
									
								//echo $insertkdx;
								if ($reskdx  = mysql_query($insertkdx, $conn)) echo "<img src='images/logos/producto.jpg'>";
				
					$i++;
				}
					
				/*	
				$tipomensaje = 1;
				$texto = "Documento fue ingresado exitosamente al sistema.";
				include("mensaje.php");
				*/
				echo "<br/>";
				echo "<img src='images/logos/documento.jpg'>";
				
			} 	
		
		
		
	} 
	else
		{
				$tipomensaje = 0;
				$texto = "Documento no fue ingresado al sistema.";
				include("mensaje.php");
	
	
		}

	
	
	
	
	/*
	echo "<br/>CLIENTE =".$nrut;
	echo "<br/>CUOTAS =".$cuotas;
	echo "<br/>VALOR CUOTAS =".$valorcuota;
	echo "<br/>forma de pago =".$tarjeta;
	
	*/
	
	
	
?>
</td>
</tr>
</table>



<p/>

<table border='0'>
<tr>
<td id='data'><img src='images/logos/pago.jpg' height='20'></td>
<td id='menu'> Forma de pago registrada exitosamente. </td>

<td id='data'><img src='images/logos/cuota.jpg' height='20'></td>
<td id='menu'>Cuota registrada exitosamente. </td>

<td id='data'><img src='images/logos/producto.jpg' height='20'></td>
<td id='menu'>Producto registrada en k&aacute;rdex. </td>

<td id='data'><img src='images/logos/documento.jpg' height='20'></td>
<td id='menu'> Documento registrado exitosamente. </td>
</tr>
</table>

<br/>
<table border='0' cellspacing='5' cellpadding='5'>
<tr>
<td id='etiqueta'> Nueva Venta</td>
<td id='data' valign='bottom' align='center'>
		<a  id='menualternativo' href='home.php'><img src="images/logos/cancelar0.jpg" onmouseover="this.src = 'images/logos/cancelar1.jpg'" onmouseout="this.src = 'images/logos/cancelar0.jpg'" border="0"></img></a><br/>
</td>
<td id='data' valign='bottom'  align='center'>
		<a id='menu' href='historial.php'><img src="images/logos/aceptar0.jpg" onmouseover="this.src = 'images/logos/aceptar1.jpg'" onmouseout="this.src = 'images/logos/aceptar0.jpg'" border="0"></img></a>
</td>

</tr>
</table>

<?php include("footer.php");