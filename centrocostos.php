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
        
    
	<table width="614" >
    
    <thead>
    	<tr>
        	<th id='etiqueta'>Proveedor</th>
            <th id='etiqueta'>Precios</th>
            <th id='etiqueta'>Cantidad</th>
            <th id='etiqueta'>Fecha</th>
            </tr>
    </thead>
    <tbody>
      <?php	$buscar		=$_GET['buscar']; 

if(!empty($buscar)){
	
	
	
				$find = "SELECT c.rut_cli, c.fecha_docc, d.cantidad_fpc, d.valor_fpc, p.nombre_pv
FROM tbk_documentocompra c, tbk_docprocompra d, tbk_proveedor p
WHERE c.id_docc = d.id_docc
AND d.cbarra_pro =  '".$buscar."'
AND p.rut_pv = c.rut_cli
GROUP BY c.rut_cli";
				if ($resf = mysql_query($find, $conn))
				{
				
					
					$i=0;
					WHILE ($ficha2 = mysql_fetch_row($resf))
					{
						$ffpv = $ficha2[3];
						$ffidcod= $ficha2[0];
						$cantidad =$ficha2[2];
						$fecha = $ficha2[1];
						$nomsaa = $ficha2[4];
								
							
	?>
 
   
   
    <tr>
        	<td id='etiqueta' ><?php echo "".$nomsaa.""  ?></td>
          
            <td id ='data'><?php echo"".$ffpv.""; ?></td>
             <td id ='data'><?php echo"".$cantidad.""; ?></td>
                <td id ='data' ><?php echo"".$fecha.""; ?></td>
            </tr> 
             <?php  } 
			 $i++;
			 
			 } ?>
    </tbody>
</table>
 <div style="width:620px; height:200px; overflow:auto;">
	<table width="614"  >
    
	   <thead>
    	<tr>
        	<th id='etiqueta'>Cliente</th>
            <th id='etiqueta'>Precios</th>
            <th id='etiqueta'>Cantidad</th>
            <th id='etiqueta'>Fecha</th>
            </tr>
    </thead>
    <tbody>
    
 <?php	$buscar		=$_GET['buscar']; 

if(!empty($buscar)){
	
	
	
				$find = "SELECT p.nombre_pro, k.fecha_kdx, k.id_pro, k.rut_kdx, c.nombre_cli, k.cantidad_doc2_kdx, k.precio_kdx
FROM tbk_kardex k, tbk_cliente c, tbk_producto p
WHERE 

k.operacion_kdx =1
AND c.rut_cli = k.rut_kdx
AND p.id_pro = k.id_pro
AND p.codigo_pro =  '".$buscar."'";
//echo"$find";
				if ($resf = mysql_query($find, $conn))
				{
				
					
					$i=0;
					WHILE ($ficha2 = mysql_fetch_row($resf))
					{
						$ffpv = $ficha2[6];
						$ffidcod= $ficha2[6];
						$cantidad =$ficha2[5];
						$fecha = $ficha2[1];
						$nomsaa = $ficha2[4];
								
							
	?>
	  
      
      <tr >
	   <td id='etiqueta'><?php echo "".$nomsaa.""  ?></td>
          
            <td id='data' ><?php echo"".$ffpv.""; ?></td>
             <td  id='data'><?php echo"".$cantidad.""; ?></td>
                <td id='data'><?php echo"".$fecha.""; ?></td>
            </tr> 
            
	    </tr>
        
        <?php  } 
			 $i++;
			 
			 } }?>
         </tbody> 	
	  </table>
	</div>
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

<?php include("footer.php");?>
