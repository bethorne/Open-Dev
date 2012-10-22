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
					$insert = "SELECT * FROM tbk_guiacompra WHERE id_gcc LIKE '".trim($codigofactura)."%' ORDER BY id_gcc DESC";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_guiacompra WHERE rut_cli LIKE '".trim($nrut)."'  ORDER BY id_gcc DESC";
					break;
					
		

			case '3':
					$insert = "SELECT * FROM tbk_guiacompra WHERE SUBSTR(fecha_gcc,4,2) LIKE '".trim($marca)."%' ORDER BY id_gcc DESC";
					break;
			
			
			case '9':
					
					
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
		
	//echo "CB.:".$cb;
	
	if ($cb != '')
	{
			
			$insert = "SELECT * FROM tbk_guiacompra WHERE id_gcc = '".trim($cb)."' ORDER BY id_gcc DESC";
			//echo $insert;
			
			if($respro = mysql_query($insert,$conn))
			{	
				$ficha = mysql_fetch_row($respro);

				$sfactura 	= $ficha[0];
				$sguia		= $ficha[1];
				$sfecha		= $ficha[2];
				$sestado	= $ficha[3];
				$rutguia 	= $ficha[4];
				$nombreguia = $ficha[5];


			
			}
	
	}

	 

?>


<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> GU&Iacute;AS DE RECEPCION</label>
	<br/>
	<label id='comentariogris'> Complete uno de los campos para realizar la b&uacute;squeda. Si desea listar todos las facturas, haga click en 'buscar c&oacute;digo' con el campo vac&iacute;o.</label>
	<hr/>
	<p/>


	<form name='boleta' action='guiascompra.php?cb=<?=$cb?>' method ='POST'>
	

	<table border='0'>
	<tr>
	<td width='400' valign='top'>
	
			<label id='subtitulo'> Buscar y seleccionar gu&iacute;a</label>
			<p/>
						
				<table border='0' cellspacing='5' cellpadding='5' width='450' background='images/logos/fondo_menu.jpg' >
				<tr>
				<td>
					<label id='comentario'>C&oacute;digo</label>
						
				</td>
				<td valign='top' align='left' width='70'>
						<input type='text' name='nombre' value='<?=limpiar($nombre)?>' size='20' >
				</td>
				
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
						echo "	<tr><th id='etiqueta'>Gu&iacute;a</th><th id='etiqueta'>Factura</th><th id='etiqueta'> FECHA</th><th id='etiqueta'>Estado</th></tr>";
						$i=0;
						While ($row = mysql_fetch_row($res))
						{
							$facturaID 	= $row[0];
							$guiaID	   	= $row[1];	
							$fechaguia 	= $row[2];
							$estado 	= $row[3];

							
							$proceso ="";
							SWITCH($estado)
							{
								case '1' : $proceso = "P"; break;
								case '0' : $proceso = "C"; break;
							
							
							
							}
							
							echo "<tr><td id='data' width='20'><a id='etiquetazul' href='guiascompra.php?cb=".$guiaID."'><font size='4'>".$guiaID."</font></a></td><td id='data'><a id='etiquetazul' href='documentoscompra.php?cb=".$facturaID."' target='blank'><img src='images/binoculares.gif' border='0'> - <font size='4'>". codigocompraid($facturaID)."</font> - </a></td><td id='data'>".$fechaguia."</td></tr>";
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

	<?php if ($cb != '') :?>
		
		
			<label id='subtitulo'> Gu&iacute;a N° <?= $cb ?></label>
			<p/>
			
			<fieldset>
			
			<table border='0' cellspacing='5' cellpadding='5' width='400'>
			<tr>
			<td   id='data' align='left' colspan='1' >
				<label id='comentario'> <font size='4'><i><?=$sfecha?></i></font></label>
			</td>
			<td  id='data' align='right' colspan='3'>
				 <label id='comentario'> <font size='4'>N°<br/>  <?=$cb?> </font></label>
			</td>
			</tr>
			
			<tr>

			<td   id='data' align='left' colspan='4'>
				 <label id='comentario'><a id='etiquetazul' href='documentoscompra.php?cb= <?=$sfactura?>'>| Ver Factura |</a></label>
			</td>
			</tr>
			
			
			
			<tr><td height='25' colspan='5'><hr/></td></tr>
			
			<tr>
				<td id='etiqueta' colspan='2'> Producto </td>
				<td id='etiqueta'> Cantidad </td>
			</tr>
		
					
			<?php
			
				$find = "SELECT * FROM tbk_guiaprocompra WHERE  id_gcc= ".$sguia;
				if ($resf = mysql_query($find, $conn))
				{
					$j=0;
					$subtotal = 0;
					WHILE ($ficha2 = mysql_fetch_row($resf))
					{
					
						
						$fcbarra 			= $ficha2[2];
						$fcantidad 			= $ficha2[3];

				?>	
					
					<tr>
					<td id='data' width='180' colspan='2'>
						<label id='comentario'><?=nombreprod($fcbarra)?></label>
					</td>
					<td id='data' align='right' width='10'>
						<label id='comentario'><?=$fcantidad?></label>
					</td>
					</tr>
					
				<?php
						$j++;
						
					}
					
					$subtotaliva = round((($subtotal * $iva)/100),0);
				?>
				
					
			</table>
			
			
			</fieldset>
			
			<p/>
			<label id='subtitulo'> Retiro realizado por </label>
			<p/>
			
			<fieldset>
			
			<table border='0' cellspacing='5' cellpadding='5' width='400'>
			<tr>
			<td id='etiqueta' width='100'>
				Rut
			</td>
			<td id='data'>
				<?=$rutguia?>
			</td>
			</tr>
			
			<tr>
			<td id='etiqueta'>
				Nombre
			</td>
			<td id='data'>
				<?=$nombreguia?>
			</td>
			</tr>			
			</table>
			
					
		<?php 	} 
			
		?>		
	
	
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