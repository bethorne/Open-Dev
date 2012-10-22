<?php include("header.php")?>


<?php

function limpiar($string )
{
	$string = str_replace("\'","",$string); 
	return $string;
}


	$nrut 			= $_POST['nrut'] ;
	$cnombre		= $_POST['cnombre'];
	$cpaterno 		= $_POST['cpaterno'];
	$cmaterno		= $_POST['cmaterno'];
	$cdireccion 	= $_POST['cdireccion'];
	$ccomuna		= $_POST['ccomuna'];
	$cregion		= $_POST['cregion'];
	$ccodigorubro 	= $_POST['ccodigorubro'];
	$ccodigorubro2 	= $_POST['ccodigorubro2'];
	$cfono			= $_POST['cfono'];
	$cemail			= $_POST['cemail'];
	$cobs			= $_POST['cobs'];
	$fechahoy		= date('d-m-Y');
	
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
		$insert.= "'".limpiar($cregion)."',";
		$insert.= "'".limpiar($ccodigorubro)."',";
		$insert.= "'".limpiar($ccodigorubro2)."',";
		$insert.= "'".limpiar($cfono)."',";
		$insert.= "'".limpiar($cemail)."',";
		$insert.= "'".limpiar($cobs)."',";

		$insert.= "'".$fechahoy."')";
		
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


<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >



	<form name='diagnostico' action='nuevocliente.php' method ='POST' onSubmit='checkRutPersonaX(document.diagnostico.nrut.value)'>

	<label id='subtitulo'> FICHA CLIENTE</label>
	<br/>
	<label id='comentariogris'> Complete los campos para ingresar el registro.</label>
	<hr/>
	<p/>
	
	<table border='0'>
	<tr>
	<td width='400' valign='top' >
	
			<label id='subtitulo'> Cliente</label>
			<p/>
			
			<fieldset>
			
				<table border='0' cellspacing='5' cellpadding='5' height='170'>
				
				<tr>
				<td id='etiqueta'>
						RUT
				</td>
				<td>
						<input type='text' class='num' name='nrut' value='<?=$nrut?>' size='14'>
				
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'>
						Nombre Cliente
				</td>
				<td>
						<input type='text' name='cnombre' value='<?=limpiar($cnombre)?>' size='30'>
				
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'>
						Ap. Paterno
				</td>
				<td>
						<input type='text' name='cpaterno' value='<?=limpiar($cpaterno)?>' size='30'>
				
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'>
						Ap. Materno
				</td>
				<td>
						<input type='text' name='cmaterno' value='<?=limpiar($cmaterno)?>' size='30'>
				
				</td>
				</tr>
		
				<tr>
				<td id='etiqueta'>
						Direcci&oacute;n
				</td>
				<td>
						<input type='text' name='cdireccion' value='<?=$cdireccion?>' size='30'>
				
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'>
						Comuna
				</td>
				<td>
						<input type='text' name='ccomuna' value='<?=$ccomuna?>' size='30'>
				
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'>
						Regi&oacute;n
				</td>
				<td>
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
				<table border='0' cellspacing='5' cellpadding='5' >
								
				<tr>
				<td id='etiqueta' width='80'>
						ACTIVIDAD COMERCIAL
						1
				</td>
				<td  id='data' width='400'>
					<select name="ccodigorubro" size="1" >
						<option />
						<option value="A">AGRICULTURA, GANADERÍA, CAZA Y SILVICULTURA</option>
						<option value="B">PESCA</option>
						<option value="C">EXPLOTACIÓN DE MINAS Y CANTERAS</option>
						<option value="D">INDUSTRIAS MANUFACTURERAS NO METÁLICAS</option>
						<option value="E">INDUSTRIAS MANUFACTURERAS METÁLICAS</option>
						<option value="F">SUMINISTRO DE ELECTRICIDAD, GAS Y AGUA</option>
						<option value="G">CONSTRUCCIÓN</option>
						<option value="H">COMERCIO AL POR MAYOR Y MENOR; </option>
						<option value="I">HOTELES Y RESTAURANTES</option>
						<option value="J">TRANSPORTE, ALMACENAMIENTO Y COMUNICACIONES</option>
						<option value="K">INTERMEDIACIÓN FINANCIERA</option>
						<option value="L">ACTIVIDADES INMOBILIARIAS, EMPRESARIALES Y DE ALQUILER</option>
						<option value="M">ADM. PÚBLICA Y DEFENSA; PLANES DE SEG. SOCIAL </option>
						<option value="N">ENSEÑANZA</option>
						<option value="O">SERVICIOS SOCIALES Y DE SALUD</option>
						<option value="P">OTRAS ACTIVIDADES  COMUNITARIAS, SOCIALES Y PERSONALES</option>
					</select>
										
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta' width='80'>
						ACTIVIDAD COMERCIAL 2
						
				<td  id='data' width='400'>
					<select name="ccodigorubro2" size="1" >
						<option />
						<option value="A">AGRICULTURA, GANADERÍA, CAZA Y SILVICULTURA</option>
						<option value="B">PESCA</option>
						<option value="C">EXPLOTACIÓN DE MINAS Y CANTERAS</option>
						<option value="D">INDUSTRIAS MANUFACTURERAS NO METÁLICAS</option>
						<option value="E">INDUSTRIAS MANUFACTURERAS METÁLICAS</option>
						<option value="F">SUMINISTRO DE ELECTRICIDAD, GAS Y AGUA</option>
						<option value="G">CONSTRUCCIÓN</option>
						<option value="H">COMERCIO AL POR MAYOR Y MENOR; </option>
						<option value="I">HOTELES Y RESTAURANTES</option>
						<option value="J">TRANSPORTE, ALMACENAMIENTO Y COMUNICACIONES</option>
						<option value="K">INTERMEDIACIÓN FINANCIERA</option>
						<option value="L">ACTIVIDADES INMOBILIARIAS, EMPRESARIALES Y DE ALQUILER</option>
						<option value="M">ADM. PÚBLICA Y DEFENSA; PLANES DE SEG. SOCIAL </option>
						<option value="N">ENSEÑANZA</option>
						<option value="O">SERVICIOS SOCIALES Y DE SALUD</option>
						<option value="P">OTRAS ACTIVIDADES  COMUNITARIAS, SOCIALES Y PERSONALES</option>
					</select>
										
				</td>
				</tr>
				
			</table>
			
			</fieldset>
	
	
			<label id='subtitulo'> Contacto</label>
			<p/>
			
			<fieldset>
			
				<table border='0' width='450'  cellspacing='5' cellpadding='5' >
								<tr>
				<td id='etiqueta'>
						Tel&eacute;fono
				</td>
				<td>
						<input type='text' name='cfono' value='<?=$cfono?>' size='30'>
				
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