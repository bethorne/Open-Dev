<?php include("header.php")?>


<?php



function limpiar($string )
{

	$string 	= str_replace("\'","",$string); 
	
	return $string;
}



	$cb 		= $_GET['cb'];
	$see 		= $_POST['look'];


	$cpaterno		= $_POST['cpaterno'];
	$erut 			= $_POST['erut'];
	
	$boton 		= "0";
	

	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert = "SELECT * FROM tbk_cliente WHERE rut_cli LIKE '".trim($erut)."%'";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_cliente WHERE nombre_cli LIKE '%".trim($cpaterno)."%' ORDER BY nombre_cli ASC";
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
			$insert = "SELECT * FROM tbk_cliente WHERE rut_cli LIKE '".trim($cb)."'";	
			if($respro = mysql_query($insert,$conn))
			{	
				$ficha[]="";
				
			
				$ficha = mysql_fetch_row($respro);
				
				$nrut 			= $ficha[0];
				$cnombre		= $ficha[1];
				$cpaterno 		= $ficha[2];
				$cmaterno		= $ficha[3];
				$cdireccion 	= $ficha[4];
				$ccomuna		= $ficha[5];
				$cregion		= $ficha[6];
				$ccodigorubro   = $ficha[7];
				$ccodigorubro2  = $ficha[8];
				$cfono			= $ficha[9];
				$cemail			= $ficha[10];
				$cobs			= $ficha[11];
				$fechaingreso   = $ficha[12];
			
			}
	
	}

	// echo $nombre."-".$cbarra."-".$um1."-".$valor1."-".$fam."-".$subfam;

?>



<table border='0' width='800' height='300'>
<tr>
<td valign='top' >



	<form name='np' action='buscarclientecredito.php' method ='POST'>
	
	

	<label id='subtitulo'> FICHA CLIENTE</label>
	<br/>
	<label id='comentariogris'> Datos registrados en el sistema del Cliente seleccionado.</label>
	<hr/>
	
	

	<table border='0'>
	<tr>
	<td width='400' valign='top'>
	
			<label id='subtitulo'> Clientes </label>
			<p/>

				
			
				<table border='0' cellspacing='5' cellpadding='5' width='430' background='images/logos/fondo_menu.jpg'>
				<tr>
				<td>
					<label id='comentario'>por rut</label>
				</td>
				<td valign='top' align='right' width='100'>
						<input type='text' name='erut' value='<?=limpiar($erut)?>' size='14' >
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='np.look.value=1; np.submit()'>
				</td>
				</tr>
				
				<tr>
				<td>
					<label id='comentario'>por Nombre</label>
				</td>
				<td valign='top'  width='100' align='right'>
						<input type='text' name='cpaterno' value='<?=$cpaterno?>'  size='14'>						
				</td>
				<td valign='top' width='16'>
						<input type='image' src='images/lupa.png' onClick='np.look.value=2; np.submit()'>
				</td>
				<td />
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
							
							$snnombre = $snombre." ".$spaterno." ".$smaterno;
							
							$sdirecciontotal = $sdireccion." ".$scomuna;
							
							echo "<tr><td id='data' width='100'><a id='etiquetazul' href='buscarclientecredito.php?cb=".$srut."'>".$srut."</a></td><td id='data'>".$snombre."</td><td id='data'>".$spaterno." ".substr($smaterno,0,1)."</td></tr>";
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
	
	<P/>
	
	<!-- informacion encontrada del proveedor en cuestion -->
	
	<?php  if (!empty($cb)) :?>
	
<table border='0' width='800' height='400'>
<tr>
<td valign='top' >



	<p/>
	<table border='0'>
	<tr>
	<td width='800' valign='top' >
	
			<label id='subtitulo'> Datos Cliente</label>
			<p/>
			
			<fieldset>
			
				<table border='0' cellspacing='1' cellpadding='1' width='800'>
				
				<tr>

				<td  id='data'>
						<?=$nrut?>
						<!-- <input type='text' name='nrut' value='<?=$nrut?>' size='15'> -->
				
				</td>
				<td  id='data' colspan='2'>
						<?=limpiar($cnombre)?>
						<!-- <input type='text' name='cnombre' value='<?=limpiar($cnombre)?>' size='80'> -->
				
				</td>
				</tr>
				
				
				<tr>
				<td id='menu' > RUT</td>
				<td id='menu' colspan='2'> NOMBRES</td>
				</tr>

				<tr>
				<td  id='data'>
						<?=$cdireccion?>
						<!-- <input type='text' name='cdireccion' value='<?=$cdireccion?>' size='40'> -->
				
				</td>
				<td  id='data'>
						<?=$ccomuna?>
						<!-- <input type='text' name='ccomuna' value='<?=$ccomuna?>' size='40'> -->
				
				</td>
				<td  id='data'>
						<SELECT name='cregion'>
							<option/>
							
							<option value='15' <? if($cregion == 15) echo "SELECTED"?>>ARICA Y PARINACOTA</option>
							<option value='1'  <? if($cregion == 1) echo "SELECTED"?>>TARAPACÁ</option>
							<option value='2'  <? if($cregion == 2) echo "SELECTED"?>>ANTOFAGASTA</option>
							<option value='3'  <? if($cregion == 3) echo "SELECTED"?>>ATACAMA</option>
							<option value='4'  <? if($cregion == 4) echo "SELECTED"?>>COQUIMBO</option>
							<option value='5'  <? if($cregion == 5) echo "SELECTED"?>>VALPARAISO</option>
							<option value='13'  <? if($cregion == 13) echo "SELECTED"?>>METROPOLITANA</option>
							<option value='6'  <? if($cregion == 6) echo "SELECTED"?>>LIBERTADOR BERNARDO O'HIGGINS</option>
							<option value='7'  <? if($cregion == 7) echo "SELECTED"?>>MAULE</option>
							<option value='8'  <? if($cregion == 8) echo "SELECTED"?>>BIOBIO</option>
							<option value='9'  <? if($cregion == 9) echo "SELECTED"?>>ARAUCANIA</option>
							<option value='14'  <? if($cregion == 14) echo "SELECTED"?>>LOS RIOS</option>
							<option value='10'  <? if($cregion == 10) echo "SELECTED"?>>LOS LAGOS</option>
							<option value='11'  <? if($cregion == 11) echo "SELECTED"?>>AISEN Y GRAL C. IBA&Ntlilde;EZ DEL CAMPO</option>
							<option value='12'  <? if($cregion == 12) echo "SELECTED"?>>MAGALLANES Y ANTARTICA CHILENA</option>
							
						</SELECT>
						
				
				</td>
				</tr>
				
				<tr>
				<td id='menu' > DIRECCION</td>
				<td id='menu' > COMUNA</td>
				<td id='menu' > REGION</td>
				</tr>


				</table>
			
			</fieldset>

	</td>
	</tr>
	
	
	</table>


	<p/>
	
	 <!-- CREDITO -->
	 
	<table border='0' width='850'>
	<tr>
	<td valign='top' >
	
		<label id='subtitulo'>Cr&eacute;dito</label>
		
		<p/>
			
		<fieldset>
			<table border='0' width='600' cellspacing='5' cellpadding='5'>
			<tr>
			<td id ='etiqueta' width='150'>
				Fecha Ingreso
			</td>
			<td/>
			<td id='data'>
					<input type='text' name='fecha' value='<?=date('d-m-Y H:i')?>'>
			</td>
			</tr>
			
			<tr>
			<td id='etiqueta'>
				Monto del Cr&eacute;dito
			</td>
			<td id='data'>$</td>
			<td id='data'>
				<input type='text' class='num' name='monto' value=''>
			</td>
			</tr>
			
			<tr>
			<td id='etiqueta'>
				Autoriza
			</td>
			<td id='data'>$</td>
			<td id='data'>
				<input type='text' name='autoriza' value='<?=$nombreUsuario ?>' size='60'>
			</td>
			</tr>
			
			</table>
		</fieldset>
		
		
	
	</td>
	</tr>
	</table>
	
	
	<table border='0' width='850'>
	<tr>
	<td align='right'>
	
		<table border='0' cellpadding='5' cellspacing='5'>
		<tr>
		<td>
			<input type='hidden' name='rutcli' value='<?=$nrut?>'>
			<input type='submit' value='Aceptar' onCLick='np.action="procesacredito.php"; submit()'>
		</td>
		</tr>
		</table>
	
	</td>
	</tr>
	</table>
	
	<?php endif ?>
	
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
	

	</form>


	


</td>
</tr>
</table>


<?php include("footer.php")?>