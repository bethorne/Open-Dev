<?php include("header.php") ?>


<?php


	$posicion = $_POST['posicion'];
	$listadocs = $_POST["listadocs$posicion"];
	$IDdocs = $_POST["IDdocs$posicion"];
	$IDcliente	= $_POST['IDcliente'];
	
	//echo "<p> POSTEO : ".$IDcliente." :: ".$listadocs." :: ".$IDdocs;
	
	
	$listado = explode(",",$listadocs);
	$elementos = count($listado);
	
	$i=0;
	WHILE ($iddoc = $listado[$i])
	{
	// buscar elementos de la guia de venta y dejarlos en una lista
				
				$searchpgv = "SELECT * FROM tbk_docpro WHERE id_doc = ".$iddoc;
				//echo $searchpgv."<br/>";
				$respgv = mysql_query($searchpgv, $conn);
				$k=0;
				
				
				$listapr[]		= 0;	// lista de productos  y cantidad por rut
				$cantidad[]		= 0;
				$precios[]		= 0;
				$listaprods 	="";   // lista de productos por rut (indices de lista[]
 				$cup 			= 0;  //cantidad unica de productos 
				$cup_rut  		= 0; //cantidad unica de productos por rut
				//$productos 		="";
				$prods 			= 0;
				
				
				WHILE ($rowpgv = mysql_fetch_row($respgv))
				{
					$pu = trim($rowpgv[1]);
					$q  = $rowpgv[3];
					$pre = $rowpgv[4];
					
					if ($listapr[$pu] == 0) $productos.= $pu.",";
					
					$listapr[$pu]++;
					$cantidad[$pu] 	= $cantidad[$pu] + $q;
					$precio[$pu]	= $pre;
					
					
					$listaprods = explode(",",$productos);
					$cup  =  Count($listaprods);
					if ($cup >$cup_rut ) $cup_rut = $cup;
					
					$k++;
				}
				$cupg =  $cup_rut-1; //cantidad unica de productos por guia
				
 				//echo  "<br/> Productos unicos ".($cupg)."<br/>";
				
	
		$i++;
		
		// fin busqueda de productos  para facturar
	}
	
			/*
			echo "<pre>";
			print_r($lista);
			echo "</pre>";
			
			
			echo "listado de productos para factura ".$productos;
			*/
			

?>


<form name='gf' action='generadocumento.php' method='POST'>

<center>
<table border='0'>
<tr>
<td>
	
	<table border='0' cellpadding='5' cellspacing='5'>
	<tr>
		<th id='etiqueta'> C&oacute;digo</th>
		<th id='etiqueta'> Producto </th>
		<th id='etiqueta'> Cantidad </th>
		<th id='etiqueta'> P. Unitario </th>
        <th id='etiqueta'> Total </th>

	</tr>
	
	<?php
	
		// construyendo tabla de productos
		$j=0;
		$codigodoc		='';
		$cadaproducto 	= explode(",",$productos);
		
		
		$cel = count($cadaproducto);
		
		$linea  ="";
		
		WHILE ($j < $cel)
		{
			$codigodoc = trim($listado[$j]);
			
			if ($cadaproducto[$j] != '')
			{
				
				//echo $cadaproducto[$j];
				$linea.= "# |".$cadaproducto[$j];

				// buscar nombre del producto
					$searchpro = "SELECT codigo_pro, nombre_pro, marca_pro FROM tbk_producto WHERE codigo_pro ='".$cadaproducto[$j]."'";
					//echo "<br>".$searchpro;
					$respro = mysql_query($searchpro, $conn);
					$l=0;
					WHILE($fichapro = mysql_fetch_row($respro))
					{
						$nombreproducto = $fichapro[1]." ".$fichapro[2];
						$l++;
					}
					
				//echo $nombreproducto;
				
				$linea.= " | ".$nombreproducto;
				
				//echo  $cantidad[$cadaproducto[$j]];
				$linea.=" | ".$cantidad[$cadaproducto[$j]];
				
			
				//echo  "$ ".$precio[$cadaproducto[$j]];
				$linea.= " | $ ".$precio[$cadaproducto[$j]]." c/u";

				
				$linea.=" | $ ".$precio[$cadaproducto[$j]] *  $cantidad[$cadaproducto[$j]];
				
				
				 
				
				
			}
		
			$j++;
		}
		
	?>
	</table>
	
	<table border='0'>
	</tr><td colspan='5'><textarea name='lista' cols='100' rows='15' readonly = 'readonly'><?=$linea?></textarea></td></tr>
	
	</table>
	
	
	<table border='0' width='650' cellspacing='5' cellpadding='5'>
	<tr>
	<td align='right'>
	
		<table border='0'>
		<tr>
		<td>
			<input type='hidden' name='IDguias' value='<?=$IDdocs?>'>
			<input type='hidden' name='listadoguias' value='<?=$listadocs?>'>
			<input type='hidden' name='IDcliente' value='<?=$IDcliente?>'>
		</td>
		<td>
			<input type='button' value='Atr&aacute;s' onClick='window.history.back()'>
			<input type='submit' value='Aceptar'>
		</td>
		</tr>
		</table>
	
	</td>
	
	</tr>
	</table>




</td>
</tr>
</table>
</center>



<?php include("footer.php") ?>