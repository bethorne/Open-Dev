<?php include("header.php")?>


<?php
	
	include("conector/conector.php");

	$busca =0;
	$periodo 	= $_POST['periodo'];
	$yearguia	= $_POST['yearguia'];
	$cliente 	= $_POST['cliente'];
	
	//echo "<p/>EL PERIODO A  CONSULTA ES ".$yearguia." / ".$periodo;
	
	if (($periodo != '') AND ($yearguia != ''))
	{
	
		//echo "<p> Hay datos,, preguntemos ";
	
	
		if (empty($cliente))
		{
		
			$searchgv = "SELECT * FROM tbk_documento WHERE tipo_doc = 2  AND estado_doc = 1 AND SUBSTR(fecha_doc, 7,4) = '".$yearguia."'  AND SUBSTR(fecha_doc, 4,2) ='".$periodo."' ORDER BY  rut_cli ASC";
		}
		else
			{
				$searchgv = "SELECT * FROM tbk_documento WHERE  rut_cli = '".$cliente."' AND  tipo_doc = 2  AND estado_doc = 1 AND SUBSTR(fecha_doc, 7,4) = '".$yearguia."'  AND SUBSTR(fecha_doc, 4,2) ='".$periodo."' ORDER BY  rut_cli ASC";
			}
		//echo "<p> ".$searchgv;
		
		$busca = 1;
	}


?>



<form action='consultarguiasdeventa.php' name='gv' method='POST'>
	

<table border='0' width='800'>
<tr>
<td valign='top' >

	

	<table border='0' width='500' height='30' cellspacing='5' cellpadding='5'>
	<tr>
	<td id='etiqueta'>
	
			Per&iacute;odo de Consulta
	
	</td>
	<td>
		
		<SELECT name='periodo' onChange='submit()'>
		<option/>
		
		<option value='01' <?php if ($periodo =='01') echo "SELECTED"?>>ENERO </option>
		<option value='02' <?php if ($periodo =='02') echo "SELECTED"?>>FEBRERO </option>
		<option value='03' <?php if ($periodo =='03') echo "SELECTED"?>>MARZO </option>
		<option value='04' <?php if ($periodo =='04') echo "SELECTED"?>>ABRIL </option>
		<option value='05' <?php if ($periodo =='05') echo "SELECTED"?>>MAYO </option>
		<option value='06' <?php if ($periodo =='06') echo "SELECTED"?>>JUNIO </option>
		<option value='07' <?php if ($periodo =='07') echo "SELECTED"?>>JULIO </option>
		<option value='08' <?php if ($periodo =='08') echo "SELECTED"?>>AGOSTO </option>
		<option value='09' <?php if ($periodo =='09') echo "SELECTED"?>>SEPTIEMBRE </option>
		<option value='10' <?php if ($periodo =='10') echo "SELECTED"?>>OCTUBRE </option>
		<option value='11' <?php if ($periodo =='11') echo "SELECTED"?>>NOVIEMBRE </option>
		<option value='12' <?php if ($periodo =='12') echo "SELECTED"?>>DICIEMBRE </option>
		<option value='00' <?php if ($periodo =='00') echo "SELECTED"?>>TODO EL A&Ntilde;O </option>
			
		</SELECT>
	
	</td>
	<td>
		
		<SELECT name='yearguia' onChange='submit()'>
		<option/>
		
		<?php
			
			$i=0;
			$yearnow = date('Y');
			for($i= $yearnow; $i >= 2000; $i--)
			{
				echo "<option value='".$i."'";
			
				if ($yearguia== $i) echo "SELECTED"; 
				
				echo ">".$i."</option>";
			}
		
		
		
		
		?>
			
		</SELECT>
	
	</td>
	
	<td>
		
		<SELECT name='cliente' onChange='submit()'>
		<option/>
		
		<?php
			
			$searchcli =  "SELECT * FROM tbk_cliente  ORDER BY rut_cli ASC";
			$rescli = mysql_query($searchcli, $conn);
			
			$i=0;
			
			WHILE ($rowcli = mysql_fetch_row($rescli))
			{
				
				$rutcli = $rowcli[0];
				$nombrecli = "(".$rowcli[0].") ".$rowcli[1] ." ".$rowcli[2];
				
			
				echo "<option value='".$rutcli."'";
			
				if ($cliente  == $rutcli ) echo "SELECTED"; 
				
				echo ">".$nombrecli."</option>";
			
				$i++;
			}
		
		
		
		?>
			
		</SELECT>
	
	</td>
	</tr>
	</table>
	
	
	<p/>



	
	<?php 
		
		if ($busca == 1)
		{
			$resgv = mysql_query($searchgv, $conn);
			
			
			echo "	<table border='0' width='650' cellpadding='3' cellspancing='3'>";
			echo "	<tr>";
			
			echo "		<th id='etiqueta'> RUT CLIENTE</th>";
			echo "		<th id='etiqueta'> NVF</th>";
			echo "		<th id='etiqueta'> FECHA EMISI&Oacute;N</th>";
			echo "		<th id='etiqueta'> C.U.P.</th>";
			echo "		<th id='etiqueta'> DOCUMENTOS FACTURABLES</th>";
			echo "		<th id='etiqueta'/>";
			
			echo "	</tr>";
			$j=0;
			$rutanterior  = "";
			WHILE ($rowgv = mysql_fetch_row($resgv))
			{
				$iddoc		= $rowgv[0];
				$rutcli 	= $rowgv[1];
				$fechadoc 	= $rowgv[3];
				$codigodoc 	= $rowgv[6];
				$obsdoc 	= $rowgv[8];
				
				if ($rutanterior != $rutcli)
				{
					$rutanterior = $rutcli;
					$listadocs ='';
					$listacodigodocs ='';
				}
				$listadocs.= $iddoc.", ";
				$listacodigodocs.= $codigodoc.", ";
				
				echo "	<tr>";
				
				echo "	<td id='etiqueta' align='right'>".$rutcli."</td>";
				echo "	<td id='etiqueta' align='center'>".$codigodoc."</td>";
				echo "	<td id='data' align='center'>".$fechadoc."</td>";
				
				echo "	<td id='data' align='center'>";
				// buscar elementos de la guia de venta y dejarlos en una lista
				
				$searchpgv = "SELECT * FROM tbk_docpro WHERE id_doc = ".$iddoc;
				//echo $searchpgv;
				$respgv = mysql_query($searchpgv, $conn);
				$k=0;
				//$lista[] ='';
				
				$lista[][]		="";	// lista de productos  y cantidad por rut
				$listaprods 	="";   // lista de productos por rut (indices de lista[]
 				$cup 			= 0;  //cantidad unica de productos 
				$cup_rut  		= 0; //cantidad unica de productos por rut
				$productos[] 	="";
				$prods 			= 0;
				
				
				WHILE ($rowpgv = mysql_fetch_row($respgv))
				{
				
					if ($lista[$rutcli][$rowpgv[1]] == 0) $productos[$rutcli].= $rowpgv[1].",";
					$lista[$rutcli][$rowpgv[1]]++;
					
					$listaprods = explode(",",$productos[$rutcli]);
					$cup  =  Count($listaprods);
					if ($cup >$cup_rut ) $cup_rut = $cup;
					
					$k++;
				}
				$cupg =  $cup_rut-1; //cantidad unica de productos por guia
				
 				echo  ($cupg);
				
	
				
				
				echo "	</td>";

				echo "	<td id='data'>";
				echo "		<input type='hidden' name='listadocs".$j."' value='".$listadocs."'>"; 
				echo "		<input type='hidden' name='IDdocs".$j."' value='".$listacodigodocs."'>"; 
				echo 		$listacodigodocs; 
				echo "	</td>";
				
				if ($cupg < 30 )
				{
					echo "	<td id='etiqueta'>";
					echo "		<input type='button' name='f".$j."' value='F' onClick='gv.IDcliente.value=\"".$rutcli."\"; gv.action=\"guiaafactura.php\"; gv.posicion.value=\"".$j."\"; gv.action=\"guiaafactura.php\"; submit()'>"; 
					echo "	</td>";	
				
				}
				echo "	</tr>\n";
				
				$j++;
			
			}
			
			echo "	<table>";
		
			/*
			echo "<pre>";
			print_r($lista);
			echo "</pre>";
			
			echo "<pre>";
			print_r($productos);
			echo "</pre>";
			*/
		}
	
	
	?>

	
	<p/>
	
	<table border='0' width='650'>
	<tr>	
	<td align='right'>
	
		<table border='0'>
		<tr>
		<td>
			<input type='hidden' name='posicion' value=''>
			<input type='hidden' name='IDcliente' value=''>
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

<?php include("footer.php")?>