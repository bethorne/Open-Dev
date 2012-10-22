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
					$insert = "SELECT * FROM tbk_documentocompra WHERE id_docc LIKE '".trim($codigofactura)."%' AND tipo_docc = 3 AND estado_docc  = 1 ORDER BY id_doc DESC";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_documento WHERE rut_cli LIKE '".trim($nrut)."' AND tipo_docc = 3 AND estado_docc  = 1 ORDER BY id_docDESC";
					break;
					
		

			case '3':
					$insert = "SELECT * FROM tbk_doc WHERE SUBSTR(fecha_docc,4,2) LIKE '".trim($marca)."%' AND tipo_doc = 3 AND estado_docc  = 1 ORDER BY id_doc DESC";
					break;
			
			
			case '9':
					//echo "almacenando pago de cuotas";
				
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

			
			}
	
	}

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>


<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'>FACTURA DE COMPRA</label>
	<br/>
	<label id='comentariogris'> Complete uno de los campos para realizar la b&uacute;squeda. Si desea listar todas las facturas, haga click en 'buscar c&oacute;digo' con el campo vac&iacute;o.</label>
	<hr/>
	<p/>


	<form name='boleta' action='facturascompra.php?cb=<?=$cb?>' method ='POST'>
	

	<table border='0'>
	<tr>
	<td width='400' valign='top'>
	
			<label id='subtitulo'> Buscar y seleccionar factura </label>
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
							$fechafact = $row[3];
							$total  = $row[4];
							$estado = $row[5];
							$codigodoc = $row[6];
							
							$proceso ="";
							SWITCH($estado)
							{
								case '1' : $proceso = "P"; break;
								case '0' : $proceso = "C"; break;
							
							
							
							}
							
							echo "<tr><td id='data' width='20'><a id='etiquetazul' href='facturascompra.php?cb=".$facturaID."'><font size='4'>".$codigodoc."</font></a></td><td id='data'>".$clienteID."</td><td id='data'>".$fechafact."</td><td id='data'>$ ".$total."</td><td id='data'>".$proceso."</td></tr>";
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
		
			<label id='subtitulo'> Factura N° <?= $codigodoc ?></label>
			<p/>
			
			<fieldset>
			
			<table border='0' cellspacing='5' cellpadding='5' width='400'>
			<tr>
			<td  id='data'>
				<label id='comentario'><font size='4'> <i> <?=$sfecha?></i></font></label>
			</td>
			<td  id='data' align='right' colspan='3'>
				 <label id='comentario'> <font size='4'>N°<br/><?=$codigodoc?></font></label>
			</td>
			</tr>
			
			<tr><td height='25' colspan='5'><hr/></td></tr>
					
					
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
		
			
			<tr><td id='etiqueta'> Producto</td><td id='etiqueta'> Cant.</td><td id='etiqueta' width='30' >  $</td></tr>
					
			<?php
			
				$find = "SELECT * FROM tbk_docpro WHERE  id_doc = ".$scodigo;
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
					
						$subtotal = $subtotal + ($fcantidad * $fvalorunitario);
				?>	
					
					<tr>
					<td id='data' width='180'>
						<label id='comentario'><?=nombreprod($fcbarra)?></label>
					</td>

					<td id='data' align='right' width='10'>
						<label id='comentario'><?=$fcantidad?></label>
					</td>
					<td id='data' align='right' >
						<label id='comentario'><?=$fvalorunitario?></label>
					</td>
					</tr>
					
				<?php
						$j++;
						
					}
					
					$subtotaliva = round((($subtotal * $iva)/100),0);
				?>
				

					<tr>
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
				
					<td >
						<label id='comentario'>IVA </label>
					</td>
					<td align='right' >
						<label id='comentario'>$ <?=$subtotaliva?></label>
					</td>
					</tr>

					<tr>
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
					
		<?php 	} 
			
				$find = "SELECT * FROM tbk_pago WHERE  id_fact = ".$scodigo;
				if ($resst = mysql_query($find, $conn))
				{
				
					$ficha3 = mysql_fetch_row($resst);
					
					$f3cliente 		= $ficha3[1];
					
					$f3tipodepago 	= $ficha3[3];
					$f3cuotas 		= $ficha3[4];
					$f3valorcuota 	= $ficha3[5];
					$f3diadepago    = $ficha3[6];
					$f3fecha 		= $ficha3[7];
					
					$f3total		= $f3cuotas * $f3valorcuota ;
					
		?>	
	</td>
	<td valign='top'>
					<p/>
					<label id='subtitulo'> Forma de Pago </label>
					<p/>
			
					<fieldset>
					
					<table border='0' cellspacing='5' cellpadding='5' width='400' >
					
				
					<tr>
					<td id='etiqueta' width='100'>
						Total Factura
					</td>

					<td id='data' align='right' colspan='2' >
						<label id='comentario'> $ <?=$f3total?></label>
					</td>
					</tr>
					
					<tr>
					<td id='data'>
						Cuotas
					</td>
					<td id='data'>
						<label id='comentario'> <?=$f3cuotas?></label>
					</td>
					<td id='data'align='right'>
						<label id='comentario'>$ <?=$f3valorcuota?></label><input type='hidden' name='cuota1' value='<?=$f3valorcuota?>'>
					</td>
					</tr>
					
					<tr>
					<td id='data'>
						Primer Pago
					</td>
					<td id='data'>
						<label id='comentario'> <?=$f3diadepago?></label>
					</td>

					</tr>
					
					</table>
					
					</fieldset>
					
					
					
					<!-- Cuotas pagadas -->
					
					
					
					<p/>
					<label id='subtitulo'> Cuotas Programadas</label>
					<p/>
					
					<fieldset>
					
						<table border='0' cellspacing='5' cellpadding='5' width='400'>
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
											
											
											$vectorcuotas[($d+1)] = $vectorcuotas[$d]+ $campo9;
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
									echo "<td id='".$celda."'>".$campo5." </td><td id='data'>".$codigodoc." </td> <td id='data'>".($d+1)."</td>";
									echo "<td id='data' align='right'> $ ".$campo9;
									
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
						</table>
						
					
					
					</fieldset>
					
					
										<!-- Monto adeudado -->
					
					
					
					<p/>
					<label id='subtitulo'> Monto Adeudado </label>
					<p/>
			
					<?php
						
							// $cuotaspagadas;
							// $f3valorcuota
							// $f3cuotas
					
							$pagadohastaahora	= $montocuotaspagadas;
							$cuotasrestantes 	= $f3cuotas - $cuotaspagadas;
							$montoadeudado 		= $montototalcuotas -  $pagadohastaahora;
					
					
					
					?>
					<fieldset>
					
					<table border='0' cellspacing='5' cellpadding='5' width='400' >

					<?php
					
							
							echo "		<tr>";
							echo "		<td id='etiqueta' width='100'> Cuota adeudadas  </td>";
							echo "		<td id='data' align='right'>".$cuotasrestantes." </td>";
							echo "		<td id='data' align='right'><label id='comentario'><font size='4'>$".$montoadeudado."</font></label> </td>";
							echo "		</tr>";

							
					?>
					
					<!--
					<tr>
					<td id='etiqueta'>
						Cuotas Faltantes
					</td>
					<td id='data'>
						<label id='comentario'> <?=$cuotasrestantes?></label>
					</td>
					<td id='data'align='right'>
						<label class='num'>$ <?=$montoadeudado?></label>
					</td>
					</tr>
					-->
					</table>
					
					</fieldset>
					
						
					<p/>
					<label id='subtitulo'> Gu&iacute;as Asociadas </label>
					<p/>
					
					<fieldset>
					
					<table border='0' cellspacing='5' cellpadding='5' width='400' >
					<tr>
					<?php
						
						
						
							$find = "SELECT * FROM tbk_guia WHERE  id_fact = ".$cb."  AND estado  = 1 ORDER BY id_guia DESC";
							//echo "<p>".$find."<p/>";
							
							
							$cuotaspagadas =0;
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
									
									
									echo "<tr>";
									echo "<td id='etiqueta' width='150'>".$campo2." </td><td id='data'>".$campo3." </td><td id='data' align='center'> <a id='etiquetazul' href='guias.php?cb=".$campo2."'>Ver</a></td> ";
							
									echo "</tr>";
									$d++;
								}
							
							}							
							else
								
								{
									echo "<label id='comentario' >Este cliente no registra cuotas pagadas para esta factura</label>";
								}
							
							
						?>
						</table>
				
					
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