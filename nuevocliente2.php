<?php include("header.php")?>


<?php

function limpiar($string )
{
	$string = str_replace("\'","",$string); 
	return $string;
}


	$nombre= $_POST['nombre'];
	$cbarra = $_POST['cbarra'];
	$marca = $_POST['marca'];
	$modelo = $_POST['modelo'];
	$desc1 = $_POST['desc1'];
	$um1 = $_POST['um1'];
	$valor1 = $_POST['valor1'];
	$fam = $_POST['fam'];
	$subfam = $_POST['subfam'];
	$boton = "0";
	

	
	if (!empty($nombre))
	{
		include("conector/conector.php");
		
		$insert = "INSERT INTO tbk_cliente VALUES(";
		$insert.= "'',";
		$insert.= "'".limpiar($cbarra)."',";
		$insert.= "'".limpiar($nombre)."',";
		$insert.= "'".limpiar($desc1)."',";
		$insert.= "'".limpiar($marca)."',";
		$insert.= "'".limpiar($modelo)."',";

		$insert.= "'')";
		
		if($res = mysql_query($insert,$conn))
		{
		 	echo "<table border='0' width='880' bgcolor='#ddffdd'><tr><td align='right'> <table border='0'><tr><td><img src='images/alerta.gif'></td><td><label id='alerta'> Producto almacenado exitosamente</label></td></tr></table> </td></tr></table>";
			$idpro = mysql_insert_id();
			$boton= "1";
			$new = 0;
			
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
		}
		else
			{
				echo "<table border='0' width='880' bgcolor='#ffdddd'><tr><td align='right'> <table border='0'><tr><td><img src='images/alerta.gif'></td><td><label id='alerta'> Este codigo de Barra ya fue asignado a otro producto</label></td></tr></table> </td></tr></table>";
				$boton= "0";
			
			}
			
	}	
		
	

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>


<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >



	<form name='diagnostico' action='nuevocliente2.php' method ='POST' onSubmit='checkRutPersona(diagnostico.rut.value)'>


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
						<input type='text' class='num' name='rut' value='<?=$crut?>' size='14'>
				
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'>
						Nombre Cliente
				</td>
				<td>
						<input type='text' name='cnombre' value='<?=limpiar($nombre)?>' size='30'>
				
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'>
						Apellido Paterno
				</td>
				<td>
						<input type='text' name='cpaterno' value='<?=limpiar($cpaterno)?>' size='30'>
				
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'>
						Apellido Materno
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
						<input type='text' name='cregion' value='<?=$cregion?>' size='30'>
				
				</td>
				</tr>
				


				</table>
			
			</fieldset>

	</td>
	<td width='400' valign='top'>
	
			<label id='subtitulo'> Contacto</label>
			<p/>
			
			<fieldset>
			
				<table border='0' cellspacing='5' cellpadding='5' >
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
				<td>
						<input type='text' name='cemail value='<?=$cemail?>' size='30'>
				
				</td>
				</tr>
				
				
				<tr>
				<td id='etiqueta'>
						Tel&eacute;fono(s)
				</td>
				<td>
						<textarea name='desc1' cols='30'  rows='3'><?=$desc1?></textarea>
				
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