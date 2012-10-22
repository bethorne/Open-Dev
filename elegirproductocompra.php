<?php include("header-zero.php")?>


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

	<label id='subtitulo'> BUSCAR PRODUCTO</label>
	<br/>
	<label id='comentariogris'> Complete uno de los campos para realizar la b&uacute;squeda. Si desea listar todos los productos, haga click en 'buscar nombre' con el campo vac&iacute;o.</label>
	<hr/>
	<p/>


	<form name='np' action='elegirproductocompra.php?pos=<?=$pos?>' method ='POST'>

	<table border='0'>
	<tr>
	<td width='400' valign='top'>

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
				<table border='0' cellspacing='5' cellpadding='5' width='500' >
				<?php
				
					if ($busqueda == 1)
					{
						$i=1;
						While ($row = mysql_fetch_row($res))
						{
							$sidpro  = $row[0];
							$snombre = $row[2];
							$scbarra = $row[1];
							$smarca  = $row[4];
							$smodelo = $row[5];
							
							
							// buscar valor producto
							$searchval = "SELECT cbarra_pro, precio_efectivo_pv FROM tbk_producto_valor WHERE cbarra_pro = '".$scbarra."'";
							//echo  $searchval;
							$rsv = mysql_query($searchval, $conn);
							
							$nfilas = mysql_num_rows($rsv);
							if ($nfilas > 0)
							{
								$fichavalor = mysql_fetch_row($rsv);
							
								$svalorproducto = $fichavalor[1];
							}
							
							
							echo "<tr><td id='etiqueta' width='5'><a href='#' onClick='window.opener.boleta.fcidpro".$pos.".value=&quot; ".$sidpro." &quot;; window.opener.boleta.fccbarras".$pos.".value=&quot; ".$scbarra." &quot;; window.opener.boleta.fcnombrespro".$pos.".value=&quot;".$snombre."&quot;; window.close()'><img src='images/flechaizq.jpg' border='0'></a></td><td id='data' width='20'>".$scbarra."</td><td id='data'>".$snombre."</td><td id='data'>".$smarca."</td><td id='data'>".$smodelo."</td></tr>";
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
	<td width='400' valign='top'>
	<?php if (!empty($cb)) :?>
		
			<label id='subtitulo'> Ficha Producto </label>
			<p/>
			
			<fieldset>
			
			<table border='0' cellspacing='5' cellpadding='5' width='300'>
			<tr>
			<td id='etiqueta' width='100'>
				Nombre
			</td>
			<td id='data'>
				 <?=$fnombre?>
			</td>
			</tr>
			
			<tr>
			<td id='etiqueta'>
				C. Barra
			</td>
			<td id='data'>
				 <?=$fcbarra?>
			</td>
			</tr>
			
			<tr>
			<td id='etiqueta'>
				Marca
			</td>
			<td id='data'>
				 <?=$fmarca?>
			</td>
			</tr>
			
			<tr>
			<td id='etiqueta'>
				Modelo
			</td>
			<td id='data'>
				 <?=$fmodelo?>
			</td>
			</tr>
			
			<tr>
			<td id='etiqueta'>
				Descripci&oacute;n
			</td>
			<td id='data'>
				 <?=$fdesc?>
			</td>
			</tr>
			</table>
			
			</fieldset>
			
			<?php
			
				$find = "SELECT * FROM tbk_producto_valor WHERE  id_pro = ".$idpro;
				if ($resf = mysql_query($find, $conn))
				{
				
					$ficha2 = mysql_fetch_row($resf);
					
					$ffpu = $ficha2[1];
					$ffpv = $ficha2[2];
				?>	
					<p/>
					<label id='subtitulo'> Valor producto </label>
					<p/>
			
					<fieldset>
					
					<table border='0' cellspacing='5' cellpadding='5' width='300'>
					<tr>
					<td id='etiqueta' width='100'>
						Valor Unitario
					</td>
					<td id='data'>
						<?=$ffpu?>
					</td>
					</tr>
					
					<tr>
					<td id='etiqueta' width='100'>
						Valor Venta
					</td>
					<td id='data'>
						<?=$ffpv?>
					</td>
					</tr>
					</table>
					
					</fieldset>
					
		<?php 	} 
			
				$find = "SELECT * FROM tbk_stock WHERE  id_pro = ".$idpro;
				if ($resst = mysql_query($find, $conn))
				{
				
					$ficha3 = mysql_fetch_row($resst);
					
					$fffum 		= $ficha3[1];
					$fffstock 	= $ficha3[2];
					$fffmin 	= $ficha3[3];
					$fffalerta 	= $ficha3[4];
					$fffmax 	= $ficha3[5];
				?>	
					<p/>
					<label id='subtitulo'> Ficha Stock </label>
					<p/>
			
					<fieldset>
					
					<table border='0' cellspacing='5' cellpadding='5' width='300'>
					<tr>
					<td id='etiqueta' width='100'>
						Stock
					</td>
					<td id='data'>
						<?=$fffstock?>
					</td>
					</tr>
					
					<tr>
					<td id='etiqueta' width='100'>
						M&iacute;nimo
					</td>
					<td id='data'>
						<?=$fffmin?>
					</td>
					</tr>
					
					<tr>
					<td id='etiqueta' width='100'>
						M&iacute;nimo de Alerta
					</td>
					<td id='data'>
						<?=$fffalerta?>
					</td>
					</tr>
					
					<tr>
					<td id='etiqueta' width='100'>
						M&aacute;ximo
					</td>
					<td id='data'>
						<?=$fffmax?>
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
	<!--
	<td width='400' valign='top'>
		
				<label id='subtitulo'> Clasficaci&oacute;n </label>
				<p/>
				

				<fieldset>
					
					<table border='0' cellspacing='5' cellpadding='5' >
					<tr>
					<td id='etiqueta'>
							Clase / Familia
					</td>
					<td>
							<SELECT name='fam'>
								<option/>
								<option>familia 1</option>
								<option>familia 2</option>
								<option>familia 3</option>
								<option>familia 4</option>
							</SELECT>
					
					</td>
					</tr>
						
					<tr>
					<td id='etiqueta'>
							Subclase / Subfamilia
					</td>
					<td>
							<SELECT name='subfam'>
								<option/>
								<option>subfamilia 1</option>
								<option>subfamilia 2</option>
								<option>subfamilia 3</option>
								<option>subfamilia 4</option>
							</SELECT>
					
					</td>
					</tr>
				
					</table>
				</fieldset>
					
	</td>
	-->
	<td>
	
			<table border='0' width='400'>
			<tr>
			<td align='right'>
					<table border='0'>
					<tr>
					<td>
						
						<input type='hidden' name='look' value=''>
						<input type='hidden' name='loc' value=''>
					
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