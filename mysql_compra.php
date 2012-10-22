<?php

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Libro_compra.xls");
$periodo = $_GET['periodo'];
$year	= $_GET['year'];
?>
<HTML LANG="es">
<title>Bases de Datos.</title>
<TITLE>Titulo de la Página.</TITLE>
</head>
<body>

<style>

 


	
	td#etiqueta
	{
		
		background  :#ccccff;
		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#888888;
		text-decoration:none;

		
	}
	
	
	td#datacuota
	{
		
		background  :#ada;
		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#000;

		
	}
	
	td#atrasocuota
	{
		
		background  :#daa;
		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#ffffff;

		
	}
	
	#etiqueta
	{
		
		background  :#eeeeee;
		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#888888;
		text-decoration:none;

		
	}
	
	#etiquetacredito
	{
		
		background  :#bac;
		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#fff;
		text-decoration:none;

		
	}
	
	#etiquetadebito
	{
		
		background  :#cba;
		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#fff;
		text-decoration:none;

		
	}
	
	#etiquetazul
	{
	

		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#359;
		text-decoration:none;
	
	}
		
		
	

	td#data
	{

		font-family :arial;
		font-size   :11px;
		color       :#555555;
		border      : solid 1px #aaaaaa;
		background  :#fff;
		
	}
	
	td#data4
	{

		font-family :arial;
		font-size   :11px;
		color       :#555555;
		border      :solid 1px #aaaaaa;
		background  :#eef;
		
	}
	


		
	td#data2
	{

		font-family :times,arial;
		font-size   :14px;
		font-style	: italic;
		color       :#555555;
		border      : solid 1px #aaaaaa;
		background  :#ffffff;
		
	}
	
	
	td#data3
	{

		font-family :times,arial;
		font-size   :14px;
		font-style	: italic;
		color       :#555555;
		border      :none;
		
		
	}
	
	 
	td#mainmenu
	{
		font-family :arial;
		font-size   :11px;
		color       :#888;
		font-weight :bold;	
		border      :none;
		text-decoration:none;	
		border-right:solid 2px #ccc;
		border-top:solid 1px #eee;	
		border-bottom:solid 2px #ccc;
		padding-top:30px;
		/*background-color:#eef;*/
		
	}
	
	 
	</style>


<?php
include("functions.php");
include("conector/conector.php");

echo"<label  style='font-size: 30px;font-family: Trebuchet MS, Arial;		font-weight:bold;		font-size:12px;'>Libro de Compras</label>";

$sql = "SELECT fecha_docc, tipo_docc, codigo_docc, rut_cli, total_docc  FROM tbk_documentocompra WHERE codigo_docc <>  '' AND SUBSTR( fecha_docc, 4, 2 ) =  '".$periodo."' AND SUBSTR( fecha_docc, 7, 4 ) =  '".$year."' ORDER BY fecha_docc";


$result=mysql_query($sql,$conn);

?>

<TABLE border=0  align="center"  valign='top'>
<TR>


		<td id='etiqueta'> FECHA</TD>
		<td id='etiqueta'> DOCUMENTO</TD>
		<td id='etiqueta'>N DOCTO.</TD> 
		
		
		
		<td id='etiqueta'> CLIENTE</TD>
        <td id='etiqueta'> NETO</TD>
        <td id='etiqueta'> IVA</TD>
		<td id='etiqueta'> TOTAL</TD>

</TR>
<?php

while($row = mysql_fetch_array($result)) {
$d = $ff[0];
			$fechc		= SUBSTR( $row[0], 4, 1 );
				
				if ($anterior  != $d)
				{
					if ($flag1 == 0) $flag1 = 1 ;
					else $flag1 = 0;
					
					$anterior = $d;
				}
					
				if ($flag1==0) $fondo = "data4";
				if ($flag1==1) $fondo = "data";
				
				$fichacliente  = explode("|",proveedorrut($row[3]));
				$nombre = $fichacliente[0];
				$documento  = '';
				SWITCH($row[1])
				{
					CASE '1' : $documento = "BOLETA"; break;
					CASE '2' : $documento = "GUIA"; break;
					CASE '3' : $documento = "FACTURA"; break;
					CASE '4' : $documento = "N. DEBITO"; break;
					CASE '5' : $documento = "N. CREDITO"; break;
	
				}
	$total=$row[4];
	$neto		= round($total/1.19);
	$iva		= round($total - $neto);


			$FEC='';
				SWITCH($fechc)
				{
					CASE '1' : $FEC = "ENERO"; break;
					CASE '2' : $FEC = "FEBRERO"; break;
					CASE '3' : $FEC = "MARZO"; break;
					CASE '4' : $FEC = "ABRIL"; break;
					CASE '5' : $FEC = "MAYO"; break;
					CASE '6' : $FEC = "JUNIO"; break;
					CASE '7' : $FEC = "JULIO"; break;
					CASE '8' : $FEC = "AGOSTO"; break;
					CASE '9' : $FEC = "SEPTIEMBRE"; break;
					CASE '10' : $FEC = "OCTUBRE"; break;
					CASE '11' : $FEC = "NOVIEMBRE"; break;
					CASE '12' : $FEC = "DICIEMBRE"; break;
				}

printf("<tr>
<td id ='".$fondo."'>&nbsp;%s</td>
<td id ='".$fondo."'>&nbsp;%s</td>
<td id ='".$fondo."'>&nbsp;%s</td>
<td id ='".$fondo."'>&nbsp;%s</td>
<td id ='".$fondo."'>&nbsp;%s</td>
<td id ='".$fondo."'>&nbsp;%s</td>
<td id ='".$fondo."'>&nbsp;%s</td>

</tr>", $row[0],$documento,$row[2],"(".$row[3].")- ".$nombre,$neto,$iva,$total);
}
mysql_free_result($result);
mysql_close($conn);  //Cierras la Conexión
?>

</table>
</body>
</html>
<?php

header("Content-Type: application/vnd.ms-excel");header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Libro_compra_".$fechc."_".$year.".xls");

?>