<?php include("header-micro.php")?>
<script type="text/javascript">
function tabular(e,obj)  
{ 
  tecla=(document.all) ? e.keyCode : e.which; 
            if(tecla!=13) return; 
            frm=obj.form; 
            for(i=0;i<frm.elements.length;i++)  
                if(frm.elements[i]==obj)  
                {  
                    if (i==frm.elements.length-1)  
                        i=-1; 
                    break  
                } 
    /*ACA ESTA EL CAMBIO disabled, Y PARA SALTEAR CAMPOS HIDDEN*/ 
            if ((frm.elements[i+1].disabled ==true) || (frm.elements[i+1].type=='hidden') )     
                tabular(e,frm.elements[i+1]); 
/*ACA ESTA EL CAMBIO readOnly */ 
            else if (frm.elements[i+1].readOnly ==true )     
                tabular(e,frm.elements[i+1]); 
            else { 
                if (frm.elements[i+1].type=='text') /*VALIDA SI EL CAMPO ES TEXTO*/ 
                { frm.elements[i+1].select(); };   /* AÑADIR LOS CORCHETES Y ESTA INSTRUCCION */ 
                frm.elements[i+1].focus(); 
            } 
            return false;  
}  
</script>

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

	<br/><p/>
	
	<form name='boleta' action='cajacompra.php' method='POST' >

	<label id='subtitulo'> Documento de Compra</label>
	<p/>
			


	
	<table border='0' cellspacing='5' cellpadding='5'  width='850' >
	<tr>
	<td>
		
		<table border='0' background='images/logos/fondo_menu.jpg'>
		<tr>	
			<tr>
			<td colspan='2'>
			
					<table border='0'width='850'>
					<tr>
					<td  width='170'>
						<label id='comentario'>RUT</label>
					</td>
					<td id='data'>
						<table border='0'><tr><td><input type='text' name='nrut' size='14' onkeypress="return tabular(event,this)"></td> <td> <a href="buscarproveedorfact.php" target="popup"  onClick="window.open(this.href, this.target, 'width=600,height=700'); return false;" onkeypress="return tabular(event,this)"><img src='images/buscarcliente.png' border='0'></a></td></tr></table>
					</td>
					<td id ='etiqueta' rowspan='5' valign='top' align='center'>
						<br/><p/>
						<font face='arial, times' size='4' color='#ffffff'> N° Documento</font> <p/>
						<input type='text' class='num' name='IDfactura' value='' size='10' onkeypress="return tabular(event,this)">
					</td>
					</tr>
					
					<tr>
					<td  >
						<label id='comentario'>NOMBRE</label>
					</td>
					<td id='data'>
						<input type='text' name='nnombre' size='50' onkeypress="return tabular(event,this)"><br/>

					</td>
					</tr>
					
					<tr>
					<td  >
						<label id='comentario'>FECHA</label>
					</td>
					<td id='data' >
						<input type='text' name='fcfecha' value='<?=date('d-m-Y')?>' size='12' onkeypress="return tabular(event,this)">
					</td>
					</tr>

					<tr>
					<td >
						<label id='comentario'>DIRECCION</label>

					</td>
					<td  id='data' >
						<input type='text' name='fcdireccion' value='' size='50' onkeypress="return tabular(event,this)">
					</td>
					</tr>
					
					<tr>
					<td>
						<label id='comentario'>ACTIVIDAD ECONOMICA</label>
					</td>
					<td  id='data' >
						<input type='text' name='fcgiro' value='<?=$ccodigorubro?>' size='50' onkeypress="return tabular(event,this)">
					</td>
					</tr>
					</table>
			
			</td>
			</tr>
			</table>
	</td>
	</tr>
	
	
	<tr>
	<td colspan='2'>
			<table border='0' cellspacing='5' cellpadding='5' width='850'>
			<tr>
			<td id='etiqueta'  width='160'> TIPO DE DOCUMENTO </td>
			<td id='data'> 
				<SELECT name='fctipodoc' onkeypress="return tabular(event,this)">
								
				<option value='3'> FACTURA</option>
				<option value='2'> GU&Iacute;A</option>
				<option value='1'> BOLETA</option>
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
					
					<th id='etiqueta' WIDTH='170'> NOMBRE</th>
					<th id='etiqueta' WIDTH='5'> CANTIDAD</th>
					<th id='etiqueta' WIDTH='10'> INGRESO</th>
					<th id='etiqueta' WIDTH='100'> $ UNIDAD</th>
                    <th id='etiqueta' WIDTH='20'>DESC1%</th>
                    <th id='etiqueta' WIDTH='20'>DESC2%</th>
                    <th id='etiqueta' WIDTH='20'>DESC3%</th>						
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
					<input type='hidden' name='fcidpro<?=$p?>' size='3' readonly='readonly' >
					<input type='hidden'  name='fccbarras<?=$p?>' size='17' readonly='readonly'>
				</td>
				<td id='data'>
					<!-- <a href='elegirproducto.php' id='menublanco' target="popup"  onClick="window.open(this.href, this.target, 'width=600,height=400'); return false;"><img src='images/binoculares.gif'></a> -->
					<a href='elegirproductocompra.php?pos=<?=$p?>' id='menublanco' target="popup"  onClick="window.open(this.href, this.target, 'width=600,height=400'); return false;"><img src='images/binoculares.gif'></a>
				</td>
                
				<td id='data'>
					<input type='text' name='fcnombrespro<?=$p?>' size='17' onkeypress="return tabular(event,this)">
				</td>
				<td id='data'>
					<input type='text' name='fccantidadpro<?=$p?>' value='' size='3' onkeypress="return tabular(event,this)">
				</td>
				<td id='etiqueta'>
					<input type='text' name='fcdespachopro<?=$p?>' value='1' size='3' onkeypress="return tabular(event,this)">
				</td>
              
				<td id='data'>
					$
				</td>
				<td id='data'>
					<input type='text' name='fcprecio<?=$p?>'  value='' size='12' onkeypress="return tabular(event,this)">
				</td>
                  <td id='data'>
					<input type='text' name='descuen1<?=$p?>' value='' size='3' onkeypress="return tabular(event,this)">
				</td>
                <td id='data'>
					<input type='text' name='descuen2<?=$p?>' value='' size='3' onkeypress="return tabular(event,this)">
				</td>
                <td id='data'>
					<input type='text' name='descuen3<?=$p?>' value='' size='3' onkeypress="return tabular(event,this)">
				</td>
				<td id='data'>
					$
				</td>
				<td id='etiqueta'>
					<input type='button' name='b<?=$p?>' value='=' onClick='multiplica("<?=$p?>")' >
					
				</td>
				<td id='data'>
					<input type='text' name='fccolumna<?=$p?>' value='0' size='12' onkeypress="return tabular(event,this)" disabled="disabled">
				</td>
				<td>
					<SELECT name='fcestado<?=$p?>' >
					<option value='0'> Recepcionado</option>
					<option value='1'> Rechazado</option>
				
					</SELECT>
				</td>
				<td>
					<input type='button' value='x' onClick ='boleta.fccbarras<?=$p?>.value=""; boleta.fcnombrespro<?=$p?>.value=""; boleta.fccantidadpro<?=$p?>.value="";boleta.fcprecio<?=$p?>.value=""; boleta.fccolumna<?=$p?>.value=""'>
				</td>
				</tr>
				
				</table>
		
		<?php
		
				}
		?>
		
				<p/>
				<table border='0' width='830' >
				<tr>
				<td id='etiqueta'>
					Observaciones
				</td>
				</tr>
				
				<tr>
				<td align='right'>
					<textarea name='fcobs' cols='137' rows='4'></textarea>
				</td>
				</tr>
				</table>
				
				<p/>
				
				<table border='0' width='850'>
				<tr>
				<td align='right'>
					<font face='arial, times' size='7'><b> TOTALES</b></font>
					<br/>
					<font face='arial, times' size='2'>del Documento de Compra </font>
				</td>
				<td align='right'>
					<br/>
					<p/>
					
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

	<table border='0' width='870'>
	<tr>
	<td align='right' >
			<table border='0' cellspacing='5' cellpadding='5' >
					<tr>
					<td id='data' valign='bottom' align='center'>
							<a  id='menualternativo' href='home.php'><img src="images/logos/cancelar0.jpg" onmouseover="this.src = 'images/logos/cancelar1.jpg'" onmouseout="this.src = 'images/logos/cancelar0.jpg'" border="0"></img></a><br/>
					</td>
					<td id='data' valign='bottom'  align='center'>
							<a id='menu' href='#'  onCLick='submit()'><img src="images/logos/aceptar0.jpg" onmouseover="this.src = 'images/logos/aceptar1.jpg'" onmouseout="this.src = 'images/logos/aceptar0.jpg'" border="0"></img></a>
					</td>

					</tr>
			</table>
			<input type='hidden' name='usuario' value='<?=$rutUsuario?>'>
	</td>
	</tr>
	</table>

	
	</form>

</td>
</tr>
</table>
</center>

<?php include("footer.php")?>