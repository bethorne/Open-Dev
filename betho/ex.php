<?php
require('mysql_table.php');

class PDF extends PDF_MySQL_Table
{
function Header()
{
	//Title
	$this->SetFont('Arial','',10);
	$this->Cell(0,6,'World populations',0,1,'C');
	$this->Ln(10);
	//Ensure table header is output
	parent::Header();
}
}

//Connect to database
mysql_connect('localhost','root','');
mysql_select_db('baro');

$pdf=new PDF();
$pdf->AddPage();

$periodo  = $_GET['periodo'];	
$yearguia  = $_GET['year'];	

//First table: put all columns automatically
$pdf->Table("SELECT rut_cli AS RUT, tipo_doc AS Documento, fecha_doc AS Fecha, total_doc AS Total, codigo_doc AS Doc 
FROM tbk_documento 
WHERE codigo_doc <>  '' 
AND SUBSTR( fecha_doc, 4, 2 ) =  '".$periodo."' 
AND SUBSTR( fecha_doc, 7, 4 ) =  '".$yearguia."' 
ORDER BY fecha_doc");

$pdf->AddPage();
//Second table: specify 3 columns


$pdf->AddCol('rank',20,'','C');
$pdf->AddCol('name',40,'Country');
$pdf->AddCol('pop',40,'Pop (2001)','R');
$prop=array('HeaderColor'=>array(255,150,100),
			'color1'=>array(210,245,255),
			'color2'=>array(255,255,210),
			'padding'=>2);
			//$pdf->Table('select name, format(pop,0) as pop, rank from country order by rank limit 0,10',$prop);
$pdf->Output();
?>
