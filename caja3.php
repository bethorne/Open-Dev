<?php include("header.php")?>


<?php
	

	$cfactura		= $_POST['cfactura'];
	$codigo			= $_POST['codigo'];
	$despacho 		= $_POST['despacho'];
	$producto 		= $_POST['producto'];
	$cantidad 		= $_POST['cantidad'];
	$valor    		= $_POST['valor'];
	$subt     		= $_POST['subtotal'];
	$total			= $_POST['total'];
	$nrut	  		= $_POST['nrut'];
	$tarjeta  		= $_POST['tarjeta'];
	$cuotas   		= $_POST['cuotas'];
	$valorcuota 	= $_POST['valorcuota'];
	$diadepago		= $_POST['diadepago'];
	$mesdepago		= $_POST['mesdepago'];
	$aniodepago		= $_POST['aniodepago'];
	$fechafact		= $_POST['fechafact'];
	$numerof  		= $_POST['numerof'];
	$documento		= $_POST['documento'];
	
	$diasdepago = $diadepago."-".$mesdepago."-".$aniodepago;
	
	
	/*
	
	echo "<p/>Codigo";
	print_r($codigo);
	echo "<p/>despacho";
	print_r($despacho);
	echo "<p/>producto";
	print_r($producto);
	echo "<p/>cantidad";
	print_r($cantidad);
	echo "<p/>valor";
	print_r($valor);
	echo "<p/>subtotal";
	print_r($subt);
	echo "<p/>";
	
	*/
	
	
	
	// guardando factura
	
	$insert = "INSERT INTO tbk_factura VALUES(";
	$insert .= "'".$cfactura."',";
	$insert .= "'".$nrut."',";
	$insert .= "'".$documento."',";
	$insert .= "'".$fechafact."',";
	$insert .= "'".$total."',";
	$insert .= "'1'";
	$insert .= ")";
	
	//echo $insert;
	
	
	if (!empty($cfactura))
	{
			if ($insertfac = mysql_query($insert,$conn))
			{
				echo " <br/>-  factura ingresada exitosamente ";
				
				//factura en parametros
				$updateF = "UPDATE tbk_parametro Set valor_param = ".$cfactura;
				
				if ($documento == '1' ) $updateF.= " WHERE id_param = 2";
				if ($documento == '2' ) $updateF.= " WHERE id_param = 4";
				
				if ($resupdateF = mysql_query($updateF,$conn)) echo "<p/>actualizado param<p/>";
				//echo "Actualizar =".$updateF;
				
				
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
				
				// Guarda forma de pago
				// -------------------------------------------
				
					$insertPG = "INSERT INTO tbk_pago VALUES(";
					$insertPG .= "'".$cfactura."',";
					$insertPG .= "'".$nrut ."',";
					$insertPG .= "'".$total ."',";
					$insertPG .= "'".$documento."',";
					$insertPG .= "'".$cuotas ."',";
					$insertPG .= "'".$valorcuota."',";
					$insertPG .= "'".$diasdepago."',";
					$insertPG .= "'".date('d-m-Y')."'";


					
					$insertPG .= ")";
						
						//echo $insertPG;
						
					if($resultadoPG = mysql_query($insertPG, $conn)) echo "<p>metodo de pago  guardados exitosamente<p/>";
					
				
				
				
				
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
					$insertPG .= "'".$cfactura."',";
					$insertPG .= "'".$nrut ."',";
					$insertPG .= "'".$cuotas ."',";
					$insertPG .= "'".$valorcuota."',";
					$insertPG .= "'".$next."',";
					$insertPG .= "'',";
					$insertPG .= "'0',";
					$insertPG .= "'0',";
					$insertPG .= "'".$valorcuota."'";


					
					$insertPG .= ")";
						
						echo $insertPG;
						
					if($resultadoPG = mysql_query($insertPG, $conn)) echo "<p>fecha y cuota de pago  guardados exitosamente<p/>";
				}
				
				$tipomensaje = 1;
				$texto = "Documento fue ingresado exitosamente al sistema.";
				include("mensaje.php");
	
				
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


<?php include("footer.php");