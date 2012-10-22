<?php include("header.php")?>
<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> Informe de Mermas</label>
	<br/>
	<label id='comentariogris'> Listado completo de las mermas  registradas por concecpto de bodega.</label>
	<hr/>
	<p/>
	
	<center>
	<table border='0' width='650' cellpadding='5'>
	<tr>
		<td id='etiqueta'/>
		<td id='etiqueta'> FECHA</TD>
		<td id='etiqueta'> PRODUCTO</TD>
		<td id='etiqueta'> CANTIDAD</TD>
		<td id='etiqueta'> OBS</TD>
		<td id='etiqueta'> RESPONSABLE</TD>

		
		
	</tr>
	<?php
		include("functions.php");
		
		$proveedores  = "SELECT * FROM tbk_producto_merma ORDER BY fecha_mer DESC";
		$resp = mysql_query($proveedores, $conn);
		
		$pfilas = mysql_num_rows($resp);
		
		if ($pfilas > 0)
		{
			$p=0;
			WHILE($linea = mysql_fetch_row($resp))
			{
				$fecha		= $linea[0];
				
				$d= substr($fecha,6,2);
				$m= substr($fecha,4,2);
				$y= substr($fecha,0,4);
				
				
				$id			= $linea[1];
				$cantidad	= $linea[2];
				$obs		= $linea[4];
				$responsable	= $linea[3];
				

				
				echo "<tr>";
				echo "<td id='etiqueta' id='4' width='5'>".($p+1)."</td>";
				echo "<td id ='data'>".$d."-".$m."-".$y."</td>";
				echo "<td id ='data'>".nombreprodid($id)."</td>";
				echo "<td id ='data'>".$cantidad."</td>";
				echo "<td id ='data'>".$obs."</td>";
				echo "<td id ='data'>".personalrut($responsable)."</td>";
	
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