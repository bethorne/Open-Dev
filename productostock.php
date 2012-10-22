<?php include("header.php")?>

<?php

     
	$idpro = $_GET['id'];
	$um1 =0;
	$boton =0;
	$new = $_GET['new'];
	
	// --- STOCK
	
	$min = $_POST['stockMin'];
	$alerta = $_POST['stockSos'];
	$max = $_POST['stockMax'];
	$stock = $_POST['stock'];

	
	

	
	if ($new == 1)
	{
		include("conector/conector.php");
		
		$insert = "INSERT INTO tbk_stock VALUES(";
		$insert.= $idpro.",";
		$insert.= $um1.",";
		$insert.= $stock.",";
		$insert.= $min.",";
		$insert.= $alerta.",";
		$insert.= $max;
		$insert.= ")";
		
		//echo $insert;
		
		if($res = mysql_query($insert,$conn))
		{
		 	echo "<table border='0' width='880' bgcolor='#ddffdd'><tr><td align='right'> <table border='0'><tr><td><img src='images/alerta.gif'></td><td><label id='alerta'> Producto almacenado exitosamente</label></td></tr></table> </td></tr></table>";
			$boton = 1;
		}
		else
			{
				echo "<table border='0' width='880' bgcolor='#ffdddd'><tr><td align='right'> <table border='0'><tr><td><img src='images/alerta.gif'></td><td><label id='alerta'> Este codigo de Barra ya fue asignado a otro producto</label></td></tr></table> </td></tr></table>";
				$boton= "0";
			
			}
			
		
		
	}
	
	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>

<center>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >


	
    <?php if ($boton == 0): ?>
		<form name='np' action='productostock.php?new=1&id=<?=$idpro?>' method ='POST'>
	<?php else :?>
		<form name='np' action='home.php' method ='POST'>
	<?php endif ?>
	
	
	<table border='0'>
	<tr>

	<td width='400' valign='top' >
	
			<label id='subtitulo'> STOCK</label>
			<p/>
			
			<fieldset>
			
				<table border='0' cellspacing='5' cellpadding='5' height='170'>
				<tr>
				<td id='etiqueta'>
						Stock M&iacute;nimo
				</td>
				<td>
						<input type='text' class='num' name='stockMin' value='<?=$min?>' size='10'>
				
				</td>
				</tr>
					
				<tr>
				<td id='etiqueta'>
						Stock M&iacute;nimo de Alerta
				</td>
				<td>
						<input type='text'  class='num' name='stockSos' value='<?=$alerta?>' size='10'>
				
				</td>
				</tr>
				
				<tr>
				<td id='etiqueta'>
						Stock  M&aacute;ximo
				</td>
				<td>
						<input type='text' class='num'  name='stockMax' value='<?=$max?>' size='10'>
				
				</td>
				</tr>
				</table>
			
			</fieldset>

	</td>
	<td width='400' valign='top' >
	
		<label id='subtitulo'> Producto</label>
		<p/>
	
		<fieldset>
		
		<table border='0' width='380'>
		<tr>
		<td>
			<label id='subtitulo'><?=$nombre?></label>
			
				
							
				<table border='0' cellspacing='5' cellpadding='5'>
				<tr>
				<td id='etiqueta'>
						Stock 
				</td>
				<td>
						<input type='text'  class='num' name='stock' value='<?=$stock?>' size='10'>
				
				</td>
				</tr>
					

				</tr>
				</table>

			
		</td>
		</tr>
		</table>
		
		</fieldset>
	
	</td>
	</tr>
	</table>
	
	<p/>
	
	<table border='0'>
	<tr>
	<td width='400' valign='top'>

					
	</td>
	<td>
	
			<table border='0' width='400'>
			<tr>
			<td align='right'>
					<table border='0'>
					<tr>
					<td>
						<input type='hidden' name='new' value='0'>
						<input type='hidden' name='id' value='<?=$idpro?>'>
						<input type='hidden' name='nombre' value='<?=$nombre?>'>
						<input type='hidden' name='um1' value='<?=$um1?>'>
						
						

							<input type='image'  src='images/Flecha_azul.jpg' onClick='javascript: submit()'>
						

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