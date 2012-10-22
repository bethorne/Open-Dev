<?php include("header-micro.php")


?>


<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />

<table width="1151" border="0" background='images/logos/fondo_menu.jpg'>
  <tr>
    <td width="232">&nbsp;</td>
    <td width="272">&nbsp;</td>
    <td width="2">&nbsp;</td>
    <td width="36">&nbsp;</td>
    <td width="36">&nbsp;</td>
    <td width="59">&nbsp;</td>
    <td width="247">&nbsp;</td>
    <td width="120">&nbsp;</td>
    <td width="41">&nbsp;</td>
    <td width="9">&nbsp;</td>
    <td width="27">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="6" align="center" id='subtitulo'><p>REGISTRO DE KILOMETRAJE DE VEHICULOS</p>
    <p>&nbsp;</p></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td id='comentario'>CONDUCTOR VEHICULO</td>
    <td id='data'><input type='text' name='nnombre' size='50' value="Ruperto Bugueño Plaza"><br/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td id='comentario'>MES</td>
    <td id='data'><input type='text' name='nnombre2' size='12' value="MAYO" ></td>
    <td id ='etiqueta' rowspan='2' valign='top' align='center'>CONTROL N&deg;
   <input type='text' name='nnombre4' size='12' value="00582" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td id='comentario'>A&Ntilde;O</td>
    <td id='data'><input type='text' name='nnombre3' size='12' value="2012" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td id='comentario'>ESTANQUE TOTAL</td>
    <td id='data'><input type='text' name='nnombre' size='50' value="100 LTS"><br/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td id='comentario'>PRECIO LITRO CONBUSTIBLE</td>
    <td id='data'><input type='text' name='nnombre' size='50' value="800"><br/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td id='comentario'>PRECIO POR KILOMETRO</td>
    <td id='data'><input type='text' name='nnombre' size='50' value="70"><br/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="1181" height="46" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><img width="50" height="50" src="images/icono-reloj.gif"
   /></td>
    <td><img width="50" height="50" src="images/icono-reloj.gif"
 /></td>
    <td><span ><img width="50" height="50" src="images/icono-reloj.gif"
    /></span></td>
    <td><img width="58" height="58" src="images/odo.jpg"
  /></td>
    <td><img width="57" height="58" src="images/odo.jpg"
 /></td>
    <td><img width="57" height="57" src="images/odo.jpg"
   /></td>
    <td><img width="56" height="78" src="images/image004.png"
   /></td>
    <td><img width="74" height="76" src="images/icono_signo_pesos.jpg"
   /></td>
  </tr>
  <tr>
    <td id='etiqueta'>FECHA </td>
    <td id='etiqueta'>DESDE</td>
    <td id='etiqueta'>HACIA</td>
    <td id='etiqueta' >MOTIVO</td>
    <td id='etiqueta'>HORA SALIDA</td>
    <td id='etiqueta'>HORA LLEGADA</td>
    <td id='etiqueta'>TOTAL TIEMPO</td>
    <td id='etiqueta'>KM INICIAL</td>
    <td id='etiqueta'>KM FINAL</td>
    <td id='etiqueta'>TOTAL KM</td>
    <td id='etiqueta'>TOTAL COMBUSTIBLE</td>
    <td id='etiqueta'>PRECIO TOTAL</td>
  </tr>
  <tr>
    <td><input type='text' name='fcidpro<?=$p?>' size="12"  ></td>
    <td><input type='text' name='fcidpro<?=$p?>' size="12" ></td>
    <td><input type='text' name='fcidpro<?=$p?>' size="12"></td>
    <td><input type='text' name='fcidpro<?=$p?>'  ></td>
    <td><input type='text' name='fcidpro<?=$p?>' size="12" ></td>
    <td><input type='text' name='fcidpro<?=$p?>' size="12"></td>
    <td><input type='text' name='fcidpro<?=$p?>'  size="12"></td>
    <td><input type='text' name='fcidpro<?=$p?>'  size="12"></td>
    <td><input type='text' name='fcidpro<?=$p?>' size="12"></td>
    <td><input type='text' name='fcidpro<?=$p?>' size="12" ></td>
    <td><input type='text' name='fcidpro<?=$p?>' size="12"></td>
    <td><input type='text' name='fcidpro<?=$p?>' size="12"></td>
  </tr>
</table>
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
