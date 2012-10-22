<?php include("header.php")?>


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
	$nvf =0;
	WHILE ($rowparam = mysql_fetch_row($resultadocodigo))
	{
		if ($rowparam[2] =='factura') 
		$factura 	= $rowparam[4] + 1;
		if ($rowparam[2] =='guia')    
		$guia		= $rowparam[4] + 1;
		if ($rowparam[2] =='boleta')  
		$boleta 	= $rowparam[4] + 1;
		if ($rowparam[2] =='nvf')     
		$nvf   	= $rowparam[4] + 1;
		
		$i++;
	}
	
	
	
	// echo " SE HA PAGADO BAJO LOS SIGUIENTES TERMINOS: ".$pagofactura." por ".$pagocliente." la cantidad de ".$pagomonto." correspondientes a ".$pagocuotas." cuotas<p/>";
	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert = "SELECT * FROM tbk_documento WHERE id_doc LIKE '%".ltrim($codigofactura)."%' AND tipo_doc = 0  ORDER BY id_doc DESC";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_documento WHERE rut_cli LIKE '".trim($nrut)."' AND tipo_doc = 0 ORDER BY id_doc DESC";
					break;
					
		

			case '3':
					$insert = "SELECT * FROM tbk_documento WHERE SUBSTR(fecha_doc,4,2) LIKE '%".ltrim($marca)."%' AND tipo_doc = 0 ORDER BY id_doc DESC";
					break;
			
			
			case '9':
					//echo "almacenando pago de cuotas";
					
					$insert = "INSERT INTO tbk_pago_cuota VALUES (";
					$insert .= "'".$pagofactura."',";
					$insert .= "'".$pagocliente."',";
					$insert .= "'".$pagocuotas."',";
					$insert .= "'".$pagomonto."',";
					$insert .= "'".$pagofecha."'";
					$insert .= ")";
					
					//echo "->".$insert."<p/>";
					
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
	
	<label id='subtitulo'> TRANSFORMA VALE EN DOCUMENTO V&Aacute;LIDO</label>
	<br/>
	<label id='comentariogris'> Complete uno de los campos para realizar la b&uacute;squeda. Si desea listar todos las facturas, haga click en 'buscar c&oacute;digo' con el campo vac&iacute;o.</label>
	<hr/>
	<p/>


	<form name='boleta' action='vales.php?cb=<?=$cb?>' method ='POST'>
	

	<table border='0'>
	<tr>
	<td width='400' valign='top'>
	
			<label id='subtitulo'> Buscar y seleccionar Vale </label>
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
					<label id='comentario'>Cliente - RUT</label>
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
								case '1' : $proceso = "Pendiente"; break;
								case '0' : $proceso = "Cancelado"; break;
								case '9' : $proceso = "Nulo"; break;
							
							
							
							}
							
							$nc = explode("|",clienterut($clienteID));
							$nombrecliente = $nc[0];
							
							if($estado=='9'){
								echo "<tr><td id='data' width='20'><a id='etiquetazul'  ><font size='4'>".$facturaID."</font></a></td><td id='data'>".$clienteID ."</td><td id='data'>".$fechafact."</td><td id='data'>$ ".$total."</td><td id='data'>".$proceso."</td></tr>";
							$i++;
										}
						else{
							echo "<tr><td id='data' width='20'><a id='etiquetazul' href='vales.php?cb=".$facturaID."'><font size='4'>".$facturaID."</font></a></td><td id='data'>".$clienteID."</td><td id='data'>".$fechafact."</td><td id='data'>$ ".$total."</td><td id='data'>".$proceso."</td></tr>";
							$i++;
							}
						
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
		
			<label id='subtitulo'> Vale N° <?= $cb ?></label>
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
			
			
			<tr><td id='etiqueta'> Producto</td><td id='etiqueta'> Cant.</td><td id='etiqueta' width='30' >Precio Venta</td><td id='etiqueta' width='30' >  $ Total</td></tr>
					
			<?php
			
				$find = "SELECT * FROM tbk_docpro WHERE  id_doc= ".$scodigo;
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
				
					<!--
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
					-->
					
					<!--
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
-->
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
	<td valign='top'>

			
			<label id='subtitulo'> Tipo de Documento </label>
			<p/>
			
			<fieldset>
				
				<table border='0' cellspacing='5' cellpadding='5' width='350'>
				<tr>
					<td id='etiqueta'>
						Tipo Documento
					</td>
					<td>
						<SELECT name='tipodoc' onChange='asignacodigo(boleta.tipodoc.value)'>
						<option/>
						<option value='2'> Gu&iacute;a</option>
						<option value='1'> Boleta </option>
						<option value='3'> Factura </option>
                        <option value='4'> NVF </option>

						</SELECT>
					</td>
					
				</tr>
				<tr>
					<td id='etiqueta'>
						C&oacute;digo
					</td>
					<td id='data'>
							<input type='text' name='codigodoc' value=''>
					</td>
				</tr>
				
				</table>
			</fieldset>
			
			<input type='hidden' name='paramfac' value='<?=$factura?>'>
			<input type='hidden' name='paramguia' value='<?=$guia?>'>
			<input type='hidden' name='paramboleta' value='<?=$boleta?>'>
            <input type='hidden' name='paramnvf' value='<?=$nvf?>'>
			
			<p/>

			
			<label id='subtitulo'> Estado de Cr&eacute;dito </label>
			<br/>
			<label id='menu'>  Tabla muestra  saldo de  &uacute;ltimo  cr&eacute;dito registrado</label>
			<p/>
			
			<fieldset>
			
				<table border='0' cellspacing='5' cellpadding='5' width='350'>
				<tr>
					<th id='etiqueta'> RUT</th>
					<th id='etiqueta'> SALDO CREDITO</th>
					<th id='etiqueta'> FECHA APROB.</th>
					<th id='etiqueta'> ESTADO</th>
				</tr>
			
				<?php
				
							$insert = "SELECT * FROM tbk_credito WHERE rut_cli LIKE '".trim($scliente)."' AND  estado_cre  = 1  ORDER BY SUBSTR(fecha_cre,7,4), SUBSTR(fecha_cre, 4,2)  DESC";	
							//echo $insert;
							
							if($respro = mysql_query($insert,$conn))
							{	
								
								$j=0;
								WHILE ($ficha = mysql_fetch_row($respro))
								{
									echo "<tr>";
									
									
									$campo1 		= $ficha[0];
									$campo2 		= $ficha[1];
									$campo3 		= $ficha[2];
									$campo4 		= $ficha[3];
									$campo5 		= $ficha[4];
									$campo6 		= $ficha[5];
									$campo7 		= $ficha[6];
		
									
									if ($campo7 == 1 ) $estadocredito  ="Activo";
									if ($campo7 == 0 ) $estadocredito  ="Inactivo";
									
									
									/*
									$searchcodigo = "SELECT codigo_doc FROM tbk_documento WHERE id_doc = ".$campo3;
									$rescodigo = mysql_query($searchcodigo, $conn);
									
									$fichadoc = mysql_fetch_row($rescodigo);
									
									$codigo_doc = $fichadoc[0];
									*/
									
									echo "<td id='etiqueta' width='70'>".$campo1."</td>";
									echo "</td><td id='data'> $ ".$campo3."</td><td id='data' >".$campo4."</td><td id='data'>".$estadocredito."</td>";
									echo "<td id='data' ><a href='creditoshistorial.php?ID=".$campo1."' target='_blank'><img src='images/binoculares.gif' border='0'></td>";
									echo "</tr>";
									
									$j++;
								
								}
								
							}
			
				?>
				</table>
			
			</fieldset>
			
			<p/>
			<label id='subtitulo'> Descuentos </label>
			<br/>
			<label id='menu'>  Si desea realizar un descuento al cliente, ingr&eacute;selo aqu&iacute;. Este descuento una vez aprobado no puede eliminarse. </label>
			<p/>
			
			<fieldset>
				<table border='0' cellspacing='5' cellpadding='5' width='350'>
				<tr>
				<td id='etiqueta'>
					Subtotal Vale
				</td>
				<td id='etiqueta'>
				$
				</td>
				<td id='data'>
					<input type='text' name='subtotalvale'  class='num' value='<?=$stotal?>' size='10' style='text-align:right'>
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'>
					Descuento (en %)
				</td>
				<td id='etiqueta'>
				%
				</td>
				<td id='data'>
					<input type='text' name='descuentovale' value='0' size='20' style='text-align:right'><input type='button' value='=' onClick='calculadescuento()'>
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'>
					Total Vale
				</td>
				<td id='etiqueta'>
				$
				</td>
				<td id='data'>
					<input type='text' name='totalvale' class='num' value='' size='10' style='text-align:right'>
				</td>
				</tr>
				</table>
			</fieldset>
				<p/>
		<table border='0' cellspacing='5' cellpadding='5' width='350'>
				<tr>
					<td>
					  <SELECT name='tipo' id='tipo' class="num" onChange='seleca(boleta.tipo.value)' >
					    <option value=''>   </option>
					    <option value='1'> Credito </option>
					    <option value='2'>Contado</option>
					    
					    </SELECT>
					  </td>
					
				</tr>
				
				</table>

		<input type='hidden'  disabled="disabled" name='cont' value=''>
        
			<p/>
			<label id='Subtitulo'><font size='2'> Administraci&oacute;n de Cuotas </label>
			<br/>
			<label id='menu'>   Para cancelar en efectivo el total considere una sola cuota </label>
			<p/>
			
			<fieldset>
				
				<table border='0' cellspacing='5' cellpadding='5' width='350'>

				<tr>
				<td id='etiqueta'>
					Cuotas
				</td>
				<td id='data'>
					<select name='cuotas' onChange='calcularcuota(boleta.cuotas.options.selectedIndex)'>
						<option value='0'/>
						
						<?php

									
									$nc = 24;
									$c=1;
									for($c=1; $c <= $nc; $c++)
									{
										echo "<option value='".$c."'> ".$c." </option>";
									}

								
						?>

					</select>
					<input type='text' name='valorcuota' class='num' value='' size='8' readonly ='readonly'>
				</td>
				</tr>
				<tr>
				<td id='etiqueta'>
					Primera Cuota
				</td>
				<td>
					<SELECT name='diadepago' >
						<option value='01' <?php if (date('d') == '01') echo "SELECTED" ?>>01</option>
						<option value='02' <?php if (date('d') == '02') echo "SELECTED" ?>>02</option>
						<option value='03' <?php if (date('d') == '03') echo "SELECTED" ?>>03</option>
						<option value='04' <?php if (date('d') == '04') echo "SELECTED" ?>>04</option>
						<option value='05' <?php if (date('d') == '05') echo "SELECTED" ?>>05</option>
						<option value='06' <?php if (date('d') == '06') echo "SELECTED" ?>>06</option>
						<option value='07' <?php if (date('d') == '07') echo "SELECTED" ?>>07</option>
						<option value='08' <?php if (date('d') == '08') echo "SELECTED" ?>>08</option>
						<option value='09' <?php if (date('d') == '09') echo "SELECTED" ?>>09</option>
						<option value='10' <?php if (date('d') == '10') echo "SELECTED" ?>>10</option>
						<option value='11' <?php if (date('d') == '11') echo "SELECTED" ?>>11</option>
						<option value='12' <?php if (date('d') == '12') echo "SELECTED" ?>>12</option>
						<option value='13' <?php if (date('d') == '13') echo "SELECTED" ?>>13</option>
						<option value='14' <?php if (date('d') == '14') echo "SELECTED" ?>>14</option>
						<option value='15' <?php if (date('d') == '15') echo "SELECTED" ?>>15</option>
						<option value='16' <?php if (date('d') == '16') echo "SELECTED" ?>>16</option>
						<option value='17' <?php if (date('d') == '17') echo "SELECTED" ?>>17</option>
						<option value='18' <?php if (date('d') == '18') echo "SELECTED" ?>>18</option>
						<option value='19' <?php if (date('d') == '19') echo "SELECTED" ?>>19</option>
						<option value='20' <?php if (date('d') == '20') echo "SELECTED" ?>>20</option>
						<option value='21' <?php if (date('d') == '21') echo "SELECTED" ?>>21</option>
						<option value='22' <?php if (date('d') == '22') echo "SELECTED" ?>>22</option>
						<option value='23' <?php if (date('d') == '23') echo "SELECTED" ?>>23</option>
						<option value='24' <?php if (date('d') == '24') echo "SELECTED" ?>>24</option>
						<option value='25' <?php if (date('d') == '25') echo "SELECTED" ?>>25</option>
						<option value='26' <?php if (date('d') == '26') echo "SELECTED" ?>>26</option>
						<option value='27' <?php if (date('d') == '27') echo "SELECTED" ?>>27</option>
						<option value='28' <?php if (date('d') == '28') echo "SELECTED" ?>>28</option>

					</SELECT>
					<SELECT name='mesdepago' >
						<option value='01' <?php if (date('m') == '01') echo "SELECTED" ?> >ENERO</option>
						<option value='02' <?php if (date('m') == '02') echo "SELECTED" ?>>FEBRERO</option>
						<option value='03' <?php if (date('m') == '03') echo "SELECTED" ?>>MARZO</option>
						<option value='04' <?php if (date('m') == '04') echo "SELECTED" ?>>ABRIL</option>
						<option value='05' <?php if (date('m') == '05') echo "SELECTED" ?>>MAYO</option>
						<option value='06' <?php if (date('m') == '06') echo "SELECTED" ?>>JUNIO</option>
						<option value='07' <?php if (date('m') == '07') echo "SELECTED" ?>>JULIO</option>
						<option value='08' <?php if (date('m') == '08') echo "SELECTED" ?>>AGOSTO</option>
						<option value='09' <?php if (date('m') == '09') echo "SELECTED" ?>>SEPTIEMBRE</option>
						<option value='10' <?php if (date('m') == '10') echo "SELECTED" ?>>OCTUBRE</option>
						<option value='11' <?php if (date('m') == '11') echo "SELECTED" ?>>NOVIEMBRE</option>
						<option value='12' <?php if (date('m') == '12') echo "SELECTED" ?>>DICIEMBRE</option>
					</SELECT>
					<SELECT name='aniodepago' >
					<?php
						$k=0;
						for($k=2012; $k<= 2020; $k++)
						{
							
							echo "<option value='".$k."'>".$k."</option>";
						
						}
					
					
					
					?>
					</SELECT>
				</td>
				</tr>
				</table>
				
			</fieldset>
			
			
			<p/>
			<table border='0' cellspacing='5' cellpadding='5' width='350'>
				<tr>
					<td id='etiqueta'>Forma de Pago</td>
					<td>
						<SELECT name='forma'  id='forma' >
						  <option value="0"></option>
						<option value='1'> Efectivo </option>
						<option value="2">Cheq. Al dia</option>
						<option value="3">Deposito </option>
                            <option value='4'> Vale Vista </option>
                            <option value="5">Transferencia</option>
                        </SELECT>
					</td>
					
				</tr>
				
				</table>
			<p/>
				<table border='0' width='400'>
				<tr>
				<td align='right'>
					
					<input type='reset' value='Limpiar'>
					<input type='submit' value='Aceptar' onClick='document.boleta.action = "procesavale.php"; submit();'>
				</td>
				</tr>
				</table>
	
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