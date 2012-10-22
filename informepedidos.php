<?php include("header.php")?>
<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> Informe de Pedidos</label>
	<br/>
	<label id='comentariogris'> Registro completo de los pedidos registrados por concepto de compra.</label>
	<hr/>
	<p/>
	
	<center>
	<table border='0' width='450' cellpadding='5'>
	<tr>
		<td id='etiqueta'/>
		<td id='etiqueta'> PRODUCTO</TD>
		<td id='etiqueta'> CANTIDAD</TD>
		<td id='etiqueta'> RESPONSABLE</TD>

		
		
	</tr>
	<?php
		include("functions.php");
		
		$proveedores  = "SELECT * FROM tbk_pedido ORDER BY id_pro ASC";
		$resp = mysql_query($proveedores, $conn);
		
		$pfilas = mysql_num_rows($resp);
		
		if ($pfilas > 0)
		{
			$p=0;
			WHILE($linea = mysql_fetch_row($resp))
			{
				$id			= $linea[0];
				$cantidad	= $linea[1];
				$rut		= $linea[2];
				
				

				
				echo "<tr>";
				echo "<td id='etiqueta' id='4' width='5'>".($p+1)."</td>";
				echo "<td id ='data'>".nombreprodid($id)."</td>";
				echo "<td id ='data'>".$cantidad."</td>";
				echo "<td id ='data'>".personalrut($rut)."</td>";
				
	
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