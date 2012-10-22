<?php include("header.php")?>

<style>
	body{
		font-family: arial ;
	}
	
	h1{
		color: #369 ;
		font-size: 17px ;
		font-style: italic ;
	}

	/* Start kpaginate css styles */
	
	#kpaginate td{
		padding: 0 4px ;
		width: 20px ;
	}

	#kpaginate a{
		display: block ;
		font-family: arial ;
		font-size: 12px ;
		padding: 2px 0 ;
		text-align: center ;
		text-decoration: none ;
	}

	#kpaginate a.normal{
		background: #def ;
		color: #369 ;
	}

	#kpaginate a.selected{
		color: #fff ;
		display: block ;
		background: #f70 ;
	}

	#kpaginate a.back,
	#kpaginate a.next,
	#kpaginate a.backdis,
	#kpaginate a.nextdis{
		background: url('kpaginate-actions.png') no-repeat ;
		height: 14px ;
	}

	#kpaginate a.back{
		background-position: 0 0 ;
	}

	#kpaginate a.backdis{
		background-position: 0 -24px ;
	}

	#kpaginate a.next{
		background-position: -24px 0 ;
	}

	#kpaginate a.nextdis{
		background-position: -24px -24px ;
	}
	
	/* End kpaginate css styles */
</style>

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
					$insert = "SELECT * FROM tbk_producto WHERE nombre_pro LIKE '".trim($nombre)."%' ";
					$result = mysql_query($insert);
					$numero = mysql_num_rows($result);
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_producto WHERE codigo_pro ='".trim($cbarra)."' ";
					$result = mysql_query($insert);
					$numero = mysql_num_rows($result);
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
			$insert = "SELECT * FROM tbk_producto WHERE codigo_pro LIKE '".trim($cb)."%'";	
			$result = mysql_query($insert);
			$numero = mysql_num_rows($result);
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


	<form name='np' action='buscar.php' method ='POST'>
	

	<table border='0'>
	<tr>
	<td width='800' valign='top'>
	
			<label id='subtitulo'> Resultado B&uacute;queda </label>
			<p/>

			
				<table border='0' cellspacing='5' cellpadding='5'width='450' background='images/logos/fondo_menu.jpg'>
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
					<label id='comentario'>C&oacute;digo de Producto</label>
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

				<table border='0' cellspacing='5' cellpadding='5' width='450' >
				<?php
				;
	//echo '<pre>getLimit() method returns: ' ; print_r($limit) ; echo '</pre>' ;
					if ($busqueda == 1)
					{
						$i=0;
						While ($row = mysql_fetch_row($res))
						{
							$snombre = $row[2];
							$scbarra = $row[1];
							$smarca  = $row[4];
							$smodelo = $row[5];
							
							echo "<tr><td id='data' width='20'><a id='etiquetazul' href='buscar.php?cb=".trim($scbarra)."' ><img src='images/flechita.gif' border='0'></a></td><td id='data' width='20'><a id='etiquetazul' href='buscar.php?cb=".trim($scbarra)."' >".$scbarra."</a></td><td id='data'>".$snombre."</td><td id='data'>".$smarca."</td><td id='data'>".$smodelo."</td></tr>";
							$i++;
						}
					}
					else
					{
						// echo "<tr><td id='etiqueta'>Recuerde colocar s&oacute;lo letras y n&uacute;meros</td></tr>";
					}
				
				include "class.kpaginate.php";

	/***********************/
	
echo "".$numero."";
	$kp1 = new kpaginate		;
	$kp1->setTotalItems($numero)	;
	$kp1->setItemsPerPage(10)	;
	$limit = $kp1->getLimit()	;
	?>
	<?php $kp1->paginate()			
				?>
				
					</table>
			

			
			<p/>
			
			
	</td>
	</tr>
	
	<tr>
	<td width='800' valign='top'>
	<?php if (!empty($cb)) :?>
		
			<label id='subtitulo'> Ficha Producto  <a id='menu' href='editarproducto.php?cb=<?=trim($cb)?>' target='_blank'>[<img src='images/edit.jpg' border='0' height='15'> Editar]</a></label>
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
			
				$find = "SELECT * FROM tbk_producto_valor WHERE  id_pro = ".trim($idpro);
				if ($resf = mysql_query($find, $conn))
				{
				
					$ficha2 = mysql_fetch_row($resf);
					
					$unitario = $ficha2[2];
					$efectivo = $ficha2[3];
					$neto = $ficha2[4];
				?>	
					<p/>
					<label id='subtitulo'> Valor producto  <a id='menu' href='productovalor.php?cb=<?=trim($cb)?>' target='_blank'>[<img src='images/edit.jpg' border='0' height='15'> Editar]</a></label>
					<p/>
			
					<fieldset>
					
					<table border='0' cellspacing='5' cellpadding='5' width='750'>
					<tr>
					<td id='etiqueta'  width='100'>
						Valor Unitario
					</td>
					<td id='data'>
						$ <?=$unitario?>
					</td>

					</tr>
					
					<tr>

					<td id='etiqueta' >
						Valor Efectivo
					</td>
					<td id='data'>
						$ <?=$efectivo?>
					</td>
					</tr>
					
					<tr>

					<td id='etiqueta' >
						Valor Neto
					</td>
					<td id='data'>
						$ <?=$neto?>
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
					<label id='subtitulo'> Ficha Stock <a id='menu' href='stock.php?cb=<?=trim($cb)?>' target='_blank'>[<img src='images/edit.jpg' border='0' height='15'> Editar]</a> </label>
					<p/>
			
					<fieldset>
					
					<table border='0' cellspacing='5' cellpadding='5' width='750'>
					<tr>
					<td id='data'>
						<?=$fffmin?>
					</td>
					<td id='data'>
						<?=$fffalerta?>
					</td>
					<td id='data'>
						<?=$fffmax?>
					</td>
					<td id='data'>
						<?=$fffstock?>
					</td>
					</tr>
					
					<tr>

					<td id='etiqueta' >
						M&iacute;nimo
					</td>
					<td id='etiqueta' >
						M&iacute;nimo de Alerta
					</td>
					<td id='etiqueta' >
						M&aacute;ximo
					</td>
					<td id='etiqueta' >
						Stock
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