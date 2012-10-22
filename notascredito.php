<?php include("header.php")?>


<?php


	include("functions.php");


	$cb 		= $_GET['cb'];
	$see 		= $_POST['look'];


	$nombre		= $_POST['nombre'];
	if (!empty($nombre)) $codigofactura = $nombre + 2000000000;
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
					$insert = "SELECT * FROM tbk_nota WHERE id_nota LIKE '%".ltrim($codigofactura)."%' AND tipo_nota = '0' ORDER BY id_nota DESC";
					break;
					
		
		
			
			case '9':
					//echo "almacenando pago de cuotas";

					
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
			$insert = "SELECT * FROM tbk_nota WHERE id_nota LIKE '".trim($cb)."'";	
			
			if($respro = mysql_query($insert,$conn))
			{	
				$ficha[]="";
				
			
				$ficha = mysql_fetch_row($respro);
				

				
				$sfactura 	= $ficha[0];
				$sguia		= $ficha[1];
				$sfecha		= $ficha[2];
				$sestado	= $ficha[3];
				$rutguia 	= $ficha[4];
				$nombreguia = $ficha[5];


			
			}
	
	}

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>


<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> NOTAS DE DEBITO</label>
	<br/>
	<label id='comentariogris'> Complete uno de los campos para realizar la b&uacute;squeda. Si desea listar todos las facturas, haga click en 'buscar c&oacute;digo' con el campo vac&iacute;o.</label>
	<hr/>
	<p/>


	<form name='boleta' action='notascredito.php?cb=<?=$cb?>' method ='POST'>
	

	<table border='0'>
	<tr>
	<td width='400' valign='top'>
	
			<label id='subtitulo'> Buscar y seleccionar Factura para ver notas asociadas</label>
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
					
				</table>
			

	
			<p/>
			
			<fieldset>
				<table border='0' cellspacing='5' cellpadding='5' width='400' >
				
				<?php
				
					if ($busqueda == 1)
					{
						echo "<tr><td id='data'>Nota</td><td id='data'>Factura</td><td id='data'> Fecha</td><td id='data'>Total</td></tr>";
						$i=0;
						While ($row = mysql_fetch_row($res))
						{
							$facturaID 	= $row[0];
							$guiaID	   	= $row[1];	
							$fechaguia 	= $row[2];
							$total	 	= $row[4];
							
							$buscaID = "SELECT codigo_doc FROM tbk_documento WHERE id_doc  ='".$facturaID."'";
							$resID = mysql_query($buscaID,$conn);
							
							$fichadoc = mysql_fetch_row($resID);
							
							$codigoID = $fichadoc[0];

							echo "<tr><td id='data' width='20'><a id='etiquetazul' href='notascredito.php?cb=".$guiaID."'><font size='4'>".$guiaID."</font></a></td><td id='data' align='center'><b>".$codigoID."</b></td><td id='data'>".$fechaguia."</td><td id='data' align='right'>$ ".$total."</td></tr>";
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
	<td width='400' valign='top'>

	<?php if (!empty($cb)) :?>
		
		
			<label id='subtitulo'> Nota N° <?= $cb ?></label>
			<p/>
			
			<fieldset>
			
			<table border='0' cellspacing='5' cellpadding='5' width='400'>
			<tr>
			<td   id='data' align='left' colspan='4' >
				<label id='comentario'> <font size='4'><i><?=$sfecha?></i></font></label>
			</td>
			<td  id='data' align='right' colspan='6'>
				 <label id='comentario'> <font size='4'> N°<br/>  <?=$cb?> </font></label>
			</td>
			</tr>
			
			<tr>

			<td   id='data' align='left' colspan='6'>
				 <label id='comentario'><font size='3'> Factura :  </font>  <a id='etiquetazul' href='facturas.php?cb=<?=$sfactura?>' target='_blank'> <img src='images/binoculares.gif' border='0'></a></label>
			</td>
			</tr>
			
			
			
			<tr><td height='25' colspan='6'><hr/></td></tr>
						<tr>
						<td id='etiqueta' colspan='2'>Producto</td>
						<td id='etiqueta'>Cantidad</td>
						<td id='etiqueta'>Retiro</td>
						<td id='etiqueta'>$<br/>Unitario</td>
						<td id='etiqueta'>$<br/>Total</td>
					</tr>
					
			<?php
			
				$find = "SELECT * FROM tbk_notapro WHERE  id_nota= ".$sguia;
				if ($resf = mysql_query($find, $conn))
				{
					$j=0;
					$subtotal = 0;
					WHILE ($ficha2 = mysql_fetch_row($resf))
					{
					
						
						$fcbarra 			= $ficha2[2];
						$fcantidad 			= $ficha2[3];
						$fretiro			= $ficha2[4];
						$fprecio			= $ficha2[5];
						
						$subtotal  = $fcantidad  * $fprecio;

				?>	
					

					<tr>
					<td id='data'  colspan='2'>
						<label id='comentario'><?=nombreprod($fcbarra)?></label>
					</td>
					
					<td id='data' align='right' width='10'>
						<label id='comentario'><?=$fcantidad?></label>
					</td>
					<td id='etiqueta' align='right' width='10'>
						<label id='comentario'><?=$fretiro?></label>
					</td>
					<td id='data' align='right' width='50'>
						<label id='comentario'>$ <?=$fprecio?></label>
					</td>
					<td id='data' align='right' width='60'>
						<label id='comentario'>$ <?=$subtotal?></label>
					</td>
					</tr>
					
				<?php
						$j++;
						
					}
					
					$subtotaliva = round((($subtotal * $iva)/100),0);
				?>
				
					
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