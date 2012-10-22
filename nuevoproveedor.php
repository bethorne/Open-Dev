<?php include("header.php")?>


<?php

function limpiar($string )
{
	$string = str_replace("\'","",$string); 
	return $string;
}


	$nrut 			= str_replace(".","",$_POST['nrut']) ;
	$cnombre		= $_POST['cnombre'];
	$cpaterno 		= $_POST['cpaterno'];
	$cmaterno		= $_POST['cmaterno'];
	$cdireccion 	= $_POST['cdireccion'];
	$cciudad	 	= $_POST['cciudad'];
	$ccomuna		= $_POST['ccomuna'];
	$cregion		= $_POST['cregion'];
	$cpnombre		= $_POST['cpnombre'];
	$cfono			= $_POST['cfono'];
	$ccodigorubro   = $_POST['ccodigorubro'];
	$ccodigorubro2  = $_POST['ccodigorubro2'];
	$ccodigorubro3  = $_POST['ccodigorubro3'];
	$cemail			= $_POST['cemail'];
	$cbanco1		= $_POST['cbanco1'];
	$cnumerocuenta1 = $_POST['cnumerocuenta1'];
	$cbanco2		= $_POST['cbanco2'];
	$cnumerocuenta2 = $_POST['cnumerocuenta2'];
	$cobs 			= $_POST['cobs'];
	$fechahoy		= date('d-m-Y');
	
	$boton = "0";
	

	
	if (!empty($cnombre))
	{
		include("conector/conector.php");
		
		$insert = "INSERT INTO tbk_proveedor VALUES(";
		
		$insert.= "'".limpiar($nrut)."',";
		$insert.= "'".limpiar($cnombre)."',";
		$insert.= "'".limpiar($cpaterno)."',";
		$insert.= "'".limpiar($cmaterno)."',";
		$insert.= "'".limpiar($cdireccion)."',";
		$insert.= "'".limpiar($cciudad)."',";
		$insert.= "'".limpiar($ccomuna)."',";
		$insert.= "'".limpiar($cregion)."',";
		$insert.= "'".limpiar($cpnombre)."',";
		$insert.= "'".limpiar($cfono)."',";
		$insert.= "'".limpiar($cemail)."',";
		$insert.= "'".limpiar($ccodigorubro)."',";
		$insert.= "'".limpiar($ccodigorubro2)."',";
		$insert.= "'".limpiar($cbanco1)."',";
		$insert.= "'".limpiar($cnumerocuenta1)."',";
		$insert.= "'".limpiar($cbanco2)."',";
		$insert.= "'".limpiar($cnumerocuenta2)."',";
		$insert.= "'".limpiar($cobs)."',";
		$insert.= "'".$fechahoy."',";
		$insert.= "'".limpiar($ccodigorubro3)."'";
		
		$insert.= ")";
		//echo $insert;
		
		if($res = mysql_query($insert,$conn))
		{
		 	echo "<table border='0' width='880' bgcolor='#ddffdd'><tr><td align='right'> <table border='0'><tr><td><img src='images/alerta.gif'></td><td><label id='alerta'> El nuevo proveedor ha sido almacenado exitosamente</label></td></tr></table> </td></tr></table>";
			$idpro = mysql_insert_id();
			$boton= "1";
			$new = 0;
			
		}
		else
			{
				echo "<table border='0' width='880' bgcolor='#ffdddd'><tr><td align='right'> <table border='0'><tr><td><img src='images/alerta.gif'></td><td><label id='alerta'> El rut ya fue ingresado previamente</label></td></tr></table> </td></tr></table>";
				$boton= "0";
			
			}
			
	}	
		
	

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>
<script type="application/javascript" src="scripts/rut.js"> </script>
<script type="text/javascript">
$(document).ready(function()
{
// Validador de RUT
$('#nrut').Rut({
  on_error: function(){ alert('Rut incorrecto'); },
  format_on: 'keyup' 
});

$("#content > ul").tabs();
});
</script>

<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >



	<form name='diagnostico' action='nuevoproveedor.php' method ='POST' onSubmit='checkRutPersonaX(diagnostico.nrut.value)'>

	<label id='subtitulo'> FICHA PROVEEDOR</label>
	<br/>
	<label id='comentariogris'> Complete todos los campos para ingresar el registro.</label>
	<hr/>
	
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
						<input type='text' class='num' name='nrut' id='nrut' value='<?=$nrut?>' size='15'>
				
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
							<option value='11'  <? if($cregion == 11) echo "SELECTED"?>>AISEN Y GRAL C. IBA&Ntilde;EZ DEL CAMPO</option>
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
				<table border='0' cellspacing='5' cellpadding='5' >
								
				<tr>
				<td id='etiqueta' width='80'>
						ACTIVIDAD COMERCIAL
						1
				</td>
				<td  id='data' width='400'>
					<input type='text' name='ccodigorubro' value='<?=$ccodigorubro?>' size='50'>
										
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta' width='80'>
						ACTIVIDAD COMERCIAL 2
						
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
					Opcional					
				</td>
				</tr>
				
				
				
				<tr>
				<td id='etiqueta'>
						CUENTA N°
				</td>
				<td id='data'>
						<input type='text' name='cnumerocuenta1' value='' size='30'>
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
					Opcional					
				</td>
				</tr>
				
				
				
				<tr>
				<td id='etiqueta'>
						CUENTA2  N°
				</td>
				<td  id='data' >
						<input type='text' name='cnumerocuenta2' value='' size='30'>
						Opcional				
				</td>
				</tr>
				</table>
			
			
			</fieldset>
			
			
			<p/>
			<label id='subtitulo'> Contacto Proveedor</label>
			<p/>
			<fieldset>		
			
				<table border='0'  width='450' cellspacing='5' cellpadding='5' >
				
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
						<textarea name='cobs'  rows='3' cols='29'><?=$cemail?></textarea> Opcional
				
				</td>
				</tr>
				</table>
			
			</fieldset>
			
			
	</td>
	</tr>
	</table>
	
	<p/>
	
	<table border='0'>
	<tr>
	<td width='400' valign='top' />
	
	<td>
	
			<table border='0' width='500'>
			<tr>
			<td align='right'>
			<!--
					<table border='0' cellspacing='5' cellpadding='5' >
					<tr>
					<td id='data' valign='bottom' align='center'>
							<a  id='menualternativo' href='home.php'><img src="images/logos/cancelar0.jpg" onmouseover="this.src = 'images/logos/cancelar1.jpg'" onmouseout="this.src = 'images/logos/cancelar0.jpg'" border="0"></img></a><br/>
					</td>
					<td id='data' valign='bottom'  align='center'>
							<a id='menu' href='#'  onCLick='submit()'><img src="images/logos/aceptar0.jpg" onmouseover="this.src = 'images/logos/aceptar1.jpg'" onmouseout="this.src = 'images/logos/aceptar0.jpg'" border="0"></img></a>
					</td>

					</tr>
					</table>
			
					<table border='0'>
					<tr>
					<td>
						
						<input type='hidden' name='id' value='<?=$idpro?>'>
						<input type='reset' value='Limpiar'>
						<input type='Submit' value='Aceptar' >
					</td>
					</tr>
					</table>
			-->		
					<table border='0'>
					<tr>
					<td>
						
						<input type='hidden' name='id' value='<?=$idpro?>'>
						<input type='reset' value='Limpiar'>
						<input type='Submit' value='Aceptar' >
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