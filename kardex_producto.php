<?php include("header.php")?>


<?php



function limpiar($string )
{

	$string 	= str_replace("\'","",$string); 
	
	return  trim($string);
}



	$cb 		= $_GET['cb'];
	$see 		= $_POST['look'];


	$nombre		= $_POST['nombre'];
	$cbarra 	= $_POST['cbarra'];
	$marca 		= $_POST['marca'];
	$modelo 	= $_POST['modelo'];
	$um1 		= $_POST['um1'];
	$valor1 	= $_POST['valor1'];
	$fam 		= $_POST['fam'];
	$subfam 	= $_POST['subfam'];
	$boton 		= "0";
	

	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert = "SELECT * FROM tbk_producto WHERE nombre_pro LIKE '".trim($nombre)."%'";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_producto WHERE codigo_pro LIKE '".trim($cbarra)."%'";
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
			$insert = "SELECT * FROM tbk_producto WHERE codigo_pro LIKE '".trim($cb)."'";	
			if($respro = mysql_query($insert,$conn))
			{	
				$ficha[]="";
				
			
				$ficha = mysql_fetch_row($respro);
				
				$idpro 		= $ficha[0];
				$fnombre 	= $ficha[2];
				$fcbarra 	= $ficha[1];
				$fdesc 		= $ficha[3];
				$fmarca 	= $ficha[4];
				$fmodelo 	= $ficha[5];
				$fcodigo2   = $ficha[9];
				$fcodigo3   = $ficha[10];
				
			
			}
	
	}

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>


<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >
	<br/>
	<p/>
	
	<label id='subtitulo'> BUSCAR PRODUCTO</label>
	<br/>
	<label id='comentariogris'> Complete uno de los campos para realizar la b&uacute;squeda. Si desea listar todos los productos, haga click en 'buscar nombre' con el campo vac&iacute;o.</label>
	<hr/>
	<p/>


	<form name='np' action='kardex_producto.php' method ='POST'>
	

	<table border='0'>
	<tr>
	<td width='800' valign='top'>
	
			<label id='subtitulo'> Resultado B&uacute;queda </label>
			<p/>
			
				<table border='0' cellspacing='5' cellpadding='5' width='450' background='images/logos/fondo_menu.jpg' >
				<tr>
				<td>
					<label id='comentario'>Nombre</label>
				</td>
				<td valign='top' align='right' width='100'>
						<input type='text' name='nombre' value='<?=limpiar($nombre)?>' size='20' >					
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='np.look.value=1; np.submit()'>
				</td>
				</tr>
				
				<tr>
				<td>
					<label id='comentario'>C&oacute;digo</label>
				</td>
				<td valign='top'  width='100' align='right'>
						<input type='text' name='cbarra' value='<?=$cbarra?>'  size='20'>
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='np.look.value=2; np.submit()'>
				</td>
				</tr>


				</table>
			<p/>
			<fieldset>
				<table border='0' cellspacing='5' cellpadding='5' width='600' >
				<?php
				
					if ($busqueda == 1)
					{
						$i=0;
						While ($row = mysql_fetch_row($res))
						{
							$snombre = $row[2];
							$scbarra = $row[1];
							$smarca  = $row[4];
							$smodelo = $row[5];
							
							echo "<tr><td id='data' width='5'><a id='etiquetazul' href='kardex_producto.php?cb=".$scbarra."' target='blank'><img src='images/flechita.gif' border='0'></a></td><td id='data' width='100'><a id='etiquetazul' href='kardex_producto.php?cb=".$scbarra."' target='blank'>".$scbarra."</a></td><td id='data' width='300'>".$snombre."</td><td id='data'>".$smarca."</td><td id='data'>".$smodelo."</td></tr>";
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
		
			<label id='subtitulo'> Ficha Producto </label>
			<p/>
			
			<fieldset>
			
				
			<table border='0' cellspacing='5' cellpadding='5' >
			<tr>
				<td id='data'>
					 <?=$fcbarra?>
				</td>
				<td id='data'>
					 <?=$fcodigo2?>
				</td>
				<td id='data'>
					 <?=$fcodigo3?>
				</td>
			</tr>
			
			<tr>
				<td id='etiqueta'> C&oacute;digo producto</td>
				<td id='etiqueta'> C&oacute;digo alternativo 1</td>
				<td id='etiqueta'> C&oacute;digo alternativo 2</td>
			</tr>
			</table>
			
			<br/>
			
			<table border='0' cellspacing='5' cellpadding='5' width='750'>
			<tr>
				<td id='data'>
					 <?=$fnombre?>
				</td>
				<td id='data'>
					 <?=$fmarca?>
				</td>
				<td id='data'>
					 <?=$fmodelo?>
				</td>
				<td id='data'>
					 <?=$fdesc?>
				</td>
			</tr>
			
			<tr>
				<td id='etiqueta' align='left'>NOMBRE</td>
				<td id='etiqueta' align='left'>MARCA</td>
				<td id='etiqueta' align='left'>MODELO</td>
				<td id='etiqueta' align='left'>DESCRIPCION</td>
				
			</tr>
			</table>
			
			</fieldset>
			
			<?php

				// buscando inventario si existe... si no, debe considerar todas las fechas del kardex
				$find = "SELECT * FROM tbk_inventario WHERE  id_pro = ".trim($idpro)." ORDER BY fecha_inv DESC";
				if ($resf = mysql_query($find, $conn))
				{
					$nfilas = mysql_num_rows($resf);
					
					$fechainicio  = 0;
					$cantidad = 0;
					if ($nfilas > 0)
					{
						$ficha2 = mysql_fetch_row($resf);
						
						$fechainicio = $ficha2[0];
						$cantidad = $ficha2[2];
					}
					
					if ($fechainicio >0)
						//$fechabusqueda  = substr($fechainicio,0,8)."0000";
						$fechabusqueda = $fechainicio;
						
					else
						$fechabusqueda  = 0;
						
					$busca = " SELECT fecha_kdx, operacion_kdx, tipodoc_kdx, cantidad_doc1_kdx, cantidad_doc2_kdx, doc1_kdx, doc2_kdx FROM tbk_kardex WHERE id_pro ='".$idpro."' AND  fecha_kdx >= ".$fechabusqueda." ORDER BY fecha_kdx ASC";
					
					//echo $busca ." y cantidad: ".$cantidad;
					//echo "<p>";
					
					//buscando en kardex movimientos desde la fecha indicada
					
					$saldodisponible = $cantidad;
					$saldofisico  = $cantidad;
					$pendienteentrega = 0;
					$pendienterecepcion = 0;
					
					
					$reskdx = mysql_query($busca, $conn);
					
					$nfilask= 0;
					$nfilask = mysql_num_rows($reskdx);
					
					if ($nfilask > 0)
					{
						$k=0;
						WHILE ($fichak = mysql_fetch_row($reskdx))
						{
							$op = $fichak[1];
							$tipo = $fichak[2];
							$cantidad1 = $fichak[3];
							$cantidad2 = $fichak[4];
							
							$codigodoc1 = $fichak[5];
							$codigodoc2 = $fichak[6];
									
							
							//echo ">".$op."-".$cantidad1."-".$cantidad2."- C1.:".$codigodoc1."- C2.:".$codigodoc2."<br/>";
							
							
							SWITCH($op)
							{
								case '0' :

											if($tipo == 3)
											{
												$pendiente = $cantidad1  - $cantidad2;
												$saldodisponible = $saldodisponible + $cantidad1;
												$saldofisico = $saldofisico + $cantidad2;
												$pendienterecepcion = $pendienterecepcion + $pendiente;
											}
											
											if($tipo == 2)
											{
												
												
												$saldofisico = $saldofisico + $cantidad2;
												$pendienterecepcion = $pendienterecepcion - $cantidad2;
											}
											break;
											
								case '1' :
											if($tipo == 4)
											{
												$pendiente = $cantidad1  - $cantidad2;
												$saldodisponible = $saldodisponible - $cantidad1;
												$saldofisico = $saldofisico - $cantidad2;
												
												$pendienteentrega = $pendienteentrega + $pendiente;
											}
											if($tipo == 3)
											{
												$pendiente = $cantidad1  - $cantidad2;
												$saldodisponible = $saldodisponible - $cantidad1;
												$saldofisico = $saldofisico - $cantidad2;
												
												$pendienteentrega = $pendienteentrega + $pendiente;
											}
											
											if($tipo == 2)
											{
												
												$saldofisico = $saldofisico - $cantidad2;
												
												
												// esto es porque una guia suelta es diferente a una guia generada de factura
												if ($codigodoc2 == '')
												{
													$saldodisponible = $saldodisponible - $cantidad2;
												}
												else
												{
													$pendienteentrega = $pendienteentrega - $cantidad2;
												}
											}
											
											
											if($tipo == 1)
											{
												$pendiente = $cantidad1  - $cantidad2;
												$saldodisponible = $saldodisponible - $cantidad1;
												$saldofisico = $saldofisico - $cantidad2;
												
												$pendienteentrega = $pendienteentrega + $pendiente;
											}
											
											

											break;
								case '2' :
											if($tipo == 3)
											{
												$pendiente = $cantidad1  - $cantidad2;
												$saldodisponible = $saldodisponible - $cantidad1;
												$saldofisico = $saldofisico - $cantidad2;
												
												$pendienteentrega = $pendienteentrega + $pendiente;
											}
											
											if($tipo == 2)
											{
												
												$saldofisico = $saldofisico + $cantidad2;
												$pendienteentrega = $pendienteentrega + $cantidad2;
											}
											
											
											break;
											
								case '7' :

												$saldofisico = $saldofisico - $cantidad2;
												$saldodisponible = $saldodisponible - $cantidad2;
																					
											break;
								
								// por que no hay operacion 8?: porque  siempre parte del ultimo 8 encontrado..
											
								case '9' :
											$pendiente = $cantidad1  - $cantidad2;
											$pendienterecepcion = $pendienterecepcion + $pendiente;
											
											break;
							
							
							}
							
							$k++;
						}
						
					}
					else
					{
						// no hay kardex
					}
					
					
				
				?>	
					<p/>
					<label id='subtitulo'> Kardex  </label>
					<p/>
			
					<fieldset>
					
					<table border='0' cellspacing='5' cellpadding='5' width='750'>
					<tr>
					<td id='etiqueta'  width='100'>
						Saldo Fisico
					</td>
					<td id='data'>
						<?=$saldofisico?>
					</td>
					<td id='data'  rowspan='4' width='300' align='center'>
							<a id='etiqueta' href='kardex.php?id=<?=$idpro?>' target='_blank'>VER KARDEX  DETALLADO COMPLETO</a>
							<p/>
							<label id='comentariogris'> Los c&aacute;lculo de kardex  se consideran a partir del &uacute;ltimo inventario registrado.</label>
					</td>
					</tr>
					
					<tr>
					<td id='etiqueta'  width='100'>
						Saldo Disponible
					</td>
					<td id='data'>
						 <?= ($saldodisponible)?>
					</td>

					</tr>
					
					<tr>

					<td id='etiqueta' >
						Pendiente Entrega
					</td>
					<td id='data'>
						 <?=$pendienteentrega?>
					</td>
					</tr>
					
					<tr>

					<td id='etiqueta' >
						Pendiente Recepcion
					</td>
					<td id='data'>
						<?=$pendienterecepcion?>
					</td>
					</tr>
					</table>
					
					</fieldset>
					
		<?php 	} ?>
				

	
	<?php endif ?>
	</td>

	</tr>
	</table>
	

	<p/>
	
	<table border='0'>
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