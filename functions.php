
<?php


	
function limpiar($string )
{

	$string 	= str_replace("\'","",$string); 
	
	return  trim($string);
}


function region($n)
{
	
	$region = $n;
	$nombre='';
	
	SWITCH($region)
	{
		
		CASE '1' : $nombre ='TARAPAC&Aacute;'; break;
		CASE '2' : $nombre ='ANTOFAGASTA'; break;
		CASE '3' : $nombre ='ATACAMA'; break;
		CASE '4' : $nombre ='COQUIMBO'; break;
		CASE '5' : $nombre ='VALPARA&Iacute;SO'; break;
		CASE '6' : $nombre ='LIBERTADOR BERNARDO OHIGGINS'; break;
		CASE '7' : $nombre ='MAULE'; break;
		CASE '8' : $nombre ='BIOB&Iacute;O'; break;
		CASE '9' : $nombre ='ARAUCAN&Iacute;A'; break;
		CASE '10' : $nombre ='LOS LAGOS'; break;
		CASE '11' : $nombre ='AISEN Y GRAL C. IBA&Ntilde;EZ DEL CAMPO'; break;
		CASE '12' : $nombre ='MAGALLANES Y ANTARTICA CHILENA'; break;
		CASE '13' : $nombre ='METROPOLITANA'; break;
		CASE '14' : $nombre ='LOS R&Iacute;OS'; break;
		CASE '15' : $nombre ='ARICA Y PARINACOTA'; break;
		
		default: $nombre ="Sin regi&oacute;n";
	}
	return $nombre;
}



function nombreprod($codigo)
{
	include("conector/conector.php");
	$sn= "SELECT id_pro, codigo_pro, nombre_pro FROM tbk_producto WHERE codigo_pro ='".trim($codigo)."'";
	//echo $sn;
	
	$rn = mysql_query($sn, $conn);
	
	$a=0;
	WHILE($rowp = mysql_fetch_row($rn))
	{
		$namepro = $rowp['2'];
		$a++;
	}
	
	//echo "NOMBRE=".$namepro;
	
	return  limpiar($namepro);
}


function nombreprodid($codigo)
{
	include("conector/conector.php");
	$sn= "SELECT id_pro, codigo_pro, nombre_pro FROM tbk_producto WHERE id_pro ='".trim($codigo)."'";
	//echo $sn;
	
	$rn = mysql_query($sn, $conn);
	
	$a=0;
	WHILE($rowp = mysql_fetch_row($rn))
	{
		$namepro = $rowp['2'];
		$a++;
	}
	
	//echo "NOMBRE=".$namepro;
	
	return  limpiar($namepro);
}


function netoprod($codigo)
{
	include("conector/conector.php");
	$sn= "SELECT precio_neto_pv FROM tbk_producto_valor WHERE cbarra_pro ='".trim($codigo)."'";
	//echo $sn;
	
	$rn = mysql_query($sn, $conn);
	
	$a=0;
	WHILE($rowp = mysql_fetch_row($rn))
	{
		$neto = $rowp[0];
		$a++;
	}
	
	//echo "NOMBRE=".$namepro;
	
	return  limpiar($neto);
}


function ventaprod($codigo)
{
	include("conector/conector.php");
	$sn= "SELECT precio_efectivo_pv FROM tbk_producto_valor WHERE cbarra_pro ='".trim($codigo)."'";
	//echo $sn;
	
	$rn = mysql_query($sn, $conn);
	
	$a=0;
	WHILE($rowp = mysql_fetch_row($rn))
	{
		$venta= $rowp[0];
		$a++;
	}
	
	//echo "NOMBRE=".$namepro;
	
	return  limpiar($venta);
}



function stockprod($codigo)
{
	include("conector/conector.php");
	$sn= "SELECT stock_stk FROM tbk_stock WHERE id_pro ='".trim($codigo)."'";
	//echo $sn;
	
	$rn = mysql_query($sn, $conn);
	
	$a=0;
	WHILE($rowp = mysql_fetch_row($rn))
	{
		$stk= $rowp[0];
		$a++;
	}
	
	//echo "NOMBRE=".$namepro;
	
	return  limpiar($stk);
}

function banco($id)
{
	$nombrebanco='Sin registro';
	if ($id !='')
	{
		include("conector/conector.php");
		$sn= "SELECT * FROM tbk_banco WHERE id_bank ='".trim($id)."'";
		//echo $sn;
		
		$bn = mysql_query($sn, $conn);
		
		$fichabanco = mysql_fetch_row($bn);
		
		$nombrebanco = $fichabanco[1];
	}
	
	return $nombrebanco;
}


function rubro($id)
{
	$nombrerubro='Sin registro';
	if ($id !='')
	{
		include("conector/conector.php");
		$sn= "SELECT * FROM tbk_rubro WHERE codigo_rb ='".trim($id)."'";
		//echo $sn;
		
		$bn = mysql_query($sn, $conn);
		
		$ficharubro = mysql_fetch_row($bn);
		
		$nombrerubro = $ficharubro[1];
	}
	
	return $nombrerubro;
}

function codigoid($id)
{
			include("conector/conector.php");
			//busca codigo de documento
			$buscacodigo = " SELECT codigo_doc FROM tbk_documento WHERE id_doc ='".$id."'";
			
			$respro =  mysql_query($buscacodigo,$conn);
			$fichaproducto = mysql_fetch_row($respro);
			$codigodocumento = $fichaproducto[0];

			return $codigodocumento;
}

function codigoidprod($id)
{
			include("conector/conector.php");
			//busca codigo de documento
			$buscacodigo = " SELECT id_pro FROM tbk_producto WHERE codigo_pro = '".trim($id)."'";
			
			
			$respro =  mysql_query($buscacodigo,$conn);
			$fichaproducto = mysql_fetch_row($respro);
			$codigodocumento = $fichaproducto[0];

			return $codigodocumento;
}


function codigocompraid($id)
{
			include("conector/conector.php");
			//busca codigo de documento
			$buscacodigo = " SELECT codigo_docc FROM tbk_documentocompra WHERE id_docc ='".$id."'";
			
			$respro =  mysql_query($buscacodigo,$conn);
			$fichaproducto = mysql_fetch_row($respro);
			$codigodocumento = $fichaproducto[0];

			return $codigodocumento;
}

function personalrut($id)
{
			include("conector/conector.php");
			//busca codigo de documento
			$buscacodigo = " SELECT nombres_bk, paterno_bk, materno_bk FROM tbk_user WHERE rut_bk ='".$id."'";
			
			$respro =  mysql_query($buscacodigo,$conn);
			$fichapersonal = mysql_fetch_row($respro);
			$nombrerut = $fichapersonal[0]." ".$fichapersonal[1]." ".$fichapersonal[2];

			return $nombrerut;
}

function clienterut($id)
{
			include("conector/conector.php");
			//busca codigo de documento
			$buscacodigo = " SELECT * FROM tbk_cliente WHERE rut_cli ='".$id."'";
			
			$respro =  mysql_query($buscacodigo,$conn);
			$fichapersonal = mysql_fetch_row($respro);
			$fichacliente= $fichapersonal[1]." ".$fichapersonal[2]." ".$fichapersonal[3]."|".$fichapersonal[4]."|".$fichapersonal[5]."|".$fichapersonal[6]."|".$fichapersonal[9]."|".$fichapersonal[7]."|".$fichapersonal[8]."|".$fichapersonal[13];

			return $fichacliente;
}



function proveedorrut($id)
{
			include("conector/conector.php");
			//busca codigo de documento
			$buscacodigo = "SELECT * FROM tbk_proveedor WHERE rut_pv ='".$id."'";
			
			$respro =  mysql_query($buscacodigo,$conn);
			$fichapersonal = mysql_fetch_row($respro);
			$ficha= $fichapersonal[1]." ".$fichapersonal[2]." ".$fichapersonal[3];

			return $ficha;
}

?>
