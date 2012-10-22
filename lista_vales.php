 <?php
include("conector/conector.php");
include("functions.php");
include("header-zero.php");
$today = date(d."-".m."-".Y); 
$insert="SELECT * FROM tbk_documento WHERE fecha_doc = '$today' ";

if($res = mysql_query($insert ))
		{
			$busqueda = 1;
			
		}
			
		else
		{
		
			$busqueda = 0;
		}
			
					if ($busqueda == 1)
					{
						$i=0;
						While ($row = mysql_fetch_row($res))
						{
							$facturaID = $row[0];
							$clienteID = $row[1];
							$fechafact = $row[3];
							$total  = $row[4];
							$estado = $row[5];
							$codigo=$row[6];
							$tipo=$row[2];
							
							$proceso ="";
							SWITCH($estado)
							{
								case '1' : $proceso = "Pendiente"; break;
								case '0' : $proceso = "Cancelado"; break;
								case '9' : $proceso = "Nulo"; break;
								
							
							
							
							}
							SWITCH($tipo)
				{
					CASE '1' : $documento = "BOLETA"; break;
					CASE '2' : $documento = "GUIA"; break;
					CASE '3' : $documento = "FACTURA"; break;
					CASE '4' : $documento = "NVF"; break;
					
				}
							$nc = explode("|",clienterut($clienteID));
							$nombrecliente = $nc[0];
						 	
							 if($estado=='1'){
								 
								 	echo"<table width='100%' cellpadding='1'   >
								  <tr>
 <td    bgcolor='#FF0000' width='18' ><a id='etiquetazul' href='vervale.php?cb=".$facturaID."' target='popup' onClick='window.open(this.href, this.target, 'width=500,height=400'); return false;'><font size='4'>".$facturaID."</font></a></td>
									<td  width='397' bgcolor='#FF0000'>".$clienteID."".$nombrecliente."</td>
									<td  width='111'  bgcolor='#FF0000'>".$fechafact."</td>
									<td  width='78' bgcolor='#FF0000'>$".$total."</td>
									<td  width='73' bgcolor='#FF0000'>".$proceso."</td>
									<td width='256'  bgcolor='#FF0000'>".$codigo."</td>
									<td width='73' bgcolor='#FF0000'>".$documento."</td>
								  </tr>
								</table>";
								 
								 }
								 else{
									 echo"<table width='100%'  >
								  <tr>
 <td    id='etiqueta' width='17' ><a id='etiquetazul' href='vervale.php?cb=".$facturaID."' target='popup' onClick='window.open(this.href, this.target, 'width=500,height=400'); return false;'><font size='4'>".$facturaID."</font></a></td>
									<td width='397' id='data'>".$nombrecliente."</td>
									<td width='111'  id='data'>".$fechafact."</td>
									<td width='78' id='data'>$".$total."</td>
									<td width='73' id='data'>".$proceso."</td>
									<td width='256' id='data'>".$codigo."</td>
									<td width='73'id='data'>".$documento."</td>
								  </tr>
								</table>";
								
									 }
								 
						
						
						 
							$i++;
						}
					}
					else
					{
						echo "<tr><td id='etiqueta'>Recuerde colocar s&oacute;lo letras y n&uacute;meros</td></tr>";
					}
			 
?>
