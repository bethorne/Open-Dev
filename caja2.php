<?php include("header-micro.php")?>


<?php
	



	$lista = $_POST['lista'];
	
	//echo nl2br($lista);
	$cadena = explode("\n",$lista);
	$listado = count($cadena);
	
	//busca ultimos codigos de  documento
	$searchcodigo = "SELECT * FROM tbk_parametro WHERE  tipo_param = 3";
	$resultadocodigo = mysql_query($searchcodigo, $conn);
	
	$i=0;
	
	$factura = 0;
	$guia = 0;
	$boleta =0;
	
	WHILE ($rowparam = mysql_fetch_row($resultadocodigo))
	{
		if ($rowparam[2] =='factura') $factura 	= $rowparam[4] + 1;
		if ($rowparam[2] =='guia')    $guia		= $rowparam[4] + 1;
		if ($rowparam[2] =='boleta')  $boleta 	= $rowparam[4] + 1;
		
		$i++;
	}
	
	
		
	echo "<form name='boleta' action='caja3.php' method='POST'>\n";
	
?>


	<label id='subtitulo'> FACTURA / BOLETA</label>
	<br/>
	<label id='comentariogris'> Complete los campos para ingresar la Factura/Boleta al sistema.</label>
	<hr/>
	<p/>
	
	
<table border='0' width='900'>
<tr>
<td width='400' valign='top' >
	

	<label id='subtitulo'> Factura/Boleta</label>
	<p/>
	
	<fieldset>
		
		<table border='0' cellspacing='5' cellpadding='5' width='350'>
		<tr>
		<td id='etiqueta'>
			Documento
		</td>
		<td>
			<SELECT name='documento' onChange='asignacodigo(boleta.documento.value)' >
				<option />
				<option value='1'> FACTURA </option>
				<option value='2'> BOLETA </option>
			</SELECT>
		</td>
		</tr>
		
		<tr>
		<td id='etiqueta'>
			N°
		</td>
		<td>
			<input type='text' name='cfactura' value='' size='20' readonly ='readonly'>
		</td>
		</tr>
		
		<tr>
		<td id='etiqueta'>
			Fecha Fact.
		</td>
		<td>
			<input type='text' name='fechafact' value='<?= date('d-m-Y')?>' size='20' readonly ='readonly'>

		</td>
		</tr>
		</table>
		
		
	</fieldset>
	
	<p/>
	
	
	

	
	<label id='subtitulo'> Forma de Pago </label>
	<p/>
	
	<fieldset>
		
		<table border='0' cellspacing='5' cellpadding='5' width='350'>
			
		<!--
		<tr>
		<td id='etiqueta' valign='top'>
			Medio de Pago
		</td>
		<td valign='top'>
	
				<table border='0' cellspacing='2' cellpadding='2'>
				
				
				<tr><td ><input type='radio' name='tarjeta' value='6' onClick='boleta.cuotas.selectedIndex=1; boleta.valorcuota.value= boleta.total.value;'></td><td colspan='5' id='data'  height='20' width='50'> Efectivo</td><td align='right'> <img src='images/luka.jpg' height='15'> </td></tr>
				<tr><td ><input type='radio' name='tarjeta' value='7' onClick='boleta.cuotas.selectedIndex=1; boleta.valorcuota.value= boleta.total.value;'></td><td colspan='5'id='data'  height='20'> RedCompra</td><td align='right'> <img src='images/redcompra.jpg' height='15'></td></tr>
				<tr><td ><input type='radio' name='tarjeta' value='8' onClick='boleta.cuotas.selectedIndex=1; boleta.valorcuota.value= boleta.total.value;'></td><td colspan='5'id='data'  height='20'> Cheque </td><td align='right'><img src='images/cheque.jpg' height='15'></td></tr>
				<tr><td colspan='7'> <hr/></td></tr>
				
				<tr>
				<td ><input type='radio' name='tarjeta' value='9'></td>
				<td id='data' colspan='7'> 
					 BANCARIA<p/>
					<SELECT name='banco'> 
						<option value=1>ABN AMRO</option>
						<option value=2>Atlas - Citibank</option>
						<option value=3>BancaFacil - Sitio de educación bancaria</option>
						<option value=4>Banco Bice</option>
						<option value=5>Banco Central de Chile</option>
						<option value=6>Banco de Chile</option>
						<option value=7>Banco de Crédito e Inversiones</option>
						<option value=8>Banco del Desarrollo</option>
						<option value=9>Banco del Desarrollo - Asesoría Financiera</option>
						<option value=10>Banco Edwards</option>
						<option value=11>Banco Falabella</option>
						<option value=12>Banco Internacional</option>
						<option value=13>Banco Nova</option>
						<option value=14>Banco Penta</option>
						<option value=15>Banco Santander Santiago</option>
						<option value=16>Banco Security</option>
						<option value=17>BancoEstado</option>
						<option value=18>BBVA</option>
						<option value=19>Citibank N.A. Chile</option>
						<option value=20>Corpbanca</option>
						<option value=21>Credichile</option>
						<option value=22>Credit Suisse Consultas y Asesorias Ltda</option>
						<option value=23>Deutsche Bank</option>
						<option value=24>ING Bank N.V.</option>
						<option value=25>Redbanc</option>
						<option value=26>Santander Banefe</option>
						<option value=27>Scotiabank Sud Americano</option>
						<option value=28>Scotiabank Sud Americano</option>
						<option value=29>UBS AG in Santiago de Chile</option>
					</SELECT>
				</td></tr>
				<tr><td><input type='radio' name='tarjeta' value='1'></td><td  id='data'  height='20'> VISA</td><td align='right'> <img src='images/visa.jpg'></td></tr>
				<tr><td><input type='radio' name='tarjeta' value='2'></td><td  id='data'  height='20'> MASTERCARD</td><td align='right'> <img src='images/mastercard.jpg'></td></tr>
				<tr><td><input type='radio' name='tarjeta' value='3'></td><td  id='data'  height='20'> AMERICAN XPRESS</td><td align='right'> <img src='images/americanxpress.jpg'></tr>
				<tr></td><td><input type='radio' name='tarjeta' value='4'></td><td  id='data'  height='20'> MAGNA</td><td align='right'> <img src='images/magna.jpg'></td></tr>
				<tr><td><input type='radio' name='tarjeta' value='5'></td><td  id='data'  height='20'> DINNERS CLUB</td><td align='right'> <img src='images/dinnersclub.jpg'></td></tr>
			
				</table>
		</td>
		</tr>
		
		-->
		<tr>
		<td id='etiqueta'>
			Cuotas
		</td>
		<td id='data'>
			<select name='cuotas' onChange='calcularcuota(boleta.cuotas.options.selectedIndex)'>
				<option value='0'/>
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
				<option>6</option>
				<option>7</option>
				<option>8</option>
				<option>9</option>
				<option>10</option>
				<option>12</option>
				<option>24</option>
			</select>
			<input type='text' name='valorcuota' class='num' value='' size='8' readonly ='readonly'>
		</td>
		</tr>
		<tr>
		<td id='etiqueta'>
			Primera Cuota
		</td>
		<td>
			<SELECT name='diadepago' >
				<option value='01' <?php if (date('d') == '01') echo "SELECTED" ?>>01</option>
				<option value='02' <?php if (date('d') == '02') echo "SELECTED" ?>>02</option>
				<option value='03' <?php if (date('d') == '03') echo "SELECTED" ?>>03</option>
				<option value='04' <?php if (date('d') == '04') echo "SELECTED" ?>>04</option>
				<option value='05' <?php if (date('d') == '05') echo "SELECTED" ?>>05</option>
				<option value='06' <?php if (date('d') == '06') echo "SELECTED" ?>>06</option>
				<option value='07' <?php if (date('d') == '07') echo "SELECTED" ?>>07</option>
				<option value='08' <?php if (date('d') == '08') echo "SELECTED" ?>>08</option>
				<option value='09' <?php if (date('d') == '09') echo "SELECTED" ?>>09</option>
				<option value='10' <?php if (date('d') == '10') echo "SELECTED" ?>>10</option>
				<option value='11' <?php if (date('d') == '11') echo "SELECTED" ?>>11</option>
				<option value='12' <?php if (date('d') == '12') echo "SELECTED" ?>>12</option>
				<option value='13' <?php if (date('d') == '13') echo "SELECTED" ?>>13</option>
				<option value='14' <?php if (date('d') == '14') echo "SELECTED" ?>>14</option>
				<option value='15' <?php if (date('d') == '15') echo "SELECTED" ?>>15</option>
				<option value='16' <?php if (date('d') == '16') echo "SELECTED" ?>>16</option>
				<option value='17' <?php if (date('d') == '17') echo "SELECTED" ?>>17</option>
				<option value='18' <?php if (date('d') == '18') echo "SELECTED" ?>>18</option>
				<option value='19' <?php if (date('d') == '19') echo "SELECTED" ?>>19</option>
				<option value='20' <?php if (date('d') == '20') echo "SELECTED" ?>>20</option>
				<option value='21' <?php if (date('d') == '21') echo "SELECTED" ?>>21</option>
				<option value='22' <?php if (date('d') == '22') echo "SELECTED" ?>>22</option>
				<option value='23' <?php if (date('d') == '23') echo "SELECTED" ?>>23</option>
				<option value='24' <?php if (date('d') == '24') echo "SELECTED" ?>>24</option>
				<option value='25' <?php if (date('d') == '25') echo "SELECTED" ?>>25</option>
				<option value='26' <?php if (date('d') == '26') echo "SELECTED" ?>>26</option>
				<option value='27' <?php if (date('d') == '27') echo "SELECTED" ?>>27</option>
				<option value='28' <?php if (date('d') == '28') echo "SELECTED" ?>>28</option>

			</SELECT>
			<SELECT name='mesdepago' >
				<option value='01' <?php if (date('m') == '01') echo "SELECTED" ?> >ENERO</option>
				<option value='02' <?php if (date('m') == '02') echo "SELECTED" ?>>FEBRERO</option>
				<option value='03' <?php if (date('m') == '03') echo "SELECTED" ?>>MARZO</option>
				<option value='04' <?php if (date('m') == '04') echo "SELECTED" ?>>ABRIL</option>
				<option value='05' <?php if (date('m') == '05') echo "SELECTED" ?>>MAYO</option>
				<option value='06' <?php if (date('m') == '06') echo "SELECTED" ?>>JUNIO</option>
				<option value='07' <?php if (date('m') == '07') echo "SELECTED" ?>>JULIO</option>
				<option value='08' <?php if (date('m') == '08') echo "SELECTED" ?>>AGOSTO</option>
				<option value='09' <?php if (date('m') == '09') echo "SELECTED" ?>>SEPTIEMBRE</option>
				<option value='10' <?php if (date('m') == '10') echo "SELECTED" ?>>OCTUBRE</option>
				<option value='11' <?php if (date('m') == '11') echo "SELECTED" ?>>NOVIEMBRE</option>
				<option value='12' <?php if (date('m') == '12') echo "SELECTED" ?>>DICIEMBRE</option>
			</SELECT>
			<SELECT name='aniodepago' >
			<?php
				$k=0;
				for($k=2012; $k<= 2020; $k++)
				{
					
					echo "<option value='".$k."'>".$k."</option>";
				
				}
			
			
			
			?>
			</SELECT>
		</td>
		</tr>
		</table>
		
	</fieldset>
</td>
	
<td valign='top'>

	<label id='subtitulo'> Datos Cliente</label>
	<p/>
	
	<fieldset>
		
		<table border='0' cellspacing='5' cellpadding='5' width='500'>
		<tr>
		<td id='etiqueta' valign='top' width='100'>
			Nombre Cliente
		</td>
		<td>
			<a  href="buscarclientefact.php" target="popup"  onClick="window.open(this.href, this.target, 'width=500,height=400'); return false;"><img src='images/binoculares.gif' border='0'></a>
			<br/>
			<input type='text' name='nrut' value='' size='20' readonly ='readonly'>
			<br/>
			<input type='text' name='nnombre' value='' size='60' readonly ='readonly'>
			
		</td>
		</tr>
		</table>
		
		
	</fieldset>
	
	<p/>

	<label id='subtitulo'> Boleta/Factura </label>
	<p/>
			
<?php	

	
	echo "<table border='0'>";
	
	$subtotalfila =0;
	$subtotalcolumna =0;
	
	$j=0;
	WHILE ($j < $listado)
	{
		$subcadena        	= explode("|",$cadena[$j]);
		$codigo             = $subcadena[0];
		$cantidadproducto 	= $subcadena[2];
		$valorproducto   	= $subcadena[3];
		$microcadena     	= explode(" ",$valorproducto);
		$preciounitario  	= $microcadena[2];
		
		$subtotalfila    	= $preciounitario * $cantidadproducto;
		$subtotalcolumna 	= $subtotalcolumna  + $subtotalfila;
		
		$ivaporciento       = round((($iva + 100)/100),2);
		
		$calcularIVA     	= round(($subtotalcolumna * $iva) / 100,0);
		$TOTAL          	 = round(($subtotalcolumna * $ivaporciento),0);
		
		$search = "SELECT cbarra_pro, nombre_pro FROM tbk_producto WHERE cbarra_pro ='".$codigo."'";
		$res1 = mysql_query($search, $conn);
		
		$ficha = mysql_fetch_row($res1);
		
		$nombreproducto = $ficha[1];
			
		
		echo "	<tr><td><input type='hidden' name='codigo[]' value='".$codigo."'></td><td id='data'><SELECT name='despacho[]'><option value='2'>Gu&iacute;a</option><option value='1'>Inmediato</option></SELECT><td id='data'><input type='text' name='producto[]' value='".$nombreproducto."' readonly ='readonly' /></td><td id='data'><input type='text' name='cantidad[]' value='".$cantidadproducto."' size='4'  readonly ='readonly' /></td><td id='data'><input type='text' name='valor[]' value='".$preciounitario."' size='8' readonly ='readonly' /></td><td id='data'><input type='text0 name='subt[]' value='".$subtotalfila."' readonly ='readonly'></label></td></tr>";
		$j++;
	}
	
	echo "<tr><td/><td/><td/><td/><td id='etiqueta' align='center'> NETO </td><td id='data'><input type='text' class='num' name='subtotal' value='".$subtotalcolumna."'  size='10'  readonly ='readonly'/></td></tr>";
	echo "<tr><td/><td/><td/><td/><td id='etiqueta' align='center'> IVA</td><td id='data'><input type='text' class='num' name='iva' value='".$calcularIVA."'  size='10' readonly ='readonly' /></td></tr>";
	echo "<tr><td/><td/><td/><td/><td id='etiqueta' align='center'> TOTAL </td><td id='data'><input type='text' class='num' name='total' value='".$TOTAL."'  size='10' readonly ='readonly' /></td></tr>";
	echo "</table>";
	
?>
	<p/>
	
	<table border='0' width='540'>
	<tr>
	<td align='right'>
		
		<input type='hidden' name='ff' value='<?=$factura?>'>
		<input type='hidden' name='bb' value='<?=$boleta?>'>
		
		<input type='hidden' name='lista' value='<?=$lista?>'>
		<input type='button' value='Editar Boleta' onClick='document.boleta.action = "caja.php"; submit();'>
		<input type='submit' value='Aceptar'>
	</td>
	</tr>
	</table>
	
	
	</form>

</td>
</tr>
</table>
<?php include("footer.php")?>
