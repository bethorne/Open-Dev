<?php include("header.php")?>
<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> Informe de Ventas</label>
	<br/>
	<label id='comentariogris'> Listado completo de las ventas registadas indistinto  su forma de pago o si fueron canceladas.</label>
	<hr/>
	<p/>
	
	<center>
	<table border='0' width='650' cellpadding='5'>
	<tr>
		<td id='etiqueta'/>
		<td id='etiqueta'> FECHA</TD>
		<td id='etiqueta'> DOCUMENTO</TD>
		<td id='etiqueta'> N°</TD>
		
		
		
		<td id='etiqueta'> CLIENTE</TD>
		<td id='etiqueta'> TOTAL</TD>
		<td id='etiqueta'> OBS</TD>
		<td id='etiqueta'> RESPONSABLE</TD>

	</tr>
	<?php
		include("functions.php");
		/*$proveedores  ="SELECT *,sum(total_doc) as total
FROM tbk_documento
WHERE codigo_doc <>  ''
GROUP BY rut_cli ASC 
LIMIT 0 , 30";*/
		$proveedores  = "SELECT * FROM tbk_documento  WHERE  codigo_doc <> '' ORDER BY substring(fecha_doc,7,2), substring(fecha_doc,4,2)  ASC";
		$resp = mysql_query($proveedores, $conn);
		
		$pfilas = mysql_num_rows($resp);
		
		if ($pfilas > 0)
		{
			$p=0;
			$anterior= 0;
			$flag1=0;
			WHILE($linea = mysql_fetch_row($resp))
			{

				$id			= $linea[0];
				$rutcli		= $linea[1];
				$tipodoc	= $linea[2];
				$fecha		= $linea[3];
				
				$total		= $linea[4];
				$estado		= $linea[5];
				$codigo		= $linea[6];
				$vendedor	= $linea[7];
				
				$ff = explode("-",$fecha);
				$d = $ff[0];

				
				if ($anterior  != $d)
				{
					if ($flag1 == 0) $flag1 = 1 ;
					else $flag1 = 0;
					
					$anterior = $d;
				}
					
				if ($flag1==0) $fondo = "data4";
				if ($flag1==1) $fondo = "data";
								
				$fichacliente  = explode("|",clienterut($rutcli));
				$nombre = $fichacliente[0];
				
				$documento  = '';
				SWITCH($tipodoc)
				{
					CASE '1' : $documento = "BOLETA"; break;
					CASE '2' : $documento = "GUIA"; break;
					CASE '3' : $documento = "FACTURA"; break;
					CASE '4' : $documento = "N.V.F."; break;
					CASE '5' : $documento = "N. DEBITO"; break;
					CASE '6' : $documento = "N. CREDITO"; break;
	
				}

				
				echo "<tr>";
				echo "<td id='etiqueta' id='4' width='5'>".($p+1)."</td>";
				echo "<td id ='".$fondo."' >".$fecha."</td>";
				echo "<td id ='".$fondo."' align='right'>".$documento."</td>";
				echo "<td id ='".$fondo."' align='right'><a id='etiquetazul' href='facturas.php?cb=".$id."' target='_blank'>".$codigo."</a></td>";
				echo "<td id ='".$fondo."' >".$nombre."</td>";
				echo "<td id ='".$fondo."' align='right'>$ ".$total."</td>";
				echo "<td id ='".$fondo."' >".$obs."</td>";
				
				echo "<td id ='".$fondo."'>".$vendedor."</td>";
	
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