<?php  include("header.php")  ;?>
	<?php
	$busca =0;
	$periodo 	= $_POST['periodo'];
	$yearguia	= $_POST['yearguia'];
	
	if (($periodo != '') AND ($yearguia != ''))
	{
	
		//echo "<p> Hay datos,, preguntemos ";
	
		
			//$searchgv = "SELECT * FROM tbk_documento WHERE tipo_doc = 2  AND estado_doc = 1 AND SUBSTR(fecha_doc, 7,4) = '".$yearguia."'  AND SUBSTR(fecha_doc, 4,2) ='".$periodo."' ORDER BY  rut_cli ASC";
			$searchgv="SELECT * FROM tbk_documentocompra WHERE codigo_docc <>  '' AND SUBSTR( fecha_docc, 4, 2 ) =  '".$periodo."' AND SUBSTR( fecha_docc, 7, 4 ) =  '".$yearguia."' ORDER BY fecha_docc";
		
			$busca = 1;
	}
	?>
<center>
<form action='informecompralbr.php' name='gv' method='POST'>
<table border='0' width='890' height='400'>
<tr>
<td valign='top' >

	<label id='subtitulo'> Libro Contable de Compras</label>
	<br/>
	<label id='comentariogris'> Listado completo de las ventas registradas indistinto  su forma de pago o si fueron canceladas.</label>
	<hr/>
	<p/>
     <table border='0' width='500' height='30' cellspacing='5' cellpadding='5'>
     <tr>
     <td id='etiqueta'>
	
			Per&iacute;odo de Consulta
	
	</td>
	<td>
		
		<SELECT name='periodo' onChange='submit()'>
		<option selected="selected"/>
		
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
      <?php  if ($busca == 1)
		{
			$resgv = mysql_query($searchgv, $conn);?>
	</tr>
    </table>
	
<center>
  <table border='0' width='750' cellpadding='5'>
	<tr>
		<td width="9" id='etiqueta'/>
		<td width="67" id='etiqueta'> FECHA</TD>
		<td width="123" id='etiqueta'> DOCUMENTO</TD>
		<td width="101" id='etiqueta'>N° DOCTO.</TD> 
		
		
		
		<td width="82" id='etiqueta'> CLIENTE</TD>
        <td width="62" id='etiqueta'> NETO</TD>
        <td width="43" id='etiqueta'> IVA</TD>
		<td width="65" id='etiqueta'> TOTAL</TD>
	<!--	<td id='etiqueta'> OBS</TD>-->
		<!-- <td id='etiqueta'> RESPONSABLE</TD>-->

	</tr>
	<?php
		include("functions.php");
		//$proveedores  ="SELECT *,sum(total_doc),count(codigo_doc) FROM tbk_documento WHERE codigo_doc <>  '' GROUP BY rut_cli ASC ";
		//$proveedores  = "SELECT * FROM tbk_documento  WHERE codigo_doc <> '' ORDER BY substring(fecha_doc,7,2), substring(fecha_doc,4,2)  ASC";
		$resp = mysql_query($searchgv, $conn);
		
		$pfilas = mysql_num_rows($resp);
		
		if ($pfilas > 0)
		{
			$p=0;
			
			$anterior= 0;
			$flag1=0;
			WHILE($linea = mysql_fetch_row($resp))
			{

				$id			= $linea[0];
				$rutcli		= $linea[1];
				$tipodoc	= $linea[2];
				$fecha		= $linea[3];
				
				$total		= $linea[4];
				$neto		= round($total/1.19);
				$iva		= round($total - $neto);
				
				
				
				
				$estado		= $linea[5];
				$codigo		= $linea[6];
				$vendedor	= $linea[7];
				
				$ff = explode("-",$fecha);
				$d = $ff[0];

				
				if ($anterior  != $d)
				{
					if ($flag1 == 0) $flag1 = 1 ;
					else $flag1 = 0;
					
					$anterior = $d;
				}
					
				if ($flag1==0) $fondo = "data4";
				if ($flag1==1) $fondo = "data";
								
				$fichacliente  = explode("|",proveedorrut($rutcli));
				$nombre = $fichacliente[0];
				
				$documento  = '';
				SWITCH($tipodoc)
				{
					CASE '1' : $documento = "BOLETA"; break;
					CASE '2' : $documento = "GUIA"; break;
					CASE '3' : $documento = "FACTURA"; break;
					CASE '4' : $documento = "N. DEBITO"; break;
					CASE '5' : $documento = "N. CREDITO"; break;
	
				}

				
				echo "<tr>";
				echo "<td id='etiqueta' id='4' width='5'>".($p++)."</td>";
				echo "<td id ='".$fondo."' >".$fecha."</td>";
				echo "<td id ='".$fondo."' align='right'>".$documento."</td>";
				echo "<td id ='".$fondo."' align='right'><a id='etiquetazul' href='documentoscompra.php?cb=".$id."' target='_blank'>".$codigo."</a></td>";
				echo "<td id ='".$fondo."' >(" .$rutcli.") - " .$nombre."</td>";
				echo "<td id ='".$fondo."' align='right'>$ ".$neto."</td>";
				echo "<td id ='".$fondo."' align='right'>$ ".$iva."</td>";
				echo "<td id ='".$fondo."' align='right'>$ ".$total."</td>";
				
				//echo "<td id ='".$fondo."' >".$obs."</td>";
				
				//echo "<td id ='".$fondo."'>".$vendedor."</td>";
	
				echo "</tr>";
				
				//number_format('$iva',2,',','.');
				$total_iva += $iva;
				$total_neto += $neto;
				$total_total += $total;
				
				
				
			}
		
		}
	
	
	
	
	?>
	</table>
    <table  border='0' width='750' cellpadding='5'>
      <tr>
        <td id="etiqueta" align="center" width="auto">TOTAL</td>
        <td id="etiqueta" align="center" width="auto">IVA</td>
        <td id="etiqueta" align="center" width="auto">Total Neto</td>
      </tr>
      <tr>
        <td id =<?php echo"'" .$fondo."' " ?>align="center" > <?php  echo"$ $total_total"; ?></td>
        <td id =<?php echo"'" .$fondo."' " ?>align="center" > <?php echo"$ $total_iva"; ?></td>
        <td id =<?php echo"'" .$fondo."' " ?>align="center" >  <?php echo"$ $total_neto"; ?></td>
      </tr>
    </table>
    <table width="200" border="0">
	  <tr>
	    <td><a  target="_new" href="pdf03_compra.php?periodo=<?php echo"$periodo"?>&year=<?php echo"$yearguia";?>"><img src="images/Exportar_a_Pdf.png" width="56" height="53" alt="Exportar a PDF" /></a></td>
	    <td><a href="mysql_compra.php?periodo=<?php echo"$periodo"?>&year=<?php echo"$yearguia";?>"><img src="images/Exportar_a_excel.png" width="47" height="52" alt="Exportar a Excel" /></a></td>
	    <td>&nbsp;</td>
	    </tr>
	  </table>
	</center>
	
</td>
</tr>
</table>
</form>
	<?php 
	}
		else{
			
			}
	
	
	?>

<?php include("footer.php")?>