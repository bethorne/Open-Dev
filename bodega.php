<?php include("header.php")?>

<?php

	$nombre= $_POST['nombre'];
	$cbarra = $_POST['cbarra'];
	$desc1 = $_POST['desc1'];
	$um1 = $_POST['um1'];
	$valor1 = $_POST['valor1'];
	$fam = $_POST['fam'];
	$subfam = $_POST['subfam'];

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>

<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<form name='np' action='#' method ='POST'>

	<table border='0'>
	<tr>

	<td width='400' valign='top' >
	
			<label id='subtitulo'> STOCK</label>
			<p/>
			
			<fieldset>
			
				<table border='0' cellspacing='5' cellpadding='5' height='170'>
				<tr>
				<td id='etiqueta'>
						Stock M&iacute;nimo
				</td>
				<td>
						<input type='text' name='stockMin' value='' size='30'>
				
				</td>
				</tr>
					
				<tr>
				<td id='etiqueta'>
						Stock M&iacute;nimo de Alerta
				</td>
				<td>
						<input type='text' name='stockSos' value='' size='30'>
				
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'>
						Stock  M&aacute;ximo
				</td>
				<td>
						<input type='text' name='stockMax' value='' size='30'>
				
				</td>
				</tr>
				</table>
			
			</fieldset>

	</td>
	<td width='400' valign='top' >
	
		<label id='subtitulo'> Producto</label>
		<p/>
	
		<fieldset>
		
		<table border='0' width='380'>
		<tr>
		<td>
			<label id='subtitulo'><?=$nombre?></label>
			<br/>
			<label id='descripcion'><?=$desc1?></label>
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
	<td width='400' valign='top'>

					
	</td>
	<td>
	
			<table border='0' width='400'>
			<tr>
			<td align='right'>
					<table border='0'>
					<tr>
					<td>
						<input type='hidden' name='new' value='0'>
						<input type='image'  src='images/Flecha_azul.jpg' onClick='javascript: submit()'>
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