<?php

session_start();

if (!empty($_POST[crut])) $_SESSION[UID]= $_POST[crut];
if (!empty($_GET[puid])) $_SESSION[PID]= $_GET[puid];

$rut  = $_SESSION[UID];
$puid = $_SESSION[PID];
$iva  = $_SESSION[IVA];



if ($_GET[s] =="x") 
	{
		session_unset();
		$rut="";
		$puid="";
		$iva = "";
	}

?>
<HTML>
<HEAD>
<STYLE>
	td#etiqueta
	{
		
		background  :#225599;
		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#ffffff;

		
	}
	
	td#data
	{

		font-family :arial;
		font-size   :11px;
		color       :#555555;
		border      : solid 1px #aaaaaa;
		background  :#ffffff;
		
	}


</STYLE>

</HEAD>
<BODY>

<?php

	include("conector/conector.php");
	include("functions.php");


	$cb 		= $_GET['cb'];
	$see 		= $_POST['look'];


	$nombre		= $_POST['nombre'];
	if (!empty($nombre)) $codigofactura = $nombre;
	$nrut 		= $_POST['nrut'];
	
	
	
	$boton 		= "0";
	
	// pago de cuota
	
	$pagofactura 	= $_POST['FFID'];
	$pagocliente 	= $_POST['FUID'];
	$pagocuotas 	=  $_POST['quotas'];
	$pagomonto  	= $_POST['montopago'];
	$pagofecha  	= $_POST['FFECHA'];
	
	
	// echo " SE HA PAGADO BAJO LOS SIGUIENTES TERMINOS: ".$pagofactura." por ".$pagocliente." la cantidad de ".$pagomonto." correspondientes a ".$pagocuotas." cuotas<p/>";
	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert = "SELECT * FROM tbk_arriendo WHERE id_fact doc '%".ltrim($codigofactura)."%' AND tipo_doc = 3 ORDER BY id_fact DESC";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_factura WHERE rut_cli LIKE '".trim($nrut)."' AND tipo_doc= 3 ORDER BY id_doc DESC";
					break;
					
		

			case '3':
					$insert = "SELECT * FROM tbk_factura WHERE SUBSTR(fecha_doc,4,2) LIKE '%".ltrim($marca)."%' AND tipo_doc= 3 ORDER BY id_doc DESC";
					break;
			
			
			case '9':
					//echo "almacenando pago de cuotas";
					
					$insert = "INSERT INTO tbk_pago_cuota VALUES (";
					$insert .= "'".$pagofactura."',";
					$insert .= "'".$pagocliente."',";
					$insert .= "'".$pagocuotas."',";
					$insert .= "'".$pagomonto."',";
					$insert .= "'".$pagofecha."'";
					$insert .= ")";
					
					//echo "->".$insert."<p/>";
					
					if($resulta = mysql_query($insert, $conn))
					{
						echo "<table border='0' width='880' bgcolor='#ddffdd'><tr><td align='right'> <table border='0'><tr><td><img src='images/alerta.gif'></td><td><label id='alerta'> Pago de cuota(s)  realizado  exitosamente</label></td></tr></table> </td></tr></table>";
					}
					else
						{
							echo "<table border='0' width='880' bgcolor='#ffdddd'><tr><td align='right'> <table border='0'><tr><td><img src='images/alerta.gif'></td><td><label id='alerta'> Se ha producido un error en el registro del pago de la cuota</label></td></tr></table> </td></tr></table>";
						}
					
					
					// RECORDAR ACTUALIZAR 
					
					break;
				
		}
		//echo "BUSCANDO=".$insert;
		
		if($res = mysql_query($insert,$conn))
		{
			$busqueda = 1;
			
		}
			
		else
		{
		
			$busqueda = 0;
		}
			
			
	}	
		

	if (!empty($cb))
	{
			$insert = "SELECT * FROM tbk_arriendo WHERE id_doc LIKE '".trim($cb)."'";	
			
			if($respro = mysql_query($insert,$conn))
			{	
				$ficha[]="";
				
			
				$ficha = mysql_fetch_row($respro);
				

				
				$scodigo 	= $ficha[0];
				$scliente	= $ficha[1];
				$stipodoc 	= $ficha[2];
				$sfecha		= $ficha[3];
				$stotal		= $ficha[4];
				$codigodoc  = $ficha[6];

			
			}
	
	}

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>


<center>
<table border='0' width='450' height='400'>
<tr>
<td valign='top' >

	<form name='boleta' action='facturas.php?cb=<?=$cb?>' method ='POST'>
	
	<h2 align='center'>Orden de Arriendo</h2>
	
	<table border='0'>
	<tr>
	<td width='400' valign='top'>
	

	<?php if (!empty($cb)) :?>
		
			<?php
			
					//Buscar datos de cliente
					$searchCli = "SELECT * FROM tbk_cliente WHERE rut_cli = '".$scliente."'";
					$resultaCli = mysql_query($searchCli, $conn);
					$i=0;
					While ($row = mysql_fetch_row($resultaCli))
						{
							$frut 		= $row[0];
							$fnombre 	= $row[1];
							$fpaterno  	= $row[2];
							$fmaterno 	= $row[3];
							$fnombrecompleto = "(".$frut.") ".$fnombre." ".$fpaterno." ".$fmaterno; 
							
							$fdir 		= $row[4];
							$fcomuna 	= $row[5];
							$fregion 	= $row[6];
							$ffono		 = $row[7];
							$fecha = time (); 
							
							$i++;
						}
					
						//echo "ACA:: ".$searchCli." NOMBRE COMPLETO ".$fombrecompleto;
			
			?>
		

			<table border='0' cellspacing='5' cellpadding='5' width='500'>
			<tr>
			<td  id='data'>
				Fecha:<br/><label id='comentario'><font size='4'> <i> <?=$sfecha?></i></font></label>
			</td>
			<td  id='data' align='right' colspan='3'>
				 N° <label id='comentario'> <font size='4'><br/><?=$cb?></font></label>
			</td>
			</tr>
			
			<tr><td height='25' colspan='5'><hr/></td></tr>
				
			<tr>
				<td id='etiqueta' colspan='5'> Cliente </td>
			</td>
					
			<tr>
			<td id='data' colspan='4'>
				 <label id='comentario'><?=$fnombrecompleto?> </label>
			</td>
			</tr>
			
						<tr>
			<td id='data' colspan='4'>
				 <label id='comentario'><?=$fdir." - ".$fcomuna?> </label>
			</td>
			</tr>
			
			<tr><td height='25' colspan='5'><hr/></td></tr>
			
		
			<tr><td id='etiqueta'> Producto</td><td id='etiqueta' align='center'> Cant.</td><td id='etiqueta' width='30' align='center' > Fecha.</td><td id='etiqueta' width='30' align='center' > Valor</td><td id='etiqueta' width='30' align='center'>  Total</td></tr>
					
			<?php
			
				$find = "SELECT * FROM tbk_docarr WHERE  id_doc = ".$scodigo;
				if ($resf = mysql_query($find, $conn))
				{
					$j=0;
					$subtotal = 0;
					WHILE ($ficha2 = mysql_fetch_row($resf))
					{
					
						$fcbarra 			= $ficha2[1];
						$ftipodespacho		= $ficha2[2];
						$fcantidad 			= $ficha2[3];
						$fvalorunitario 	= $ficha2[4];
					
						$subtotal = $subtotal + ($fcantidad * $fvalorunitario);
				?>	
					
					<tr>
					<td id='data' width='180'>
						<label id='comentario'><?=nombreprod($fcbarra)?></label>
					</td>
	
					<td id='data' align='right' width='10'>
						<label id='comentario'><?=$fcantidad?></label>
					</td>
                    <td id='data' align='right' width='20' >
						<label id='comentario'><?=$sfecha?></label>
					</td>
					<td id='data' align='right' >
						<label id='comentario'>$ <?=$fvalorunitario?></label>
					</td>
					<td id='data' align='right' >
						<label id='comentario'>$ <?=$fvalorunitario * $fcantidad ?></label>
					</td>
					</tr>
					
				<?php
						$j++;
						
					}
					
					$subtotaliva = round((($subtotal * $iva)/100),0);
				?>
				


					<tr>
					<td />
					<td />
					<td id='etiqueta' >
						<label id='comentario'><b>TOTAL</b> </label>
					</td>
					<td id='etiqueta' align='right' >
						$ <?=$stotal?>
					</td>
					</tr>					
			</table>

					
		<?php 	} 
			
				
					
		?>	
	</td>
					

	<?php endif ?>

	</tr>
	</table>
	

	<p/>
	
	<table border='0'>
	<tr>
	<td>
	
			<table border='0' width='400'>
			<tr>
			<td align='right'>
					<table border='0'>
					<tr>
					<td>
						
						<input type='hidden' name='look' value=''>
					
					</td>
					</tr>
					</table>
				
			</td>
			</tr>
			</table>
	</td>
	
	</tr>
	</table>
			
			
	<p/>
	

	
<input type="button" name="imprimir" value="Imprimir" onclick="window.print();">
	</form>		





</td>
</tr>
</table>
</center>

</BODY>
</HTML>