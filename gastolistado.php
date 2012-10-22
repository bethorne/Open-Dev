 <?php
include("conector/conector.php");
include("functions.php");
include("header-zero.php");
$today = date(d."-".m."-".Y); 
$insert="SELECT * FROM tbk_gasto WHERE fecha_gas=".$today." ";

if($res = mysql_query($insert ))
		{
			$busqueda = 1;
			
		}
			
		else
		{
		
			$busqueda = 0;
		}					
			?>						
            <h1>Listado de Gastos 
            de Hoy <?=$today?></h1>
            <table  >
									  <tr>
 									<td id='data' width='143'  ><font size='4'>Fecha</font></td>
									
									<td width='300'  id='data'><font size='4'>Motivo</font></td>
									<td width='78' id='data'><font size='4'>Monto</font></td>
									
									
			  </tr>
</table>
                                <?php
					if ($busqueda == 1)
					{
						$i=0;
						While ($row = mysql_fetch_row($res))
						{
						
							$fecha = $row[1];
							$cantidad = $row[2];
							$obs  = $row[3];
							$rut = $row[4];
							
						 	
							 echo"<table  >
								  <tr>
 								<td    id='etiqueta'  ><font size='4'>".$fecha."</font></td>
									
									<td width='300'  id='data'><font size='4'>".$obs."</font></td>
									<td width='78' id='data'><font size='4'>$".$cantidad."</font></td>
									
									
								  </tr>
								</table>";
								
									 
								 
						
						
						 
							$i++;
						}
					}
					
			 
?>
