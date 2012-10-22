<?php include("header.php") ?>


<?php


	$ficha = $_GET['id'];
	
	if ($ficha != '')
	{
	
			//buscando codigo interno del producto

			$buscaID = "SELECT  nombre_pro, marca_pro,modelo_pro FROM tbk_producto WHERE id_pro ='".$ficha."'";
			$resID = mysql_query($buscaID, $conn);
			$fichaproducto = mysql_fetch_row($resID);
			$nombre = $fichaproducto[0];
			$marca =$fichaproducto[1];
			$modelo = $fichaproducto[2];
			
			$nombrecompleto = $nombre." (".$marca."/".$modelo.")";
			
			
	
	}

?>

<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<!-- Tabla de Kardex -->
	
	
	
	<center>
	
	<fieldset>
	<label id='subtitulo'> KARDEX DETALLADO DEL PRODUCTO</label>
	<br>
	<label id='comentariogris'><i><?=$nombrecompleto?></i></label>
	<p/>
	
	<table border='0' width='800' cellspacing='2' cellpadding='2'>
	<tr>
	
		<td colspan='10' id='data'>
			<table border='0'>
			<tr>
				<td id='etiqueta' rowspan='2'> Simbolog&iacute;a</td>
				<td id='data' colspan='2'> <img src='images/salida.gif'> salida </td>
				<td id='data'> <img src='images/salida_anulada.gif'> salida anulada </td>
				<td id='etiqueta' width='10' />
				<td id='data' > <img src='images/salida.gif'> merma </td>
				<td id='etiqueta' width='10' />
			</tr>
			<tr>
				<td id='data'> <img src='images/entrada.gif'> entrada </td>
				<td id='data'> <img src='images/pedido.gif'> pedido </td>
				<td id='data'> <img src='images/entrada_anulada.gif'> entrada anulada</td>
				<td id='etiqueta' width='10' />
				<td id='data'> <img src='images/inventario.gif'> inventario </td>
				<td id='etiqueta' width='10' />
			</tr>
			</table>
		</td> 
	
	</tr>
	<tr>
			<td id='etiqueta'>Fecha</td>
			<td id='etiqueta'/>
			<td id='etiqueta'>Documento</td>
			<td id='etiqueta'>Documento<br/>Asociado</td>
			<td id='etiqueta'>Tipo</td>
			<td id='etiqueta'>Producto</td>
			<td id='etiqueta'>Proveedor/<br/>Cliente</td>
			<td id='etiqueta'>Cantidad <br/>Documento</td>
			<td id='etiqueta'>Cantidad <br/>Movilizada</td>
			<!-- <td id='etiqueta'>Precio<br/>Compra/Venta</td> -->
			
	</tr>
	

	
	<?php
	
		$leekardex  = "SELECT * FROM tbk_kardex WHERE id_pro ='".$ficha."'  ORDER BY fecha_kdx DESC";
		$reskardex  = mysql_query($leekardex, $conn);
		
		
		
		$i=0;
		WHILE ($linea = mysql_fetch_row($reskardex))
		{
		
		
			$fecha = $linea[0];
			$op = $linea[1];
			$documentopadre = $linea[2];
			$documentohijo = $linea[3];
			$tipodoc = $linea[4];
			$idpro = $linea[5];
			$rut = $linea[6];
			$cantidad1  = $linea[7];
			$cantidad2  = $linea[8];
			$precio = $linea[9];
			
			
			
			$fk  = $fecha;
			
			
			// asigna imagen al tipo de operacion
			SWITCH($op)
			{
				case '0' : $operacion="<img src='images/entrada.gif'>"; break;
				case '1' : $operacion="<img src='images/salida.gif'>"; break;
				case '2' : $operacion="<img src='images/salida_anulada.gif'>"; break;
				case '3' : $operacion="<img src='images/entrada_anulada.gif'>"; break;
				case '4' : $operacion="<img src='images/salida_anulada.gif'>"; break;
				case '7' : $operacion="<img src='images/merma.gif'>"; break;
				case '8' : $operacion="<img src='images/inventario.gif'>"; break;
				case '9' : $operacion="<img src='images/pedido.gif'>"; break;
				
			}
			
			
			//determina tipo de documento
			SWITCH($tipodoc)
			{
				case '1'  : $doc = "Boleta";  
							if ($op == 0) $buscapro = "SELECT  codigo_docc  FROM tbk_documentocompra WHERE id_docc ='".trim($documentopadre)."'";
							if ($op == 1) $buscapro = "SELECT  codigo_doc  FROM tbk_documento WHERE id_doc ='".trim($documentopadre)."'";
							break;
				case '2'  : $doc = "Gu&iacute;a"; 
							if ($op == 0) $buscapro = "SELECT  codigo_docc  FROM tbk_documentocompra WHERE id_docc ='".trim($documentopadre)."'";
							if ($op == 1) $buscapro = "SELECT  codigo_doc  FROM tbk_documento WHERE id_doc ='".trim($documentopadre)."'";
							if ($op == 2) $buscapro = "SELECT  codigo_doc  FROM tbk_documento WHERE id_doc ='".trim($documentopadre)."'";
							break;
				case '3'  : $doc = "Factura"; 
							if ($op == 0) $buscapro = "SELECT  codigo_docc  FROM tbk_documentocompra WHERE id_docc ='".trim($documentopadre)."'";
							if ($op == 1) $buscapro = "SELECT  codigo_doc, guias_doc FROM tbk_documento WHERE id_doc ='".trim($documentopadre)."'";
							break;
				case '4'  : $doc = "Nota D&eacute;bito"; 
							if ($op == 1) $buscapro = "SELECT  codigo_doc  FROM tbk_documento WHERE id_doc ='".trim($documentopadre)."'";
							break;
				case '5'  : $doc = "Nota Cr&eacute;dito"; 
							if ($op == 0) $buscapro = "SELECT  codigo_doc  FROM tbk_documento WHERE id_doc ='".trim($documentopadre)."'";
							break;
				case '7'  : $doc = "Merma"; 
							if ($op == 1) $buscapro = "SELECT  codigo_doc  FROM tbk_documento WHERE id_doc ='".trim($documentopadre)."'";
							break;
				case '8'  : $doc = "Inventario"; 
							if ($op == 8) $buscapro = "SELECT  codigo_doc  FROM tbk_documento WHERE id_doc ='".trim($documentopadre)."'";
							break;
				case '9'  : $doc = "Pedido"; 
							if ($op == 0) $buscapro = "SELECT  codigo_docc  FROM tbk_documentocompra WHERE id_docc ='".trim($documentopadre)."'";
							if ($op == 1) $buscapro = "SELECT  codigo_doc  FROM tbk_documento WHERE id_doc ='".trim($documentopadre)."'";
							break;
			
			}
						
			if ($op < 7)
			{	
				// buscar codigo del documento 
				$respro =  mysql_query($buscapro,$conn);
				$fichaproducto = mysql_fetch_row($respro);
				$codigodocpadre = $fichaproducto[0];
				$docasociados = $fichaproducto[1];
				
				$lista ='';
				if ($docasociados !='')
				{
					$guiasasociadas = '';
					$largo = strlen($docasociados);
					$lista = substr($docasociados,0, ($largo-2));
					
					$buscacodguias = "SELECT codigo_doc FROM tbk_documento  WHERE id_doc IN(".$lista.")";
					//echo $buscacodguias;
					$rescodguias = mysql_query($buscacodguias, $conn);
					
					$g=0;
					$listadoguias ='';
					WHILE($rowg=mysql_fetch_row($rescodguias))
					{
						$listadoguias.= $rowg[0].",";
						$g++;
					}
					
					$largo = strlen($listadoguias );
					$lista = substr($listadoguias ,0, ($largo-1));
				
				}	
			}		
				// buscar nombre del producto 
				$buscapro = "SELECT  nombre_pro  FROM tbk_producto WHERE id_pro ='".trim($idpro)."'";
			
				//echo "<p>".$buscapro."</p>";
				
				$respro =  mysql_query($buscapro,$conn);
				$fichaproducto = mysql_fetch_row($respro);
				$nombrepro = $fichaproducto[0];

			


			

			echo "<tr>";
			echo "<td id='data'>".$fk."</td>";
			echo "<td id='data' width='10' align='center'>".$operacion."</td>";
			echo "<td id='data'>".$codigodocpadre."</td>";
			echo "<td id='data'>".$documentohijo." ".$lista ."</td>";
			echo "<td id='data'>".$doc."</td>";
			echo "<td id='data'>".$nombrepro."</td>";
			echo "<td id='data'>".$rut."</td>";
			echo "<td id='data'>".$cantidad1."</td>";
			echo "<td id='data'>".$cantidad2."</td>";
			//echo "<td id='data' align='right'>$ ".$precio."</td>";
			echo "</tr>";
			
		
		
			$i++;
		}
		?>
		</table>
	

		</fieldset>

		</center>
</td>
</tr>
</table>




<?php include("footer.php")?>