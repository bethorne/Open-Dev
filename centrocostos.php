<?php include("header.php")?>


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
					$insert = "SELECT * FROM tbk_producto WHERE nombre_pro LIKE '".trim($nombre)."%'  ";
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
	<form name='np' action='centrocostos.php?pos=<?=$pos?>' method ='POST'>
	  
	  <table border='0'>
	<tr>
	<td width='400' height="100%" valign='top'>

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
							
							
							echo "<tr><td id='etiqueta' width='5'><a href='centrocostos.php?buscar=".$scbarra."' ><img src='images/flechaizq.jpg' border='0'></a></td><td id='data' width='20'>".$scbarra."</td><td id='data'>".$snombre."</td><td id='data'>".$smarca."</td><td id='data'>".$smodelo."</td></tr>";
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
	</table>
      <p>
        
    
	<table id="one-column-emphasis" summary="2007 Major IT Companies' Profit">
    <colgroup>
    	<col class="oce-first" />
    </colgroup>
    <thead>
    	<tr>
        	<th scope="col">Proveedor</th>
            <th scope="col">Precios</th>
            </tr>
    </thead>
    <tbody>
      <?php	$buscar		=$_GET['buscar']; 

if(!empty($buscar)){
	
	
	
				$find = "SELECT * FROM tbk_docprocompra WHERE  `cbarra_pro` =  '".$buscar."'";
				if ($resf = mysql_query($find, $conn))
				{
				
					
					$i=0;
					WHILE ($ficha2 = mysql_fetch_row($resf))
					{
						$ffpv = $ficha2[4];
						$ffidcod= $ficha2[0];
								
							
	?>
    <?php
    
	
	
	?>
    	<tr>
        	<td><?php echo"".$ffidrt.""; ?></td>
          
            <td ><?php echo"".$ffpv.""; ?></td>
          
            </tr> 
             <?php } 
			 $i++;
			 
			 } ?>
    </tbody>
</table>
	
	<?php 
				
				
				}
	else{
		
		
		
		
		}







?>
     


      <table>
        
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