<?php include("header.php")?>


<?php


	include("functions.php");


	$cb 		= $_GET['cb'];
	$see 		= $_POST['look'];


	$nombre		= $_POST['nombre'];
	if (!empty($nombre)) $codigofactura = $nombre ;
	$nrut 		= $_POST['nrut'];
	
	
	
	$boton 		= "0";
	$facturacancelada =0;
	
	// pago de cuota
	
	$pagofactura 	= $_POST['FFID'];
	$pagocliente 	= $_POST['FUID'];
	$pagocuotas 	= $_POST['cuantascuotas'];
	$pagomonto  	= $_POST['montopago'];
	$pagofecha  	= $_POST['FFECHA'];
	$pagocadacuota  = $_POST['cadacuota'];
	$fpc			= $_POST['fpc'];
	$vc				= $_POST['vc'];
	
	$abonoparte1 	= $_POST['abonoparte1'];
	$abonoparte2	= $_POST['abonoparte2'];
	$abonoparte3	= $_POST['abonoparte3'];
	$abonoparte4	= $_POST['abonoparte4'];
	$abonoparte5	= $_POST['abonoparte5'];
	$abonototal		= $_POST['abonototal'];
	
	$rc1			= $_POST['rc1'];			
	$rc2			= $_POST['rc2'];
	$rc3			= $_POST['rc3'];
	
	$cheque1		= $_POST['cheque1'];
	$cheque2		= $_POST['cheque2'];
	$cheque3		= $_POST['cheque3'];
	$cheque4		= $_POST['cheque4'];
	
	$bancocheque1	= $_POST['bancocheque1'];
	$bancocheque2	= $_POST['bancocheque2'];
	$bancocheque3	= $_POST['bancocheque3'];
	$bancocheque4	= $_POST['bancocheque4'];
	


	
	
	
	 //echo " SE HA PAGADO BAJO LOS SIGUIENTES TERMINOS: ".$pagofactura." por ".$pagocliente." la cantidad de ".$pagomonto." correspondientes a ".$pagocuotas." cuotas<p/>";
	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert = "SELECT * FROM tbk_documento WHERE id_doc LIKE '".trim($codigofactura)."%'  AND estado_doc = 1 ORDER BY id_doc DESC";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_documento WHERE rut_cli LIKE '".trim($nrut)."' AND estado_doc = 1  ORDER BY id_docDESC";
					break;
					
		

			case '3':
					$insert = "SELECT * FROM tbk_documento WHERE SUBSTR(fecha_doc,4,2) LIKE '".trim($marca)."%' AND estado_doc = 1 ORDER BY id_doc DESC";
					break;
			
			
			case '9':
					//echo "almacenando pago de cuotas";
					
					// ahora lo que debemos hacer es repartir el abono entre las cuotas
					// las que queden completas.. se consideran pagadas
					// las siguientes. sólo abonadas y se consideran retrasadas si se vence la couta
					
					
					
					//echo "ABONO TOTAL =".$abonototal;
					
					/*
					echo "<pre>";
					print_r($fpc);
					echo "</pre>";
					
					echo "<pre>";
					print_r($vc);
					echo "</pre>";
					*/
					$cuotaspagables = 0;
					$j=0;
					
				    echo "<p/>ELEMENTOS DEL VECTOR CUOTA =".Count($vc);
					$vectorq = Count($vc);

					
					WHILE (($vc[$j] >= 0) AND ($j <= $vectorq))
					{
							$vcuota = $vc[$j];
							// echo "<br> ".$j." -> ".$vcuota." < ".$abonototal;
							
							
							if ($vcuota < $abonototal)  
							{
								if ($vcuota > 0 ) $cuotaspagables++;
							}
							else 
								{
									break;
								}
								
							
						$j++;
					}
					
					
					if ($j>= $vectorq) 
						{
							//echo "<h1> Factura pagada J:".$vcuota."</h1>";
							$facturacancelada = 1;
							$saldofinal  = $abonototal - $vc[($j-2)];
					
						}
					//echo "<p/>CUOTAS PAGABLES =".$cuotaspagables;
					// echo "<p/> SALDO ABONO = ".$saldoabono;
					 
					
					$q=0;
					
					for ($q =0; $q <  $cuotaspagables; $q++)
					{
					
						$update = "UPDATE tbk_pago_cuota SET";
						$update.= " fecha_pc ='".date('d-m-Y H:i')."',";
						$update.= " estado_pc =1 ";
						$update.= " WHERE id_fact = '".$pagofactura."' AND rut_cli = '".$pagocliente."' AND  vencimiento_pc = '".$fpc[$q]."';";
						
						
						//echo "<p/>->".$update."<p/>";
						/*
						echo " <p/> Abono Efectivo 1 : RedCompra: ".$rc1." Banco:".$bancocheque1." N°: ".$cheque1." Monto: $".$abonoparte1;
						echo " <p/> Abono Efectivo 2 : RedCompra: ".$rc2." Banco:".$bancocheque2." N°: ".$cheque2." Monto: $".$abonoparte2;
						echo " <p/> Abono Efectivo 3 : RedCompra: ".$rc3." Banco:".$bancocheque3." N°: ".$cheque3." Monto: $".$abonoparte3;
						echo " <p/> Abono Tarjeta  4 : Banco:".$bancocheque4." N°: ".$cheque4." Monto: $".$abonoparte4;
						*/
						
						$registro =1 ;
						
						if($resulta = mysql_query($update, $conn))
						{
							$registro = 1;
							
							
							
							
							
						}
						else
							{
								$registro = 0;
							}
						
						
						// RECORDAR ACTUALIZAR 
					}
					
					
					
							// aqui debemos registrar qué tipo de abonos se hicieron para pagar las cuotas 
							// en la tabla abonos
							
								if ($abonoparte1 > 0 )
								{
									$insertabono ="";
									$insertabono = "INSERT INTO tbk_abono VALUES ('',";
								
									$insertabono.= "'".$pagocliente."',";
									$insertabono.= "'".$pagofactura."',";
									$insertabono.= "'".date('d-m-Y H:i')."',";
									$insertabono.= "'1',";
									$insertabono.= "'".$rc1."',";
									$insertabono.= "'".$cheque1."',";
									$insertabono.= "'".$bancocheque1."',";
									$insertabono.= "'".$abonoparte1."'";
									$insertabono.= ")";
									
									//echo "<p/>".$insertabono;
									if($resulta = mysql_query($insertabono, $conn)) echo "<br/>";
									
								
								}
								
								if ($abonoparte2 > 0 )
								{
									$insertabono ="";
									$insertabono = "INSERT INTO tbk_abono VALUES ('',";
									$insertabono.= "'".$pagocliente."',";
									$insertabono.= "'".$pagofactura."',";
									$insertabono.= "'".date('d-m-Y H:i')."',";
									$insertabono.= "'1',";
									$insertabono.= "'".$rc2."',";
									$insertabono.= "'".$cheque2."',";
									$insertabono.= "'".$bancocheque2."',";
									$insertabono.= "'".$abonoparte2."'";
									$insertabono.= ")";
									
									//echo "<p/>".$insertabono;
									if($resulta = mysql_query($insertabono, $conn)) echo "<br> abono2";
								}
								
								
								if ($abonoparte3 > 0 )
								{
									$insertabono ="";
									$insertabono = "INSERT INTO tbk_abono VALUES ('',";
									$insertabono.= "'".$pagocliente."',";
									$insertabono.= "'".$pagofactura."',";
									$insertabono.= "'".date('d-m-Y H:i')."',";
									$insertabono.= "'1',";
									$insertabono.= "'".$rc3."',";
									$insertabono.= "'".$cheque3."',";
									$insertabono.= "'".$bancocheque3."',";
									$insertabono.= "'".$abonoparte3."'";
									$insertabono.= ")";
									
									//echo "<p/>".$insertabono;
									if($resulta = mysql_query($insertabono, $conn)) echo "<br> abono3";
								}
								
								if ($abonoparte4 > 0 )
								{
									$insertabono ="";
									$insertabono = "INSERT INTO tbk_abono VALUES ('',";
									$insertabono.= "'".$pagocliente."',";
									$insertabono.= "'".$pagofactura."',";
									$insertabono.= "'".date('d-m-Y H:i')."',";
									$insertabono.= "'0',";
									$insertabono.= "'',";
									$insertabono.= "'".$cheque4."',";
									$insertabono.= "'".$bancocheque4."',";
									$insertabono.= "'".$abonoparte4."'";
									$insertabono.= ")";
									
									//echo "<p/>".$insert;
									if($resulta = mysql_query($insertabono, $conn)) echo "<br> abono4";
								}
								
								$saldoabonototal = $abonototal - $vc[($j-1)];	
								
								//echo "<p> SALDO ABONO TOTAL ".$saldoabonototal;
								
								$saldoactualizar = $saldoactual + $saldoabonototal;
								$update = "UPDATE tbk_saldo SET saldo_sa = ".$saldoactualizar." WHERE rut_cli ='".$pagocliente."'";
								//echo "<p>".$update;
								$ressaldo = mysql_query($update, $conn);
					
					
					
					
					if($registro == 1)
						{
							$tipomensaje = 1;
							$texto = "Pago de cuota(s)  realizado  exitosamente";
							include("mensaje.php");
							
						}
						else
							{
							
								// resulta que el abono no alcanza para la primera cuota.. asi que se va saldo
								
								//echo " <p/>Abono  - Vcuota = ".($abonototal - $vcuota);
								
								$insertsaldo ="INSERT INTO tbk_saldo VALUES (";
								$insertsaldo.="'".$pagocliente."',";
								$insertsaldo.="'".$abonototal."'";
								$insertsaldo.=")";
								
								//echo $insertsaldo;
								
								if ($ressaldo = mysql_query($insertsaldo, $conn)) 
								{
									echo "<img src='images/ok.jpg'>";
								}
								else
									{
											$saldoactualizar = $saldoactual + $abonototal;
											$update = "UPDATE tbk_saldo SET saldo_sa = ".$saldoactualizar." WHERE rut_cli ='".$pagocliente."'";
											//echo "<p>".$update;
											$ressaldo = mysql_query($update, $conn);
											
										
									}
								
								
								
								
								
								$tipomensaje=0;
								$texto = "El abono realizado  no es suficiente para cancelar la cuota, porque lo que ser&aacute; acumulado al pozo de abono del cliente";
								include("mensaje.php");
								
								
								
								
							}
						
					
					break;
				
		}
		
		if ($facturacancelada == 1 )
		{
								
			echo "<h1>Actualizar Factura</h1>";
			
			
			//actualizar factura
			
			echo " <h2> Saldo </h2>".$saldofinal;
			$update = "UPDATE tbk_saldo SET saldo_sa = ".$saldofinal." WHERE rut_cli ='".$pagocliente."'";
			//echo "<p>".$update;
			$ressaldo = mysql_query($update, $conn);
								
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
				$codigodoc  = $ficha[5];

			
			}
	
	}

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>


<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> PAGOS</label>
	<br/>
	<label id='comentariogris'> Complete uno de los campos para realizar la b&uacute;squeda. Si desea listar todos las facturas, haga click en 'buscar c&oacute;digo' con el campo vac&iacute;o.</label>
	<hr/>
	<p/>


	<form name='boleta' action='facturasadeudadas.php?cb=<?=$cb?>' method ='POST'>
	

	
	<table border='0'>
	<tr>
	<td width='400' valign='top'>
	
			<label id='subtitulo'> Resultado B&uacute;queda </label>
			<p/>
			
			<fieldset>
			
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
							$tipodoc	= $row[2];
							$fechafact = $row[3];
							$total  = $row[4];
							$estado = $row[5];
							$codigodoc = $row[6];
							
							if ($tipodoc == 1) $folio = "Boleta";
							if ($tipodoc == 2) $folio = "Gu&iacute;a de Venta";
							if ($tipodoc == 3) $folio = "Factura";
							
							$proceso ="";
							SWITCH($estado)
							{
								case '1' : $proceso = "P"; break;
								case '0' : $proceso = "C"; break;
							
							
							
							}
							
							echo "<tr><td id='data' width='20'><a id='etiquetazul' href='facturasadeudadas.php?cb=".$facturaID."'><font size='4'>".$codigodoc."</font></a></td><td id='data'>".$clienteID."</td><td id='etiqueta'>".$folio."</td><td id='data'>".$fechafact."</td><td id='data'>$ ".$total."</td></tr>";
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
		
					
		<?php 	 
			
				$find = "SELECT * FROM tbk_pago WHERE  id_fact = ".$scodigo;
				if ($resst = mysql_query($find, $conn))
				{
				
					$ficha3 = mysql_fetch_row($resst);
					
					$f3cliente 		= $ficha3[1];
					//$f3total		= $ficha3[2];
					$f3tipodepago 	= $ficha3[3];
					$f3cuotas 		= $ficha3[4];
					$f3valorcuota 	= $ficha3[5];
					$f3diadepago    = $ficha3[6];
					$f3fecha 		= $ficha3[7];
					
					$f3total 		= $f3cuotas *  $f3valorcuota;
					
					// averiguar saldo de cliente
					$searchsaldo = " SELECT * FROM tbk_saldo WHERE rut_cli ='".$f3cliente ."'";
					$ressaldo = mysql_query($searchsaldo,$conn);
					
					$fichasaldo = mysql_fetch_row($ressaldo);
					$saldoactualizar =  $fichasaldo[1];
					
				//	echo "SALDO CLIENTE=".$saldoactualizar;
			
					
		?>	

					<p/>
					<label id='subtitulo'> Datos de Factura </label>
					<p/>
			
					<fieldset>
					
					<table border='0' cellspacing='5' cellpadding='5' width='800' >
					<tr>
					<th id='etiqueta'> Factura </th>
					
					<th id='etiqueta'> Cuotas </th>
					<th id='etiqueta'> Valor Cuota</th>
					<th id='etiqueta'> Primer Pago </th>
					<th id='etiqueta'> Total </th>
					</tr>
					
					<tr>
					<td id='data' align='center' >
						   <a  href="verfactura.php?cb=<?=$cb?>" target="popup"  onClick="window.open(this.href, this.target, 'width=500,height=600'); return false;"><img src='images/binoculares.gif' border='0'></a>  
					</td>

					<td id='data' align='right' >
						<label id='comentario'> <?=$f3cuotas?></label>
					</td>
					<td id='data'align='right'>
						<label id='comentario'>$ <?=$f3valorcuota?></label><input type='hidden' name='cuota1' value='<?=$f3valorcuota?>'>
					</td>
					<td id='data' align='right' >
						<label id='comentario'> <?=$f3diadepago?></label>
					</td>
					<td id='data' align='right'  >
						<label id='comentario'><font size='4'> $ <?=$f3total?></font></label>
					</td>
					</tr>
					
					</table>
					
					</fieldset>
					
					
					
					<!-- Cuotas pagadas -->
					
					
					
					<p/>
					<label id='subtitulo'> Cuotas Programadas</label>
					<table border='0' cellspacing='5' cellpadding='5'>
					<tr>
					<td id='etiqueta'> Ver Abonos del Cliente </td>
					<td id='data'>
							<a  href="verabono.php?ID=<?=$frut?>" target="popup"  onClick="window.open(this.href, this.target, 'width=750,height=600'); return false;"><img src='images/binoculares.gif' border='0'></a>  
					</td>
					</tr>
					</table>
					<p/>
					
					<fieldset>
					
						<table border='0' cellspacing='5' cellpadding='5' width='800'>
						
						<tr>
						
						<th id='etiqueta' width='100'> Fecha Vencimiento </th>
				
						<th id='etiqueta' width='20'>  N° </th>
						<th id='etiqueta' width='100'> Valor Cuota</th>
						<th id='etiqueta' width='100'> Valor Acumulativo</th>
						<th id='etiqueta' width='100'> Fecha de Pago  </th>
						
						
						</tr>
						<?php
						
						
						
							$find = "SELECT * FROM tbk_pago_cuota WHERE  id_fact = ".$cb." AND rut_cli LIKE '".$frut."' ORDER BY SUBSTR(vencimiento_pc,7,4), SUBSTR(vencimiento_pc,4,2) ASC";
							//echo "<p>".$find."<p/>";
							
							$montocuotaspagadas = 0;
							$montototalcuotas =0;
							$cuotaspagadas =0;
							
							$vectorcuotas[]=0;
						
							if ($resst2 = mysql_query($find, $conn))
							{	
								$d=0;
								WHILE ($ficha4 = mysql_fetch_row($resst2))
								{
									
									$campo1 = $ficha4[0];
									$campo2 = $ficha4[1];
									$campo3 = $ficha4[2];
									$campo4 = $ficha4[3];
									$campo5 = $ficha4[4];
									$campo6 = $ficha4[5];
									$campo7 = $ficha4[6];
									$campo8 = $ficha4[7];
									$campo9 = $ficha4[8];
									
									$montototalcuotas = $montototalcuotas + $campo9;
									
									//este ciclo crea un vector acumulativo de pagos de cuotas
									$z=1;
									$tope = $d + 1;
									
									$acumulativo =0;
									for ($z =1; $z <=$tope; $z++)
									{
											$otracuota = 0;
											$otracuota = $campo9;
											if ($campo7 == 1) $otracuota =0;
											$vectorcuotas[($d+1)] = $vectorcuotas[$d]+ $otracuota;
											//echo "<p>".$vectorcuotas[$d+1];
									}
									
									
									
									
									if ($campo8 >0)	
									{
											$celda= "atrasocuota"; 
									} else
										{
											$celda = "etiqueta";
										}
									
									if ($campo7 == 1) $celda= "datacuota"; 
									
									echo "<tr>";
									//echo "<td id='etiqueta'><input type='checkbox' name='p".$d."' value='".$campo9."' onClick = 'set1(this.value,boleta.abonototal.value)'></td>";
									
									echo "<td id='".$celda."'>".$campo5." </td><td id='data'>".($d+1)."</td>";
									
									echo "<td id='data' align='right'> $ ".$campo9;
									
									echo "<td id='data' align='right'>$ ".$vectorcuotas[($d+1)]."</td>";
									echo "<input type='hidden' name='vc[]' value='".$vectorcuotas[($d+1)]."'>";
									
									echo "</td>";
									if (empty($campo6))
									{
										echo "<td id='".$celda."'>".$campo6."</td>";
										echo "<input type='hidden' name='fpc[]' value='".$campo5."'>";
										
									
									} else
										{
											echo "<td id='".$celda."'>".$campo6."</td>";
											$cuotaspagadas = $cuotaspagadas +1;
											$montocuotaspagadas = $montocuotaspagadas + $campo9;
										}
								
									echo "</tr>";
									$d++;
								}
							
							}							
							else
								
								{
									echo "<label id='comentario' >Este cliente no registra cuotas pagadas para esta factura</label>";
								}
							
							
							
						?>
												
						<tr>
						<td/>
						<td/>

						<td id='etiqueta'>
							Monto Adeudado
						</td>
					
						<td id='etiqueta'  align='right' >
							$ <?=$vectorcuotas[($d)]?>
						</td>
						</tr>
						</table>
						
					
					
					</fieldset>
					
					
					
					
					
					
				
				
						
						

				
					
		<?php 	} ?>
	
	<?php endif ?>
	</td>

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