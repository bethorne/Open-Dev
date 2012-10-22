<?php include("header.php")?>

<style>
#menublanco
	{

		font-family :Trebuchet MS, Arial;
		font-size:12px;
		color:#fff;
		text-decoration: none;
	}
</style>
<?php


	include("functions.php");


	$cb 		= $_GET['cb'];
	$see 		= $_POST['look'];


	$nombre		= $_POST['nombre'];
	$codigofactura = $nombre ;
	$nrut 		= $_POST['nrut'];
	
	
	
	$boton 		= "0";
	
	// pago de cuota
	
	$pagofactura 	= $_POST['FFID'];
	$pagocliente 	= $_POST['FUID'];
	$pagocuotas 	=  $_POST['quotas'];
	$pagomonto  	= $_POST['montopago'];
	$pagofecha  	= $_POST['FFECHA'];
	
	//busca ultimos codigos de  documento
	$searchcodigo = "SELECT * FROM tbk_parametro WHERE  tipo_param = 3";
	$resultadocodigo = mysql_query($searchcodigo, $conn);
	
	$i=0;
	
	$factura = 0;
	$guia = 0;
	$boleta =0;
	
	WHILE ($rowparam = mysql_fetch_row($resultadocodigo))
	{
		if ($rowparam[2] =='factura') $factura 	= $rowparam[4] + 1;
		if ($rowparam[2] =='guia')    $guia		= $rowparam[4] + 1;
		if ($rowparam[2] =='boleta')  $boleta 	= $rowparam[4] + 1;
		
		$i++;
	}
	
	
	
	// echo " SE HA PAGADO BAJO LOS SIGUIENTES TERMINOS: ".$pagofactura." por ".$pagocliente." la cantidad de ".$pagomonto." correspondientes a ".$pagocuotas." cuotas<p/>";
	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert = "SELECT * FROM tbk_cotizacion WHERE id_doc LIKE '%".ltrim($codigofactura)."%' AND tipo_doc = 0 AND estado_doc = 9 ORDER BY id_doc DESC";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_cotizacion WHERE rut_cli LIKE '%".trim($nrut)."%' AND tipo_doc = 0  AND estado_doc = 9 ORDER BY id_doc DESC";
					break;
					
		

			case '3':
					$insert = "SELECT * FROM tbk_cotizacion WHERE SUBSTR(fecha_doc,4,2) LIKE '%".ltrim($marca)."%' AND tipo_doc = 9 AND estado_doc = 0 ORDER BY id_doc DESC";
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
			$insert = "SELECT * FROM tbk_cotizacion WHERE id_doc LIKE '".trim($cb)."'";	
			
			if($respro = mysql_query($insert,$conn))
			{	
				$ficha[]="";
				
			
				$ficha = mysql_fetch_row($respro);
				

				
				$scodigo 	= $ficha[0];
				$scliente	= $ficha[1];
				$stipodoc 	= $ficha[2];
				$sfecha		= $ficha[3];
				$stotal		= $ficha[4];
				$formadepago= $ficha[10];
				$desc		= $ficha[11];
				$ssubtotal	= $ficha[12];
				
				
				$descuento 	=  round((($ssubtotal * $desc)/100),0);

			
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
	<label id='subtitulo'>ANULAR VALE </label>
	<br/>
	<label id='comentariogris'> Complete el campo para realizar la b&uacute;squeda. Si desea listar todos los vales disponibles, haga click en 'buscar c&oacute;digo' con el campo vac&iacute;o.</label>
	<hr/>
	<p/>


	<form name='boleta' action='cot_anulados.php?cb=<?=$cb?>' method ='POST'>
	

	<table border='0'>
	<tr>
	<td width='400' valign='top'>
	
			<label id='subtitulo'> Buscar y seleccionar vale </label>
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
					<label id='comentario'>Cliente - RUT </label>
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
							
							$proceso ="";
							SWITCH($estado)
							{
								case '1' : $proceso = "P"; break;
								case '0' : $proceso = "C"; break;
								case '9' : $proceso = "A"; break;
							
							
							
							}
							?>
                            
							<tr><td id="atrasocuota" width="20"><a id='etiquetazul'  href='vervalecotizacion.php?cb=<?php echo"$facturaID" ?>' target='popup' onClick="window.open(this.href, this.target, 'width=500,height=400'); return false;"><s><font size='4'><?php echo"$facturaID" ?></font></s></a></td><td id='data'><?php echo"$clienteID" ?> </td><td id='data'><?php echo"$fechafact" ?></td><td id='data'><?php echo"$ $total" ?></td><td id='data'><?php echo"$proceso" ?> </td></tr>;
                            <?php
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
							$ffono		= $row[7];
							
							$i++;
						}
					
						//echo "ACA:: ".$searchCli." NOMBRE COMPLETO ".$fombrecompleto;
			
			?>
	</td>
	<td align='top'>
			<label id='subtitulo'> Vale de Compra <?= $cb ?></label>
			<p/>
			
			<fieldset>
			
			<table border='0' cellspacing='5' cellpadding='5' width='400'>
			<tr>
			<td  id='data'>
				<label id='comentario'><font size='4'> <i> <?=$sfecha?></i></font></label>
			</td>
			<td  id='data' align='right' colspan='3'>
				 <label id='comentario'> <font size='4'>N°<br/><?=$cb?></font></label>
				 <input type='hidden' name='cb' value='<?=$cb?>'>
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
			
			
			<tr><td id='etiqueta'> Producto</td><td id='etiqueta'> Cant.</td><td id='etiqueta' width='30' >  $ Unitario</td><td id='etiqueta' width='30' >  $ Total</td></tr>
					
			<?php
			
				$find = "SELECT * FROM tbk_doccot WHERE  id_doc= ".$scodigo;
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
						
						$vendedor			= $ficha[7];
						$obs				= $ficha[8];
					
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
					<td id='data' align='right' >
						<label id='comentario'><?=$fvalorunitario * $fcantidad?></label>
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
					<td >
						<label id='comentario'>Neto </label>
					</td>
					<td id='etiqueta' align='right' width='120'>
						$ <?=$subtotal?>
					</td>
					</tr>	
					
					<tr>
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
					<td >
						<label id='comentario'>Descuento (<?=$desc?>%) </label>
					</td>
					<td align='right' >
						<label id='comentario'>$ <?=$descuento?></label>
					</td>
					</tr>

					<tr>
					<td />
					<td />
					<td  >
						<label id='comentario'>TOTAL </label>
					</td>
					<td id='etiqueta' align='right' width='120' >
						$ <?=$stotal?>
						<input type='hidden' name='total' value='<?=$stotal?>'>
						<input type='hidden' name='nrut' value='<?=$scliente?>'>
					</td>
					</tr>	


					<tr>
					<td id ='etiqueta'>
						Vendedor
					</td>
					<td id='data' colspan='3'>
							<?=$vendedor?>
					</td>
					</tr>
					
					<tr>
					<td id ='etiqueta'>
						Observaciones
					</td>
					<td id='data' colspan='3'>
							<?=$obs?>
					</td>
					</tr>
			</table>
			
			</fieldset>
					
		<?php 	} ?>	
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