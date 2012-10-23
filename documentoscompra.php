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
					$insert = "SELECT * FROM tbk_documentocompra WHERE id_docc LIKE '".trim($codigofactura)."%' AND estado_docc  <= 1 ORDER BY id_docc DESC";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_documentocompra WHERE rut_cli LIKE '".trim($nrut)."%' AND estado_docc  <= 1 ORDER BY id_docc DESC";
					break;
					
		

			case '3':
					$insert = "SELECT * FROM tbk_documentocompra WHERE SUBSTR(fecha_docc,4,2) LIKE '".trim($marca)."%' AND estado_docc  <= 1 ORDER BY id_docc DESC";
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
				$stipodoc	= $ficha[2];
				$stipodoc 	= $ficha[2];
				$sfecha		= $ficha[3];
				$stotal		= $ficha[4];
				$codigodoc  = $ficha[6];
				$obs		= $ficha[8];
				
				$proceso ="";
				SWITCH($stipodoc)
				{
								case '1' : $nombredoc = "Boleta"; break;
								case '2' : $nombredoc = "Gu&iacute;a"; break;
								case '3' : $nombredoc = "Factura"; break;
				}
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
	
	<label id='subtitulo'>DOCUMENTOS DE COMPRA</label>
	<br/>
	<label id='comentariogris'> Complete uno de los campos para realizar la b&uacute;squeda. Si desea listar todas las facturas, haga click en 'buscar c&oacute;digo' con el campo vac&iacute;o.</label>
	<hr/>
	<p/>


	<form name='boleta' action='documentoscompra.php?cb=<?=$cb?>' method ='POST'>
	

	<table border='0'>
	<tr>
	<td width='400' valign='top'>
	
			<label id='subtitulo'> Buscar y seleccionar documento de compra</label>
			<p/>
						
				<table border='0' cellspacing='5' cellpadding='5' width='450' background='images/logos/fondo_menu.jpg' >
				<tr>
				<td>
					<label id='comentario'>C&oacute;digo Documento</label>
				</td>
				<td valign='top' align='right' width='70'>
						<input type='text' name='nombre' value='<?=limpiar($nombre)?>' size='20' >
						
				</td>
				<td />
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='boleta.look.value=1; np.submit()'>
				</td>
				</tr>
				
				
				<tr>
				<td>
					<label id='comentario'>Proveedor</label>
				</td>
				<td valign='top'  width='100' align='right'>
					
					<input type='text' name='nrut' size='20' value='<?=$nrut?>' >
					<input type='hidden' name='nnombre' value='' size='30' >

					
				</td>
				<td>
					<a  href="buscarproveedorpop.php" target="popup"  onClick="window.open(this.href, this.target, 'width=500,height=400'); return false;"><img src='images/buscarcliente.png' border='0'></a>
				</td>

				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='boleta.look.value=2; np.submit()'>
				</td>
				</tr>
				</table>
			
		
	
			<p/>
			
			<fieldset>
				<table border='0' cellspacing='5' cellpadding='5' width='450' >

				
				<?php
				
					if ($busqueda == 1)
					{
						echo "				<tr><th id='etiqueta'> N°</th><th id='etiqueta'> Proveedor</th>	<th id='etiqueta'> Fecha Compra</th><th id='etiqueta'> Total Compra</th><th id='etiqueta'> Documento</th></tr>";
						$i=0;
						While ($row = mysql_fetch_row($res))
						{
							$facturaID 	= $row[0];
							$clienteID 	= $row[1];
							$tipodoc 	= $row[2];
							$fechafact 	= $row[3];
							$total  	= $row[4];
							$estado 	= $row[5];
							$codigodoc 	= $row[6];
							$des1		= $row[7];
							$des2		= $row[8];
							$des3		= $row[9];
							$proceso ="";
							SWITCH($tipodoc)
							{
								case '1' : $proceso = "Boleta"; break;
								case '2' : $proceso = "Gu&iacute;a"; break;
								case '3' : $proceso = "Factura"; break;
							
							
							
							}
							
							 $preciodesc1 =$fvalorunitario*((100 - $des1)/100) ;
                     		   $preciodesc2 =$preciodesc1*((100 - $des2)/100) ;
                        		 $preciodesc3 =$preciodesc2*((100 - $des3)/100); 
                        
							echo "<tr><td id='data' width='20'><a id='etiquetazul' href='documentoscompra.php?cb=".$facturaID."' ><font size='4'>".$codigodoc."</font></a></td><td id='data'>".proveedorrut($clienteID)."</td><td id='data'>".$fechafact."</td><td id='data' align='right'>$ ".$total."</td><td id='data'>".$proceso."</td></tr>";
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
		
			<?php
			
					//Buscar datos de cliente
					$searchCli = "SELECT * FROM tbk_proveedor WHERE rut_pv = '".$scliente."'";
					//echo $searchCli;
					
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
		
			<label id='subtitulo'><?=$nombredoc?> N° <?= $codigodoc ?></label>
			<p/>
			
			<fieldset>
			
			<table border='0' cellspacing='5' cellpadding='5' width='400'>
			<tr>
			<td  id='data'>
				<label id='comentario'><font size='4'> <i> <?=$sfecha?></i></font></label>
			</td>
			<td  id='data' align='right' colspan='4'>
				 <label id='comentario'> <font size='4'><?=$nombredoc?> N°<br/><?=$codigodoc?></font></label>
			</td>
			</tr>
			
			<tr><td height='25' colspan='6'><hr/></td></tr>
					
					
			<tr>
			<td id='data' colspan='5'>
				 <label id='comentario'><?=$fnombrecompleto?> </label>
			</td>
			</tr>
			
						<tr>
			<td id='data' colspan='5'>
				 <label id='comentario'><?=$fdir." - ".$fcomuna?> </label>
			</td>
			</tr>
			
			<tr><td height='25' colspan='5'><hr/></td></tr>
		
			
			<tr><td id='etiqueta'> Producto</td>
            <td id='etiqueta'> Cantidad.</td>
            <td id='etiqueta' width='30' > Pendiente<br/>Recepci&oacute;n</td>
            <td id='etiqueta' width='30' >  $<br/>Unitario</td>
            <td id='etiqueta' width='30' >Desc1</td>
            <td id='etiqueta' width='30' >Desc1</td>
            <td id='etiqueta' width='30' >Desc1</td>
            <td id='etiqueta' width='60' >  $<br/>Total</td></tr>
					
			<?php
			
				$find = "SELECT * FROM tbk_docprocompra WHERE  id_docc = ".$scodigo;
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
						$pendiente		 	= $ficha2[5];
						
						$festado			= $ficha2[6];
							$fdesc1			= $ficha2[7];
							$fdesc2			= $ficha2[8];
							$fdesc3			= $ficha2[9];
					
						
						
						if ($festado == 0) $subtotal = $subtotal + ($fcantidad * $fvalorunitario);
				?>	
					
					<tr>
					<td id='data' width='180'>
						<?php if ($festado  == 1) echo "<s>" ?>
					
						<label id='comentario'><?=nombreprod($fcbarra)?></label>
						
						<?php if ($festado  == 1) echo "</s>" ?>
					</td>

					<td id='data' align='right' width='10'>
						<?php if ($festado  == 1) echo "<s>" ?>
						
						<label id='comentario'><?=$fcantidad?></label>
						
						<?php if ($festado  == 1) echo "</s>" ?>
					</td>
					<td id='etiqueta' align='right' width='10'>
						<?php if ($festado  == 1) echo "<s>" ?>
						
						<label id='comentario'><?=$pendiente?></label>
						
						<?php if ($festado  == 1) echo "</s>" ?>
					</td>
					<td id='data' align='right' >
						<?php if ($festado  == 1) echo "<s>" ?>
						
						<label id='comentario'><?=$fvalorunitario?></label>
						
						<?php if ($festado  == 1) echo "</s>" ?>
					</td>
                    
                    <td id='data' align='right' >
						<?php if ($festado  == 1) echo "<s>" ?>
                        
						
						<label id='comentario'><?=$fdesc1?></label>
						
						<?php if ($festado  == 1) echo "</s>" ?>
					</td>
                    
                      <td id='data' align='right' >
						<?php if ($festado  == 1) echo "<s>" ?>
						
						<label id='comentario'><?=$fdesc2?></label>
						
						<?php if ($festado  == 1) echo "</s>" ?>
					</td>
                      <td id='data' align='right' >
						<?php if ($festado  == 1) echo "<s>" ?>
						
						<label id='comentario'><?=$fdesc3?></label>
						
						<?php if ($festado  == 1) echo "</s>" ?>
					</td>
                    
					<td id='data' align='right' >
						<?php if ($festado  == 1) echo "<s>" ?>
						<?php $preciodesc1 =$fvalorunitario*((100 - $fdesc1)/100) ?>
                        <?php $preciodesc2 =$preciodesc1*((100 - $fdesc2)/100) ?>
                        <?php $preciodesc3 =$preciodesc2*((100 - $fdesc3)/100) ?>
                        
						<label id='comentario'><?=round($preciodesc3)?></label>
						
						<?php if ($festado  == 1) echo "</s>" ?>
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
					<td/>
					
					<td >
						<label id='comentario'>Neto </label>
					</td>
					<td id='etiqueta' align='right'>
						$ <?=$subtotal?>
					</td>
					</tr>	
					
					<tr>
					<td />
					<td/ >
					<td/>
					
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
			
			<fieldset>
				
				<table border='0'>
				<tr>
				<td id='etiqueta'>
					<label id='comentariogris' > Documentos asociados : </label>
				
				</td>
				<td>
					<?php
						// listado  documentos asociados
						
						$buscadocs = "SELECT  * FROM tbk_guiacompra WHERE  id_fact=".$cb;
						//echo $buscadocs;
						
						$resdocs = mysql_query($buscadocs, $conn);
						
						$nfilas = 0;
						$nfilas = mysql_num_rows($resdocs);
						
						if ($nfilas > 0)
						{
							$j=0;
							WHILE ($rowdocs = mysql_fetch_row($resdocs))
							{
								$gfact = $rowdocs[0];
								$gguia  = $rowdocs[1];
								$gfecha = $rowdocs[2];
								$gestado = $rowdocs[3];
								$grutguia = $rowdocs[4];
								$gnombreguia = $rowdocs[5];
								
								echo "<a id='etiqueta' href='guiascompra.php?cb=".$gguia."' target='_blank'> ".$gguia." |  </a>";
							
								$j++;
							}
						
						
						
						}
					
					
					?>
					
				</td>
				</tr>
				</table>
				
			</fieldset>
			
					
		<?php 	} 
			
				
		?>	
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