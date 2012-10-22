<?php


include('class.ezpdf.php');
include("functions.php");
$periodo = $_GET['periodo'];
$year	= $_GET['year'];
$pdf =& new Cezpdf('Letter');
$pdf->selectFont('fonts/courier.afm');
$datacreator = array (
					'Title'=>'',
					'Author'=>'',
					'Subject'=>'',
					'Creator'=>'',
					'Producer'=>''
					);
$pdf->addInfo($datacreator);


include("conector/conector.php");

$queEmp = "SELECT *  FROM tbk_documento WHERE codigo_doc <>  '' AND SUBSTR( fecha_doc, 4, 2 ) =  '".$periodo."' AND SUBSTR( fecha_doc, 7, 4 ) =  '".$year."' ORDER BY fecha_doc";
$resEmp = mysql_query($queEmp, $conn) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);
while($row = mysql_fetch_array($resEmp))
  {
				
				$id			= $row[0];
				$rutcli		= $row['rut_cli'];
				$tipodoc	= $row[2];
				$fecha		= substr( $row[3] , 0, 5 );
				
				$fechc		= SUBSTR( $row[3], 4, 1 );
				$nume		= $row['codigo_doc'];
				
				$total		= $row[4];
				$neto		= round($total/1.19);
				$iva		= round($total - $neto);
 				$documento  = '';
				SWITCH($tipodoc)
				{
					CASE '1' : $documento = "BOLETA"; break;
					CASE '2' : $documento = "GUIA"; break;
					CASE '3' : $documento = "FACTURA"; break;
					CASE '4' : $documento = "NVF"; break;
					CASE '5' : $documento = "N. CREDITO"; break;
	
				}

				$fichacliente  = explode("|",clienterut($rutcli));
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


$pdf->ezText("<b>Libro contable de Ventas</b>\n",20);
$pdf->ezText("MES : ".$FEC." - ".$year."\n",12);
$pdf->ezTable($data,$titles,'',$options,10 );
$pdf->ezText("\n\n",10);
$pdf->ezText("<b>NETO : $".$total_neto."</b>");
$pdf->ezText("<b>IVA :     $".$total_iva."</b>");
$pdf->ezText("<b>TOTAL : $".$total_total."</b>");

$pdf->ezStream();
?>