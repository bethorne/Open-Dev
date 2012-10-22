<?php include("header.php")?>
<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> Informe de Productos</label>
	<br/>
	<label id='comentariogris'> Listado completo de los productos registrados en el sistema.</label>
	<hr/>
	<p/>
	
	<center>
	<table border='0' width='700' cellpadding='5'>
	<tr>
		<td id='etiqueta'/>
		<td id='etiqueta'> CODIGO</TD>
		<td id='etiqueta'> NOMBRE</TD>
		<td id='etiqueta'> DESCRIPCION</TD>
		<td id='etiqueta'> MARCA</TD>
		<td id='etiqueta'> MODELO</TD>
		
		
	</tr>
	<?php
		include("functions.php");
		
		$proveedores  = "SELECT * FROM tbk_producto ORDER BY nombre_pro ASC";
		$resp = mysql_query($proveedores, $conn);
		
		$pfilas = mysql_num_rows($resp);
		
		if ($pfilas > 0)
		{
			$p=0;
			WHILE($linea = mysql_fetch_row($resp))
			{
				$id			= $linea[0];
				$codigo		= $linea[1];
				$nombre 	= $linea[2];
				$descripcion 	= $linea[3];
				$marca		= $linea[4];
				$modelo		= $linea[5];

				
				echo "<tr>";
				echo "<td id='etiqueta' id='4'>".($p+1)."</td>";
				echo "<td id ='data'><a id='etiquetazul' href='buscar.php?cb=".$codigo."' target='_blank'>".$codigo."</a></td>";
				echo "<td id ='data'>".$nombre."</td>";
				echo "<td id ='data' > ".$descripcion."</td>";
				echo "<td id ='data'>".$marca."</td>";
				echo "<td id ='data'>".$modelo."</td>";
	
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