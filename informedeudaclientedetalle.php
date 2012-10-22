<?php include("header.php")?>
<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> Informe Deuda de Cliente</label>
	<br/>
	<label id='comentariogris'> Registro de las deudas del cliente con la empresa registradas en el sistema.</label>
	<hr/>
	<p/>
	
	<center>
	<table border='0' width='700' cellpadding='5' cellspacing='5'>
	<tr>
		<td id='etiqueta' width='30'> DOCUMENTO</TD>
		<td id='etiqueta'> CLIENTE</TD>
		<td id='etiqueta'> CUOTAS</TD>
		<td id='etiqueta'> VALOR</TD>
		<td id='etiqueta'> VENCIMIENTO</TD>
		<td id='etiqueta'> VALOR POR ATRASO</TD>
		<td id='etiqueta'> FECHA PAGO</TD>

		

	</tr>
	<?php
	
		$id = $_GET['x'];
		include("functions.php");
		
		
		$proveedores  = "SELECT * FROM tbk_pago_cuota WHERE rut_cli='".$id."' ORDER BY SUBSTR(vencimiento_pc,7,4), SUBSTR(vencimiento_pc,4,2) ASC";
		
		
		$resp = mysql_query($proveedores, $conn);
		
		$a=0;
		$pfilas = mysql_num_rows($resp);
		
				WHILE($linea = mysql_fetch_row($resp))
				{
					$id		= $linea[0];
					$rutcli = $linea[1];
					$cuotas = $linea[2];
					$valorcuota = $linea[3];
					$vencimiento = $linea[4];
					$fechapago =$linea[5];
					$estado =$linea[6];
					$diasatraso =$linea[7];
					$valoratraso =$linea[8];
					
					$fc = explode("|",clienterut($rutcli));
					$nombre = $fc[0];

					echo "<tr>";
					echo "<td id ='data'align='center' ><b><a id='etiquetazul' href='facturas.php?cb=".$id."' target='_blank'>".codigoid($id)."</b></td>";
					echo "<td id ='data'>".$nombre."/<br/><b>".$rutcli."</b></td>";
					echo "<td id ='data' align='right'> ".$cuotas."</td>";
					echo "<td id ='data' align='right'>$ ".$valorcuota."</td>";
					echo "<td id ='data' aling='center'> ".$vencimiento."</td>";
					echo "<td id ='data' align='right'>$ ".$valoratraso."</td>";
					echo "<td id ='data4' align='center'> <b>".$fechapago."</b></td>";
					echo "</tr>";
					
					$a++;
					
				}
				
				$deudas="SELECT SUM(  `valor_cuota_atraso_pc` ) AS deuda_total FROM tbk_pago_cuota WHERE rut_cli = '".$rutcli."' ORDER BY SUBSTR( vencimiento_pc, 7, 4 ) , SUBSTR(									vencimiento_pc, 4, 2 ) ASC ";
				$resp_de = mysql_query($deudas, $conn);
				$d=0;
				$pfilasd = mysql_num_rows($resp_de);
					WHILE($linead = mysql_fetch_row($pfilasd))
				{
					$deuda_total=$linead[1];
					echo"".$deuda_total."";
					echo "<td id ='data4' align='center'> <b>".$fechapago."</b></td>";
					$d++;
					}
					
	?>
	</table>
    
	</center>
</td>
</tr>
</table>


<?php include("footer.php")?>