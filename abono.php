<?php include("header-zero.php")?>


<?php


include("functions.php");


	$cb 		= $_GET['ID'];
	
	
	$see 		= $_POST['look'];


	$cpaterno		= $_POST['cpaterno'];
	$crut 			= $_POST['ID'];
	
	$boton 		= "0";
	

	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert = "SELECT * FROM tbk_cliente WHERE rut_cli LIKE '%".ltrim($crut)."%'";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_cliente WHERE paterno_cli LIKE '%".trim($cpaterno)."%'";
					break;
					

					
		}
		//echo "BUSCANDO=".$insert;
		
		if($res = mysql_query($insert,$conn))
		{
			$busqueda = 1;
			
		}
			
		else
		{
		
			$busqueda = 0;
		}
			
			
	}	
		



	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>


<center>
<table border='0' width='760' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> Informe Pago/Abono de Cliente</label>
	<br/>
	<hr/>
	<p/>
	

	<form name='np' action='abono.php' method ='POST'>
	

	<table border='0'>

	<tr>
	<td width='750' valign='top'>
	<?php if (!empty($cb)) :?>
	
			<?php
			
				//buscando datos de cliente
				
				$searchcli = "SELECT * FROM tbk_cliente WHERE rut_cli ='".$cb."'";
				$res = mysql_query($searchcli, $conn);
				
		
				$fichaCli = mysql_fetch_row($res);
				
			
			
			
			
			
			?>

			<fieldset>
			
			<table border='0' cellspacing='5' cellpadding='5' width='700'>
			<tr>
			<td id='etiqueta'>
				Nombre
			</td>
			<td id='data'>
				<?="(".$fichaCli[0].") ". $fichaCli[1]." ".$fichaCli[2]." ".$fichaCli[3]?>
			</td>
			</tr>
			
			</table>
			</fieldset>
		
			<p/>

			<fieldset>
			
			<table border='0' cellspacing='5' cellpadding='5' width='700'>
			<tr>
				<th id='etiqueta'> Documento <br/>Abonado</th>
				<th id='etiqueta'> Fecha</th>
				<th id='etiqueta'> Efectivo/<br/>Cr&eacute;dito </th>
				<th id='etiqueta'> Tipo/<br/>Efectivo </th>
				<th id='etiqueta'> Banco</th>
				<th id='etiqueta'> N° Documento</th>
				<th id='etiqueta'> Valor Abono</th>
			</tr>
			
			<?php
			
				if (!empty($cb))
					{
							$insert = "SELECT * FROM tbk_abono WHERE rut_cli LIKE '".trim($cb)."'  ORDER BY SUBSTR(fecha_ab,7,4), SUBSTR(fecha_ab, 4,2), SUBSTR(fecha_ab, 12,5)  DESC";	
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
									$campo6 		= $ficha[5];
									$campo7 		= $ficha[6];
									$campo8 		= $ficha[7];
									$campo9 		= $ficha[8];
									$campo10 		= $ficha[9];
									
									if ($campo5 == 0) $tipopago ="Cr&eacute;dito";
									if ($campo5 == 1) $tipopago ="Efectivo";
									if ($campo5 == 2) $tipopago ="Cr&eacute;dito<br/>Cliente";
									
									$tipopago2 ='';
									SWITCH($campo6)
									{
										case '1' : $tipopago2 = 'Dinero'; break;
										case '2' : $tipopago2 = 'RedCompra'; break;
										case '3' : $tipopago2 = 'Cheque'; break;
										case '4' : $tipopago2 = 'Transferencia Elect.'; break;
									
									
									
									
									}
									
									/*
									$searchcodigo = "SELECT codigo_doc FROM tbk_documento WHERE id_doc = ".$campo3;
									
									$rescodigo = mysql_query($searchcodigo, $conn);
									
									$fichadoc = mysql_fetch_row($rescodigo);
									
									$codigo_doc = $fichadoc[0];
									*/
									
									
									//echo "<td id='data'>".$campo2."</td>";
									if (!empty($campo3))
									{
										echo "<td id='data' align='right'><b>".codigoid($campo3)."</b> -  <a  id='menu' href='verfactura.php?cb=".$campo3."' target='_popup'  onClick='window.open(this.href, this.target, \"width=500,height=600\"); return false;'><img src='images/binoculares.gif' border='0'></a>  ";
									}
									else
									{	
										echo "<td id='data' />";
									}
									echo "</td>";
									echo "<td id='data'>".$campo4."</td>";
									echo "<td id='data'>".$tipopago."</td>";
									echo "<td id='data'>".$tipopago2."</td>";
									echo "<td id='data'>".banco($campo8)."</td>";
									echo "<td id='data'>".$campo10."</td>";
									echo "<td id='data' align='right'>$ ".$campo9."</td>";
									echo "</tr>";
									
									$j++;
								
								}
								
							}
			
					}
				
					$j=0;
					WHILE ($facturasadeudadas[$j])
					{
					
			
						echo "<tr>";
						echo "<td id='etiqueta' width='100'>";
						echo "	Ver Factura";
						echo "</td>";
						echo "<td id='data'>";
						echo "	<a id='etiquetazul' href='facturas.php?cb=".$facturasadeudadas[$j]."' target='_blank'>".$facturasadeudadas[$j]."</a>";
						echo "</td>";
						echo "</tr>";
			
					
						$j++;
					}
				
				
					echo "<tr>";
					echo "	<td id='etiqueta' colspan='6'>";
					echo "		Saldo<br/>Abonos";
					echo "	</td>";

					echo "	<td id='data' align='right'>";
						
						$insert = "SELECT * FROM tbk_saldo WHERE rut_cli LIKE '".trim($cb)."' ";	
						//echo $insert;
							
						if($ressal = mysql_query($insert,$conn))
						{
							$fsaldo = mysql_fetch_row($ressal);
							
							$saldoAbono = $fsaldo[1];
							
							echo "$ ".$saldoAbono;
						
						}
						else
							{
								echo "No reporta saldo";
							}
					
					
					
					
					echo "</td>";
					echo "</tr>";
				
					
				
					?>
			</table>
	<?php endif ?>
	
	</td>

	</tr>
	</table>
	

	<p/>
	
	<table border='0' width='750'>
	<tr>
	<td>
	
			<table border='0' width='400'>
			<tr>
			<td align='right'>
					<table border='0'>
					<tr>
					<td>
						
						<input type='hidden' name='look' value=''>
					
					</td>
					</tr>
					</table>
				
			</td>
			</tr>
			</table>
	</td>
	</tr>
	</table>
			
			
	<p/>
	

	
	
	</form>





</td>
</tr>
</table>
</center>

<?php include("footer.php")?>