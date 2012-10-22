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
	$delete		=$_POST['delete'];
	
	$cpaterno		= $_POST['cpaterno'];
	$erut 			= $_POST['erut'];
	
	$boton 		= "0";
	

	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert ="SELECT *, MATCH(rut_pv,nombre_pv) AGAINST('".trim($erut)."') FROM tbk_proveedor WHERE MATCH(rut_pv,nombre_pv) AGAINST('".trim($erut)."')";
					//$insert = "SELECT * FROM tbk_proveedor WHERE rut_pv LIKE '".trim($erut)."%'";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_proveedor WHERE nombre_pv LIKE '".trim($cpaterno)."%'";
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
			$insert = "SELECT * FROM tbk_proveedor WHERE rut_pv LIKE '".trim($cb)."'";	
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
				$ccomuna		= $ficha[6];
				$cregion		= $ficha[7];
				$cpnombre		= $ficha[8];
				$cfono			= $ficha[9];
				$cemail			= $ficha[10];
				$ccodigorubro   = $ficha[11];
				$ccodigorubro2  = $ficha[12];
				$cbanco1		= $ficha[13];
				$cnumerocuenta1 = $ficha[14];
				$cbanco2		= $ficha[15];
				$cnumerocuenta2 = $ficha[16];
				$cobs			= $ficha[17];
				$fechaingreso   = $ficha[18];
				$ccodigorubro3  = $ficha[19];
			
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
				
				$update = "UPDATE tbk_proveedor SET ";
				$update.= "nombre_pv = '".limpiar($cnombre)."', ";
				$update.= "paterno_pv = '".limpiar($cpaterno)."', ";
				$update.= "materno_pv = '".limpiar($cmaterno)."', ";
				$update.= "direccion_pv = '".limpiar($cdireccion)."', ";
				$update.= "ciudad_pv = '".limpiar($cciudad)."', ";
				$update.= "comuna_pv = '".limpiar($ccomuna)."', ";
				$update.= "region_pv = '".limpiar($cregion)."', ";
				$update.= "contacto_pv = '".limpiar($cpnombre)."', ";
				$update.= "fono_pv = '".$cfono."', ";
				$update.= "email_pv = '".limpiar($cemail)."', ";
				$update.= "codigo_rb = '".limpiar($ccodigorubro)."', ";
				$update.= "codigo2_rb = '".limpiar($ccodigorubro2)."', ";
				$update.= "banco1_pv = '".limpiar($cbanco1)."', ";
				$update.= "cuenta1_pv = '".limpiar($cnumerocuenta1)."', ";
				$update.= "banco2_pv = '".limpiar($cbanco2)."', ";
				$update.= "cuenta2_pv = '".limpiar($cnumerocuenta2)."', ";
				$update.= "obs_pv = '".limpiar($cobs)."', ";
				$update.= "codigo3_rb = '".limpiar($ccodigorubro3)."' ";
				
				$update.= " WHERE rut_pv ='".$cb."'";
				
				//echo "UPDATE=".$update;
				
				if ($resup = mysql_query($update, $conn))
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
	if($see==9){
	
				$insert ="DELETE FROM tbk_proveedor WHERE rut_pv = '".$nrut."' ";
						if ($resup = mysql_query($insert, $conn))
				 {
					$tipomensaje=1;
						$texto = "Ficha del Proveedor  ha sido Borrado exitosamente ".$nrut."";
						include("mensaje.php");}
echo"$insert";
	}

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>



<table border='0' width='890' height='300'>
<tr>
<td valign='top' >

	<p/>

	<form name='np' action='borrarproveedor.php' method ='POST'>
	
	

	<label id='subtitulo'> FICHA PROVEEDOR</label>
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
					<label id='comentario'>Buscar por Nombre/R.U.T.</label>
				</td>
				<td valign='top' align='right' width='100'>
						<input type='text' name='erut' value='<?=limpiar($erut)?>' size='14' >
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='np.look.value=1; np.submit()'>
				</td>
				</tr>
				
				
				</tr>
					
				</table>
			
			<p/>
           
	<?php	if (!empty($cb)) : ?>
            
			<td valign ='top' align='right' width='430'>
	
	
			<label id='subtitulo'> ¿Está seguro que desea Borrar a este Proveedor? <?=$cb?></label>
			<p/>
			
				<table border='0' cellspacing='5' cellpadding='5'>
				<tr>
				<td id='data' valign='bottom' align='center'>
						<a  id='menualternativo' href='home.php'><img src="images/logos/cancelar0.jpg" onmouseover="this.src = 'images/logos/cancelar1.jpg'" onmouseout="this.src = 'images/logos/cancelar0.jpg'" border="0"></img></a><br/>
				</td>
				<td id='data' valign='bottom'  align='center'>
						<a id='menu' href='borrarproveedor.php?delete=<?php echo"$cb"?>' onClick='np.look.value="9"; submit()'><img src="images/logos/aceptar0.jpg" onmouseover="this.src = 'images/logos/aceptar1.jpg'" onmouseout="this.src = 'images/logos/aceptar0.jpg'" border="0"></img></a>
				</td>

				</tr>
				</table>
                    </td>
                    <?php endif ?>
	
			
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
							
							echo "<tr><td id='data' width='20'><a id='menualternativo' href='borrarproveedor.php?cb=".$srut."'><img src='images/flechita.gif' border='0'></a></td><td id='data' width='100'><a id='etiquetazul' href='borrarproveedor.php?cb=".$srut."'>".$srut."</a></td><td id='data'>".$snombre."</td><td id='data'>".$spaterno." ".substr($smaterno,0,1)."</td></tr>";
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
	
<table border='0' width='800' height='400'>
<tr>
<td valign='top' >



	<p/>
	<table border='0'>
	<tr>
	<td width='400' valign='top' >
	
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
				
				
				
				
				
				<p/>
				<label id='subtitulo'> Ubicaci&oacute;n</label>
				<p/>
			
				<fieldset>
				
				<table border='0' cellspacing='5' cellpadding='5' height='170' width='400'>
				<tr>
				<td id='etiqueta' width='100'>
						Direcci&oacute;n
				</td>
				<td  id='data'>
						<input type='text' name='cdireccion' value='<?=$cdireccion?>' size='40'>
				
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta' width='100'>
						Ciudad
				</td>
				<td  id='data'>
						<input type='text' name='cciudad' value='<?=$cciudad?>' size='40'>
				
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'>
						Comuna
				</td>
				<td  id='data'>
						<input type='text' name='ccomuna' value='<?=$ccomuna?>' size='40'>
				
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'>
						Regi&oacute;n
				</td>
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
				


				</table>
			
			</fieldset>
            

	</td>
	<td width='400' valign='top'>
	
			<label id='subtitulo'>Datos Comerciales</label>
			<p/>
			
			<fieldset>
				<table border='0' width='450' cellspacing='5' cellpadding='5' >
								
				<tr>
				<td id='etiqueta' width='80'>
						ACTIVIDAD COMERCIAL
				</td>
				<td  id='data' width='400'>
					<input type='text' name='ccodigorubro' value='<?=$ccodigorubro?>' size='50'>
										
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta' width='80'>
						ACTIVIDAD COMERCIAL 2
				</td>
				<td  id='data' width='400'>
					<input type='text' name='ccodigorubro2' value='<?=$ccodigorubro2?>' size='50'>
										
				</td>
				</tr>
				
								
				<tr>
				<td id='etiqueta' width='80'>
						ACTIVIDAD COMERCIAL 3
						
				<td  id='data' width='400'>
					<input type='text' name='ccodigorubro3' value='<?=$ccodigorubro3?>' size='50'>
				</td>
				</tr>
				
				
				
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
				
				
				
				<tr>
				<td id='etiqueta'>
						CUENTA N°
				</td>
				<td id='data'>
						<input type='text' name='cnumerocuenta1' value='<?=$cnumerocuenta1?>' size='30'>
						Opcional				
				</td>
				</tr>
				
				<!-- cuenta corriente 2 -->
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
				</table>
			
			
			</fieldset>
			
			
			<p/>
			<label id='subtitulo'> Contacto Proveedor</label>
			<p/>
			<fieldset>		
			
				<table border='0' width='450' cellspacing='5' cellpadding='5' >
				
				<tr>
				<td id='etiqueta' >
						Nombre
				</td>
				<td id='data'>
						<input type='text' name='cpnombre' value='<?=$cpnombre?>' size='30'> Opcional
				
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta' width='100'>
						Tel&eacute;fono
				</td>
				<td id='data'>
						<input type='text' name='cfono' value='<?=$cfono?>' size='30'> Opcional
				
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'>
						Email
				</td>
				<td id='data'>
						<input type='text' name='cemail' value='<?=$cemail?>' size='30'> Opcional
				
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'>
						Observaciones
				</td>
				<td id='data'>
						<textarea name='cobs'  rows='3' cols='29'><?=$cobs?></textarea> Opcional
				
				</td>
				</tr>
				</table>
			
			</fieldset>
			
			
			
			
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