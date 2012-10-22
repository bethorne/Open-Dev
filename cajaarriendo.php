<?php include("header-micro.php")?>


<?php



	include("functions.php");


	$cb 		= $_GET['cb'];
	$IDcliente	= $_GET['IDcliente'];
	$see 		= $_POST['look'];


	$nombre		= $_POST['nombre'];
	$codigo 	= $_POST['codigo'];
	$cantidad 	= $_POST['cantidad'];
	$eliminar   = strtoupper($_POST['eliminar']);

	
	$boton 		= "0";
	
	$tp 		= $_GET['tp'];
	
	$lista = limpiar($_POST['lista']);
	$listaprecios = $_POST['listaprecios'];
	$subtotal = $_POST['subtotal'];
	
	
	$elementos  = "";
	$elementos  = explode("\n",$lista);
	
	
	
	
	// agregando producto nuevo ------------------------------------------------
		if ($codigo != '')
			{
			$np =  nombreprod($codigo);
		
			// ahora el neto
			$valor = ventaprod($codigo);
			
			
			if ($valor =='')
			{
					$tipomensaje = 0;
					$texto=" Atenci&oacute;n<p/>El producto <b> ".$np."</b> no tiene un precio definido. Para poder venderlo ingrese un valor para este producto.";
					include("mensaje.php");
					$codigo = "";
						
			}
			
			$idpp 	= codigoidprod($codigo);
			$stock  = stockprod($idpp);
			
		
		
		
					
			if ($cantidad <= 0)
			{
					$tipomensaje = 0;
					$texto=" Atenci&oacute;n<p/>Ingrese una cantidad de venta para el producto.";
					include("mensaje.php");
					$codigo = "";
						
			}
			
		}
		
		
		
		if ($codigo != '')
		{
			// si el codigo es distinto de vacio  debemos buscar sus datitos
			// primero que nada:  el nombre
			

			
			
			$lista ="";
			FOREACH($elementos as $elemento)
			{
					if ($elemento !='')
					{
						$lista  = $lista.$elemento;
						$e++;
					}
			}
			$lista = $lista."\n|".trim($codigo)."|".$np."|".$cantidad."|$ ".$valor;
		}	
		
		
		
		
		// Eliminar de Lista
		
		//echo "ELIMINAR PRODUCTO<p>";
		
		if ($eliminar != '')
		{
			$lista ="";
			$a=1;
			FOREACH($elementos as $elemento)
			{
					$articulo = explode("|",$elemento);
					$codigop = strtoupper($articulo[1]);
					
					//echo $articulo[1]. "<>".$eliminar."<p>";
					
					$comparar  = strcmp(trim($codigop),trim($eliminar));
					if ($comparar == 0 )
					{
						$lista  = $lista;
					}
					else 
						{
							$lista  = $lista.$elemento;
						}
					
					
			}
			
		}

	// --------------------------------------------------------------------------
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert = "SELECT * FROM tbk_producto WHERE nombre_pro LIKE '%".ltrim($nombre)."%'";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_producto WHERE codigo_pro LIKE '%".trim($cbarra)."%'";
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
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >
	
	<label id='subtitulo'> Arriendo a Cliente</label>
	<br/>
	<label id='comentariogris'>Seleccione la maquina que desea ARRENDAR y agr&eacute;guelos a la vista.</label>
	<hr/>
	<p/>
	
	
	<form name='np' action='cajaarriendo.php?IDcliente=<?=$IDcliente?>&tp=<?=$tp?>' method ='POST'>
	
	
	<table border='0'>
	<tr>
	<td width='600' valign='top'>

			<textarea name='lista' rows='25' cols='80'  readonly = 'readonly'><?=$lista?></textarea>
			<p/>

			
	</td>		
	<td valign='top'>
			
			
			<table border='0' cellspacing='3' cellpadding='3'>
			<tr>
			<td id='etiqueta'>
				Codigo Producto
			
			</td>
			<td>
				<input type='text' name='codigo' value='' size='20'>
			</td>
			<td id='data'>
						<!-- <a href='elegirproducto.php' id='menublanco' target="popup"  onClick="window.open(this.href, this.target, 'width=600,height=400'); return false;"><img src='images/binoculares.gif'></a> -->
						<a href='elegirarriendo.php?pos=<?=$p?>' id='menublanco' target="popup"  onClick="window.open(this.href, this.target, 'width=600,height=400'); return false;"><img src='images/binoculares.gif'></a>
			</td>
			<td id='etiqueta'>
				Cantidad
			
			</td>
			<td>
				<input type='text' name='cantidad' value='' size='7'>
			</td>
			</tr>
			</table>
			<br/>
			<table border='0'>
			<tr>

			<td id='etiquetazul' colspan='5'>
				C&oacute;digo maquina a eliminar 
				<input type='text' name='eliminar' value='' size='15'> (Presione OK)
			</td>
			</tr>
			</table>
			
			<p/>
			<input type='hidden' name='IDcliente' value='<?=$IDcliente?>'>


			<table border='0' cellspacing='5' cellpadding='5' >
					<tr>
					<td id='data' valign='bottom' align='center'>
							<a  id='menualternativo' href='#' onClick='np.lista.value=""' ><img src="images/logos/cancelar0.jpg" onmouseover="this.src = 'images/logos/cancelar1.jpg'" onmouseout="this.src = 'images/logos/cancelar0.jpg'" border="0"></img></a><br/>
					</td>
					<td id='data' valign='bottom'  align='center'>
							<a id='menu' href='#'  onCLick='submit()'><img src="images/logos/aceptar0.jpg" onmouseover="this.src = 'images/logos/aceptar1.jpg'" onmouseout="this.src = 'images/logos/aceptar0.jpg'" border="0"></img></a>
					</td>
					<td id='data' valign='bottom'  align='center'>
							<a id='menu' href='#'   onClick='document.np.action="generaarriendo.php"; submit()'><img src="images/logos/vale0.jpg" onmouseover="this.src = 'images/logos/vale1.jpg'" onmouseout="this.src = 'images/logos/vale0.jpg'" border="0"></img></a>
					</td>
					</tr>
			</table>

	</td>
	</tr>
	</table>
	


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
			

	
	</form>





</td>
</tr>
</table>
</center>

<?php include("footer.php")?>