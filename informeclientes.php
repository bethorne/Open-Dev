<?php include("header.php")?>
<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> Informe de Clientes</label>
	<br/>
	<label id='comentariogris'> Listado completo de los clientes registrados en el sistema.</label>
	<hr/>
	<p/>
	
	
	<center>
	<table border='0' width='700' cellpadding='5'>
	<tr>
		<td id='etiqueta'/>
		<td id='etiqueta'> NOMBRE</TD>
		<td id='etiqueta'> DIRECCION</TD>
		<td id='etiqueta'> COMUNA / REGION</TD>
		<td id='etiqueta'> CONTACTO</TD>
		<td id='etiqueta'> FONO</TD>
		
		
	</tr>
	<?php
		include("functions.php");
		$proveedores  = "SELECT * FROM tbk_cliente ORDER BY nombre_cli ASC";
		$resp = mysql_query($proveedores, $conn);
		
		$pfilas = mysql_num_rows($resp);
		
		if ($pfilas > 0)
		{
			$p=0;
			WHILE($linea = mysql_fetch_row($resp))
			{
				$rutcli	= $linea[0];
				$nombre = $linea[1]." ".$linea[2]." ".$linea[3];
				$direccion = $linea[4];
				$comuna = $linea[5];
				$region = $linea[6];
				$fono = $linea[9];
				
				echo "<tr>";
				echo "<td id='etiqueta' id='4'>".($p+1)."</td>";
				echo "<td id ='data'><a id='etiquetazul' href='informecliente.php?x=".$rutcli."'target='_blank'>".$nombre."<br/>(".$rutcli.")</b></a></td>";
				echo "<td id ='data'>".$direccion."</td>";
				echo "<td id ='data'>".$comuna."<br/><b>".region($region)."</td>";
				echo "<td id ='data'>".$contacto."</td>";
				echo "<td id ='data'>".$fono."</td>";
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