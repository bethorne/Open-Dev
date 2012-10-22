<?php include("header.php") ?>

<?php
	
	include("functions.php");
	
	$save = $_POST['save'];
	
	$fecha 			= $_POST['fechacaja'];
	$cajachica 		= $_POST['cajachica'];
	$efectivo 		= $_POST['efectivo'];
	$guiasdeventa	= $_POST['guiasdeventa'];
	$gastos 		= $_POST['gastos'];
	$totalcaja		= $_POST['totalcaja'];
	$obs			= $_POST['obs'];
	
	
	if ($save == 1)
	{
		$fechakdx = date('Y-m-d');
		$insert = "INSERT INTO tbk_cajadiaria VALUES(";
		$insert .="'".$fechakdx."',";
		$insert .="'".$cajachica."',";
		$insert .="'".$efectivo."',";
		$insert .="'".$guiasdeventa."',";
		$insert .="'".$gastos."',";
		$insert .="'".$totalcaja."',";
		$insert .="'".$obs."',";
		$insert .="'".$rutUsuario."'";
		$insert .=")";
		
		//echo "INSERT=".$insert;
		
		if ($res = mysql_query($insert, $conn))
		{
		
						
				$tipomensaje = 1;
				$texto ="La Caja Diaria ha sido registrada exitosamente.";
				include("mensaje.php");
		
		}
		else
		{
				$fechakdx = date('Y-m-d');
				$insert = "UPDATE  tbk_cajadiaria  SET ";
				
				$insert .="cajachica_ca = '".$cajachica."',";
				$insert .="efectivo_ca = '".$efectivo."',";
				$insert .="guiasventa_ca = '".$guiasdeventa."',";
				$insert .="gastos_ca= '".$gastos."',";
				$insert .="total_ca= '".$totalcaja."',";
				$insert .="obs_ca= '".$obs."',";
				$insert .="rut_bk= '".$rutUsuario."'";
				
				$insert .="  WHERE fecha_ca='".$fechakdx."'";
				//echo "INSERT=".$insert;
				$res= mysql_query($insert,$conn);
				
				$tipomensaje = 1;
				$texto ="La Caja Diaria ha sido registrada exitosamente.";
				include("mensaje.php");
				
		
		}
	}
	$fechahoy = date(d."-".m."-".Y); 
?>


<form name='caja' action='cajadiaria.php' method='POST'>
<table border='0' width='800'>
<tr>
<td >
	
	<label id='subtitulo'>Arqueo Diario de Caja </label>
	<br/>
	<hr/>
	
	<br/>
	<p/>
	
	<label id='subtitulo'>Ingresos de  Caja </label>
	<br/>
	<label id='comentariogris'>Fecha: <?php echo"".$fechahoy."" ?></label>
    <br/>
    <?php
	include('conector/conector.php');
 $insert = "SELECT COUNT(  `fecha_doc` ) 
FROM  `tbk_documento` 
WHERE  `fecha_doc` = DATE_FORMAT( NOW( ) ,  '%d-%m-%Y' )";	
			 
					$resultaCli = mysql_query($insert, $conn);
					$i=0;
					While ($row = mysql_fetch_row($resultaCli))
						{
							$frut 		= $row[0];
							 
							$i++;
						}
	?>
	<a href="lista_vales.php" target='popup' onClick="window.open(this.href, this.target, 'width=1000,height=400'); return false;">
	<label id='subtitulo'>Cantidad de Vales del Dia : <?php echo"".$frut.""?></label>
	</a>
<p/>

	<center>	
	<table border='0' cellspacing='5' cellpadding='4' width='700'>
	<tr>
		<th id='etiqueta'> Descripci&oacute;n</th>
		<th id='etiqueta'> Efectivo</th>
		<th id='etiqueta'> RedCompra</th>
		<th id='etiqueta'> Cheque</th>
		<th id='etiqueta'> Transferencias</th>
		<th id='etiqueta'> Cr&eacute;dito</th>
		<th id='etiqueta'> Cr&eacute;dito Cliente</th>
		
		<th id='etiqueta'> Totales</th>
	</tr>
		
	<?php
	
		$abonosdia = "SELECT * FROM tbk_abono WHERE substring(fecha_ab,1,10)  ='".date('d-m-Y')."'";
		//echo $abonosdia;
		$resabono = mysql_query($abonosdia, $conn);
		
		
		$efectivo = 0;
		$efectivo3 = 0;
		$efectivo4 = 0;
		$totalefectivo =0;
		
		$redcompra = 0;
		$redcompra3 = 0;
		$redcompra4 = 0;
		$totalredcompra = 0;
		
		$cheque = 0;
		$cheque3 = 0;
		$cheque4 = 0;
		$totalcheque = 0;
		
		$trans = 0;
		$trans3 = 0;
		$trans4 = 0;
		$totaltrans = 0;
		
		$credito = 0;
		$credito3 = 0;
		$credito4 = 0;
		$totalcredito = 0;
		
		$guia = 0;
		
		$totalboletas = 0;
		$totalfacturas = 0;
		$totalbonos = 0;
		
		$fechakdx = date('Y-m-d');
		
		$a=0;
		WHILE ($linea = mysql_fetch_row($resabono))
		{
			
			$tipopago		= $linea[4];
			$tipoefectivo 	= $linea[5];
			$abono 			= $linea[8];
			$tipodocumento 	= $linea[10];
			$iddoc			= $linea[11];
			
			// averiguar si la factura es producto de una facturacion.. de ser asi  NO SE CONSIDERA
			$buscaf = "SELECT guias_doc FROM tbk_documento WHERE id_doc='".$iddoc."'";
			//echo "<p>".$buscaf."<p/>";
			$resf = mysql_query($buscaf,$conn);
			$fichafactura = mysql_fetch_row($resf);
			$guiasasociadas = trim($fichafactura[0]);
			
			
			//echo "TIPOPAGO::".$tipopago." TIPODOCUMENTO::".$tipodocumento." TIPOEFETIVO::".$tipoefectivo." BONO:: ".$abono." <p>";
			
			
			SWITCH($tipopago)
			{
				
				case '1':
							//pago en efectivo
							
							SWITCH($tipodocumento)
							{
								case '0':
										// pago BONO
										SWITCH($tipoefectivo)
										{
											case '1': $efectivo = $efectivo + $abono; break;
											case '2': $redcompra = $redcompra + $abono; break;
											case '3': $cheque = $cheque + $abono; break;
											case '4': $trans = $trans + $abono; break;
																			
										}
										
										break;
								case '3':
										// pago factura
										// si la factura contiene guias asociadas NO DEBE CONSIDERARSE en la operacion
										
										if ($guiasasociadas =='')
										{
											
											SWITCH($tipoefectivo)
											{
												
												case '1': $efectivo3 = $efectivo3 + $abono; break;
												case '2': $redcompra3 = $redcompra3 + $abono; break;
												case '3': $cheque3 = $cheque3 + $abono; break;
												case '4': $trans3 = $trans3 + $abono; break;
																				
											}
										}
										
										break;
								
								
								case '4':
										// pago boleta
										SWITCH($tipoefectivo)
										{
											case '1': $efectivo4 = $efectivo4 + $abono; break;
											case '2': $redcompra4 = $redcompra4 + $abono; break;
											case '3': $cheque4= $cheque4 + $abono; break;
											case '4': $trans4 = $trans4 + $abono; break;
																			
										}
										
										break;		
							
							
							}
							
							break;
				
			
				case '0' :
				
							SWITCH($tipodocumento)
							{
								case '0':
										// pago factura
										$credito  = $credito + $abono;
										
										break;
								case '3':
										// pago factura
										$credito3  = $credito3 + $abono;
										
										break;
								
								
								case '4':
										// pago boleta
										
										$credito4 = $credito4 +  $abono;
										break;		
							
							
							}
							
							break;
				
				case '2' :
				
						$guia =  $guia  + $abono; break;
							
			}

			
		
			$a++;
		}
		
			$totalefectivo = $efectivo + $efectivo3 + $efectivo4;
			$totalredcompra = $redcompra + $redcompra3 + $redcompra4;
			$totalcheque = $cheque + $cheque3 + $cheque4;
			$totaltrans = $trans + $trans3 + $trans4;
			
			$totalcredito = $credito + $credito3 + $credito4;
			
			$totalbonos = $efectivo + $redcompra + $cheque + $trans + $credito;
			$totalboletas = $efectivo4 + $redcompra4 + $cheque4 + $trans4 + $credito4;
			$totalfacturas = $efectivo3 + $redcompra3 + $cheque3 + $trans3 + $credito3;
			
			$total = $totalbonos + $totalboletas + $totalfacturas + $guia;
			
			
			
			
					
			echo "<tr>";
			echo "<td id='etiqueta'>Bonos</td>";
			echo "<td id='data' align='right'>$ ".$efectivo."</td>";
			echo "<td id='data' align='right'>$ ".$redcompra."</td>";
			echo "<td id='data' align='right'>$ ".$cheque."</td>";
			echo "<td id='data' align='right'>$ ".$trans."</td>";
			echo "<td id='data' align='right'>$ ".$credito."</td>";
			echo "<td id='data' align='right'>$ 0</td>";
			echo "<td id='etiqueta' align='right'>$ ".$totalbonos."</td>";
			echo "</tr>";
			
			echo "<tr>";
			echo "<td id='etiqueta'>Gu&iacute;as</td>";
			echo "<td id='data' align='right'>$ 0</td>";
			echo "<td id='data' align='right'>$ 0</td>";
			echo "<td id='data' align='right'>$ 0</td>";
			echo "<td id='data' align='right'>$ 0</td>";
			echo "<td id='data' align='right'>$ 0</td>";
			echo "<td id='data' align='right'>$ ".$guia."</td>";
			echo "<td id='etiqueta' align='right'>$ ".$guia."</td>";
			echo "</tr>";	
			
			echo "<tr>";
			echo "<td id='etiqueta'>Boletas</td>";
			echo "<td id='data' align='right'>$ ".$efectivo4."</td>";
			echo "<td id='data' align='right'>$ ".$redcompra4."</td>";
			echo "<td id='data' align='right'>$ ".$cheque4."</td>";
			echo "<td id='data' align='right'>$ ".$trans4."</td>";
			echo "<td id='data' align='right'>$ ".$credito4."</td>";
			echo "<td id='data' align='right'>$ 0</td>";
			echo "<td id='etiqueta' align='right'>$ ".$totalboletas."</td>";
			echo "</tr>";
			
			echo "<tr>";
			echo "<td id='etiqueta'> Facturas</td>";
			echo "<td id='data' align='right'>$ ".$efectivo3."</td>";
			echo "<td id='data' align='right'>$ ".$redcompra3."</td>";
			echo "<td id='data' align='right'>$ ".$cheque3."</td>";
			echo "<td id='data' align='right'>$ ".$trans3."</td>";
			echo "<td id='data' align='right'>$ ".$credito3."</td>";
			echo "<td id='data' align='right'>$ 0</td>";
			echo "<td id='etiqueta' align='right'>$ ".$totalfacturas."</td>";
			echo "</tr>";	

		
		
		
		echo "<tr>";
			echo "<td id='etiqueta'> NVF</td>";
			echo "<td id='data' align='right'>$ ".$efectivo3."</td>";
			echo "<td id='data' align='right'>$ ".$redcompra3."</td>";
			echo "<td id='data' align='right'>$ ".$cheque3."</td>";
			echo "<td id='data' align='right'>$ ".$trans3."</td>";
			echo "<td id='data' align='right'>$ ".$credito3."</td>";
			echo "<td id='data' align='right'>$ 0</td>";
			echo "<td id='etiqueta' align='right'>$ ".$totalfacturas."</td>";
			echo "</tr>";
		
			
			echo "<tr>";
			echo "<td id='etiqueta'> Totales</td>";
			echo "<td id='etiqueta' align='right'>$ ".$totalefectivo."</td>";
			echo "<td id='etiqueta' align='right'>$ ".$totalredcompra."</td>";
			echo "<td id='etiqueta' align='right'>$ ".$totalcheque."</td>";
			echo "<td id='etiqueta' align='right'>$ ".$totaltrans."</td>";
			echo "<td id='etiqueta' align='right'>$ ".$totalcredito."</td>";
			echo "<td id='data' align='right'>$ ".$guia."</td>";
			echo "<td id='etiqueta' align='right'><font size='4'><i>$ ".$total."</i></font></td>";
			echo "</tr>";
			
	
	
	
	
	?>
	</table>
	
	<br/>
	<label id='comentariogris'>Nota: Los pagos relacionados a facturas producto de <i>facturaci&oacute;n de gu&iacute;as</i> no se consideran en la cuadratura</label>
	</center>
	
	<br/>
	<p/>
	<p/>

	
	<label id='subtitulo'>Gastos del d&iacute;a. </label>
	<br/>
	<label id='comentariogris'>Salidas de efectivo desde la caja.</label>
	
	<p/>
	
	<center>
	<table border='0' cellpadding='5' cellspacing='5' width='700'>
	<tr>
		<th id='etiqueta'> N°</th>
		<th id='etiqueta'> Fecha de Salida</th>
		<th id='etiqueta'> Motivo </th>
		<th id='etiqueta'> Cantidad</th>
		<th id='etiqueta'> Registro</th>	
		
	
	</tr>
	
	<?php
	
		$buscagastos= "SELECT * FROM tbk_gasto WHERE substring(fecha_gas, 1, 10) = '".date('Y-m-d')."' ORDER BY fecha_gas DESC";
		$resb = mysql_query($buscagastos, $conn);
		
		$nfilas = mysql_num_rows($resb);
		$totalgastos = 0;
		if ($nfilas > 0 )
		{	
			$g=1;
			$totalgastos = 0;
			WHILE($gasto = mysql_fetch_row($resb))
			{
				$gfecha  		= $gasto[1];
				$gcantidad 		= $gasto[2];
				$gmotivo 		= $gasto[3];
				$guser		= $gasto[4];
				
				echo "<tr><td id='etiqueta' align='center'>".$g."</td><td id='data'>".$gfecha."</td><td id='data'>".$gmotivo."</td><td id='data'>".personalrut($guser)."</td><td id='etiqueta' align='right'>$ ".$gcantidad."</td></tr>";
				$totalgastos = $totalgastos + $gcantidad;
			
				$g++;
			}
		
		
		}
		else
		{
		
			echo "<tr><td colspan='8' id='data'> No se registran gastos </td></tr>";
		
		}
	
		echo "<tr><td id='etiqueta' align='center'/><td id='etiqueta'>Total Gastos</td><td id='etiqueta'  /><td id='etiqueta' /><td id='etiqueta' align='right'><font size='4'><i>$ ".$totalgastos."</i></font></td></tr>";
	
	?>
	</table>
	</center>

	<br/>
	<p/>
	<p/>
	
	<label id='subtitulo'>Detalle General. </label>
	<br/>
	<label id='comentariogris'>Res&uacute;men de entradas y salidas de efectivo de caja.</label>
	
	<p/>
	
	<center>
	<table border='0' cellpadding='5' cellspacing='5' width='700'>
	<tr>

		<th id='etiqueta'> Descripci&oacute;n</th>
		<th id='etiqueta'> Cantidad</th>
				
	
	</tr>
	<?php
		
		$buscacc = "SELECT cajachica_ca FROM tbk_cajadiaria WHERE fecha_ca ='".$fechakdx."'";
		$rescc = mysql_query($buscacc, $conn);
		
		$cfilas  = mysql_num_rows($rescc);
		
		$cajachica = 0;
		if ($cfilas > 0)
		{
			$fichacc = mysql_fetch_row($rescc);
			
			$cajachica = $fichacc[0];
		
		}
	
		echo "<tr>";
		echo "<td id='data'> Caja Chica (+)</td>";
		echo "<td id='etiqueta' align='right'>$ ".$cajachica."</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td id='data'> Efectivo Pago /Abonos Ventas (+)</td>";
		echo "<td id='etiqueta' align='right'>$ ".$total."</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td id='data'> Ventas por Gu&iacute;as (-)</td>";
		echo "<td id='etiqueta' align='right'>$ ".$guia."</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td id='data'> Gastos Varios (-)</td>";
		echo "<td id='etiqueta' align='right'>$ ".$totalgastos."</td>";
		echo "</tr>";
		
		$totalgeneral = $cajachica + $total - $guia  - $totalgastos;
		
		echo "<tr>";
		echo "<td id='etiqueta'> Total Caja (=)</td>";
		echo "<td id='etiqueta' align='right'><font size='4'><i>$ ".$totalgeneral."</i></font></td>";
		echo "</tr>";
		
	
	?>
	
	</table>
	</center>
	<br/>
	<p/>
	<p/>
	
	<label id='subtitulo'>Observaciones. </label>
	<br/>
	<label id='comentariogris'>Comentario que considere adecuado dejar como registro.</label>
	
	<p/>
	<center>
	<table border='0' cellpadding='5' cellspacing='5' width='700'>
	<tr>
		<td><textarea name='obs' cols='112' rows='3'></textarea></td>	

	</tr>
	</table>
	</center>
	
	
	
	<p/>
	
	<table border='0' width='700'>
	<tr>
	<td align='right'>
		
		<input type='hidden' name='cajachica' value='<?=$cajachica?>'>
		<input type='hidden' name='efectivo' value='<?=$total?>'>
		<input type='hidden' name='guiasdeventa' value='<?=$guia?>'>
		<input type='hidden' name='gastos' value='<?=$totalgastos?>'>
		<input type='hidden' name='totalcaja' value='<?=$totalgeneral?>'>

		<input type='hidden' name='save' value='0'>
		<input type='Submit' value='Guardar Caja Diaria' onClick='caja.save.value="1"'>
			
	</td>
	</tr>
	</table>

	

	
</td>
</tr>
</table>
</form>


<?php include("footer.php")?>