<?php include("header-micro.php")?>

<center>
<table border='0' width='800'>
<tr>
<td align='center'>

<?php
	

	$IDcliente			= $_POST['IDcliente'];
	$codigo				= $_POST['codigo'];
	$producto 			= $_POST['producto'];
	$cantidad 			= $_POST['cantidad'];
	$despacho 			= $_POST['pdespacho'];
	$valor    			= $_POST['valor'];
	$subt     			= $_POST['subtotal'];
	$total				= $_POST['total'];
	$vendedor			= $_POST['vendedor'];
	$obs				= $_POST['obs'];
	$listadoguias		= $_POST['listadoguias'];
	
	$desc				= $_POST['desc'];
	$tp					= $_POST['tp'];
	$subtotal			= $_POST['subtotal'];
	
	$fechadoc			= date('d-m-Y');
	$fechakdx			= date('Ymd');
	$fecha = time (); 
	$fechahr=date ( "h:i:s" , $fecha );
	
	

	
	
	// guardando factura
	
	$insert = "INSERT INTO tbk_arriendo VALUES(";
	$insert .= "'',";
	$insert .= "'".$IDcliente."',";
	$insert .= "'0',";
	$insert .= "'".$fechadoc." / ".$fechahr."',";
	$insert .= "'".$total."',";
	$insert .= "'1',";
	$insert .= "'',";
	$insert .= "'".$vendedor."',";
	$insert .= "'".$obs."',";
	$insert .= "'".$listadoguias."',";
	$insert .= "'".$tp."',";
	$insert .= "'".$desc."',";
	$insert .= "'".$subtotal."'";
	$insert .= ")";
	
	//echo $insert;
	
	echo "<table border='0' width='500' height='250'>";
	echo "<tr>";
	echo "<td id='data' align='center'>";
	
			if ($insertfac = mysql_query($insert,$conn))
			{
				echo " <br/><img src='images/documento.jpg'><br/> ";
				$IDdocumento  =  mysql_insert_id();
				
			
				
				// --------------------------------------------------------------
				
				// Guardar productos de la factura
				
				$p=0;
				WHILE (!empty($codigo[$p]))
				{
				
						$pcodigo 		= $codigo[$p];
						$pdespacho 		= $despacho[$p];
						$pproducto 		= $producto[$p];
						$pcantidad 		= $cantidad[$p];
						$pvalor 		= $valor[$p];
						
						$pdisponible = $pcantidad - $pdespacho;
						if ($pdisponible < 0 ) $pdisponible = 0;
						
						$insertP = "INSERT INTO tbk_docarr VALUES(";
						$insertP .= "'".$IDdocumento."',";
						$insertP .= "'".$pcodigo ."',";
						$insertP .= "'".$pdespacho ."',";
						$insertP .= "'".$pcantidad ."',";
						$insertP .= "'".$pvalor ."',";
						$insertP .= "'".$pdisponible ."'";
						$insertP .= ")";
						
						//echo $insertP;
						
						if($resultadoP = mysql_query($insertP, $conn)) 
						{
						
							// descontar productos de stok del producto
							/*
							//buscar stock del producto
							$buscapro = "SELECT  * FROM  tbk_producto WHERE codigo_pro = '".$pcodigo."'";
							//echo $buscapro."<p/>";
							$respro = mysql_query($buscapro);
							
							$fichap = mysql_fetch_row($respro);
							$idprod = $fichap[0];
													
							$selectpro = "SELECT * FROM tbk_stock WHERE id_pro = ".$idprod;
							//echo $selectpro."<p/>";
							
							$resproducto = mysql_query($selectpro, $conn);
							$fichaprod = mysql_fetch_row($resproducto);
							
							$actualstock = $fichaprod[2];
							
							$nuevostock =  $actualstock  - $pcantidad;
							
							//echo "ANTERIOR =". $actualstock. "  NUEVO STOCK =".$nuevostock;
							
							$updatestock ="UPDATE tbk_stock  SET ";
							$updatestock.=" stock_stk = ".$nuevostock;
							
							$updatestock.=" WHERE id_pro = ".$idprod;
							if ($resultadostock = mysql_query($updatestock))
							{
								
								
								//ingresar operacion a kardex
								
								$insertkdx = "INSERT tbk_kardex VALUES(";
								$insertkdx.= "'".$fechakdx."',";
								$insertkdx.= "'0',";
								$insertkdx.= "'".$IDdocumento."',";
								$insertkdx.= "'',";
								$insertkdx.= "'0',";
								$insertkdx.= "'".$idprod."',";
								$insertkdx.= "'".$IDcliente."',";
								$insertkdx.= "'".$pcantidad."',";
								$insertkdx.= "'0',";
								$insertkdx.= "'".$pvalor."')";
								
								//echo $insertkdx;
								if ($reskdx  = mysql_query($insertkdx, $conn)) echo "<p/>OK KARDEX<p/>";
								
							}
							
							*/
							
							
							
							
							echo "<img src='images/producto.jpg'> ";
							
						}
						
						
						
					$p++;
				}
				
				
				
					
				
			} 	
		
		
		
		echo "<td>";
		echo "</tr>";
		echo "</table>";
		
		echo "<br/>";
		echo "<table border='0'><tr><td id='data'><img src='images/documento.jpg' height='30'> </td><td > <label id='comentario'>Documento grabado exitosamente</label> </td></tr>";
		echo "</tr><td id='data'><img src='images/producto.jpg' height='30'></td><td ><label id='comentario'> Producto almacenado exitosamente</label></td></tr></table>";
		
		echo "<p/>";
		
		echo "<table border='0' cellspacing='5' cellpadding='5' height='50'>";
		echo "<tr>";
		echo "<td id='data' align='center'><a id='menu' href='historialcotizacion.php'><img src='images/nuevo.jpg' border='0' height='30'><br/>NUEVO ARRIENDO</a> </td><td id='data' align='center'>  <a id='menu' href='vervalearriendo.php?cb=".$IDdocumento."' target='popup'  onClick='window.open(this.href, this.target, \"width=650,height=500\"); return false;'> <img src='images/lupa.png'  height='30' border='0'><br/>VER ARRIENDO</a> </td>  ";
		echo "</tr></table>";
	
	
	
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


<?php include("footer.php");