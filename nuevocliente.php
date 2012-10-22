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
	$ccodigorubro 	= $_POST['ccodigorubro'];
	$ccodigorubro2 	= $_POST['ccodigorubro2'];
	$cfono			= $_POST['cfono'];
	$cemail			= $_POST['cemail'];
	$cobs			= $_POST['cobs'];
	$fechahoy		= date('d-m-Y');
	$ccodigorubro3 	= $_POST['ccodigorubro3'];
	
	$boton = "0";
	

	
	if (!empty($cnombre))
	{
		include("conector/conector.php");
		
		$insert = "INSERT INTO tbk_cliente VALUES(";
		$insert.= "'".limpiar($nrut)."',";
		$insert.= "'".limpiar($cnombre)."',";
		$insert.= "'".limpiar($cpaterno)."',";
		$insert.= "'".limpiar($cmaterno)."',";
		$insert.= "'".limpiar($cdireccion)."',";
		$insert.= "'".limpiar($ccomuna)."',";
		$insert.= "'".limpiar($cciudad)."',";
		$insert.= "'".limpiar($cregion)."',";
		$insert.= "'".limpiar($ccodigorubro)."',";
		$insert.= "'".limpiar($ccodigorubro2)."',";
		$insert.= "'".limpiar($cfono)."',";
		$insert.= "'".limpiar($cemail)."',";
		$insert.= "'".limpiar($cobs)."',";
		$insert.= "'".$fechahoy."',";
		$insert.= "'".limpiar($ccodigorubro3)."'";
		
		$insert.= ")";
		
		
		//echo $insert;
		
		if($res = mysql_query($insert,$conn))
		{
		 	echo "<table border='0' width='880' bgcolor='#ddffdd'><tr><td align='right'> <table border='0'><tr><td><img src='images/alerta.gif'></td><td><label id='alerta'> Cliente ha sido almacenado exitosamente</label></td></tr></table> </td></tr></table>";
			$idpro = mysql_insert_id();
			$boton= "1";
			$new = 0;
			
			/*
			$insert2 = "INSERT INTO tbk_producto_valor VALUES(";
			$insert2.= $idpro.",";
			$insert2.= $valor1.",";
			$insert2.= "0)";
			
			echo $insert2;
			if ($res = mysql_query($insert2,$conn))
			{
				// precio almacenado exitosamente
			}
			else
			{
			
					// precio no almacenad
			}
			*/
		}
		else
			{
				echo "<table border='0' width='880' bgcolor='#ffdddd'><tr><td align='right'> <table border='0'><tr><td><img src='images/alerta.gif'></td><td><label id='alerta'> Este rut ya fue ingresado previamente.</label></td></tr></table> </td></tr></table>";
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
<table border='0' width='800' height='400'>
<tr>
<td valign='top' >



	<form name='diagnostico' action='nuevocliente.php' method ='POST' onSubmit='return checkRutPersonaX(document.diagnostico.nrut.value)'>

	<label id='subtitulo'> FICHA CLIENTE</label>
	<br/>
	<label id='comentariogris'> Complete los campos para ingresar el registro.</label>
	<hr/>
	<p/>
	
	<table border='0' cellpadding='1' cellspacing='1'>
	<tr>
	<td  valign='top' >
	
			<label id='subtitulo'> Cliente</label>
			<p/>
			
			<fieldset>
			
				<table border='0' cellspacing='5' cellpadding='5' >
				
				<tr>
				<td id='data'>
						<input type='text' name='nrut' id='nrut'value='<?=$nrut?>' size='14'>
				
				</td>
				<td  id='data' colspan='3'>
						<input type='text' name='cnombre' value='<?=limpiar($cnombre)?>' size='70'>
				
				</td>
				<!--
				<td  id='data'>
						<input type='text' name='cpaterno' value='<?=limpiar($cpaterno)?>' size='30'>
				
				</td>
				<td  id='data'>
						<input type='text' name='cmaterno' value='<?=limpiar($cmaterno)?>' size='40'>
				
				</td>
				-->
				</tr>
				
				<tr>
				<td id='etiqueta'> RUT</td>
				<td id='etiqueta' colspan='3'> NOMBRES / APELLIDO PATERNO / APELLIDO MATERNO</td>
				</tr>

				
				<tr>

				<td   id='data'>
						<input type='text' name='cdireccion' value='<?=$cdireccion?>' size='48'>
				
				</td>
				<td  id='data'>
						<input type='text' name='cciudad' value='<?=$cciudad?>' size='30'>
				
				</td>
				<td  id='data'>
						<input type='text' name='ccomuna' value='<?=$ccomuna?>' size='30'>
				
				</td>

				</tr>
				
				<tr>
				<td id='etiqueta' > DIRECCION</td>
				<td id='etiqueta' > CIUDAD</td>
				<td id='etiqueta'> COMUNA</td>

				
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
					<td id='etiqueta'> REGION</td>
				</tr>
				
				</table>
		 
		
		
		<tr>
		<td>
				<fieldset>
				<table border='0' cellspacing='5' cellpadding='5' >
				
				<tr>
				<td  id='data' >
					<input type='text' name='ccodigorubro1' value='<?=$ccodigorubro3?>' size='40'>		
				</td>
				<tr>
		
				<td id='etiqueta'> GIRO COMERCIAL 1</td>
									
				</tr>
				
				<tr>
				<td  id='data' >
					<input type='text' name='ccodigorubro2' value='<?=$ccodigorubro3?>' size='40'>
										
				</td>
				</tr>
				
								
				<tr>
					<td id='etiqueta'> GIRO COMERCIAL 2</td>
				</tr>
				
				<tr>
				<td  id='data' >
					<input type='text' name='ccodigorubro3' value='<?=$ccodigorubro3?>' size='40'>
				</td>
				</tr>
				
								
				<tr>
					<td id='etiqueta'> GIRO COMERCIAL 3</td>
				</tr>
				
				
				</table>
				
				</fieldset>
		</td>
		</tr>

		<tr>
		<td>
				<fieldset>
				<table border='0' cellspacing='5' cellpadding='5' >

				<tr>

				<td id='data'>
						<input type='text' name='cfono' value='<?=$cfono?>' size='60'>
				
				</td>
				<td id='data'>
						<input type='text' name='cemail' value='<?=$cemail?>' size='60'> 
				
				</td>
				
				</tr>
				
												
				<tr>
		
				<td id='etiqueta'> TELEFONO</td>
				<td id='etiqueta'> EMAIL  (opcional)</td>
				
				
				</tr>
				
				<tr>
				<td id='data' colspan='2'>
						<textarea name='cobs'  rows='3' cols='125'><?=$cobs?></textarea>
				
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'> OBSERVACIONES (Opcional)</td>
				
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
	
			<table border='0' width='400'>
			<tr>
			<td align='right'>
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