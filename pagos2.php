<?php include("header.php")?>


<?php



function limpiar($string )
{

	$string 	= str_replace("\'","",$string); 
	
	return $string;
}



	$cb 		= $_GET['ID'];
		
	$see 		= $_POST['look'];
	
	$cpaterno		= $_POST['cpaterno'];
	$erut 			= $_POST['erut'];
	

	
	
	//echo "BUSCANDO=".$insert;

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
	$doc			= $_POST['doc'];
	
	$abonoparte1 	= $_POST['abonoparte1'];
	$abonoparte2	= $_POST['abonoparte2'];
	$abonoparte3	= $_POST['abonoparte3'];
	$abonoparte4	= $_POST['abonoparte4'];
	$abonoparte5	= $_POST['abonoparte5'];
	$abonoparte6	= $_POST['abonoparte6'];
	
	$saldocredito   = $_POST['saldocredito'];
	$abonototal		= $_POST['abonototal'];
	
	$pago1			= $_POST['pago1'];			
	$pago2			= $_POST['pago2'];
	$pago3			= $_POST['pago3'];
	
	$interes1		= $_POST['interes1'];			
	$interes2		= $_POST['interes2'];
	$interes3		= $_POST['interes3'];
	
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
					$insert = "SELECT * FROM tbk_cliente WHERE rut_cli LIKE '".trim($erut)."%'";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_cliente WHERE nombre_cli LIKE '%".trim($cpaterno)."%' ORDER BY nombre_cli ASC";
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
					
					echo "<pre>";
					print_r($doc);
					echo "</pre>";
					*/
					
					$cuotaspagables = 0;
					$j=0;
					
				   // echo "<p/>ELEMENTOS DEL VECTOR CUOTA =".Count($vc);
					$vectorq = Count($vc);

					
					WHILE (($vc[$j] >= 0) AND ($j <= $vectorq))
					{
							$vcuota = $vc[$j];
							// echo "<br> ".$j." -> ".$vcuota." < ".$abonototal;
							
							
							if ($vcuota <= $abonototal)  
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
							echo "<h1> Factura pagada J:".$doc[($j-2)]."</h1>";
							$facturacancelada = 1;
							$saldofinal  = $abonototal - $vc[($j-2)];
					
						}
					//echo "<p/>CUOTAS PAGABLES =".$cuotaspagables;
					// echo "<p/> SALDO ABONO = ".$saldoabono;
					 
					
					$q=0;
					
					for ($q =0; $q <  $cuotaspagables; $q++)
					{
					
						$pagofactura = $doc[$q];
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
						
						
						
						//echo "<h1> FACTURA :".$pagofactura."</h1>";
						
						// busca cuotas impagas de factura
						// si no existen.. la da por cancelada completamente
						$searchimpagas = "SELECT * FROM tbk_pago_cuota WHERE id_fact=".$pagofactura." AND estado_pc=0";
						//echo $searchimpagas;
								
						$resimpagas = mysql_query($searchimpagas, $conn);
								
						$r=0;
						WHILE ($fichaimpagas = mysql_fetch_row($resimpagas))
						{
									
									$r++;
						}
								 
						//echo "<p/>ERRE =".$r;
								 
						if($r == 0)
						{
							// actualizar factura cancelada	
							$update = "UPDATE tbk_documento SET estado_doc = 0  WHERE id_doc ='".$pagofactura."'";
							//echo "<p>".$update;
							$ressaldo = mysql_query($update, $conn);
							
							
								
								
						} 
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
									$insertabono.= "'".$pago1."',";
									$insertabono.= "'".$interes1."',";
									$insertabono.= "'".$bancocheque1."',";
									$insertabono.= "'".$abonoparte1."',";
									$insertabono.= "'".$cheque1."',";
									$insertabono.= "'',";
									$insertabono.= "''";
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
									$insertabono.= "'".$pago2."',";
									$insertabono.= "'".$interes2."',";
									$insertabono.= "'".$bancocheque2."',";
									$insertabono.= "'".$abonoparte2."',";
									$insertabono.= "'".$cheque2."',";
									$insertabono.= "'',";
									$insertabono.= "''";
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
									$insertabono.= "'".$pago3."',";
									$insertabono.= "'".$interes3."',";
									$insertabono.= "'".$bancocheque3."',";
									$insertabono.= "'".$abonoparte3."',";
									$insertabono.= "'".$cheque3."',";
									$insertabono.= "'',";
									$insertabono.= "''";
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
									$insertabono.= "'',";
									$insertabono.= "'".$bancocheque4."',";
									$insertabono.= "'".$abonoparte4."',";
									$insertabono.= "'".$cheque4."',";
									$insertabono.= "'',";
									$insertabono.= "''";
							
									$insertabono.= ")";
									
									//echo "<p/>".$insert;
									if($resulta = mysql_query($insertabono, $conn)) echo "<br> abono4";
								}
								
								if ($abonoparte5 > 0 )
								{
									$insertabono ="";
									$insertabono = "INSERT INTO tbk_abono VALUES ('',";
									$insertabono.= "'".$pagocliente."',";
									$insertabono.= "'".$pagofactura."',";
									$insertabono.= "'".date('d-m-Y H:i')."',";
									$insertabono.= "'2',";
									$insertabono.= "'',";
									$insertabono.= "'',";
									$insertabono.= "'',";
									$insertabono.= "'".$abonoparte5."',";
									$insertabono.= "'',";
									$insertabono.= "'',";
									$insertabono.= "''";
									$insertabono.= ")";
									
									//echo "<p/>".$insert;
									if($resulta = mysql_query($insertabono, $conn)) 
									{
									
										// rebajar credito
										$resto = $saldocredito - $abonoparte5;
										
										$estadocredito = 1;
										if ($resto <= 0)  { $estadocredito = 0; }
										
										$updatecred = "UPDATE tbk_credito SET saldo_cre = ".$resto.", fecha_actualizacion_cre ='".date('d-m-Y H:i')."'  WHERE rut_cli = '".$pagocliente."' and estado_cre = ".$estadocredito;
										//echo "<p>".$updatecred;
										if ($rescred = mysql_query($updatecred, $conn)) echo "";
										
									}
								}
								$saldoabonototal = $abonototal - $vc[($j-1)];	
								
								//echo "<p> SALDO ABONO TOTAL ".$saldoabonototal;
								
															//echo " <p/>Abono  - Vcuota = ".($abonototal - $vcuota);
								
								
								$insertsaldo ="INSERT INTO tbk_saldo VALUES (";
								$insertsaldo.="'".$pagocliente."',";
								$insertsaldo.="'".$saldoabonototal."'";
								$insertsaldo.=")";
								
								//echo $insertsaldo;
								
								if ($ressaldo = mysql_query($insertsaldo, $conn)) 
								{
									echo "<img src='images/ok.jpg'>";
								}
								else
									{
											$saldoactualizar = $saldoactual + $abonototal;
											$update = "UPDATE tbk_saldo SET saldo_sa = ".$saldoabonototal." WHERE rut_cli ='".$pagocliente."'";
											//echo "<p>".$update;
											$ressaldo = mysql_query($update, $conn);
											
										
									}
								
								
					
							
							
														
								
								
								
								

					
					
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
		

			
			/*
			echo "<H1> FACTURA CANCELADA </h1>";			
			// actualizar factura cancelada	
			$update = "UPDATE tbk_documento SET estado_doc = 0  WHERE id_doc ='".$pagocliente."'";
			//echo "<p>".$update;
			$ressaldo = mysql_query($update, $conn);
			
			
			
			//actualizar factura
			
			echo " <h2> Saldo </h2>".$saldofinal;
			$update = "UPDATE tbk_saldo SET saldo_sa = ".$saldofinal." WHERE rut_cli ='".$pagocliente."'";
			//echo "<p>".$update;
			$ressaldo = mysql_query($update, $conn);
			*/				
		
								
								
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
		

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>




<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'>PAGO MEDIANTE ABONO </label>
	<br/>
	<label id='comentariogris'> Ingrese uno de los campos para buscar un Cliente. Para listar todos los clientes presione buscar con el campo 'nombre' vac&iacute;o.</label>
	<hr/>
	<p/>
	

	<form name='boleta' action='pagos2.php?ID=<?=$cb?>' method ='POST'>
	

	<table border='0'>
	<tr>
	<td width='800' valign='top'>
	
			<label id='subtitulo'> Resultado B&uacute;queda </label>
				<p/>
				
				<table border='0' cellspacing='5' cellpadding='5' width='430' background='images/logos/fondo_menu.jpg'>
				<tr>
				<td>
					<label id='comentario'>C&oacute;digo Factura</label>
				</td>
				<td valign='top' align='right' width='100'>
						<input type='text' name='erut' value='<?=limpiar($erut)?>' size='14' >
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='boleta.look.value=1; np.submit()'>
				</td>
				</tr>
				
				<tr>
				<td>
					<label id='comentario'>Cliente (RUT)</label>
				</td>
				<td valign='top'  width='100' align='right'>
						<input type='text' name='cpaterno' value='<?=$cpaterno?>'  size='14'>						
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='boleta.look.value=2; np.submit()'>
				</td>
				<td />
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
								$snombre = $row[1];
								$srut = $row[0];
								$spaterno  = $row[2];
								$smaterno = $row[3];
								
								
								echo "<tr><td id='data' width='20'><a id='menualternativo' href='pagos2.php?ID=".$srut."'><img src='images/flechita.gif' border='0'></a></td><td id='data' width='100'><label id='menualternativo' >".$srut."</label></td><td id='data'>".$snombre."</td><td id='data'>".$spaterno." ".substr($smaterno,0,1)."</td></tr>";
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
			
			
	</td>
	</tr>
	
	<tr>
	<td width='800' valign='top'>
	<?php if (!empty($cb)) :?>
	
			<?php
			
				//buscando datos de cliente
				
				$searchcli = "SELECT * FROM tbk_cliente WHERE rut_cli ='".$cb."'";
				$res = mysql_query($searchcli, $conn);
				
		
				$fichaCli = mysql_fetch_row($res);
				
			
				
				// averiguar saldo de cliente
				$searchsaldo = " SELECT * FROM tbk_saldo WHERE rut_cli ='".$cb ."'";
				$ressaldo = mysql_query($searchsaldo,$conn);
					
				$fichasaldo = mysql_fetch_row($ressaldo);
				$saldoactualizar =  $fichasaldo[1];
			
			
			
			?>
			<label id='subtitulo'> Ficha Usuario </label>
			<p/>
			
			<fieldset>
			
			<table border='0' cellspacing='5' cellpadding='5' width='700'>
			<tr>
			<td id='etiqueta'>
				Nombre
			</td>
			<td id='data'>
				<?=$fichaCli[1]." ".$fichaCli[2]." ".$fichaCli[3]?>
			</td>
			</tr>
			
			</table>
			</fieldset>
		
			<p/>
					<label id='subtitulo'> Cuotas Programadas</label>
					<table border='0' cellspacing='5' cellpadding='5'>
					<tr>
					<td id='etiqueta'> Ver Abonos del Cliente </td>
					<td id='data'>
							<a  href="verabono.php?ID=<?=$cb?>" target="popup"  onClick="window.open(this.href, this.target, 'width=800,height=600'); return false;"><img src='images/binoculares.gif' border='0'></a>  
					</td>
					</tr>
					</table>
					<p/>
					
					<fieldset>
					
						<table border='0' cellspacing='5' cellpadding='5' width='800'>
						
						<th id='etiqueta' width='20'>  Documento</th>
						
						<th id='etiqueta' width='100'> Fecha Vencimiento </th>
					
					
						<th id='etiqueta' width='100'> Valor Cuota</th>
						<th id='etiqueta' width='100'> Valor Acumulativo</th>
						<th id='etiqueta' width='100'> Fecha de Pago  </th>
						
						
						</tr>
						<?php
						
						
						
							$find = "SELECT * FROM tbk_pago_cuota WHERE  rut_cli LIKE '".$cb."' and estado_pc = 0  ORDER BY SUBSTR(vencimiento_pc,7,4), SUBSTR(vencimiento_pc,4,2) ASC";
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
									
									echo "<td id='data' align='center'> <a  id='menu' href='verfactura.php?cb=".$campo1."' target='popup'  onClick='window.open(this.href, this.target, \"width=500,height=600\"); return false;'><img src='images/binoculares.gif' border='0'></a>  </td>";
									echo "<input type='hidden' name='doc[]' value='".$campo1."'>";
									echo "<td id='".$celda."'>".$campo5." </td>";
									//echo "<td id='data'>".($d+1)."</td>";
									
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
					
					
					
					<!-- monto adeudado  -->
					
					<p/>
					<label id='subtitulo'>Forma de Pago </label>
					<p/>
			
					<fieldset>
					<table border='0 cellspacing='2' cellpadding='2' width='800'>

						
						<tr>
						<td align='right'>
							<table border='0'  cellspacing='2' cellpadding='2' width='800'>
							<tr>
								<td id='etiqueta'>FORMA DE PAGO</td>
								<td id='etiqueta'>TIPO DE PAGO</td>
								<td id='etiqueta'> </td>
								<td id='etiqueta'>BANCO </td>
								<td id='etiqueta'>NUMERO DEL DOCUMENTO</td>
								<td id='etiqueta' />
								<td id='etiqueta'>MONTO</td>
							
							</tr>
							<tr>
							<td id='etiqueta'>
								1.- Efectivo
							</td>
							<td  id='etiqueta'>
								<SELECT name='pago1'>
									
									<option value='1'>Efectivo</option>
									<option value='2'>RedCompra</option>
									<option value='3'>Cheque</option>
									<option value='4'>Transf. Electr&oacute;nica</option>
								
																	
								</SELECT>
								
							</td>
							<td>
								<!--
								<SELECT name='interes1'>
									<option value='0'>0%</option>
									<option value='1'>1%</option>
									<option value='2'>2%</option>
									<option value='3'>3%</option>
									<option value='4'>4%</option>
									<option value='5'>5%</option>
									<option value='6'>6%</option>
									<option value='7'>7%</option>
									<option value='8'>8%</option>
									<option value='9'>9%</option>
									<option value='10'>10%</option>
									<option value='11'>11%</option>
									<option value='12'>12%</option>
									<option value='13'>13%</option>
									<option value='14'>14%</option>
									<option value='15'>15%</option>
								</SELECT>
								-->
							</td>
							<td id='data' width='200'>
							<SELECT name='bancocheque1'> 
								<option value=0 />
								<option value=1>ABN AMRO</option>
								<option value=2>Atlas - Citibank</option>
								<option value=3>BancaFacil - Sitio de educación bancaria</option>
								<option value=4>Banco Bice</option>
								<option value=5>Banco Central de Chile</option>
								<option value=6>Banco de Chile</option>
								<option value=7>Banco de Crédito e Inversiones</option>
								<option value=8>Banco del Desarrollo</option>
								<option value=9>Banco del Desarrollo - Asesoría Financiera</option>
								<option value=10>Banco Edwards</option>
								<option value=11>Banco Falabella</option>
								<option value=12>Banco Internacional</option>
								<option value=13>Banco Nova</option>
								<option value=14>Banco Penta</option>
								<option value=15>Banco Santander Santiago</option>
								<option value=16>Banco Security</option>
								<option value=17>BancoEstado</option>
								<option value=18>BBVA</option>
								<option value=19>Citibank N.A. Chile</option>
								<option value=20>Corpbanca</option>
								<option value=21>Credichile</option>
								<option value=22>Credit Suisse Consultas y Asesorias Ltda</option>
								<option value=23>Deutsche Bank</option>
								<option value=24>ING Bank N.V.</option>
								<option value=25>Redbanc</option>
								<option value=26>Santander Banefe</option>
								<option value=27>Scotiabank Sud Americano</option>
								<option value=28>Scotiabank Sud Americano</option>
								<option value=29>UBS AG in Santiago de Chile</option>
							</SELECT>
							</td>
							<td  id='data'>
								<input type='text' name='cheque1' value=''  size='15'>  
							</td>
							<td id='etiqueta'> $ </td>
							<td  id='data'>
								<input type='text' name='abonoparte1' value='0'  size='15' >  
							</td>
							</tr>
							
							<tr>
							<td id='etiqueta'>
								2.-  Efectivo
							</td>
							<td  id='etiqueta'>
								<SELECT name='pago2'>
									
									<option value='1'>Efectivo</option>
									<option value='2'>RedCompra</option>
									<option value='3'>Cheque</option>
									<option value='4'>Transf. Electr&oacute;nica</option>
									
																	
								</SELECT>
								
							</td>
							<td>
								<!--
								<SELECT name='interes2'>
									<option value='0'>0%</option>
									<option value='1'>1%</option>
									<option value='2'>2%</option>
									<option value='3'>3%</option>
									<option value='4'>4%</option>
									<option value='5'>5%</option>
									<option value='6'>6%</option>
									<option value='7'>7%</option>
									<option value='8'>8%</option>
									<option value='9'>9%</option>
									<option value='10'>10%</option>
									<option value='11'>11%</option>
									<option value='12'>12%</option>
									<option value='13'>13%</option>
									<option value='14'>14%</option>
									<option value='15'>15%</option>
								</SELECT>
								-->
							</td>
							
							<td id='data'>
							<SELECT name='bancocheque2'> 
								<option value=0 />
								<option value=1>ABN AMRO</option>
								<option value=2>Atlas - Citibank</option>
								<option value=3>BancaFacil - Sitio de educación bancaria</option>
								<option value=4>Banco Bice</option>
								<option value=5>Banco Central de Chile</option>
								<option value=6>Banco de Chile</option>
								<option value=7>Banco de Crédito e Inversiones</option>
								<option value=8>Banco del Desarrollo</option>
								<option value=9>Banco del Desarrollo - Asesoría Financiera</option>
								<option value=10>Banco Edwards</option>
								<option value=11>Banco Falabella</option>
								<option value=12>Banco Internacional</option>
								<option value=13>Banco Nova</option>
								<option value=14>Banco Penta</option>
								<option value=15>Banco Santander Santiago</option>
								<option value=16>Banco Security</option>
								<option value=17>BancoEstado</option>
								<option value=18>BBVA</option>
								<option value=19>Citibank N.A. Chile</option>
								<option value=20>Corpbanca</option>
								<option value=21>Credichile</option>
								<option value=22>Credit Suisse Consultas y Asesorias Ltda</option>
								<option value=23>Deutsche Bank</option>
								<option value=24>ING Bank N.V.</option>
								<option value=25>Redbanc</option>
								<option value=26>Santander Banefe</option>
								<option value=27>Scotiabank Sud Americano</option>
								<option value=28>Scotiabank Sud Americano</option>
								<option value=29>UBS AG in Santiago de Chile</option>
							</SELECT>
							</td>
							<td id='data' >
								<input type='text' name='cheque2' value=''  size='15'>  
							</td>
							<td id='etiqueta'> $ </td>
							<td id='data'>
								<input type='text' name='abonoparte2' value='0'  size='15' >  
							</td>
							</tr>
							
							
							<tr>
							<td id='etiqueta'>
								3.-  Efectivo
							</td>
							<td  id='etiqueta'>
								<SELECT name='pago3'>
									
									<option value='1'>Efectivo</option>
									<option value='2'>RedCompra</option>
									<option value='3'>Cheque</option>
									<option value='4'>Transf. Electr&oacute;nica</option>
									
																	
								</SELECT>
								
							</td>
							<td>
								<!--
								<SELECT name='interes3'>
									<option value='0'>0%</option>
									<option value='1'>1%</option>
									<option value='2'>2%</option>
									<option value='3'>3%</option>
									<option value='4'>4%</option>
									<option value='5'>5%</option>
									<option value='6'>6%</option>
									<option value='7'>7%</option>
									<option value='8'>8%</option>
									<option value='9'>9%</option>
									<option value='10'>10%</option>
									<option value='11'>11%</option>
									<option value='12'>12%</option>
									<option value='13'>13%</option>
									<option value='14'>14%</option>
									<option value='15'>15%</option>
								</SELECT>
								-->
							</td>
							<td id='data' >
							<SELECT name='bancocheque3'> 
								<option value=0 />
								<option value=1>ABN AMRO</option>
								<option value=2>Atlas - Citibank</option>
								<option value=3>BancaFacil - Sitio de educación bancaria</option>
								<option value=4>Banco Bice</option>
								<option value=5>Banco Central de Chile</option>
								<option value=6>Banco de Chile</option>
								<option value=7>Banco de Crédito e Inversiones</option>
								<option value=8>Banco del Desarrollo</option>
								<option value=9>Banco del Desarrollo - Asesoría Financiera</option>
								<option value=10>Banco Edwards</option>
								<option value=11>Banco Falabella</option>
								<option value=12>Banco Internacional</option>
								<option value=13>Banco Nova</option>
								<option value=14>Banco Penta</option>
								<option value=15>Banco Santander Santiago</option>
								<option value=16>Banco Security</option>
								<option value=17>BancoEstado</option>
								<option value=18>BBVA</option>
								<option value=19>Citibank N.A. Chile</option>
								<option value=20>Corpbanca</option>
								<option value=21>Credichile</option>
								<option value=22>Credit Suisse Consultas y Asesorias Ltda</option>
								<option value=23>Deutsche Bank</option>
								<option value=24>ING Bank N.V.</option>
								<option value=25>Redbanc</option>
								<option value=26>Santander Banefe</option>
								<option value=27>Scotiabank Sud Americano</option>
								<option value=28>Scotiabank Sud Americano</option>
								<option value=29>UBS AG in Santiago de Chile</option>
							</SELECT>
							</td>
							<td id='data'>
								<input type='text' name='cheque3' value=''  size='15'>  
							</td>
							<td id='etiqueta'> $ </td>
							<td id='data'>
								<input type='text' name='abonoparte3' value='0'  size='15' >  
							</td>
							</tr>
							
							
							<tr>
							<td id='etiqueta'> Tarjeta de Cr&eacute;dito</td>
							<td id='etiqueta'/>	
							<td id='etiqueta'/>	
							<td id='data'>
							<SELECT name='bancocheque4'> 
								<option value=0 />
								<option value=1>ABN AMRO</option>
								<option value=2>Atlas - Citibank</option>
								<option value=3>BancaFacil - Sitio de educación bancaria</option>
								<option value=4>Banco Bice</option>
								<option value=5>Banco Central de Chile</option>
								<option value=6>Banco de Chile</option>
								<option value=7>Banco de Crédito e Inversiones</option>
								<option value=8>Banco del Desarrollo</option>
								<option value=9>Banco del Desarrollo - Asesoría Financiera</option>
								<option value=10>Banco Edwards</option>
								<option value=11>Banco Falabella</option>
								<option value=12>Banco Internacional</option>
								<option value=13>Banco Nova</option>
								<option value=14>Banco Penta</option>
								<option value=15>Banco Santander Santiago</option>
								<option value=16>Banco Security</option>
								<option value=17>BancoEstado</option>
								<option value=18>BBVA</option>
								<option value=19>Citibank N.A. Chile</option>
								<option value=20>Corpbanca</option>
								<option value=21>Credichile</option>
								<option value=22>Credit Suisse Consultas y Asesorias Ltda</option>
								<option value=23>Deutsche Bank</option>
								<option value=24>ING Bank N.V.</option>
								<option value=25>Redbanc</option>
								<option value=26>Santander Banefe</option>
								<option value=27>Scotiabank Sud Americano</option>
								<option value=28>Scotiabank Sud Americano</option>
								<option value=29>UBS AG in Santiago de Chile</option>
							</SELECT>
							</td>
							<td id='data'>
								<input type='text' name='cheque4' value=''  size='15'>  
							</td>
							<td id='etiqueta'> $ </td>
							<td id='data'>
								<input type='text' name='abonoparte4' value='0'  size='15' >  
							</td>
							
							
							</tr>
													
							
							<tr>
							<td id='etiqueta' colspan ='2'>
								Cr&eacute;dito Cliente
							</td>
							<td id='etiqueta'/>	
							
					
							
							<td  id='etiqueta'>
								Disponible
							</td>
							<td  id='data'  >
							
								
							
							<?php
							
								
								$insert = "SELECT * FROM tbk_credito WHERE rut_cli LIKE '".trim($f3cliente)."'  AND estado_cre = 1 ORDER BY SUBSTR(fecha_cre,7,4), SUBSTR(fecha_cre, 4,2)  DESC";	
								//echo $insert;
								
								$totalcredito  =0 ;
								if($respro = mysql_query($insert,$conn))
									{	
										
										$j=0;
										WHILE ($ficha = mysql_fetch_row($respro))
										{
											
											
											
											$campo1 		= $ficha[0];
											$campo2 		= $ficha[1];
											$campo3 		= $ficha[2];
											$campo4 		= $ficha[3];
											$campo5 		= $ficha[4];
											$campo6 		= $ficha[5];
											$campo7 		= $ficha[6];
				
											if ($campo7 == 1 )
											{
											
												$totalcredito= $totalcredito + $campo3;
											
											}
											/*
											$searchcodigo = "SELECT codigo_doc FROM tbk_documento WHERE id_doc = ".$campo3;
											$rescodigo = mysql_query($searchcodigo, $conn);
											
											$fichadoc = mysql_fetch_row($rescodigo);
											
											$codigo_doc = $fichadoc[0];
											*/
											
										
											
									
											
											$j++;
										
										}
										
									}
								echo "$ ".$totalcredito;
								echo "<input type='hidden' name='saldocredito' value='".$totalcredito."'  size='10' >";  
							?>
								
							</td>
						
							
							<td  id='etiqueta'>$</td>
							<td  id='data'>
								<input type='text' name='abonoparte5' value='0'  size='15' readonly='readonly'>  
							</td>
							</tr>
							
							
							
							<tr>
							<td id='etiqueta' colspan ='2'>
								Saldo  Abonos Anteriores
							</td>

							
							<td id='etiqueta'/>	
							<td id='etiqueta'/>	
							<td id='etiqueta'/>	

							
							<td  id='etiqueta'>$</td>
							<td id='data'>
								<input type='text' name='abonoparte6' value='<?=$saldoactualizar ?>'  size='15' readonly='readonly'>  
							</td>
							</tr>
							
							</table>
						</td>
						</tr>
						
						
						
						
						<tr>
						
						<td align='right'>
							
							<table border='0' cellspacing='3' cellpadding='3'>
							<tr>
							<td> 
								<input type='button' value='CALCULAR TOTAL'  onClick='totalabono()'>
							</td>
							<td>
								<input type='text' name='abonototal' value='0'  >
							</td>
							</tr>
							</table>
							
						</td>
						</tr>

						
						
					</table>
					</fieldset>	
						
						
						
					<table border='0' cellspacing='5' cellpadding='5' width='850'>
						<tr>
						<td />
						<td align='right'>
								<table border='0'>
								<tr>
								<td>
									<input type='hidden' name='FUID' value='<?=$cb?>'> <input type='hidden' name='FFECHA' value='<?=date('d-m-Y H:i')?>'>
									<input type='Reset' value='Limpiar Formulario'>
									<input type='Submit' value='Aceptar Pago' onClick='boleta.look.value=9'>
									
								</td>
								</tr>
								</table>
								
						</td>
						</tr>
						
					</table>
					
					
				
				<!--  Forma de pago -->
					
	<?php endif ?>
	
	</td>

	</tr>
	</table>
	

	<p/>
	
	<table border='0' width='800'>
	<tr>
	<td>
	
			<table border='0' width='400'>
			<tr>
			<td align='right'>
					<table border='0'>
					<tr>
					<td>
						
						<input type='text' name='look' value=''>
					
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