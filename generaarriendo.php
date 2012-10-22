<?php include("header-micro.php")?>


<?php
	
	include("functions.php");


	$lista 			= $_POST['lista'];  	  	    // lista de compras
	$IDcliente		= $_POST['IDcliente'];  	   // Cliente
	$listadoguias 	= $_POST['listadoguias']; 	  // genera factura a partir de estas guias de venta
	$IDguias	 	= $_POST['IDguias'];	     // codigos secundarios de guias 	
	
	$tp 			= $_POST['tp'];			   // forma de pago EFECTIVO / CONTADO
	$tipodevale 	= $_POST['tipodevale'];	  // el documento es boleta ? guia? factura? (para efectos del  IVA)
	$desc			= $_POST['desc'];        // Descuento

	
	if ($listadoguias != '') $obsguias 	= "Facturaci&oacute;n de las siguientes guías ".$IDguias;
	
	//echo nl2br($lista);
	$cadena = explode("\n",$lista);
	$listado = count($cadena);
	
	//busca datos de cliente
	$searchcodigo = "SELECT * FROM tbk_cliente WHERE  rut_cli= '".$IDcliente."'";
	//echo "<p>".$searchcodigo;
	$resultadocodigo = mysql_query($searchcodigo, $conn);
	
	$rowcli = mysql_fetch_row($resultadocodigo);
	
	//datos de cliente
	
	$docnombre = $rowcli[1]." ".$rowcli[2]." ".$rowcli[3];
	$docdireccion = $rowcli[4]." - ".$rowcli[5];
	

	
	
		
	echo "<form name='boleta' action='guardadocumentoarriendo.php' method='POST'>\n";
	
?>
	
	
<table border='0' width='800'>
<tr>
<td valign='top' align ='center'>


	<p/>

	<label id='subtitulo'> ORDEN DE ARRIENDO</label>
	<p/>
	

	
	<table border='0' width='610' cellspacing='5' cellpadding='5'>
	<tr>
	<td id ='data' width='200'>
		<?php include("fichaempresa.php");?>
		<b><?=$Empresanombre?></b>
		<br/>
		<?=$Empresaencabezadomini?> 
	</td>
	<td id ='data' align='right' >
		Fecha de Emision :<b><?=date('d-m-Y')?> </b>
		<br/>
		SALAMANCA
	</td>
	</tr>
	<tr>
		<td id ='etiqueta' >	Cliente </td> <td id='data'><?=$IDcliente." ".$docnombre?> </td>
	</tr>
	<tr>
		<td id ='etiqueta' >	Direcci&oacute;n </td> <td id='data'> <?=$docdireccion?></td>
	</tr>
	<tr>
		 <td id ='etiqueta' >	Vendedor </td><td id='data' > <?=$nombreUsuario?></td>
	</tr>

	</table>
	
	<br/>
	
	<table border='0' width='610' cellspacing='5' cellpadding='5'>
	<tr>
	<td id ='data' colspan='5'>
		NOTA: La <b>ORDEN DE ARRIENDO</b> BDIBUI <b><i>DBHSUJSADASFDSFSDFDSSLDK</i></b>, REWREWREWRWFSFSDEDSFSD <b><i>FDSFDSFDSF DSFEFDS</i></b>.
	</td>
	</tr>
	</table>
<?php	


	echo "<p/>";
	echo "<table border='0' width='600' cellspacing='2' cellpadding='2'>";
	echo "<tr>";
	echo "<th/><th id='etiqueta'> Producto </th>";
	echo "<th id='etiqueta'> Cantidad </th>";
	echo "<th id='etiqueta'> Despacho </th>";
	echo "<th id='etiqueta'> Precio  </th>";
	echo "<th id='etiqueta'> Total </th>";
	echo "</tr>";
	
	
	$subtotalfila =0;
	$subtotalcolumna =0;
	
	$j=0;
	WHILE ($j < $listado)
	{
		$subcadena        	= explode("|",$cadena[$j]);
		$codigo             = $subcadena[1];
		if ($codigo != '')
		{	
			$cantidadproducto 	= $subcadena[3];
			$valorproducto   	= $subcadena[4];
			$microcadena     	= explode(" ",$valorproducto);
			$preciounitario  	= $microcadena[1];
		
			$subtotalfila    	= $preciounitario * $cantidadproducto;
			$subtotalcolumna 	= $subtotalcolumna  + $subtotalfila;
		
			$ivaporciento       = round((($iva + 100)/100),2);
		
			$calcularIVA     	= round(($subtotalcolumna * $iva) / 100,0);
			if ($desc  > 0)
			{
				$SUBTOTAL          	= round(($subtotalcolumna ),0);
				$factordescuento 	= round((100 - $desc)/100,2);
			
				$TOTAL  			= round($SUBTOTAL * $factordescuento,0);
			
		
			}
			else
			{
				$TOTAL          	= round(($subtotalcolumna ),0);
			}
		
		
		
		

		
			$nombreproducto = nombreprod($codigo);
			
		
			echo "	<tr><td><input type='hidden' name='codigo[]' value='".$codigo."'></td><td id='data'><input type='text' name='producto[]' value='".$nombreproducto."' readonly ='readonly' /></td><td id='data'><input type='text' name='cantidad[]' value='".$cantidadproducto."' size='4'  readonly ='readonly' /></td><td id='etiqueta'>";
			if ($obsguias =='')
			{
				echo "  <input type='text' name='pdespacho[]' value='0' size='4' ></td>";
			}
			else
				{
					echo "  <input type='text' name='pdespacho[]' value='".$cantidadproducto."' size='4'  readonly = 'readonly'></td>";
				}
			echo "  <td id='data'>$<input type='text' name='valor[]' value='".$preciounitario."' size='8' readonly ='readonly' /></td><td id='data' align='right'> $ <input type='text' name='subt[]' value='".$subtotalfila."' readonly ='readonly'></label></td></tr>";
		
		
		}	
		$j++;
	
	}
	
	//echo "<tr><td/><td/><td/><td/><td id='etiqueta' align='center'> NETO </td><td id='data' align='right'><input type='text' class='num' name='subtotal' value='".$subtotalcolumna."'  size='10'  readonly ='readonly'/></td></tr>";
	//echo "<tr><td/><td/><td/><td/><td id='etiqueta' align='center'> IVA</td><td id='data' align='right'><input type='text' class='num' name='iva' value='".$calcularIVA."'  size='10' readonly ='readonly' /></td></tr>";
	
	if ($desc > 0)
	{
		//echo "<tr><td/><td/><td/><td/><td id='etiqueta' align='center'> SUBTOTAL </td><td id='data' align='right'><input type='text' class='num' name='subtotal' value='".$SUBTOTAL."'  size='10' readonly ='readonly' /></td></tr>";
		echo "<tr><td/><td/><td/><td/><td id='etiqueta' align='center'> DESCUENTO </td><td id='data' align='right'><input type='text' class='num' name='desc' value='".$desc."%'  size='10' readonly ='readonly' /></td></tr>";
		echo "<tr><td/><td/><td/><td/><td id='etiqueta' align='center'> TOTAL </td><td id='data' align='right'><input type='text' class='num' name='total' value='".$TOTAL."'  size='10' readonly ='readonly' /></td></tr>";
	}
	else
	{
		//echo "<tr><td/><td/><td/><td/><td id='etiqueta' align='center'> SUBTOTAL </td><td id='data' align='right'><input type='text' class='num' name='subtotal' value='".$TOTAL."'  size='10' readonly ='readonly' /></td></tr>";
		echo "<tr><td/><td/><td/><td/><td id='etiqueta' align='center'> TOTAL </td><td id='data' align='right'><input type='text' class='num' name='total' value='".$TOTAL."'  size='10' readonly ='readonly' /></td></tr>";
	}
	
	echo "<tr><td/><td id='etiqueta'> Observaci&oacute;n </td><td id='data'   colspan='4'> <textarea name='obs' cols='60' rows='3'>".$obsguias."</textarea></td>";
	 
	echo "</table>";
	
?>
	<p/>
	
	<table border='0' width='600'>
	<tr>
	<td align='right'>
		

		<input type='hidden' name='listadoguias' value='<?=$listadoguias?>'>
		<input type='hidden' name='lista' value='<?=$lista?>'>
		<input type='hidden' name='IDcliente' value='<?=$IDcliente?>'>
		<input type='hidden' name='vendedor' value='<?=$nombreUsuario?>'>
		<input type='hidden' name='tp' value='<?=$tp?>'>

		
		
		<input type='button' value='Editar Arriendo' onClick='document.boleta.action = "cajaarriendo.php?IDcliente=<?=$IDcliente?>&tp=<?=$tp?>"; submit();'>
		<input type='submit' value='Aceptar'>
	</td>
	</tr>
	</table>
	
	
	</form>
	
</td>
</tr>
</table>
<?php include("footer.php")?>
