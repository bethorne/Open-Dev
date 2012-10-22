<?php include("header.php")?>
<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> Informe Unidades de Medida</label>
	<br/>
	<label id='comentariogris'> Listado completo de las unidades de medidas utilizadas en el sistema.</label>
	<hr/>
	<p/>
	
	<center>
	<table border='0' width='300' cellpadding='5'>
	<tr>
		<td id='etiqueta'/>
		<td id='etiqueta'> NOMBRE</TD>

		
		
	</tr>
	<?php
		include("functions.php");
		
		$proveedores  = "SELECT * FROM tbk_unidad_medida ORDER BY nombre_um ASC";
		$resp = mysql_query($proveedores, $conn);
		
		$pfilas = mysql_num_rows($resp);
		
		if ($pfilas > 0)
		{
			$p=0;
			WHILE($linea = mysql_fetch_row($resp))
			{
				$id			= $linea[0];
				$nombre 	= $linea[1];
				

				
				echo "<tr>";
				echo "<td id='etiqueta' id='4' width='5'>".($p+1)."</td>";
				echo "<td id ='data'>".$nombre."</td>";
	
				echo "</tr>";
				
				$p++;
			}
		
		}
	
	
	
	?>
	</table>
	</center>
	
</td>
</tr>
</table>


<?php include("footer.php")?>