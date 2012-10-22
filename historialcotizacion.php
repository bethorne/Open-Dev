<?php include("header-micro.php")?>


<?php



	include("functions.php");


	$cb 		= $_GET['ID'];
	
	
	$see 		= $_POST['look'];


	$cpaterno		= $_POST['cpaterno'];
	$crut 			= $_POST['crut'];
	
	$boton 		= "0";
	

	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert = "SELECT * FROM tbk_cliente WHERE rut_cli LIKE '".trim($crut)."%'";
					
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_cliente WHERE nombre_cli LIKE '%".trim($cpaterno)."%' ORDER BY nombre_cli ASC";
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
		

	if (!empty($cb))
	{
			$insert = "SELECT DISTINCT id_fact FROM tbk_pago_cuota WHERE rut_cli LIKE '".trim($cb)."' AND diasatraso_pc > 0 ORDER BY id_fact DESC";	
			//echo $insert;
			
			if($respro = mysql_query($insert,$conn))
			{	
				$facturasadeudadas[]="";
				
				$j=0;
				WHILE ($ficha = mysql_fetch_row($respro))
				{
					
					$facturasadeudadas[$j] 		= $ficha[0];
					$j++;
				
				}
				
			}
	
	}

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>


<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> Buscar Cliente</label>
	<br/>
	<label id='comentariogris'> Ingrese uno de los campos para buscar un Cliente. Para listar todos los clientes presione buscar con el campo 'nombre' vac&iacute;o. </label>
    <label id='comentariogris'> El cliente tiene que estar registrado para poder hacer un ARRIENDO DE MAQUINARIA </label>
	<hr/>
	<p/>
	

	<form name='np' action='historialcotizacion.php' method ='POST'>
	

	<table border='0'>
	<tr>
	<td width='400' valign='top'>
	
			<label id='subtitulo'>Criterio de B&uacute;squeda</label>
				<br/>
				<p/>
					
			
				<table border='0' cellspacing='5' cellpadding='5' width='390' background='images/logos/fondo_menu.jpg' >
				<tr>
				<td>
					<label id='comentario'>RUT</label>
				</td>
				<td  align='right' width='100'>
						<input type='text' name='crut' value='<?=limpiar($crut)?>' size='14' >
				</td>

				<td width='16'>
						<input type='image' src='images/lupa.png' onClick='np.look.value=1; np.submit()'>
				</td>
				</tr>
				
				
				<tr>
				<td>
					<label id='comentario'>APELLIDO PATERNO</label>
				</td>
				<td   width='100' align='right'>
						<input type='text' name='cpaterno' value='<?=$cpaterno?>'  size='14'>
						<br/>
						
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
								
								
								echo "<tr><td id='data' width='20'><a id='menualternativo' href='historialcotizacion.php?ID=".$srut."'><img src='images/flechita.gif' border='0'></a></td><td id='data' width='100'>".$srut."</td><td id='data'>".$snombre."</td><td id='data'>".$spaterno." ".substr($smaterno,0,1)."</td></tr>";
								$i++;
							}
						}

					
				?>
				
					</table>
			
			</fieldset>
			
			<p/>
			
			
	</td>
	<td valign='top'>
		
			<?php
			
				//buscando datos de cliente
				
				$searchcli = "SELECT * FROM tbk_cliente WHERE rut_cli ='".$cb."'";
				$res = mysql_query($searchcli, $conn);
				
		
				$fichaCli = mysql_fetch_row($res);
				
			
			?>
			<label id='subtitulo'> Ficha Usuario </label>
			<p/>

			
			<table border='0' cellspacing='5' cellpadding='5' width='400' background='images/logos/fondo_menu.jpg'>
			<tr>
			<td id='ficha'> 
				Cliente
			</td>
			<td id='ficha'>
				<?=$fichaCli[0]?> <?=$fichaCli[1]." ".$fichaCli[2]." ".$fichaCli[3]?>
			</td>
			</tr>
			
			<tr>
			<td id='ficha'>
				Direcci&oacute;n
			</td>
			<td id='ficha'>
				<?=$fichaCli[4]?> <?=$fichaCli[5]?>
			</td>
			</tr>
			</table>
			
			<br/>
			<p/>
			
			<label id='subtitulo'> Arrendar</label>
			<p/>
			
			<?php if (!empty($cb)) :?>
			<center>
			<table border='0' cellspacing='5' cellpadding='5'>
			<tr>
			<td id='data' valign='bottom' align='center'>
					<a  id='menualternativo' href='home.php'><img src="images/logos/cancelar0.jpg" onmouseover="this.src = 'images/logos/cancelar1.jpg'" onmouseout="this.src = 'images/logos/cancelar0.jpg'" border="0"></img></a><br/>
			</td>
			<td id='data' valign='bottom'  align='center'>
					<a id='menu' href='cajaarriendo.php?IDcliente=<?=$cb?>&tp=1'><img src="images/logos/aceptar0.jpg" onmouseover="this.src = 'images/logos/aceptar1.jpg'" onmouseout="this.src = 'images/logos/aceptar0.jpg'" border="0"></img></a>
			</td>

			</tr>
			</table>
			</center>
			<?php endif ?>
	
	</td>
	</tr>
	
	<tr>
	<td width='400' valign='top'>
	<?php if (!empty($cb)) :?>
	

			<label id='subtitulo'> Documentos con  Deudadas </label>
			<p/>
			
			<fieldset>
			
			<table border='0' cellspacing='5' cellpadding='5' width='400'>
			
			<tr>			
			<td >
			
				 <label id='comentario'> El Cliente adeuda los siguientes documentos </label> <p/>
				
			
				<?php
				
					$j=0;
					WHILE ($facturasadeudadas[$j])
					{
						echo " <a id='etiquetazul' href='facturas.php?cb=".$facturasadeudadas[$j]."' target='_blank'>".codigoid($facturasadeudadas[$j])."<img src='images/editar.jpg'> </a>, ";

						$j++;
					}
				
				
					?>
			</td>
			</tr>
			</table>
	
			
			
	<?php endif ?>
	
	</td>

	</tr>
	</table>
	

	<p/>
	
	<table border='0' width='890'>
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
	<td align='center'>
	

			
	
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