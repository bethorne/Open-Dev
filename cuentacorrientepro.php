<?php include("header.php")?>


<?php



function limpiar($string )
{

	$string 	= str_replace("\'","",$string); 
	$string 	= str_replace(",","",$string); 
	
	return $string;
}



	$cb 		= $_GET['cb'];
	$see 		= $_POST['look'];


	$cpaterno		= $_POST['cpaterno'];
	$erut 			= $_POST['erut'];
	
	$boton 		= "0";
	

	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert = "SELECT *, MATCH(rut_pv,nombre_pv) AGAINST('".trim($erut)."') FROM tbk_proveedor WHERE MATCH(rut_pv,nombre_pv) AGAINST('".trim($erut)."')";
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
			$insert = " SELECT * FROM tbk_proveedor WHERE rut_pv LIKE'".trim($cb)."'";	
			if($respro = mysql_query($insert,$conn))
			{	
				$ficha[]="";
				
			
				$ficha = mysql_fetch_row($respro);
				
				$nrut 			= $ficha[0];
				$cnombre		= $ficha[1];
				$cpaterno 		= $ficha[2];
				$cmaterno		= $ficha[3];
				$cdireccion 	= $ficha[4];
				$cciudad 		= $ficha[5];
				$cregion		= $ficha[6];
				
			
			}
	
	}
	
	if ($see == '3')
	{
				$cb 			= $_POST['nrut'];
				$nrut 			= $_POST['nrut'];
				$cnombre		= $_POST['cnombre'];
				$cpaterno 		= $_POST['cpaterno'];
				$cmaterno		= $_POST['cmaterno'];
				$cdireccion 	= $_POST['cdireccion'];
				$cciudad	 	= $_POST['cciudad'];
				$ccomuna		= $_POST['ccomuna'];
				$cregion		= $_POST['cregion'];
				$cpnombre		= $_POST['cpnombre'];
				$cfono			= $_POST['cfono'];
				$cemail			= $_POST['cemail'];
				$ccodigorubro   = $_POST['ccodigorubro'];
				$ccodigorubro2  = $_POST['ccodigorubro2'];
				$cbanco1		= $_POST['cbanco1'];
				$cnumerocuenta1 = $_POST['cnumerocuenta1'];
				$cbanco2		= $_POST['cbanco2'];
				$cnumerocuenta2 = $_POST['cnumerocuenta2'];
				$cobs			= $_POST['cobs'];
				$fechaingreso   = $_POST['fechaingreso'];
				$ccodigorubro3  = $_POST['ccodigorubro3'];
				
				 
				
				//echo "UPDATE=".$update;
				
				if ($resup = mysql_query($insert, $conn))
				{
						$tipomensaje=1;
						$texto = "Ficha del Proveedor  ha sido actualizado exitosamente";
						include("mensaje.php");
					
					
				}
				else
				{
						$tipomensaje=0;
						$texto = "Ficha del Proveedor  no ha sido actualizada. Contacte al administrador para m&aacute;s informaci&oacute;n.";
						include("mensaje.php");
					
					
				}
	
	
	
	
	
	}

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>



<table border='0' width='890' height='300'>
<tr>
<td valign='top' >

	<p/>

	<form name='np' action='cuentacorrientepro.php' method ='POST'>
	
	

	<label id='subtitulo'> CARTOLA CUENTA CORRIENTE PROVEEDOR</label>
	<br/>
	<label id='comentariogris'> Complete todos los campos para ingresar el registro.</label>
	<hr/>
	
	

	<table border='0'>
	<tr>
	<td width='400' valign='top'>
	
			<label id='subtitulo'> Listar Proveedores </label>
			<p/>
			
			
				<table border='0' cellspacing='5' cellpadding='5' width='430' background='images/logos/fondo_menu.jpg'>
				<tr>
				<td>
					<label id='comentario'>por rut</label>
				</td>
				<td valign='top' align='right' width='100'>
						<input type='text' name='erut' value='<?=limpiar($erut)?>' size='14' >
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='np.look.value=1; np.submit()'>
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
							$snombre = $row[1];
							$srut = $row[0];
							$spaterno  = $row[2];
							$smaterno = $row[3];
							$sdireccion = $row[4];
							$scomuna = $row[5];
							
							$snnombre = $snombre." ".$spaterno." ".$smaterno;
							
							$sdirecciontotal = $sdireccion." ".$scomuna;
							
							echo "<tr><td id='data' width='20'><a id='menualternativo' href='cuentacorrientepro.php?cb=".$srut."'><img src='images/flechita.gif' border='0'></a></td><td id='data' width='100'><a id='etiquetazul' href='editarproveedor.php?cb=".$srut."'>".$srut."</a></td><td id='data'>".$snombre."</td><td id='data'>".$spaterno." ".substr($smaterno,0,1)."</td></tr>";
							$i++;
						}
					}
					else
					{
						//echo "<tr><td id='etiqueta'>Recuerde colocar s&oacute;lo letras y n&uacute;meros</td></tr>";
					}
				
				
				?>
				
					</table>
			
			</fieldset>
			
			<p/>
			
			
	</td>
		</tr>
	</table>
	
	<P/>
	
	<!-- informacion encontrada del proveedor en cuestion -->
	
	<?php  if (!empty($cb)) :?>
	
<table border='0' >
<tr>
<td valign='top' >



	<p/>
	<table border='0'>
	<tr>
	<td width='800' height='400' valign='top' >
	
			<label id='subtitulo'> Datos Proveedor</label>
			<p/>
			
			<fieldset>
			
				<table border='0' cellspacing='5' cellpadding='5' height='170' width='400'>
				
				<tr>
				<td id='etiqueta' width='100'>
						RUT
				</td>
				<td  id='data'>
						<input type='text' class='num' name='nrut' value='<?=$nrut?>' size='15' readonly ="readonly">
				
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'>
						Nombre/<br/>
						Raz&oacute;n Social
				</td>
				<td  id='data'>
						<input type='text' name='cnombre' value='<?=limpiar($cnombre)?>' size='40'>
				
				</td>
				</tr>

		

				</table>
				
				</fieldset>
				<label id='subtitulo'>Informe de cuenta </label>
			<p/>
			
			<fieldset>
				<table  width='800' cellspacing='5' cellpadding='5' >
						 <tr>
			    <td width="100" id='etiqueta'  >Tipo Doc</td>
			    <td width="65" id='etiqueta' >Compra</td>
			    <td width="50" id='etiqueta' >N Doc.</td>
			    <td width="110" id='etiqueta' >Fecha Compra</td>
			    <td width="95" id='etiqueta' >Total Compra</td>
			    <td width="95" id='etiqueta' >Fecha de Cancelacion</td>
			    <td width="80" id='etiqueta' >Banco</td>
                 <td width="69" id='etiqueta' >Forma Pago</td>
			    
			    </tr>		
				
				</table>
				<table  width='800' cellspacing='5' cellpadding='5' >
						 
                         <?php
						 
					
						 $i=0;
					 
								
						 $deud ="SELECT  d.tipo_docc, d.fecha_docc, d.codigo_docc, d.fcpago, d.fecha_pago,d.id_docc,d.total_docc,d.pago1,d.bancocheque
								FROM tbk_documentocompra d, tbk_proveedor p
								WHERE d.rut_cli = p.rut_pv
								AND d.rut_cli LIKE '".trim($nrut)."'";
 					 	//echo"$deud";
					if ($resf = mysql_query($deud, $conn))
				{
				
					
					$i=0;
					WHILE ($row = mysql_fetch_row($resf))
					{
						 
							$stipo = $row[0];
							$sfecha = $row[1];
							$scodigo  = $row[2];
							$sfpago = $row[3];
							$sfechapao= $row[4];
							$iddocc = $row[5];
							$total_com = $row[6];
							$pago1=$row[7];
							$banco=$row[8];
							
				 
					SWITCH($pago1)
					{
					CASE '1' : $pago1 = "Efectivo"; break;
					CASE '2' : $pago1 = "RedCompra"; break;
					CASE '3' : $pago1 = "Cheque"; break;
					CASE '4' : $pago1 = "Transf. Electr&oacute;nica"; break;
					}
							 
					SWITCH($banco)
					{
							CASE '1' : $banco  = "ABN AMRO"; break;
								CASE '2' : $banco  = "Atlas - Citibank"; break;
								CASE '3' : $banco  = "BancaFacil - Sitio de educación bancaria"; break;
								CASE '4' : $banco  = "Banco Bice"; break;
								CASE '5' : $banco  = "Banco Central de Chile"; break;
								CASE '6' : $banco  = "Banco de Chile"; break;
								CASE '7' : $banco  = "Banco de Crédito e Inversiones"; break;
								CASE '8' : $banco  = "Banco del Desarrollo"; break;
								CASE '9' : $banco  = "Banco del Desarrollo - Asesoría Financiera"; break;
								CASE '10' : $banco  = "Banco Edwards"; break;
								CASE '11' : $banco  = "Banco Falabella"; break;
								CASE '12' : $banco  = "Banco Internacional"; break;
								CASE '13' : $banco  = "Banco Nova"; break;
								CASE '14' : $banco  = "Banco Penta"; break;
								CASE '15' : $banco  = "Banco Santander Santiago"; break;
								CASE '16' : $banco  = "Banco Security"; break;
								CASE '17' : $banco  = "BancoEstado"; break;
								CASE '18' : $banco  = "BBVA"; break;
								CASE '19' : $banco  = "Citibank N.A. Chile"; break;
								CASE '20' : $banco  = "Corpbanca"; break;
								CASE '21' : $banco  = "Credichile"; break;
								CASE '22' : $banco  = "Credit Suisse Consultas y Asesorias Ltda"; break;
								CASE '23' : $banco  = "Deutsche Bank"; break;
								CASE '24' : $banco  = "ING Bank N.V."; break;
								CASE '25' : $banco  = "Redbanc"; break;
								CASE '26' : $banco  = "Santander Banefe"; break;
								CASE '27' : $banco  = "Scotiabank Sud Americano"; break;
								CASE '28' : $banco  = "Scotiabank Sud Americano"; break;
								CASE '29' : $banco  = "UBS AG in Santiago de Chile"; break;
					}
							 
					$documento="";
				SWITCH($stipo)
				{
					CASE '1' : $documento = "BOLETA"; break;
					CASE '2' : $documento = "GUIA"; break;
					CASE '3' : $documento = "FACTURA"; break;
					CASE '4' : $documento = "NVF"; break;
					CASE '5' : $documento = "N. CREDITO"; break;
	
				}
				SWITCH($sfpago)
				{
					CASE '1': $paga ="CREDITO";break;
					CASE '2': $paga ="CONTADO";break;
					CASE '3': $paga ="CANCELADO";break;
					
					}
							
												 ?>
                         <tr>
			    <td id ='data' width="98"><?php echo"$documento";?></td>
			    <td id='data' width="60"><?php echo"$paga"; ?></td>
			    <td id='data' width="50"><a href="verfacturacompra.php?cb=<?=$iddocc?>" target="popup"  onClick="window.open(this.href, this.target, 'width=500,height=600'); return false;"> <?php echo"$scodigo";?></a></td>
			    <td id='data' width="110"><?php echo"$sfecha";?></td>
			    <td id='data' width="95"><?php echo"$ $total_com";?></td>
			    <td id='data' width="95"><?php echo "$sfechapao"; ?></td>
			    <td id='data' width="80"><?php echo"$pago1";?></td>
                 <td id='data' width="66"><?php echo"$banco";?></td>
			    
			    </tr>		
				<?php 
							$i++;
							}
					 
				}
				?>
				</table>
		 
			</fieldset>
				<table border='0' cellspacing='5' cellpadding='5' >
					<tr>
					<td id='data' valign='bottom' align='center'>
							<a  id='menualternativo' href='cuentacorrientepro.php'><img src="images/logos/cancelar0.jpg" onmouseover="this.src = 'images/logos/cancelar1.jpg'" onmouseout="this.src = 'images/logos/cancelar0.jpg'" border="0"></img></a><br/>
					</td>
					 

					</tr>
			</table>
				
				
				 

	</td>
 
	</tr>
	</table>
					
	<?php endif ?>

	<p/>
	

	<table border='0'>
	<tr>
	<td>
	
			<table border='0' width='900'>
			<tr>
			<td align='right'>

					
					<table border='0'>
					<tr>
					<td>
						<!--//<input type='Submit' value='Aceptar' onClick='np.look.value=3; np.submit()'>-->
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


<?php include("footer.php")?>