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
	<table border='0' width='800' cellpadding='5'>
	<tr>
		<td id='etiqueta'/>
		<td id='etiqueta' width='70'> FECHA</TD>
		<td id='etiqueta' width='70'> CAJA CHICA</TD>
		<td id='etiqueta' width='70'> EFECTIVO</TD>
		<td id='etiqueta' width='70'> GUIAS DE VENTA</TD>
		<td id='etiqueta' width='70' > GASTOS</TD>
		<td id='etiqueta' width='70'> TOTAL</TD>
		<td id='etiqueta' width='80'> OBS</TD>
		<td id='etiqueta' width='70'> VENDEDOR</TD>
		


	</tr>
	<?php
		include("functions.php");
		
		$proveedores  = "SELECT * FROM tbk_cajadiaria  ORDER BY substring(fecha_ca,1,4), substring(fecha_ca,6,2), substring(fecha_ca,9,2)  DESC";
		$resp = mysql_query($proveedores, $conn);
		
		$pfilas = mysql_num_rows($resp);
		
		if ($pfilas > 0)
		{
			$p=0;
			$anterior= 0;
			$flag1=0;
			WHILE($linea = mysql_fetch_row($resp))
			{

				$fecha		= $linea[0];
				$cajachica	= $linea[1];
				$efectivo	= $linea[2];
				$guiasventa	= $linea[3];
				
				$gastos		= $linea[4];
				$total		= $linea[5];
				$obs		= $linea[6];
				$vendedor	= $linea[7];
				
				$ff = explode("-",$fecha);
				$d = $ff[2];

				
				if ($anterior  != $d)
				{
					if ($flag1 == 0) $flag1 = 1 ;
					else $flag1 = 0;
					
					$anterior = $d;
				}
					
				if ($flag1==0) $fondo = "data4";
				if ($flag1==1) $fondo = "data";
								

				
				echo "<tr>";
				echo "<td id='etiqueta' id='4' width='5'>".($p+1)."</td>";
				echo "<td id ='".$fondo."' >".$fecha."</td>";
				echo "<td id ='".$fondo."' align='right'>$ ".$cajachica."</td>";
				echo "<td id ='".$fondo."' align='right'>$ ".$efectivo."</td>";
				echo "<td id ='".$fondo."' align='right'>$ ".$guiasventa."</td>";
				echo "<td id ='".$fondo."' align='right'>$ ".$gastos."</td>";
				echo "<td id ='etiqueta' align='right'>$ ".$total."</td>";
				echo "<td id ='".$fondo."' ><i>".$obs."</i></td>";
				echo "<td id ='".$fondo."'>".personalrut($vendedor)."</td>";
	
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