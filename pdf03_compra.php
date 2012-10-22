<?php
include('class.ezpdf.php');
include("functions.php");
$periodo = $_GET['periodo'];
$year	= $_GET['year'];
$pdf =& new Cezpdf('Letter');
$pdf->selectFont('fonts/courier.afm');
$datacreator = array (
					'Title'=>'Ejemplo PDF',
					'Author'=>'unijimpe',
					'Subject'=>'PDF con Tablas',
					'Creator'=>'unijimpe@hotmail.com',
					'Producer'=>'http://blog.unijimpe.net'
					);
$pdf->addInfo($datacreator);

include("conector/conector.php");

$queEmp = "SELECT fecha_docc, tipo_docc, codigo_docc, rut_cli, total_docc  FROM tbk_documentocompra WHERE codigo_docc <>  '' AND SUBSTR( fecha_docc, 4, 2 ) =  '".$periodo."' AND SUBSTR( fecha_docc, 7, 4 ) =  '".$year."' ORDER BY fecha_docc";

$resEmp = mysql_query($queEmp, $conn) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);
while($row = mysql_fetch_array($resEmp))
  {
				
				$id			= $row[0];
				$rutcli		= $row['rut_cli'];
				$tipodoc	= $row['tipo_docc'];
				$fecha		= $row[3];
				$fechc		= SUBSTR( $row[3], 4, 1 );
				$nume		= $row['codigo_docc'];
				
				$total		= $row[4];
				$neto		= round($total/1.19);
				$iva		= round($total - $neto);
 				$documento  = '';
				SWITCH($tipodoc)
				{
					CASE '1' : $documento = "BOLETA"; break;
					CASE '2' : $documento = "GUIA"; break;
					CASE '3' : $documento = "FACTURA"; break;
					CASE '4' : $documento = "N. DEBITO"; break;
					CASE '5' : $documento = "N. CREDITO"; break;
	
				}

				$fichacliente  = explode("|",proveedorrut($rutcli));
				$nombre = $fichacliente[0];
		
	$data[] = array('fecha'=>$fecha, 'documento'=>$documento, 'nume'=>$nume, 'cliente'=> '('.$rutcli.')'.$nombre, 'neto'=>'$'.$neto, 'iva'=>'$'.$iva, 'total'=>'$'.$total);
	
	
				$total_iva += $iva;
				$total_neto += $neto;
				$total_total += $total;
  }
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
				
				
$titles = array('fecha'=>'<b>Fecha</b>', 'documento'=>'<b>Documento</b>', 'nume'=>'<b>N Docto. </b>', 'cliente'=>'<b>Cliente</b>', 'neto'=>'<b>Neto</b>', 'iva'=>'<b>IVA</b>', 'total'=>'<b>Total</b>');


$pdf->ezText("<b>Libro contable Compras</b>\n",20);
$pdf->ezText("MES : ".$FEC." - ".$year."\n",12);
$pdf->ezTable($data,$titles,'',$options,10 );
$pdf->ezText("\n\n",10);
$pdf->ezText("<b>NETO : $".$total_neto."</b>");
$pdf->ezText("<b>IVA :     $".$total_iva."</b>");
$pdf->ezText("<b>TOTAL : $".$total_total."</b>");

$pdf->ezStream();
?>