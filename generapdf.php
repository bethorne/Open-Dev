<?php include("header-pdf.php");

include("conector/conector.php");
include("functions.php");
require('fpdf/fpdf.php');
date_default_timezone_set('America/Santiago');

// recuperar informacion de factura

$cb  = $_GET['cb'];

global $rutcli,$stipodoc,$fechadoc,$codigodoc ,$vendedor,$formadepago;
	// buscar informacion de Factura

	$bf= "SELECT * FROM  tbk_documento WHERE id_doc='".$cb."'";
	$rf = mysql_query($bf, $conn);
		
	$ficha = mysql_fetch_row($rf);

	$GLOBALS['rutcli']		= $ficha[1];
	$GLOBALS['nombrecli']   = clienterut($GLOBALS['rutcli']);
	$stipodoc 				= $ficha[2];
	$GLOBALS['fechadoc'] 	= $ficha[3];
	$GLOBALS['codigodoc'] 	= $ficha[6];
	$GLOBALS['vendedor']  	= $ficha[7];
	
	$bfp= "SELECT cuotas_pag FROM  tbk_pago WHERE id_doc='".$cb."'";
	$rfp = mysql_query($bf, $conn);
	
	$fichafp = mysql_fetch_row($rfp);
	
	$ncuotas = $fichafp[0];
	
	if ($ncuotas <= 1) 
		$GLOBALS['formadepago'] = 'CONTADO';
	else $GLOBALS['formadepago'] = 'CREDITO';
	


	
class PDF extends FPDF
{
// Cabecera de página
function Header()
{

	$dia  = substr($GLOBALS['fechadoc'],0,2);
	$mesesfactura  = array('01'=>'ENERO','02'=>'FEBRERO','03'=>'MARZO','04'=>'ABRIL','05'=>'MAYO','06'=>'JUNIO','07'=>'JULIO','08'=>'AGOSTO','09'=>'SEPTIEMBRE','10'=>'OCTUBRE','11'=>'NOVIMEBRE','12'=>'DICIEMBRE');
	$mes  = $mesesfactura[substr($GLOBALS['fechadoc'],3,2)];
	$year = substr($GLOBALS['fechadoc'],6,4);
	
	//datos del cliente
	$fc = explode("|",$GLOBALS['nombrecli']);
	$rut = $GLOBALS['rutcli']; 
	$nc	= $fc[0];
	$dir = $fc[1];
	$comuna = $fc[2];
	$fono = $fc[4];
	$rubro1 = $fc[5];
	$rubro2 = $fc[6];
	$rubro3 = $fc[7];
	
	$rubros  = rubro($rubro1).",".rubro($rubro2).",".rubro($rubro3);
	
		
    // Logo
    $this->Image('images/factura_baro.jpg',1,1,210);
    // Arial bold 15
    $this->SetFont('Arial','B',20);
    // Movernos a la derecha
    //$this->Cell(80);
    // Título tamaño total: 195, 90
	 
	$this->Cell(188,18,'76.024.185-7',0,1,'R');
	$this->Cell(172,16,'',0,1,'R');
	$this->SetFont('Arial','B',15);
    $this->Cell(172,-5,$GLOBALS['codigodoc'],0,1,'R');
	$this->Cell(172,12,'',0,1,'R');
	
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

$find = "SELECT * FROM tbk_docpro WHERE  id_doc ='".$cb."'";
if ($resf = mysql_query($find, $conn))
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
					
		$fcbarra 			= trim($ficha2[1]);
		$ftipodespacho		= $ficha2[2];
		
		$fcantidad 			= $ficha2[3];
		//$fvalorunitario 	= $ficha2[4];
		$fguia			 	= $ficha2[5];
		$festado			= $ficha2[6];
		$totalcantidad[$fcbarra]  	=  $totalcantidad[$fcbarra] 	+ $fcantidad;
		$totalpendiente[$fcbarra]  	=  $totalpendiente[$fcbarra] 	+ $fguia;
							

		
					
		
		//buscar valor neto
		
		$buscaneto = "SELECT * FROM tbk_producto_valor WHERE cbarra_pro  ='".$fcbarra."'";
		if ($resneto = mysql_query($buscaneto, $conn))
		{
			$fprod = mysql_fetch_row($resneto);
			//obteniendo neto
			$fvalorneto 	= $fprod[4];
			$fvalorventa 	= $fprod[3];
		}
					
		
		//$subtotal = $subtotal + ($fcantidad * $fvalorunitario);
		
		if ($festado == 0)
		{
			if ($stipodoc == 1)
			{
			$subtotal = $subtotal + ($fcantidad * $fvalorventa);
			$ultimoprecio[$fcbarra] = $fvalorventa;
			}

			if ($stipodoc == 2)
			{
				$subtotal = $subtotal + ($fcantidad * $fvalorneto);
				$ultimoprecio[$fcbarra] = $fvalorneto;
				}

			if ($stipodoc == 3)
			{
				$subtotal = $subtotal + ($fcantidad * $fvalorneto);
				$ultimoprecio[$fcbarra] = $fvalorneto;
			}

		}


		if ($stipodoc == 1) $columnaprecio= $fvalorventa;
		if ($stipodoc == 2) $columnaprecio= $fvalorneto;
		if ($stipodoc == 3) $columnaprecio= $fvalorneto;


		if ($stipodoc == 1) $columnatotal= $fvalorventa * $fcantidad;
		if ($stipodoc == 2) $columnatotal= $fvalorneto * $fcantidad;
		if ($stipodoc == 3) $columnatotal= $fvalorneto * $fcantidad;
		
		$totalcolumnatotal  = $totalcolumnatotal + $columnatotal;
		
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

	$lista30 = 29 - $j;
	for($l=1; $l <= $lista30; $l++)
		$pdf->Cell(135,4,'-',0,1);

	// linea de totales del documento
	// ultimos calculos
	include("numero.php");
	
	$totalfactura  = $totalcolumnatotal + $subtotaliva;
	$pdf->Cell( 160,8,numtoletras($totalfactura),0,1,'L');
	$pdf->Cell(160,7,$totalcolumnatotal,0,1,'R');
	$pdf->Cell(160,7,$subtotaliva,0,1,'R');
	$pdf->Cell(160,8,$totalfactura,0,1,'R');

	$pdf->Output();
}

?>