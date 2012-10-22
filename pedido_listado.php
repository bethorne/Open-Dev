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
					$insert = "SELECT * FROM tbk_producto WHERE nombre_pro LIKE '%".ltrim($nombre)."%'";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_producto WHERE codigo_pro LIKE '".trim($cbarra)."'";
					break;
					
		

			case '3':
					$insert = "SELECT * FROM tbk_producto WHERE marca_pro LIKE '%".ltrim($marca)."%'";
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

	<label id='subtitulo'> PEDIDO DE PRODUCTOS DESDE BODEGA</label>
	<br/>
	<label id='comentariogris'> Complete uno de los campos para realizar la b&uacute;squeda. Si desea listar todos los productos, haga click en 'buscar nombre' con el campo vac&iacute;o.</label>
	<hr/>
	<p/>


	<form name='np' action='buscar.php' method ='POST'>
	

	<table border='0'>
	<tr>
	<td width='800' valign='top'>
		
			<label id='subtitulo'>  Listado de Pedidos </label>
			<p/>
			
			<fieldset>
				<table border='0' cellpadding='1'>
				<tr>
					<td id='etiqueta'/>
					<td id='etiqueta'> C&oacute;digo</td>
					<td id='etiqueta'> Nombre</td>
					<td id='etiqueta'> Marca</td>
					<td id='etiqueta'> Modelo</td>
					<td id='etiqueta'> Cantidad</td>
				</tr>
				
			<?php
				$buscaped = "SELECT * FROM tbk_pedido WHERE cantidad_pdd > 0 ORDER  BY id_pro ASC";
				$resped = mysql_query($buscaped, $conn);
				
				$nfilas  = mysql_num_rows($resped);
				
				$i=0;
				WHILE ($lista = mysql_fetch_row($resped))
				{
					$idpro = $lista[0];
					$cantidad = $lista[1];
									
					
					$buscapro = "SELECT codigo_pro, nombre_pro, marca_pro, modelo_pro FROM tbk_producto WHERE id_pro =".$idpro;
					$respro = mysql_query($buscapro, $conn);
					$fichapro = mysql_fetch_row($respro);
					$codigopro  = $fichapro[0];
					$nombrepro  = $fichapro[1];
					$marcapro  = $fichapro[2];
					$modelopro  = $fichapro[2];
					
					
					echo "<tr>";
					
					echo "<td id='data2'>";
					echo "<a href='buscar.php?cb=".$codigopro."' target='_blank'><img src='images/binoculares.gif' border='0'></a>";
					echo "</td>";
					
					
					
					echo "<td id='data2'>";
					echo $codigopro;
					echo "</td>";
					
					
					echo "<td id='data2'>";
					echo $nombrepro;
					echo "</td>";
					
					echo "<td id='data2'>";
					echo $marcapro;
					echo "</td>";
					
					echo "<td id='data2'>";
					echo $modelopro;
					echo "</td>";
					
					
					echo "<td id='data2' align='right'>";
					echo $cantidad;
					echo "</td>";
					echo "</tr>";
				
				
				
				
					$i++;
				}
			
			
			?>

				</table>
			</fieldset>
			

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