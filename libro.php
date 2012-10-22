<?php echo " <table border='0'>
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
				<table border='0' cellspacing='5' cellpadding='5' width='450' >
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
							
							$snnombre = $snombre.' '.$spaterno.' '.$smaterno;
							
							$sdirecciontotal = $sdireccion.' '.$scomuna;
							
<tr><td id='data' width='20'><a id='menualternativo' href='editarcliente.php?cb='.$srut.''><img src='images/flechita.gif' border='0'></a></td><td id='data' width='130'><a id='etiquetazul' href='buscarcliente.php?cb='.$srut.''>'.$srut.'</a></td><td id='data'>'.$snombre.'</td><td id='data'>'.$spaterno.' '.substr($smaterno,0,1).'</td></tr>;
							$i++;
						}
					}
					else
					{
						<tr><td id='etiqueta'>Recuerde colocar s&oacute;lo letras y n&uacute;meros</td></tr>;
					}
				
				
				?>
				
					</table>
			
			</fieldset>
			
			<p/>
			
			
	</td>
		</tr>
	</table>";