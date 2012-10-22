<?php include("header-micro.php")?>


<?php



function limpiar($string )
{

	$string 	= str_replace("\'","",$string); 
	
	return $string;
}



	$cb 		= $_GET['cb'];
	$see 		= $_POST['look'];


	$nombre		= $_POST['nombre'];
	$cbarra 	= $_POST['cbarra'];
	$marca 		= $_POST['marca'];
	$modelo 	= $_POST['modelo'];
	$um1 		= $_POST['um1'];
	$valor1 	= $_POST['valor1'];
	$fam 		= $_POST['fam'];
	$subfam 	= $_POST['subfam'];
	$boton 		= "0";
	
	$lista = $_POST['lista'];
	$listaprecios = $_POST['listaprecios'];
	$subtotal = $_POST['subtotal'];
	

	
	if (!empty($see))
	{
		include("conector/conector.php");
		
		SWITCH($see)
		{
				
			case '1':
					$insert = "SELECT * FROM tbk_producto WHERE nombre_pro LIKE '%".ltrim($nombre)."%'";
					break;
					
		
			case '2':
					$insert = "SELECT * FROM tbk_producto WHERE cbarra_pro LIKE '".trim($cbarra)."'";
					break;
					
		

			case '3':
					$insert = "SELECT * FROM tbk_producto WHERE marca_pro LIKE '%".ltrim($marca)."%'";
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
			$insert = "SELECT * FROM tbk_producto WHERE codigo_pro LIKE '".trim($cb)."'";	
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
<table border='0' height='400'>
<tr>
<td valign='top' >

<!-- carrito de compras -->


	<form name='boleta' action='cajacompra.php' method='POST' >

	<label id='subtitulo'> ARRIENDO MAQUINAS</label>
	<p/>
				
	<fieldset>
<?php 
$num_arr=0;
$num_arr=$num_arr+1;
?>

	
	<table border='0' cellspacing='5' cellpadding='5'  width='850' >
	<tr>
	<td />
	<td width='200' valign='top'>
		<input type='text' class='num' name='IDfactura' value='<?php echo"$num_arr" ?>' size='10'>
	</td>
	</tr>
	
	<tr>
	<td colspan='2'>
			<table border='0'width='850'>
			<tr>
			
			<td id='data'>
				<input type='text' name='nrut' size='14'><a  href="buscarproveedorfact.php" target="popup"  onClick="window.open(this.href, this.target, 'width=500,height=400'); return false;"><img src='images/binoculares.gif' border='0'></a>
			</td>
			<td id='data'>
				<input type='text' name='nnombre' size='50'><br/>

			</td>
			<td id='data' >
				<input type='text' name='fcfecha' value='<?=date('d-m-Y')?>' size='12'>
			</td>
			</tr>
			
			<tr>
			<td id='etiqueta'>
				RUT

			</td>
			
			<td id='etiqueta' >
				NOMBRE
			</td>
			<td id='etiqueta' >
				FECHA
			</td>
			
			</tr>
			</table>
			
	</td>
	</tr>
	
	<tr>
	<td colspan='2'>
			<table border='0'width='850'>
			<tr>
			
			<td id='data' >
				<input type='text' name='fcdireccion' value='' size='110'>
			</td>
			</tr>
			
			<tr>
			<td id='etiqueta'>
				DIRECCION

			</td>

			
			</tr>
			</table>
			
	</td>
	</tr>
	
	<tr>
	<td colspan='2'>
			<table border='0' width='850' >
			<tr>
			
			<td id='data' >
				<input type='text' name='fcgiro' value='<?=$ccodigorubro?>' size='110'>
			</td>
			</tr>
			
			<tr>
			<td id='etiqueta'>
			ACTIVIDAD ECONOMICA
			</td>

			
			</tr>
			</table>
	
	</td>
	</tr>
	
	
	<tr>
	<td colspan='2'>
			<table border='0' cellspacing='5' cellpadding='5'>
			<tr>
			<td id='etiqueta' > TIPO DE DOCUMENTO </td>
			<td id='data'> 
				<SELECT name='fctipodoc'>
				<option value='0'> GUIA</option>
				
				</SELECT>
			</td>
			</tr>
			</table>
	</td>
	</tr>
	
	<tr>
	<td colspan='2'>
	
		
				<table border='0' width='850'>
				<tr>
					<th id='etiqueta' WIDTH='150'> CODIGO (barras)</th>
					<th id='etiqueta' WIDTH='205'> NOMBRE</th>
					<th id='etiqueta' WIDTH='12'> CANTIDAD</th>
					<th id='etiqueta' WIDTH='100'> $ UNIDAD</th>
					<th id='etiqueta'> TOTAL</th>
				</tr>
				</table>
	
		<?php
			
			$p=0;
			for($p=1; $p <= 20; $p++)
			{
			
			?>
				<!-- producto 1  de 15 -->
				<table border='0' width='850'>
				
				<tr>
				<td id='data'>
					<input type='text' name='fcidpro<?=$p?>' size='3' readonly='readonly'>
					<input type='text' name='fccbarras<?=$p?>' size='17'>
				</td>
				<td id='data'>
					<!-- <a href='elegirproducto.php' id='menublanco' target="popup"  onClick="window.open(this.href, this.target, 'width=600,height=400'); return false;"><img src='images/binoculares.gif'></a> -->
					<a href='elegirproductocompra.php?pos=<?=$p?>' id='menublanco' target="popup"  onClick="window.open(this.href, this.target, 'width=600,height=400'); return false;"><img src='images/binoculares.gif'></a>
				</td>
				<td id='data'>
					<input type='text' name='fcnombrespro<?=$p?>' size='30'>
				</td>
				<td id='data'>
					<input type='text' name='fccantidadpro<?=$p?>' value='0' size='3'>
				</td>
				<td id='data'>
					$
				</td>
				<td id='data'>
					<input type='text' name='fcprecio<?=$p?>'  value='0' size='12' >
				</td>
				<td id='data'>
					$
				</td>
				<td>
					<input type='button' name='b<?=$p?>' value='=' onClick='multiplica("<?=$p?>")'>
				</td>
				<td id='data'>
					<input type='text' name='fccolumna<?=$p?>' value='0' size='12'>
				</td>
				<td>
					<SELECT name='fcestado<?=$p?>'>
					<option value='0'> Recepcionado</option>
					<option value='1'> Rechazado</option>
				
					</SELECT>
				</td>
				<td>
					<input type='button' value='x' onClick ='boleta.fccbarras<?=$p?>.value=""; boleta.fcnombrespro<?=$p?>.value=""; boleta.fccantidadpro<?=$p?>.value="0";boleta.fcprecio<?=$p?>.value="0"; boleta.fccolumna<?=$p?>.value="0"'>
				</td>
				</tr>
				
				</table>
		
		<?php
		
				}
		?>
		
				<p/>
				<table border='0' width='850'>
				<tr>
				<td id='etiqueta'>
					Observaciones
				</td>
				</tr>
				
				<tr>
				<td align='right'>
					<textarea name='fcobs' cols='140' rows='4'></textarea>
				</td>
				</tr>
				</table>
				
				<p/>
				
				<table border='0' width='850'>
				<tr>
				<td align='right'>
					<table border='0' cellpadding='5' cellspacing='5'>
					<tr>
					<td />
					<td id='data'> <input type='button'  value='=' onClick='totalfacturacompra()'>
					</tr>
					<tr>
					<td id='etiqueta'> NETO </td>
					<td id='data'> <input type='text' name='fcneto' value='' style='text-align:right'>
					</tr>
					<tr>
					<td id='etiqueta'> I.V.A. </td>
					<td id='data'> <input type='text' name='fciva' value='' style='text-align:right'>
					</tr>
					<tr>
					<td id='etiqueta'> TOTAL </td>
					<td id='data'> <input type='text' name='fctotal' value='' style='text-align:right'>
					</tr>
					</table>
					
				</td>
				</tr>
				
				</table>
	</td>
	</tr>
	</table>
	

	

	
	</fieldset>
	
	<p>
	<table border='0' width='850'>
	<tr>
	<td align='right'>
		<input type='text' name='usuario' value='<?=$rutUsuario?>'>
		<input type='Submit' value='Aceptar'>
	</td>
	</tr>
	</table>
	</form>

</td>
</tr>
</table>
</center>

<?php include("footer.php")?>