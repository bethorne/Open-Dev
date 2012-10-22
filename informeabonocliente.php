<?php include("header.php")?>
<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> Informe Abonos/Pagos de Clientes</label>
	<br/>
	<label id='comentariogris'> Elija al cliente que desea consultar sus abonos o pagos.</label>
	<hr/>
	<p/>
	
	
	<center>
	<table border='0' width='700' cellpadding='5'>
	<tr>
		<td id='etiqueta'> DOC.</TD>
		<td id='etiqueta'> NOMBRE</TD>
		<td id='etiqueta'> MONTO</TD>
		<td id='etiqueta'> SALDO</TD>
		<td id='etiqueta'> ULTIMA ACTUALIZACION</TD>
		<td id='etiqueta'> AUTORIZA</TD>
		<td id='etiqueta'> ESTADO</TD>
		
		
		
	</tr>
	<?php
		include("functions.php");
		
		$x= $_GET['x'];

							$insert = "SELECT * FROM tbk_abono ORDER BY SUBSTR(fecha_ab,7,4), SUBSTR(fecha_ab, 4,2), SUBSTR(fecha_ab, 12,5)  DESC";	
						// WHERE rut_cli='".trim($x)."' 
							//echo $insert;
							
							if($respro = mysql_query($insert,$conn))
							{	
								
								$j=0;
								WHILE ($ficha = mysql_fetch_row($respro))
								{
									echo "<tr>";
									
									
									$campo1 		= $ficha[0];
									$campo2 		= $ficha[1];
									$campo3 		= $ficha[2];
									$campo4 		= $ficha[3];
									$campo5 		= $ficha[4];
									$campo6 		= $ficha[4];
									$campo7 		= $ficha[6];
									$campo8 		= $ficha[7];
									$campo9 		= $ficha[8];
									$campo10 		= $ficha[9];
									
									if ($campo5 == 1) $tipopago ="Tarjeta";
									if ($campo5 == 2) $tipopago ="Efectivo";
									
									
									$tipopago2 ='';
									SWITCH($campo6)
									{
										case '1' : $tipopago2 = 'Dinero'; break;
										case '2' : $tipopago2 = 'RedCompra'; break;
										case '3' : $tipopago2 = 'Cheque'; break;
										case '4' : $tipopago2 = 'Transferencia Elect.'; break;
									
									
									
									
									}

									
									//echo "<td id='data'>".$campo2."</td>";
									if (!empty($campo3))
									{
										echo "<td id='data' align='center'><a  id='etiquetazul' href='facturas.php?cb=".$campo10."' target='_blank'>".codigoid($campo10)."</a>  ";
									}
									else
									{	
										echo "<td id='data' />";
									}
									echo "</td>";
									echo "<td id='data'>".clienterut($campo2)."</td>";
									echo "<td id='data'>".$campo9."</td>";
									echo "<td id='data'>".$campo9."</td>";
									echo "<td id='data'>".banco($campo8)."</td>";
									echo "<td id='data'>".$campo10."</td>";
									echo "<td id='data' align='right'>$ ".$campo9."</td>";
									echo "</tr>";
									
									$j++;
								
								}
								
							}
			
					
				

				
				
	
	
	?>
	</table>
	</center>
	
</td>
</tr>
</table>


<?php include("footer.php")?>