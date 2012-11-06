<?php include("header.php")?>
<?php

	include("functions.php");
	

	
	// revision de la factura antes de grabar
	
	$tipodocumento 	= limpiar($_POST['fctipodoc']);
	$estadopago		= limpiar($_POST['fcpago']);
	
	$IDfactura		= limpiar($_POST['IDfactura']);
	$obs			= limpiar($_POST['fcobs']);
	
	
	
	
	$nrut  			= limpiar($_POST['nrut']);
	$fcfecha		= limpiar($_POST['fcfecha']);
	
	$fcneto			= limpiar($_POST['fcneto']);	
	$fcciva			= limpiar($_POST['fciva']);	
	$fctotal		= limpiar($_POST['fctotal']);	
	$usuario		= limpiar($_POST['usuario']);
	$fcobs			= limpiar($_POST['fcobs']);
	
		

	$doc = "";
	if ($tipodocumento == 1) 
	$doc = "BOLETA";
	if ($tipodocumento == 2) 
	$doc = "GUIA";
	if ($tipodocumento == 3) 
	$doc = "FACTURA";
	
	// guardar documento
	
	
	
	
	$insfc  = "INSERT INTO tbk_documentocompra VALUES (";
	
	$insfc.= "'',";
	$insfc.= "'".$nrut."',";
	$insfc.= "'".$tipodocumento."',";
	$insfc.= "'".$fcfecha."',";
	$insfc.= "'".$fctotal."',";
	$insfc.= "'0',";
	$insfc.= "'".$IDfactura."',";
	$insfc.= "'".$usuario."',";
	$insfc.= "'".$fcobs."',";
	$insfc.= "'',";
	$insfc.= "'".$estadopago."',";
	$insfc.= "''";
	$insfc.=")";
	
	echo"$estadopago";
	 echo "  SQL :: ".$insfc;
	if($doc == "BOLETA"){
		
			$fechakdx = date('Y-m-d H:i');

						$insertarbb =" INSERT INTO tbk_gasto VALUES (";
						$insertarbb .= "'',";
						$insertarbb .= "'".$fechakdx."',";
						$insertarbb .= "'".$fctotal."',";
						$insertarbb .= "'".$fcobs."',";
						$insertarbb .= "'".$nrut."'";
						$insertarbb .= ")";
						echo"$tipodocumento";
						if ($res = mysql_query($insertarbb, $conn))
						{
							$tipomensaje=1;
							$texto = "El gasto ha sido registrado exitosamente";
							include("mensaje.php");
							
						
						}
		
		
		}
	if ($insfac= mysql_query($insfc, $conn))
	{

			$IDdocumento = mysql_insert_id();
	
			$tipomensaje  = 1;
			$texto = "Recuerde: El Ingreso de este documento s&oacute;lo modifica precios de los productos. El stock es modificado por las gu&iacute;as asociadas.";
			include("mensaje.php");
			
			
			echo "<p/>";
			echo "<table border='0' cellpadding='5' cellspacing='5'  width='700'>";
			echo "<tr>";
			echo "<td  id='etiqueta' align='right' colspan='5'>";
			echo  "<font size='4'>".$doc."  N° ".$IDfactura."</font>";
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td id='etiqueta' > CODIGO</td>";
			echo "<td id='etiqueta'> NOMBRE</td>";
			echo "<td id='etiqueta'> CANTIDAD</td>";
			echo "<td id='etiqueta'> PRECIO</td>";
			echo "<td id='etiqueta'> DESC1</td>";
			echo "<td id='etiqueta'> DESC2</td>";
			echo "<td id='etiqueta'> DESC3</td>";
			echo "<td id='etiqueta'> $ TOTAL </td>";

			//echo "<td id='etiqueta'> STOCK PREVIO</td>";
			//echo "<td id='etiqueta'> NUEVO STOCK</td>";
			echo "</tr>";

			
			$i=0;
			for($i=1; $i <= 15; $i++)
			{
			
				$idpro			= limpiar($_POST['fcidpro'.$i]);
				$codigo 		= limpiar($_POST['fccbarras'.$i]);
				$nombre 		= limpiar($_POST['fcnombrespro'.$i]);
				$cantidad 		= limpiar($_POST['fccantidadpro'.$i]);
				$despacho 		= limpiar($_POST['fcdespachopro'.$i]);
				$precio 		= limpiar($_POST['fcprecio'.$i]);
				$columna 		= limpiar($_POST['fccolumna'.$i]);
				$estado 		= limpiar($_POST['fcestado'.$i]);
				$fcdecto1		= limpiar($_POST['descuen1'.$i]);
				$fcdecto2		= limpiar($_POST['descuen2'.$i]);
				$fcdecto3		= limpiar($_POST['descuen3'.$i]);
				
				if (!empty($codigo))
				{
				
					if ($estado == 0)
					{
						//buscar producto para actualizar datos....
						// si no lo encuentra.. lo ingresa como producto nuevo
						
						if (!empty($idpro))
						{
							// buscando stock de producto
								
							$nfilas  =0;
							if ($despacho > 0)
							{
								// actualizando stock del producto
								$spro = "SELECT * FROM tbk_stock WHERE id_pro = '".$idpro."'";
								
								
								//echo $spro;
								$rpro = mysql_query($spro, $conn);
								$nfilas  = mysql_num_rows($rpro);
								
								if ($nfilas > 0 )
								{
										$fichapro = mysql_fetch_row($rpro);
										$fcstock = $fichapro[2];
								
										$nuevofcstock  = $fcstock + $despacho;
										
										//actualizar stock
										$uppro = "UPDATE tbk_stock SET ";
										$uppro.= " stock_stk = '".$nuevofcstock."' WHERE id_pro = ".$idpro;
										//echo $uppro;
								}
								else
								
								{
								
										$uppro = "INSERT INTO tbk_stock VALUES( ";
										$uppro.= "'".$idpro."',";
										$uppro.= "'0',";
										$uppro.= "'".$despacho."',";
										$uppro.= "'0',";
										$uppro.= "'0',";
										$uppro.= "'0'";
										$uppro.= ")";
								}
								//echo $uppro;
								if ($respro = mysql_query($uppro, $conn)) echo " <br/> STOCK OK";
								// -----------------------------------------------------------------------
								
								
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
							}	
								
						
								
								
								
								
								
								
								
								// buscando precio de producto
								$vpro = "SELECT * FROM tbk_producto_valor WHERE id_pro = '".$idpro."'";
								$respro = mysql_query($vpro, $conn);
								
								$fichavalor  = mysql_fetch_row($respro);
								
								$fccosto  		= $fichavalor[2];
								$fcefectivo 	= $fichavalor[3];
								$fccredito 		= $fichavalor[4];
								$fcflete 		= $fichavalor[5];
								$fciva 			= $fichavalor[6];
								$fcrecargocredito = $fichavalor[7];
								$fcmargen 		=  $fichavalor[8];
								
								
								//echo "PRECIO COSTO ANTERIOR  =".$fccosto."  //  NUEVO VALOR  ".$precio;
								
								
								$nuevoflete  	= round((($precio * $fcflete)/100),0);
								$nuevoiva    	= round((($precio * $fciva)/100),0);
								$nuevomargen 	= round((($precio * $fcmargen)/100),0);
								
								
								
								$nuevoprecioefectivo  	=  $precio + $nuevoflete + $nuevoiva + $nuevomargen ;
								
								$nuevoprecioneto   		=  $precio + $nuevoflete +  $nuevomargen;
								
								
								$update= "UPDATE tbk_producto_valor SET ";
								$update.= "precio_costo_pv  ='".$precio."',";
								$update.= "precio_efectivo_pv  ='".$nuevoprecioefectivo."',";
								$update.= "precio_neto_pv  ='".$nuevoprecioneto."'";
								
								$update.= " WHERE id_pro= ".$idpro;
								
								//echo "UPDATE = ".$update;
								
								$upvalor  = 0;
								if ($uppro = mysql_query($update, $conn))
								{
									$upvalor = 1;
								}
								
								
								
								
								
								

						}
						else
						{
							// ingresa producto nuevo
							// lo ingresa en la lista de productos
							// le asigna un  precio
							// no se le asigna stock pues quien ingresa productos al inventario es la guia
							
							
							$insert  = "INSERT INTO tbk_producto VALUES (";
							$insert.= "'',";
							$insert.= "'".$codigo."',";
							$insert.= "'".$nombre."',";
							$insert.= "'',";
							$insert.= "'',";
							$insert.= "'',";
							$insert.= "'',";
							$insert.= "'',";
							$insert.= "'',";
							$insert.= "'',";
							$insert.= "''";
							
							$insert.= ")";
							
							//echo "SQL::".$insert;
							$flag=0;
							if ($inspro = mysql_query($insert, $conn))
							{
								$flag = 1;
								
								$idpro = mysql_insert_id();
								
								// agregar precio
								$insert2  = "INSERT INTO tbk_producto_valor VALUES (";
								$insert2.= "'".$idpro."',";
								$insert2.= "'".$codigo."',";
								$insert2.= "'".$precio."',";
								$insert2.= "'',";
								$insert2.= "'',";
								$insert2.= "'',";
								$insert2.= "'',";
								$insert2.= "'',";
								$insert2.= "''";
								
								$insert2.= ")";
								
								//echo "SQL::".$insert2;
							
								$flagvalor=0;
								if ($inspro = mysql_query($insert2, $conn))
								{
									$flagvalor  =1 ;
								}
								else
								{
									$flagvalor  =0;
								}
								
								
								
							}
							else
							{
								$flag = 0;
							}
							
						}
						
						
						$totaldespacho  = $cantidad - $despacho;
						
						// asociar producto a documento 
						$insert =" INSERT INTO tbk_docprocompra VALUES (";
						$insert.= "'".$IDdocumento."',";
						$insert.= "'".$codigo."',";
						$insert.= "'0',";
						$insert.= "'".$cantidad."',";
						$insert.= "'".$precio."',";
						$insert.= "'".$totaldespacho."',";
						$insert.= "'".$estado."',";
						$insert.= "'".$fcdecto1."',";
						$insert.= "'".$fcdecto2."',";
						$insert.= "'".$fcdecto3."',";
						$insert.= "'".	"'";

						$insert.= ")";						
						
					//	echo "<br/>".$insert."</br/>";
						if ($resip = mysql_query($insert,$conn))
						{
									//echo " <br/> Producto ".$codigo." ingresado.";
							
									//ingresar operacion a kardex
									// -----------------------------------------------------------------------
									$fechakdx = date('d-m-Y H:i');
									
									$insertkdx = "INSERT tbk_kardex VALUES(";
									$insertkdx.= "'".$fechakdx."',";
									$insertkdx.= "'0',";
									$insertkdx.= "'".$IDdocumento."',";
									$insertkdx.= "'',";
									$insertkdx.= "'3',";
									$insertkdx.= "'".$idpro."',";
									$insertkdx.= "'".$nrut."',";
									$insertkdx.= "'".$cantidad."',";
									$insertkdx.= "'".$despacho."',";
									$insertkdx.= "'".$precio."')";
									
									//echo $insertkdx;
									if ($reskdx  = mysql_query($insertkdx, $conn)) echo "<p/>OK KARDEX<p/>";
									// -----------------------------------------------------------------------
								
								
								
								
								
						}
						
																		
						echo "<tr>";
						echo '<td id="data" width="100">'.$codigo.'</td>';
						echo '<td id="data">'.$nombre.'</td>';
						echo '<td id="data" align="right">'.$cantidad.'</td>';
						echo '<td id="data" align="right">$ '.$precio.'</td>';
						$colum=$cantidad*$precio;
						echo '<td id="data" align="right">$ '.$fcdecto1.'</td>';
						echo '<td id="data" align="right">$ '.$fcdecto2.'</td>';
						echo '<td id="data" align="right">$ '.$fcdecto3.'</td>';
						echo '<td id="data" align="right">$ '.$colum.'</td>';

						//echo '<td id="data" align="right">0</td>';
						//echo '<td id="data" align="right">'.$cantidad.'</td>';
						//echo '<td id="data" align="right"> <a id="menu" href="buscar.php?cb='.$codigo.'" target="_blank"> [Ver Ficha]</a></td>';
						
						echo "</tr>";
						
						
					}
				}
					
				if ($estado == 1)
				{
						if (empty($idpro))

						{
							// ingresa producto nuevo
							// lo ingresa en la lista de productos
							// le asigna un  precio
							// no se le asigna stock pues quien ingresa productos al inventario es la guia
							
							
							$insert  = "INSERT INTO tbk_producto VALUES (";
							$insert.= "'',";
							$insert.= "'".$codigo."',";
							$insert.= "'".$nombre."',";
							$insert.= "'',";
							$insert.= "'',";
							$insert.= "'',";
							$insert.= "'',";
							$insert.= "'',";
							$insert.= "'',";
							$insert.= "'',";
							$insert.= "''";
							
							$insert.= ")";
							
							//echo "SQL::".$insert;
							$flag=0;
							if ($inspro = mysql_query($insert, $conn))
							{
								$flag = 1;
								
								$idpro = mysql_insert_id();
								
								// agregar precio
								$insert2  = "INSERT INTO tbk_producto_valor VALUES (";
								$insert2.= "'".$idpro."',";
								$insert2.= "'".$codigo."',";
								$insert2.= "'".$precio."',";
								$insert2.= "'',";
								$insert2.= "'',";
								$insert2.= "'',";
								$insert2.= "'',";
								$insert2.= "'',";
								$insert2.= "''";
								
								$insert2.= ")";
								
								echo "SQL::".$insert2;
							
								$flagvalor=0;
								if ($inspro = mysql_query($insert2, $conn))
								{
									$flagvalor  =1 ;
								}
								else
								{
									$flagvalor  =0;
								}
								
								
								
							}
							else
							{
								$flag = 0;
							}
							
						}
						
						$totaldespacho  = $cantidad - $despacho;
						// asociar producto a documento 
						$insert =" INSERT INTO tbk_docprocompra VALUES (";
						$insert.= "'".$IDdocumento."',";
						$insert.= "'".$codigo."',";
						$insert.= "'0',";
						$insert.= "'".$cantidad."',";
						$insert.= "'".$precio."',";
						$insert.= "'".$totaldespacho."',";
						$insert.= "'".$estado."',";
						$insert.= "'".$fcdecto1."',";
						$insert.= "'".$fcdecto2."',";
						$insert.= "'".$fcdecto3."'";

						$insert.= ")";						
						
						//echo "<br/>".$insert."</br/>";
						if ($resip = mysql_query($insert,$conn))
						{
							echo " <br/> Producto ".$codigo." ingresado.";
							
								
								
									// si el producto es rechazado no debe modificar el kardex
									//ingresar operacion a kardex
									
							
						}
						
						echo "<tr>";
						echo '<td id="atrasocuota" width="100">'.$codigo.'</td>';
						echo '<td id="atrasocuota">'.$nombre.'</td>';
						echo '<td id="atrasocuota" align="right">'.$cantidad.'</td>';
						echo '<td id="atrasocuota" align="right">$ '.$precio.'</td>';
						$colum=$cantidad*$precio;
						echo '<td id="data" align="right">$ '.$colum.'</td>';

						//echo '<td id="atrasocuota" align="right">'.$fcstock.'</td>';
						//echo '<td id="atrasocuota" align="right">'.($fcstock + $cantidad).'</td>';
						//echo '<td  align="right"> <a id="menu" href="buscar.php?cb='.$codigo.'" target="_blank"> [Ver Ficha]</a></td>';
						echo "</tr>";
				}
			}
			
			
			
			echo "<tr>";
			echo "<td id=' data' colspan='3' />";
			echo "<td id='etiqueta' '> NETO </td>";
			echo "<td id='etiqueta' align='right'>";
			echo 	$fcneto;
			echo "</td>";
			echo "</tr>";
			
			echo "<tr>";
			echo "<td id=' data' colspan='3' />";
			echo "<td id='etiqueta' '> IVA </td>";
			echo "<td id='etiqueta' align='right'>";
			echo 	$fcciva;
			echo "</td>";
			echo "</tr>";
			
			echo "<tr>";
			echo "<td id=' data' colspan='3' />";
			echo "<td id='etiqueta' '> TOTAL </td>";
			echo "<td id='etiqueta' align='right'>";
			echo 	$fctotal;
			echo "</td>";
			echo "</tr>";
			
			echo "</table>";
			
			echo "<p/>";
			echo "<label id='menu'><b>Nota:</b> Los productos en rojo fueron marcados como <b>RECHAZADOS</b> y no tienen ingerencia alguna en el inventario del sistema.</label>";
			
	}
	else
	{
		$tipomensaje =0;
		$texto  = "La Factura de compra no pudo ser almacenada. Comun&iacute;quese con el administrador para mayor informaci&oacute;n";
		include("mensaje.php");
	
	}
		


?>
<?php include("footer.php")?>