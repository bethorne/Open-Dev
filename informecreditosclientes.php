<?php include("header.php")?>
<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> Informe Créditos a Clientes</label>
	<br/>
	<label id='comentariogris'> Elija al cliente que desea consultar su estado de deudas.</label>
	<hr/>
	<p/>
	
	
	<center>
	<table border='0' width='700' cellpadding='5'>
	<tr>
		<td id='etiqueta'/>
		<td id='etiqueta'> RUT CLIENTE</TD>
		<td id='etiqueta'> NOMBRE</TD>


		
		
		
	</tr>
	<?php
		include("functions.php");
		$proveedores  = "SELECT DISTINCT(rut_cli) FROM tbk_credito ORDER BY rut_cli ASC";
		$resp = mysql_query($proveedores, $conn);
		
		$pfilas = mysql_num_rows($resp);
		
		if ($pfilas > 0)
		{
			$p=0;
			WHILE($linea = mysql_fetch_row($resp))
			{
				$rutcli	= $linea[0];
				$monto = $linea[1];
				$saldo = $linea[2];
				$fecha = $linea[3];
				$actualiza = $linea[4];
				$autoriza = $linea[5];
				$estado  = $linea[6];
				
				$fc = explode("#",clienterut($rutcli));
				$nombre = $fc[0];
				
				$leyenda='';
				if ($estado == 1) $leyenda  = "activo";
				if ($estado == 0) $leyenda  = "inactivo";
				
				echo "<tr>";
				echo "<td id='etiqueta' id='4'>".($p+1)."</td>";
				echo "<td id ='data'><a id='etiquetazul' href='informecreditocliente.php?x=".$rutcli."' target='_blank'>".$rutcli."</td>";
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