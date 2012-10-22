<?php include("header-pdf.php");

include("conector/conector.php");
include("functions.php");
require('fpdf/fpdf.php');
date_default_timezone_set('America/Santiago');

// recuperar informacion de factura
global $rutcli,$tipodoc,$fecha,$total,$neto,$iva,$estado,$codigo,$vendedor;



$periodo  = $_GET['periodo'];	
$yearguia  = $_GET['year'];	


 


//Hago una query a mi bd
$bf="SELECT *  FROM tbk_documento WHERE codigo_doc <>  '' AND SUBSTR( fecha_doc, 4, 2 ) =  '".$periodo."' AND SUBSTR( fecha_doc, 7, 4 ) =  '".$yearguia."' ORDER BY fecha_doc";

	// buscar informacion de Factura

	$rf = mysql_query($bf, $conn);
		
	$ficha = mysql_fetch_row($rf);

	$GLOBALS['rutcli']		= $ficha[1];
	$GLOBALS['nombrecli']   = clienterut($GLOBALS['rutcli']);
	$stipodoc 				= $ficha[2];
	$GLOBALS['fechadoc'] 	= $ficha[3];
	$GLOBALS['codigodoc'] 	= $ficha[6];
	$GLOBALS['vendedor']  	= $ficha[7];
	



	
class PDF extends FPDF
{
// Cabecera de página
function Header()
{

	
		
    // Logo
 
    // Arial bold 15
    $this->SetFont('Arial','B',20);
    // Movernos a la derecha
    //$this->Cell(80);
    // Título tamaño total: 195, 90
	 
	
	$this->Cell(172,17,'',0,1,'R');
	$this->SetFont('Arial','B',10);
    $this->Cell(172,5,$GLOBALS['codigodoc'],0,1,'R');
	
	$this->Cell(172,12,'',0,1,'R');
	
	$this->SetFont('Arial','',9);
	$this->Cell(115,5,'',0,0,'L');$this->Cell(10,5,$dia." - ".$mes." - ".$year,0,1,'L');
	
	$this->Cell(172,4,'',0,1,'R');

	$this->Cell(10,5,'',0,0,'L');$this->Cell(130,5,$nc,0,0,'L');
	$this->Cell(40,5,$rut,0,1,'L');
	$this->Cell(10,2,'',0,1,'L');
	$this->Cell(10,6,'',0,0,'L');$this->Cell(105,6,$dir,0,0,'L');
	
	$this->Cell(80,6,'Fonos: '.$fono,0,1,'L');
	$this->Cell(6,3,'',0,1,'R');
	$this->Cell(10,6,'',0,0,'L');$this->Cell(75,6,$comuna,0,0,'L'); $this->Cell(70,6,'',0,0,'L'); $this->Cell(40,6,$GLOBALS['formadepago'],0,0,'L');
	
	$this->Cell(6,9,'',0,1,'R');
	$this->Cell(10,6,'',0,0,'L');$this->Cell(185,6,$rubros,0,0,'L');
    // Salto de línea
    $this->Ln(15);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
   // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}


//imprimir contenido de la factura


if ($resf = mysql_query($bf, $conn))
{
	$j=0;
	$subtotal = 0;
					
	// fijemos estos valores generales para a factura y sus notas
	$totalcantidad[] =0;
	$totalpendiente[] =0;
	$ultimoprecio[]=0;
	
	// valores totales documento
	$totalcolumnatotal  = 0;
					
	
	// Creación del objeto de la clase heredada
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Courier','',9);				
					
	WHILE ($ficha2 = mysql_fetch_row($resf))
	{
					
		$fcbarra 			= $ficha2[1];
		
							

		
					
		
		//
		//$subtotal = $subtotal + ($fcantidad * $fvalorunitario);
		
		
		
		$pdf->Cell(15 ,4,$fcantidad,0,0,'L');		
		$pdf->Cell(92,4,nombreprod($fcbarra),0,0);
	
		$pdf->Cell(24,4,$columnaprecio,0,0,'R');
		$pdf->Cell(28,4,$columnatotal,0,1,'R');

		$j++;
								
	}
	if ($stipodoc == 3) 
	{
			// el iva se calcula solo para la factura  se trabaja con el NETO
			$subtotaliva = round((($totalcolumnatotal * $iva)/100),0);
	}
	else $subtotaliva = 0;

	$lista30 = 31 - $j;
	
	// linea de totales del documento
	// ultimos calculos
	
	$totalfactura  = $totalcolumnatotal + $subtotaliva;
	
	$pdf->Cell(160,8,$totalcolumnatotal,0,1,'R');
	$pdf->Cell(160,8,$subtotaliva,0,1,'R');
	$pdf->Cell(160,8,$totalfactura,0,1,'R');

	$pdf->Output();
}

?>