<?php include("header.php");?>

	<table border="0" width="880"  >
	<tr>
	<td  align="center" valign='top' >
			
			
			<?php

				//listar  asignaciones, junto con sus diferentes estados para este vendedor

				$consulta = "SELECT * FROM tbk_user WHERE 1";
				$resultado = mysql_query($consulta, $conn);

				$a=0;
				
				echo "<p/><br/><label id='subtitulo'> :: Tabla de Administraci&oacute;n de Usuarios</label><p/>\n";

			
				echo "<table border='0'  bgcolor='#ffffff' cellspacing='5' cellpadding='5' >\n";
				echo "<th id='etiqueta'>id</th><th id='etiqueta'>R.U.T.</th><th id='etiqueta'>Nombre</th><th id='etiqueta'>Ap. Paterno</th><th id='etiqueta'>Ap. Materno</th><th id='etiqueta'>Sexo</th><th id='etiqueta'>Contacto</th><th id='etiqueta'>Contrase&ntilde;a</th><th id='etiqueta' colspan='2' align='left'>Perfiles</th>\n";
				echo "<tr></tr>\n";

				
				While ($registro = mysql_fetch_row($resultado))
				{
					$transid 	= $registro[0];
					$campo1 	= $registro[1];
					$campo2 	= $registro[2];
					$campo3 	= $registro[3];
					$campo4 	= $registro[4];
					$campo5 	= $registro[5];
					$campo6       = $registro[6];
					$campo7       = $registro[7];
					$campo8	= $registro[8];




					echo "<tr>\n";
					echo "<td id='data' align='center' style='border:solid 1px #eeeeee' >";

					echo 	$transid;
				
					echo "</td>";
					echo "<td id='data'>";
					echo 		$campo1;
					echo "</td>";
					echo "<td id='data'>";
					echo 		$campo2;
					echo "</td>";
					echo "<td id='data'>";
					echo 		$campo3;
					echo "</td>";
					echo "<td id='data'>";
					echo 		$campo4;
					echo "</td>";
					echo "<td id='data'>";
					echo 		$campo5;
					echo "</td>";
					echo "<td id='data'>";
					echo 		$campo6;
					echo "</td>";



					echo "<td align='center' ><a id='menualternativo' href='cambiopass.php?pid=".$transid."&urut=".$campo1."'><b>CAMBIAR</b></a></td>";
					echo "<td align='center'><a id='menualternativo'  href='datosusuario.php?pid=".$transid."'><b>EDITAR FICHA</b></a></td>";
					echo "<td align='center'><a id='menualternativo'  href='procesa_orden.php?ax=32&cid=".$transid."&urut=".$campo1."&nu=".$campo2." ".$campo3." ".$campo4." '><b>ELIMINAR</b></a></td>";
					//echo "<td align='center'><a href=''>Privilegios</a></td>";

					echo "</tr>\n";
					$a++;
				}

				echo "</table>\n";
		?>	

				



	</td>
	</tr>
	</table>

<?php include("footer.php");?>

			