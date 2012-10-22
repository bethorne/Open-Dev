<?php include("header.php")?>
<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> Informe de Compras</label>
	<br/>
	<label id='comentariogris'> Listado completo de los documentos registrados por operaciones de compra.</label>
	<hr/>
	<p/>
	
	
	<center>
	<table border='0' width='700' cellpadding='5'>
	<tr>
		<td id='etiqueta'/>
		<td id='etiqueta'> FECHA</TD>
		<td id='etiqueta'> PROVEEDOR</TD>
		<td id='etiqueta'> TIPO DOCUMENTO</TD>
		<td id='etiqueta'> TOTAL</TD>
		<td id='etiqueta'> RESPONSABLE</TD>
		
		
	</tr>
	<?php
		include("functions.php");
		
		$proveedores  = "SELECT * FROM tbk_documentocompra ORDER BY id_docc DESC";
		$resp = mysql_query($proveedores, $conn);
		
		$pfilas = mysql_num_rows($resp);
		
		if ($pfilas > 0)
		{
			$p=0;
			WHILE($linea = mysql_fetch_row($resp))
			{
				$id			= $linea[0];
				$rutcli 	= $linea[1];
				$tipodoc 	= $linea[2];
				$fecha 		= $linea[3];
				$total 		= $linea[4];
				$codigo		= $linea[6];
				$vendedor 	= $linea[7];
				
				if ($tipodoc == 1) $tipodocumento = "BOLETA";
				if ($tipodoc == 2) $tipodocumento = "GUIA";
				if ($tipodoc == 3) $tipodocumento = "FACTURA";
				

				
				echo "<tr>";
				echo "<td id='etiqueta' id='4'>".($p+1)."</td>";
				echo "<td id ='data'>".$fecha."</td>";
				echo "<td id ='data'>".proveedorrut($rutcli)."</td>";
				echo "<td id ='data'><a id='etiquetazul' href='documentoscompra.php?cb=".$id."' target='_blank'>".$tipodocumento." N° ".$codigo."</a></td>";
				echo "<td id ='data' align='right'>$ ".$total."</td>";
				echo "<td id ='data'>".personalrut($vendedor)."</td>";
	
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