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
		
		
		$proveedores  = "SELECT * FROM tbk_proveedor WHERE rut_pv='".$id."' ORDER BY nombre_pv ASC";
		$resp = mysql_query($proveedores, $conn);
		
		$pfilas = mysql_num_rows($resp);
		
				$linea = mysql_fetch_row($resp);
			
				$id		= $linea[0];
				$nombre = $linea[1]." ".$linea[2]." ".$linea[3];
				$direccion = $linea[4];
				$comuna = $linea[5];
				$region = $linea[6];
				$contacto  = $linea[7];
				$fono = $linea[8];
				$email = $linea[9];
				$rubro1 =$linea[10];
				$rubro2 =$linea[11];
				$rubro3 =$linea[18];
				$banco1 = $linea[12];
				$cuenta1  = $linea[13];
				$banco2 = $linea[14];
				$cuenta2  = $linea[15];
				$obs  = $linea[16];
				$fechain = $linea[17];
				
				
				
				
				
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
				
				echo "<tr>";
				echo "<td id='etiqueta'> BANCO / CUENTA </td>";
				echo "<td id='etiqueta'> BANCO / CUENTA </td>";
				echo "<td id='etiqueta'> FECHA INGRESO </td>";

				echo "</tr>";

				echo "<tr>";
				echo "<td id ='data'>".banco($banco1)." /<br/> <b>".$cuenta1."</b></td>";
				echo "<td id ='data'>".banco($banco2)." /<br/> <b>".$cuenta2."</b></td>";
				echo "<td id ='data'>".$fechain."</td>";
				echo "</tr>";
	
	?>
	</table>
	
</td>
</tr>
</table>


<?php include("footer.php")?>