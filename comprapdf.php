
<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
th    { vertical-align: top; }
}
-->
</style>
<page backcolor="#FEFEFE"  backimgx="center" backimgy="bottom" backimgw="100%" backtop="0" backbottom="30mm" footer="date;heure;page" style="font-size: 12pt">
    
     <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt;">
	<tr>
		<th id='etiqueta'/>
		<th style="width: 10%"> FECHA</th>
		<th style="width: 10%"> DOCUMENTO</th>
		<th style="width:  13%">N° DOCTO.</th> 
		<th  style="width: 32%"> CLIENTE</th>
        <th style="width: 11%"> NETO</th>
        <th style="width: 11%"> IVA</th>
		<th style="width: 13%"> TOTAL</th>


	</tr>
    </table>
    
<?php
include("functions.php");
include("conector/conector.php");

	$busca =0;
	$periodo 	= $_GET['periodo'];
	$yearguia	= $_GET['yearguia'];
	
	
		//echo "<p> Hay datos,, preguntemos ";
	$searchgv="SELECT *  FROM tbk_documento WHERE codigo_doc <>  '' AND SUBSTR( fecha_doc, 4, 2 ) =  '".$periodo."' AND SUBSTR( fecha_doc, 7, 4 ) =  '".$yearguia."' ORDER BY fecha_doc";
		
	
	
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
								
				$fichacliente  = explode("|",clienterut($rutcli));
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

				
	
	?>

    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #F7F7F7; text-align: center; font-size: 10pt;">
        <tr>
            <th ><?php echo $p++; ?> </th>
			<th  ><?php echo $fecha;?></th>
            <th ><?php echo $documento;?></th>
            <th  ><?php echo $codigo; ?></th>
            <th  ><?php echo $nombre; ?></th>
            <th  ><?php echo $neto; ?></th>
            <th  ><?php echo $iva; ?></th>
            <th  ><?php echo $total; 	?> </th>
        </tr>
    </table>
    <?php
				$total_iva += $iva;
				$total_neto += $neto;
				$total_total += $total;
				}
				}
	?>
   
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt;">
      <tr>
        <th  >TOTAL</th>
        <th >IVA</th>
        <th >TOTAL NETO</th>
      </tr>
      <tr>
        <th > <?php  echo $total_total; ?></th>
        <th  > <?php echo $total_iva; ?></th>
        <th>  <?php echo $total_neto; ?></th>
      </tr>
    </table>

   
   
   
</page>