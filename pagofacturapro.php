<?php include("header.php")?>


<?php


	include("functions.php");


	$cb 		= $_GET['cb'];
	$see 		= $_POST['look'];


	$erut 			= $_POST['erut'];
	$nrut 			= $_POST['nrut'];
	if (!empty($erut)) $codigofactura = $erut ;
	$cpaterno		= $_POST['cpaterno'];

	
	
	
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
	$abonoparte6	= $_POST['abonoparte6'];
	
	$saldocredito 	= $_POST['saldocredito'];
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
					if ($codigofactura == '')
					{
						//$insert = "SELECT * FROM tbk_documento WHERE tipo_doc = 3  AND codigo_doc <> '' AND estado_doc = 1 ORDER BY id_doc DESC";
					      $insert ="SELECT c.id_docc,c.codigo_docc, c.rut_cli, c.tipo_docc, c.fecha_docc, c.total_docc
FROM   tbk_documentocompra c
WHERE  c.tipo_docc =3
 
AND c.fcpago =1";
					// echo"$insert";
					}
					else
					{
						$insert ="SELECT * FROM tbk_documentocompra WHERE id_docc LIKE '".trim($codigofactura)."%' AND estado_docc  <= 1 AND fcpago != 3 ORDER BY id_docc DESC";
						//$insert = "SELECT * FROM tbk_documento WHERE tipo_doc = 3  AND  codigo_doc LIKE '".trim($codigofactura)."%'  AND estado_doc = 1 ORDER BY id_doc DESC";	
					//echo"$insert"; 
					}
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_documentocompra WHERE  tipo_docc = 3  AND  rut_cli LIKE '".trim($nrut)."' AND estado_docc = 1 AND fcpago != 3  ORDER BY id_docc DESC";
					break;
					
		

			case '3':
					$insert = "SELECT * FROM tbk_documentocompra WHERE tipo_docc = 3  AND  SUBSTR(fecha_docc,4,2) LIKE '%".ltrim($marca)."%' AND estado_docc = 1  ORDER BY id_docc DESC";
					break;
			
			
			case '9':
					//echo "almacenando pago de cuotas";
					
					// ahora lo que debemos hacer es repartir el abono entre las cuotas
					// las que queden completas.. se consideran pagadas
					// las siguientes. sólo abonadas y se consideran retrasadas si se vence la couta
					
					 echo "<H1> FACTURA CANCELADA </h1>";			
			// actualizar factura cancelada	
			
			//$update ="UPDATE tbk_documentocompra SET fcpago =3,fecha_pago = '".date("d-m-Y H:i:s")."' pago1='".$pago1."',bancocheque ='".$bancocheque1."' WHERE id_docc =  '".$pagofactura."' ";
			$update ="UPDATE tbk_documentocompra SET fcpago ='3',fecha_pag` =  '".date("d-m-Y H:i:s")."',pago1 ='".$pago1."',bancocheque ='".$bancocheque1."' WHERE  id_docc ='".$pagofactura."'";
			 echo "<p>".$update;
			$ressaldo = mysql_query($update, $conn);
			break;
					 
							
							  
					
					
					 
				 
						
				 
				
		}
		
		if ($facturacancelada == 1 )
		{
								
			 echo "<H1> FACTURA CANCELADA </h1>";			
			// actualizar factura cancelada	
			$update = "UPDATE tbk_docprocompra SET fcpago = 3  WHERE id_docc ='".$pagofactura."'";
			//echo "<p>".$update;
			$ressaldo = mysql_query($update, $conn);
			
			//actualizar factura
			
			
								
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
			$insert = "SELECT * FROM tbk_documentocompra WHERE id_docc LIKE '".trim($cb)."' ";	
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

	<label id='subtitulo'> PAGO DE FACTURA</label>
	<br/>
	<label id='comentariogris'> Complete uno de los campos para realizar la b&uacute;squeda. Si desea listar todos las facturas, haga click en 'buscar c&oacute;digo' con el campo vac&iacute;o.</label>
	<hr/>
	<p/>


	<form name='boleta' action='pagofacturapro.php?cb=<?=$cb?>' method ='POST'>
	

	
	<table border='0'>
	<tr>
	<td width='400' valign='top'>
	
			<label id='subtitulo'> Resultado B&uacute;queda </label>
			<p/>
			
			<fieldset>
			<!--
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
				-->
				<p/>
				
				<table border='0' cellspacing='5' cellpadding='5' width='430' background='images/logos/fondo_menu.jpg'>
				<tr>
				<td>
					<label id='comentario'>C&oacute;digo Factura</label>
				</td>
				<td valign='top' align='right' width='100'>
						<input type='text' name='erut' value='<?=limpiar($erut)?>' size='14' >
				</td>
				<td/>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='boleta.look.value=1; np.submit()'>
				</td>
				</tr>
				
				<tr>
				<td>
					<label id='comentario'>Cliente</label>
				</td>
				<td valign='top'  width='100' align='right'>
						<input type='text' name='nrut' value='<?=$nrut?>'  size='14'>						
				</td>
				<td>
						<a  href="buscarclientefact.php" target="popup"  onClick="window.open(this.href, this.target, 'width=500,height=400'); return false;"><img src='images/buscarcliente.png' border='0'></a>
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='boleta.look.value=2; np.submit()'>
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
						//echo "<p/>".$insert;
						
						While ($row = mysql_fetch_row($res))
						{
							$facturaID = $row[0];
							$clienteID = $row[2];
							$tipodoc	= $row[3];
							$fechafact = $row[4];
							$total  = $row[5];
							$estado = $row[6];
							$codigodoc = $row[1];
							
							if ($tipodoc == 1) $folio = "Boleta";
							if ($tipodoc == 2) $folio = "Gu&iacute;a de Venta";
							if ($tipodoc == 3) $folio = "Factura";
							
							$proceso ="";
							SWITCH($estado)
							{
								case '1' : $proceso = "P"; break;
								case '0' : $proceso = "C"; break;
							
							
							
							}
							
							echo "<tr><td id='data' width='20'><a id='etiquetazul' href='pagofacturapro.php?cb=".$facturaID."'><font size='4'>".$codigodoc."</font></a></td><td id='data'>".proveedorrut($clienteID)."</td><td id='etiqueta'>".$folio."</td><td id='data'>".$fechafact."</td><td id='data'>$ ".$total."</td></tr>";
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
			
				$find = "SELECT * FROM tbk_documentocompra WHERE  id_docc = ".$scodigo;
				if ($resst = mysql_query($find, $conn))
				{
				
					$ficha3 = mysql_fetch_row($resst);
					
					$f3cliente 		= $ficha3[1];
					//$f3total		= $ficha3[2];
					$f3tipodepago 	= $ficha3[3];
				//	$f3cuotas 		= $ficha3[4];
					$f3valorcuota 	= $ficha3[4];
				//	$f3diadepago    = $ficha3[6];
					$f3fecha 		= $ficha3[3];
					
					$f3total 		= $f3valorcuota;
					
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
						   <a  href="verfacturacompra.php?cb=<?=$cb?>" target="popup"  onClick="window.open(this.href, this.target, 'width=500,height=600'); return false;"><img src='images/binoculares.gif' border='0'></a>  
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
					
					
					
					<!-- notas de debito o credito asociadas -->
					<?php
					
						$nfilas = 0;
						$buscanotas  = "SELECT id_nota, fecha_nota, total FROM tbk_nota WHERE id_fact ='".$scodigo."'";
						if ($resnotas  = mysql_query($buscanotas, $conn))
						{
							$nfilas = mysql_num_rows($resnotas);
							if ($nfilas > 0)
							{
								echo "<fieldset>";
								echo "<table border='0' cellspacing='5' cellpadding='5'   width='800' >";
								echo "<tr>";
								echo "<th id='etiqueta' width='100'> Nota de D&eacute;bito</th>";
								echo "<th id='etiqueta' > Cuotas </th>";
								echo "<th id='etiqueta' > Valor Cuota </th>";
								echo "<th id='etiqueta' > Fecha Nota </th>";
								echo "<th id='etiqueta'  width='190'> TOTAL </th>";
								
								
								echo "</tr>";
								$i=0;
								WHILE ($note = mysql_fetch_row($resnotas))
								{
									$idnota = $note[0];
									$fechanota = $note[1];
									$totalnota = $note[2];
									
									echo "<tr>";
									echo "<td id='data' align='center'>".$idnota."</td>";
									echo "<td id='data' />";
									echo "<td id='data' />";
									echo "<td id='data' align='right'><label id='comentario'>".$fechanota."</label></td>";
									
									echo "<td id='data' align='right'><label id='comentario'><font size='4'>$ ".$totalnota."</font></label></td>";
									echo "</tr>";
									

									$i++;
								}
								echo "</table>";
								echo "</fieldset>";
							}
						}
					
					?>
					
					
					
					<!-- ------------------------------------------------------------------------------------ -->
					
					
					<!-- Cuotas pagadas -->
					
					
					
					<p/>
					<p/>
					
					
					
					
					
					<!-- monto adeudado  -->
					
					<p/>
					<label id='subtitulo'>Forma de Pago </label>
					<p/>
			
					<fieldset>
					<table border='0' cellspacing='2' cellpadding='2' width='800'>

						
						<tr>
						<td align='right'>
							<table border='0'  cellspacing='2' cellpadding='2' width='800'>
							<tr>
								<td id='etiqueta'>FORMA DE PAGO</td>
								<td id='etiqueta'>TIPO DE PAGO</td>
								<td id='etiqueta'></td>
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
								<input type='text' name='abonoparte6' value='<?=$saldoactualizar ?>'  size='15' readonly='readonly' >  
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
									<input type='hidden' name='FFID' value='<?=$cb?>'><input type='hidden' name='FUID' value='<?=$frut?>'> <input type='hidden' name='FFECHA' value='<?=date('d-m-Y H:i')?>'>
									<input type='Reset' value='Limpiar Formulario'>
									<input type='Submit' value='Aceptar Pago' onClick='boleta.look.value=9'>
									
								</td>
								</tr>
								</table>
								
						</td>
						</tr>
						
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