<?php include("header.php")?>
<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> Informe / Ficha de Provedor</label>
	<br/>
	<label id='comentariogris'> Listado completo de los proveedores registrados en el sistema.</label>
	<hr/>
	<p/>
	
	
	<table border='0' width='700' cellpadding='5' cellspacing='5'>
	<tr>
		<td id='etiqueta' width='100'> NOMBRE</TD>
		<td id='etiqueta'> DIRECCION</TD>
		<td id='etiqueta'> COMUNA/REGION</TD>

	</tr>
	<?php
	
		$id = $_GET['x'];
		include("functions.php");
		
		
		$proveedores  = "SELECT * FROM tbk_cliente WHERE rut_cli='".$id."' ORDER BY paterno_cli ASC";
		$resp = mysql_query($proveedores, $conn);
		
		$pfilas = mysql_num_rows($resp);
		
				$linea = mysql_fetch_row($resp);
			
				$id		= $linea[0];
				$nombre = $linea[1]." ".$linea[2]." ".$linea[3];
				$direccion = $linea[4];
				$comuna = $linea[5];
				$region = $linea[6];
				$rubro1 =$linea[7];
				$rubro2 =$linea[8];
				$rubro3 =$linea[13];
				$fono =$linea[9];
				$email = $linea[10];
				$obs  = $linea[14];
				$fechain = $linea[15];
				
				
				
				
				
				
				echo "<tr>";

				echo "<td id ='data' >".$nombre." /<br/><b>".$id."</b></td>";
				echo "<td id ='data'>".$direccion."</td>";
				echo "<td id ='data'>".$comuna."/<br/><b>".region($region)."</b></td>";
				echo "</tr>";
				
				
				echo "<tr>";
				echo "<td id='etiqueta'> CONTACTO </td>";
				echo "<td id='etiqueta'> FONOS </td>";
				echo "<td id='etiqueta'> CORREO ELECTROCNICO </td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td id ='data'>".$contacto."</td>";
				echo "<td id ='data'>".$fono."</td>";
				echo "<td id ='data'>".$email."</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td id='etiqueta'> RUBRO 1 </td>";
				echo "<td id='etiqueta'> RUBRO 2 </td>";
				echo "<td id='etiqueta'> RUBRO 3 </td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td id ='data'>".rubro($rubro1)."</td>";
				echo "<td id ='data'>".rubro($rubro2)."</td>";
				echo "<td id ='data'>".$rubro3."</td>";
				echo "</tr>";

	
	?>
	</table>
	
</td>
</tr>
</table>


<?php include("footer.php")?>