<?php include("header.php")?>


<?php



function limpiar($string )
{

	$string 	= str_replace("\'","",$string); 
	
	return $string;
}



	$cb 			= $_GET['cb'];
	$see 			= $_POST['look'];


	$cpaterno		= $_POST['cpaterno'];
	$erut 			= $_POST['erut'];
	
	$boton 			= "0";
	
	
	//datos del cliente
	
	$nrut 			= $_POST['nrut'];
	$nnombre		= $_POST['nnombre'];
	$cnombre		= $_POST['cnombre'];
	$cpaterno		= $_POST['cpaterno'];
	$cmaterno		= $_POST['cmaterno'];
	$ndireccion  	= $_POST['ndireccion'];
	$nciudad 		= $_POST['nciudad'];
	$ncomuna		= $_POST['ncomuna'];
	$cregion    	= $_POST['cregion'];
	$ccodigorubro1 	= $_POST['ccodigorubro1'];
	$ccodigorubro2 	= $_POST['ccodigorubro2'];
	$nfono 			= $_POST['nfono'];
	$nemail 		= $_POST['nemail'];
	$nobs			= $_POST['nobs'];
	$ccodigorubro3 	= $_POST['ccodigorubro3'];
	
	
	if (!empty($nrut))
	{
			$cb = $nrut;
	}
	

	
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
			
					$update = "UPDATE tbk_cliente SET ";
					$update.= "nombre_cli = '".$cnombre."',";
					$update.= "paterno_cli = '".$cpaterno."',";
					$update.= "materno_cli = '".$cmaterno."',";
					$update.= "direccion_cli = '".$ndireccion."',";
					$update.= "ciudad_cli = '".$nciudad."',";
					$update.= "comuna_cli = '".$ncomuna."',";
					$update.= "region_cli = '".$cregion."',";
					$update.= "codigo_rb = '".$ccodigorubro1."',";
					$update.= "codigo2_rb = '".$ccodigorubro2."',";
					$update.= "fono_cli = '".$nfono."',";
					$update.= "email_cli = '".$nemail."',";
					$update.= "obs_cli = '".$nobs."',";
					$update.= "codigo3_rb = '".$ccodigorubro3."'";
					
					$update.= " WHERE rut_cli = '".$nrut."'";
					
					
					//echo $update;
					if ($resup = mysql_query($update, $conn))
					{
						$tipomensaje=1;
						$texto = "Ficha del Cliente  ha sido actualizado exitosamente";
						include("mensaje.php");
					
					
					}
					else
					{
						$tipomensaje=0;
						$texto = "Ficha del Cliente  no ha sido actualizado. Consulte con el administrador para mayor informaci&oacute;n";
						include("mensaje.php");
					
					
					}					
					
										
					
			
					$insert = "SELECT * FROM tbk_cliente WHERE rut_cli ='".$nrut."'";
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
			$insert = "SELECT * FROM tbk_cliente WHERE rut_cli LIKE '".trim($cb)."'";	
			if($respro = mysql_query($insert,$conn))
			{	
				$ficha[]="";
				
					
	
				$ficha = mysql_fetch_row($respro);
				
				$nrut 			= $ficha[0];
				$cnombre		= $ficha[1];
				$cpaterno 		= $ficha[2];
				$cmaterno		= $ficha[3];
				$cdireccion 	= $ficha[4];
				$ccomuna		= $ficha[5];
				$cciudad		= $ficha[6];
				$cregion		= $ficha[7];
				$ccodigorubro1  = $ficha[8];
				$ccodigorubro2  = $ficha[9];
				$cfono			= $ficha[10];
				$cemail			= $ficha[11];
				$cobs			= $ficha[12];
				$fechaingreso   = $ficha[13];
				$ccodigorubro3  = $ficha[14];

				
			
			}
	
	}

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>



<table border='0' width='800' height='300'>
<tr>
<td valign='top' >



	<form name='np' action='editarcliente.php' method ='POST'>
	
	

	<label id='subtitulo'> FICHA CLIENTE</label>
	<br/>
	<label id='comentariogris'> Datos registrados en el sistema del Cliente seleccionado.</label>
	<hr/>
	
	

	<table border='0'>
	<tr>
	<td width='400' valign='top'>
	
			<label id='subtitulo'> Clientes </label>
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
				
				<tr>
				<td>
					<label id='comentario'>por Nombre</label>
				</td>
				<td valign='top'  width='100' align='right'>
						<input type='text' name='cpaterno' value='<?=$cpaterno?>'  size='14'>						
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='np.look.value=2; np.submit()'>
				</td>
				<td />
				</tr>
					
				</table>
			
			<p/>
				

			
			<fieldset>
				<table border='0' cellspacing='5' cellpadding='5' width='450' >
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
							
							echo "<tr><td id='data' width='20'><a id='menualternativo' href='editarcliente.php?cb=".$srut."'><img src='images/flechita.gif' border='0'></a></td><td id='data' width='130'><a id='etiquetazul' href='editarcliente.php?cb=".$srut."'>".$srut."</a></td><td id='data'>".$snombre."</td><td id='data'>".$spaterno." ".substr($smaterno,0,1)."</td></tr>";
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
	</table>
	
	<P/>
	
	<!-- informacion encontrada del proveedor en cuestion -->
	
	<?php  if (!empty($cb)) :?>
	
<table border='0' width='800' height='400'>
<tr>
<td valign='top' >



	<p/>
	<table border='0'>
	<tr>
	<td width='800' valign='top' >
	
			
			
			<fieldset>
				<label id='comentario'> Datos del Cliente</label>
				<p/>
				<table border='0' cellspacing='1' cellpadding='1' width='800'>
				
				<tr>

				<td  id='data'>
						<font size='4'><?=$nrut?></font>
						<input type='hidden' name='nrut' value='<?=$nrut?>' size='15'>
				
				</td>
				<td  id='data' colspan='2'>
				
						<table border='0' width='530'>
						<tr>
						<td id = 'data'>
 								<input type='text' name='cnombre' value="<?=$cnombre?>" size='80'>
							<!--
								<input type='text' name='cpaterno' value="<?=$cpaterno?>" size='28'>
								<input type='text' name='cmaterno' value="<?=$cmaterno?>" size='28'>
							-->
 						</td>
						</tr>
						</table>
						<!-- <input type='text' name='nnombre' value='<?=limpiar($cnombre)?>' size='80'> -->
				
				</td>
				</tr>
				
				
				<tr>
				<td id='menu' > RUT</td>
				<td id='menu' colspan='2'> NOMBRES</td>
				</tr>

				<tr>
				<td  id='data'>
						<input type='text' name='ndireccion' value='<?=$cdireccion?>' size='40'>
				
				</td>
				<td  id='data'>
						<input type='text' name='nciudad' value='<?=$cciudad?>' size='40'>
				
				</td>
				<td  id='data'>
						<input type='text' name='ncomuna' value='<?=$ccomuna?>' size='40'>
				
				</td>

				</tr>
				
				<tr>
				<td id='menu' > DIRECCION</td>
				<td id='menu' > CIUDAD</td>
				<td id='menu' > COMUNA</td>

				</tr>
				
				<tr>
				<td  id='data'>
						<SELECT name='cregion'>
							<option/>
							
							<option value='15' <? if($cregion == 15) echo "SELECTED"?>>ARICA Y PARINACOTA</option>
							<option value='1'  <? if($cregion == 1) echo "SELECTED"?>>TARAPACÁ</option>
							<option value='2'  <? if($cregion == 2) echo "SELECTED"?>>ANTOFAGASTA</option>
							<option value='3'  <? if($cregion == 3) echo "SELECTED"?>>ATACAMA</option>
							<option value='4'  <? if($cregion == 4) echo "SELECTED"?>>COQUIMBO</option>
							<option value='5'  <? if($cregion == 5) echo "SELECTED"?>>VALPARAISO</option>
							<option value='13'  <? if($cregion == 13) echo "SELECTED"?>>METROPOLITANA</option>
							<option value='6'  <? if($cregion == 6) echo "SELECTED"?>>LIBERTADOR BERNARDO O'HIGGINS</option>
							<option value='7'  <? if($cregion == 7) echo "SELECTED"?>>MAULE</option>
							<option value='8'  <? if($cregion == 8) echo "SELECTED"?>>BIOBIO</option>
							<option value='9'  <? if($cregion == 9) echo "SELECTED"?>>ARAUCANIA</option>
							<option value='14'  <? if($cregion == 14) echo "SELECTED"?>>LOS RIOS</option>
							<option value='10'  <? if($cregion == 10) echo "SELECTED"?>>LOS LAGOS</option>
							<option value='11'  <? if($cregion == 11) echo "SELECTED"?>>AISEN Y GRAL C. IBA&Ntlilde;EZ DEL CAMPO</option>
							<option value='12'  <? if($cregion == 12) echo "SELECTED"?>>MAGALLANES Y ANTARTICA CHILENA</option>
							
						</SELECT>
						
				
				</td>
				</tr>
				
				<tr>
						<td id='menu' > REGION</td>
				</tr>

				</table>
			
			</fieldset>

	</td>
	</tr>
	
	
	<tr>
	<td valign='top'>
			
			<fieldset>
			
			<label id='comentario'> Actividades del Cliente</label>
			<p/>
			
				<table border='0'  cellspacing='1' cellpadding='1' >
								
				<tr>
				<td  id='data' width='400'>
					<input type='text' name='ccodigorubro1' value='<?=$ccodigorubro1?>' size='50'>
										
				</td>
				</tr>
				<tr>
				<td id='comentario' > RUBRO 1</td>
				</tr>

				
				<td  id='comentario' >
					<input type='text' name='ccodigorubro2' value='<?=$ccodigorubro2?>' size='50'>
										
				</td>
				</tr>
				
				
				<tr>
				<td id='comentario' > RUBRO 2</td>
				</tr>

				
				<tr>
				<td  id='data' >
					<input type='text' name='ccodigorubro3' value='<?=$ccodigorubro3?>' size='50'>
				</td>
				</tr>
				
				
				<tr>
					<td id='comentario'> RUBRO 3</td>
				</tr>
				
				
				<!--
				<tr>
				<td id='etiqueta'>
						BANCO
				</td>
				<td  id='data'>
						<SELECT name='cbanco1'> 
						<option value=0 />
						<option value=1 <? if($cbanco1 == '1') echo "SELECTED"?>>ABN AMRO</option>
						<option value=2 <? if($cbanco1 == '2') echo "SELECTED"?>>Atlas - Citibank</option>
						<option value=3 <? if($cbanco1 == '3') echo "SELECTED"?>>BancaFacil - Sitio de educación bancaria</option>
						<option value=4 <? if($cbanco1 == '4') echo "SELECTED"?>>Banco Bice</option>
						<option value=5 <? if($cbanco1 == '5') echo "SELECTED"?>>Banco Central de Chile</option>
						<option value=6 <? if($cbanco1 == '6') echo "SELECTED"?>>Banco de Chile</option>
						<option value=7 <? if($cbanco1 == '7') echo "SELECTED"?>>Banco de Crédito e Inversiones</option>
						<option value=8 <? if($cbanco1 == '8') echo "SELECTED"?>>Banco del Desarrollo</option>
						<option value=9 <? if($cbanco1 == '9') echo "SELECTED"?>>Banco del Desarrollo - Asesoría Financiera</option>
						<option value=10 <? if($cbanco1 == '10') echo "SELECTED"?>>Banco Edwards</option>
						<option value=11 <? if($cbanco1 == '11') echo "SELECTED"?>>Banco Falabella</option>
						<option value=12 <? if($cbanco1 == '12') echo "SELECTED"?>>Banco Internacional</option>
						<option value=13 <? if($cbanco1 == '13') echo "SELECTED"?>>Banco Nova</option>
						<option value=14 <? if($cbanco1 == '14') echo "SELECTED"?>>Banco Penta</option>
						<option value=15 <? if($cbanco1 == '15') echo "SELECTED"?>>Banco Santander Santiago</option>
						<option value=16 <? if($cbanco1 == '16') echo "SELECTED"?>>Banco Security</option>
						<option value=17 <? if($cbanco1 == '17') echo "SELECTED"?>>BancoEstado</option>
						<option value=18 <? if($cbanco1 == '18') echo "SELECTED"?>>BBVA</option>
						<option value=19 <? if($cbanco1 == '19') echo "SELECTED"?>>Citibank N.A. Chile</option>
						<option value=20 <? if($cbanco1 == '20') echo "SELECTED"?>>Corpbanca</option>
						<option value=21 <? if($cbanco1 == '21') echo "SELECTED"?>>Credichile</option>
						<option value=22 <? if($cbanco1 == '22') echo "SELECTED"?>>Credit Suisse Consultas y Asesorias Ltda</option>
						<option value=23 <? if($cbanco1 == '23') echo "SELECTED"?>>Deutsche Bank</option>
						<option value=24 <? if($cbanco1 == '24') echo "SELECTED"?>>ING Bank N.V.</option>
						<option value=25 <? if($cbanco1 == '25') echo "SELECTED"?>>Redbanc</option>
						<option value=26 <? if($cbanco1 == '26') echo "SELECTED"?>>Santander Banefe</option>
						<option value=27 <? if($cbanco1 == '27') echo "SELECTED"?>>Scotiabank Sud Americano</option>
						<option value=28 <? if($cbanco1 == '28') echo "SELECTED"?>>Scotiabank Sud Americano</option>
						<option value=29 <? if($cbanco1 == '29') echo "SELECTED"?>>UBS AG in Santiago de Chile</option>
					</SELECT>
					Opcional					
				</td>
				</tr>
				-->
			
				
				<!-- cuenta corriente 2 -->
				<!--
				<tr>
				<td id='etiqueta'>
						BANCO
				</td>
				<td  id='data'>
					<SELECT name='cbanco2'> 
						<option value=0 />
						<option value=1 <? if($cbanco2 == '1') echo "SELECTED"?>>ABN AMRO</option>
						<option value=2 <? if($cbanco2 == '2') echo "SELECTED"?>>Atlas - Citibank</option>
						<option value=3 <? if($cbanco2 == '3') echo "SELECTED"?>>BancaFacil - Sitio de educación bancaria</option>
						<option value=4 <? if($cbanco2 == '4') echo "SELECTED"?>>Banco Bice</option>
						<option value=5 <? if($cbanco2 == '5') echo "SELECTED"?>>Banco Central de Chile</option>
						<option value=6 <? if($cbanco2 == '6') echo "SELECTED"?>>Banco de Chile</option>
						<option value=7 <? if($cbanco2 == '7') echo "SELECTED"?>>Banco de Crédito e Inversiones</option>
						<option value=8 <? if($cbanco2 == '8') echo "SELECTED"?>>Banco del Desarrollo</option>
						<option value=9 <? if($cbanco2 == '9') echo "SELECTED"?>>Banco del Desarrollo - Asesoría Financiera</option>
						<option value=10 <? if($cbanco2 == '10') echo "SELECTED"?>>Banco Edwards</option>
						<option value=11 <? if($cbanco2 == '11') echo "SELECTED"?>>Banco Falabella</option>
						<option value=12 <? if($cbanco2 == '12') echo "SELECTED"?>>Banco Internacional</option>
						<option value=13 <? if($cbanco2 == '13') echo "SELECTED"?>>Banco Nova</option>
						<option value=14 <? if($cbanco2 == '14') echo "SELECTED"?>>Banco Penta</option>
						<option value=15 <? if($cbanco2 == '15') echo "SELECTED"?>>Banco Santander Santiago</option>
						<option value=16 <? if($cbanco2 == '16') echo "SELECTED"?>>Banco Security</option>
						<option value=17 <? if($cbanco2 == '17') echo "SELECTED"?>>BancoEstado</option>
						<option value=18 <? if($cbanco2 == '18') echo "SELECTED"?>>BBVA</option>
						<option value=19 <? if($cbanco2 == '19') echo "SELECTED"?>>Citibank N.A. Chile</option>
						<option value=20 <? if($cbanco2 == '20') echo "SELECTED"?>>Corpbanca</option>
						<option value=21 <? if($cbanco2 == '21') echo "SELECTED"?>>Credichile</option>
						<option value=22 <? if($cbanco2 == '22') echo "SELECTED"?>>Credit Suisse Consultas y Asesorias Ltda</option>
						<option value=23 <? if($cbanco2 == '23') echo "SELECTED"?>>Deutsche Bank</option>
						<option value=24 <? if($cbanco2 == '24') echo "SELECTED"?>>ING Bank N.V.</option>
						<option value=25 <? if($cbanco2 == '25') echo "SELECTED"?>>Redbanc</option>
						<option value=26 <? if($cbanco2 == '26') echo "SELECTED"?>>Santander Banefe</option>
						<option value=27 <? if($cbanco2 == '27') echo "SELECTED"?>>Scotiabank Sud Americano</option>
						<option value=28 <? if($cbanco2 == '28') echo "SELECTED"?>>Scotiabank Sud Americano</option>
						<option value=29 <? if($cbanco2 == '29') echo "SELECTED"?>>UBS AG in Santiago de Chile</option>
					</SELECT>
					Opcional					
				</td>
				</tr>
				
				
				
				<tr>
				<td id='etiqueta'>
						CUENTA2  N°
				</td>
				<td  id='data' >
						<input type='text' name='cnumerocuenta2' value='<?=$cnumerocuenta2?>' size='30'>
						Opcional				
				</td>
				</tr>
				
				-->
				</table>
			
			
			</fieldset>
	</td>
	</tr>
	
	
	<tr>
	<td>
			<fieldset>		
				<label id='comentario'> Informaci&oacute;n de Contacto</label>
				<p/>
			
				<table border='0' width='800' cellspacing='1' cellpadding='1' >
				<tr>
				<td id='comentario'>
						<input type='text' name='nfono' value='<?=$cfono?>' size='60'> 
				
				</td>
				<td id='comentario'>
						<input type='text' name='nemail' value='<?=$cemail?>' size='60'>
				
				</td>
				</tr>
				
				<tr>
				<td id='comentario' > TELEFONO (Opcional)</td>
				<td id='comentario' > EMAIL (Opcional)</td>
				
				</tr>

				
				<tr>
				<td id='comentario' colspan='2'>&nbsp;</td>
				</tr>
				
				<tr>
				<td id='comentario' > OBSERVACIONES</td>
				
				</tr>

				</table>
			
			</fieldset>
			
			
	</td>
	</tr>
	</table>
	
	<table border='0'>
	<tr>
	<td>
	
			<table border='0' width='800'>
			<tr>
			<td align='right'>
					<textarea name='nobs'  rows='3' cols='125'><?=$cobs?>
					</textarea>
					<table border='0'>
					<tr>
					<td>
						
						
						<input type='button' value='Aceptar' onClick="np.look.value=3; submit()">
					</td>
					</tr>
					</table>
				
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
	
			<table border='0' width='800'>
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
	</form>





</td>
</tr>
</table>


<?php include("footer.php")?>