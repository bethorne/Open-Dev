<?php include("header-zero.php")?>

<link rel="stylesheet" type="text/css" href="pagination.css"> 
<?php



function limpiar($string )
{

	$string 	= str_replace("\'","",$string); 
	
	return $string;
}



	$cb 		= $_GET['cb'];
	$see 		= $_POST['look'];

	$pos 		= $_GET['pos'];


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
					$insert = "SELECT * FROM tbk_producto WHERE nombre_pro LIKE  'arriendo%' AND nombre_pro LIKE '%".trim($nombre)."%'";
					$_pagi_cuantos = 10;
					$_pagi_nav_num_enlaces = 10;
					include("paginator.inc.php");
					
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_producto WHERE codigo_pro LIKE '".trim($cbarra)."'";
					$_pagi_cuantos = 10;
					$_pagi_nav_num_enlaces = 10;
					include("paginator.inc.php");
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
			$insert = "SELECT * FROM tbk_producto WHERE cbarra_pro LIKE '".trim($cb)."'";	
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
				
			
			}
	
	}

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>


<center>
<table border='0' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> BUSCAR MAQUINA</label>
	<br/>
	<label id='comentariogris'> Complete uno de los campos para realizar la b&uacute;squeda. Si desea listar todos las maquinas, haga click en 'buscar nombre' con el campo vac&iacute;o.</label>
	<hr/>
	<p/>


	<form name='np' action='elegirarriendo.php' method ='POST'>
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
				<table border='0' cellspacing='5' cellpadding='5' width='750' >

				<?php
				
					if ($busqueda == 1)
					{
						echo "				
						<tr>
							<td/>
						<th id='etiqueta'> CODIGO</th>
						<th id='etiqueta'> NOMBRE</th>
					
						<th id='etiqueta'> STOCK </th>
						<th id='etiqueta'> PRECIO</th>
						
						</tr>";
						$i=0;
						While ($row = mysql_fetch_row($res))
						{
							$sid 	 = $row[0];
							$snombre = $row[2];
							$scbarra = $row[1];
							$smarca  = $row[4];
							$smodelo = $row[5];
							
							
							// STOCK producto
							
							$searchprecio = "SELECT  * FROM tbk_stock WHERE id_pro = ".$sid;
							$respre  = mysql_query($searchprecio, $conn);
							
							$fichastock = mysql_fetch_row($respre);
							
							$sminimo  = $fichastock[3];
							$salerta  = $fichastock[4];
							$smaximo  = $fichastock[5];
							$sstock   = $fichastock[2];
							
							//PRECIO PRODUCTO
								$srprecio = "SELECT  * FROM tbk_producto_valor WHERE id_pro = ".$sid;
							$respres  = mysql_query($srprecio, $conn);
							
							$fichaprecio = mysql_fetch_row($respres);
							
							$precio  = $fichaprecio[3];
							
							
							echo "<tr><td  bordercolor='red' id='etiqueta' width='5'><a href='#' onClick='window.opener.np.codigo.value=&quot; ".$scbarra."&quot; ; window.close()'><img src='images/flechaizq.jpg' border='0'></a></td><td id='data' width='20'".$scbarra."'>".$scbarra."</td><td id='data'>".$snombre."</td><td id='data'>".$salerta."-".$sstock."</td><td id='data'>".$precio."</td></tr>";
							$i++;
							
						}
					}
					else
					{
						echo "<tr><td id='etiqueta'>Recuerde colocar s&oacute;lo letras y n&uacute;meros</td></tr>";
					}
				 echo" <ul id='pagination-digg'>".$_pagi_navegacion."</> ";
				
				?>
				
					</table>
			
			</fieldset>
			
			<p/>
			
			<input type='hidden' name='look' value=''>
				
		</form>





</td>
</tr>
</table>
</center>

<?php include("footer.php")?>