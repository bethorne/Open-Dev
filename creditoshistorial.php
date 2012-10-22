<?php include("header.php")?>


<?php



function limpiar($string )
{

	$string 	= str_replace("\'","",$string); 
	
	return $string;
}



	$cb 		= $_GET['ID'];
	
	
	$see 		= $_POST['look'];


	$cpaterno		= $_POST['cpaterno'];
	$crut 			= $_POST['ID'];
	$erut 			= $_POST['erut'];
	$boton 		= "0";
	

	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert = "SELECT * FROM tbk_cliente WHERE rut_cli LIKE '".trim($erut)."%'";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_cliente WHERE nombre_cli LIKE '".trim($cpaterno)."%'";
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
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> Informe Abono de Cliente</label>
	<br/>
	<label id='comentariogris'> Ingrese uno de los campos para buscar un Cliente. Para listar todos los clientes presione buscar con el campo 'nombre' vac&iacute;o.</label>
	<hr/>
	<p/>
	

	<form name='np' action='creditoshistorial.php' method ='POST'>
	

	<table border='0'>
	<tr>
	<td width='800' valign='top'>
	
			<label id='subtitulo'> Resultado B&uacute;queda </label>
			<p/>

				
			
				<table border='0' cellspacing='5' cellpadding='5' width='430' background='images/logos/fondo_menu.jpg'>
				<tr>
				<td>
					<label id='comentario'>por rut</label>
				</td>
				<td valign='top' align='right' width='100'>
						<input type='text' name='erut' value='<?=limpiar($erut)?>' size='14' >
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='np.look.value=1; np.submit()'>
				</td>
				</tr>
				
				<tr>
				<td>
					<label id='comentario'>por Nombre</label>
				</td>
				<td valign='top'  width='100' align='right'>
						<input type='text' name='cpaterno' value='<?=$cpaterno?>'  size='14'>						
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='np.look.value=2; np.submit()'>
				</td>
				<td />
				</tr>
					
				</table>
			<p/>
			<fieldset>
				<table border='0' cellspacing='5' cellpadding='5' width='400' >
				<?php
				
				
						if ($busqueda == 1)
						{
							$i=0;
							While ($row = mysql_fetch_row($res))
							{
								$snombre = $row[1];
								$srut = $row[0];
								$spaterno  = $row[2];
								$smaterno = $row[3];
								
								
								echo "<tr><td id='data' width='20'><a id='menualternativo' href='creditoshistorial.php?ID=".$srut."'><img src='images/flechita.gif' border='0'></a></td><td id='data' width='100'><label id='menualternativo' >".$srut."</label></td><td id='data'>".$snombre."</td><td id='data'>".$spaterno." ".substr($smaterno,0,1)."</td></tr>";
								$i++;
							}
						}
						else
						{
							echo "<tr><td id='etiqueta'>Recuerde colocar s&oacute;lo letras y n&uacute;meros</td></tr>";
						}
					
				?>
				
					</table>
			
			</fieldset>
			
			<p/>
			
			
	</td>
	</tr>
	
	<tr>
	<td width='800' valign='top'>
	<?php if (!empty($cb)) :?>
	
			<?php
			
				//buscando datos de cliente
				
				$searchcli = "SELECT * FROM tbk_cliente WHERE rut_cli ='".$cb."'";
				$res = mysql_query($searchcli, $conn);
				
		
				$fichaCli = mysql_fetch_row($res);
				
			
			
			
			
			
			?>
			<label id='subtitulo'> Ficha Usuario </label>
			<p/>
			
			<fieldset>
			
			<table border='0' cellspacing='5' cellpadding='5' width='700'>
			<tr>
			<td id='etiqueta'>
				Nombre
			</td>
			<td id='data' colspan='3'>
				<?=$fichaCli[1]." ".$fichaCli[2]." ".$fichaCli[3]?>
			</td>
			</tr>
			
			<tr>
			<td id='etiqueta'>
				Fono
			</td>
			<td id='data'>
				<?=$fichaCli[9]?>
			</td>
			<td id='etiqueta'>
				Direcci&oacute;n
			</td>
			<td id='data'>
				<?=$fichaCli[4]?>
			</td>
			</tr>
			</table>
			</fieldset>
		
			<p/>
		
			<label id='subtitulo'> Historial de Cr&eacute;ditos</label>
			<p/>
			
			<fieldset>
			
			<table border='0' cellspacing='5' cellpadding='5' width='700'>
			<tr>
				<th id='etiqueta'> Cliente </th>
				<th id='etiqueta'> Monto Cr&eacute;dito </th>
				<th id='etiqueta'> Saldo Cr&eacute;dito </th>
				<th id='etiqueta'> Fecha Aprobación </th>
				<th id='etiqueta'> Fecha &Uacute;ltima Actualizaci&oacute;n </th>
				<th id='etiqueta'> Autorizado por</th>
				<th id='etiqueta'> Estado</th>

			</tr>
			
			<?php
			
				if (!empty($cb))
					{
							$insert = "SELECT * FROM tbk_credito WHERE rut_cli LIKE '".trim($cb)."'  ORDER BY SUBSTR(fecha_cre,7,4), SUBSTR(fecha_cre, 4,2)  DESC";	
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
		
									if ($campo7 == 1 ) $estadocredito  ="Activo";
									if ($campo7 == 0 ) $estadocredito  ="Inactivo";

									
									
									/*
									$searchcodigo = "SELECT codigo_doc FROM tbk_documento WHERE id_doc = ".$campo3;
									$rescodigo = mysql_query($searchcodigo, $conn);
									
									$fichadoc = mysql_fetch_row($rescodigo);
									
									$codigo_doc = $fichadoc[0];
									*/
									
									echo "<td id='etiqueta' width='80'>".$campo1."</td>";
									echo "</td><td id='data' width='90' align='right'>$ ".$campo2."</td><td id='data' align='right' width='90'>$ ".$campo3."</td><td id='data'>".$campo4."</td><td id='data' >".$campo5."</td><td id='data' width='200'>".$campo6.".</td><td id='data'>".$estadocredito."</td>";
									echo "</tr>";
									
									$j++;
								
								}
								
							}
			
					}
				
					
				

				
					
				
					?>
			</table>
	<?php endif ?>
	
	</td>

	</tr>
	</table>
	

	<p/>
	
	<table border='0' width='800'>
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