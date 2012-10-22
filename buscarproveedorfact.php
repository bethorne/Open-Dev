<?php include("header-zero.php")?>


<?php



function limpiar($string )
{

	$string 	= str_replace("\'","",$string); 
	
	return $string;
}



	$cb 		= $_GET['cb'];
	$see 		= $_POST['look'];


	$cpaterno		= $_POST['cpaterno'];
	$crut 			= $_POST['crut'];
	
	$boton 		= "0";
	

	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
				$insert ="SELECT *, MATCH(rut_pv,nombre_pv) AGAINST('".trim($crut)."') FROM tbk_proveedor WHERE MATCH(rut_pv,nombre_pv) AGAINST('".trim($crut)."')";
					//$insert = "SELECT * FROM tbk_proveedor WHERE rut_pv LIKE '".trim($crut)."%'";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_proveedor WHERE nombre_pv LIKE '%".trim($cpaterno)."%'  ORDER BY nombre_pv ASC ";
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
			$insert = "SELECT * FROM tbk_producto WHERE cbarra_pro LIKE '".trim($cb)."'";	
			if($respro = mysql_query($insert,$conn))
			{	
				$ficha[]="";
				
			
				$ficha = mysql_fetch_row($respro);
				
				$idpro 		= $ficha[0];
				$fnombre 	= $ficha[2];
				$fcbarra 	= $ficha[1];
				$fdesc 		= $ficha[3];
				$fmarca 	= $ficha[4];
				$fmodelo 	= $ficha[5];
				
			
			}
	
	}

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>


<center>
<table border='0' height='300'>
<tr>
<td valign='top' >



	<form name='np' action='buscarproveedorfact.php' method ='POST'>
	

	<table border='0'>
	<tr>
	<td width='400' valign='top'>
	

			<table border='0'>
			<tr><td><img src='images/buscarcliente.png'></td><td><label id='subtitulo'> Proveedores </label></td></tr>
			</table>
			<p/>
			
				<table border='0' cellspacing='5' cellpadding='5' width='450' background='images/logos/fondo_menu.jpg'>
				<tr>
				<td><label id='comentario'>Buscar por Rut o Nombre</label></td>
				<td valign='top' align='right' width='100'>
						<input type='text' name='crut' value='<?=limpiar($crut)?>' size='20' >	
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='np.look.value=1; np.submit()'>
				</td>
				</tr>
					
				</table>
			
			
			<p/>
			
			<fieldset>
				<table border='0' cellspacing='5' cellpadding='5' width='400' >
				<?php
				
					if ($busqueda == 1)
					{
						$i=0;
						While ($row = mysql_fetch_row($res))
						{
							$snombre = $row[1];
							$srut = $row[0];
							$spaterno  = $row[2];
							$smaterno = $row[3];
							$sdireccion = $row[4];
							$scomuna = $row[5];
							$scodigorubro = $row[10];
							
							$snnombre = $snombre." ".$spaterno." ".$smaterno;
							
							$sdirecciontotal = $sdireccion." ".$scomuna;
							
							$sac = "SELECT * FROM tbk_rubro WHERE codigo_rb = '".$scodigorubro."'";
							$resac = mysql_query($sac, $conn);
							
							$ficharubro =  mysql_fetch_row($resac);
							$snombrerubro = $ficharubro[1];
							
							echo "<tr><td id='etiqueta' width='5'><a href='#' onClick='window.opener.boleta.nrut.value=\"".$srut."\"; window.opener.boleta.nnombre.value=\"".$snnombre."\";window.opener.boleta.fcdireccion.value=\"".$sdirecciontotal."\"; window.opener.boleta.fcgiro.value=\"".$snombrerubro."\"; window.close()'><img src='images/flechaizq.jpg' border='0'></a></td><td id='data' width='100'>".$srut."</td><td id='data'>".$snombre."</td></tr>";
							$i++;
						}
					}
					else
					{
						echo "<tr><td id='etiqueta'>Recuerde colocar s&oacute;lo letras y n&uacute;meros</td></tr>";
					}
				
				
				?>
				
					</table>
			
			</fieldset>
			
			<p/>
			
			
	</td>
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
	

	
	
	</form>





</td>
</tr>
</table>
</center>

<?php include("footer.php")?>