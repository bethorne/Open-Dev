<?php include("header.php");?>

	<form action ="privilegios_update.php" method="POST">
	<table border="0" width="880" >
	<tr>
	<td  align="center" valign='top' >
			
			
			<?php

				//listar  asignaciones, junto con sus diferentes estados para este vendedor

				$consulta = "SELECT * FROM tbk_user WHERE 1";
				$resultado = mysql_query($consulta, $conn);

				$a=0;
				
				echo "<p/><br/><label id='subtitulo'> :: Tabla de Permisos de Usuario</label><p/>\n";
			
				echo "<table border='0'  bgcolor='#ffffff' cellspacing='5' cellpadding='5' >\n";
				echo "<th id='etiqueta'>id</th><th id='etiqueta'>R.U.T.</th><th id='etiqueta'>Nombre</th><th id='etiqueta'>Ap. Paterno</th><th id='etiqueta'>Ap. Materno</th><th id='etiqueta'>Administrador</th><th id='etiqueta'>Caja</th><th id='etiqueta'>Bodega</th><th id='etiqueta'>Vendedor</th>\n";
				echo "<tr></tr>\n";

				
				While ($registro = mysql_fetch_row($resultado))
				{
					$transid 	= $registro[0];
					$campo1 	= $registro[1];
					$campo2 	= $registro[2];
					$campo3 	= $registro[3];
					$campo4 	= $registro[4];
					$campo5 	= $registro[5];
					$campo6     = $registro[6];
					$campo7     = $registro[7];
					$campo8		= $registro[8];




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
					

					// buscar datos de transaccion
					$consultaTrans = "SELECT *  FROM tbk_perfil_usuario WHERE id_bk = ".$transid;
					$resultadoseek = mysql_query($consultaTrans, $conn);


					$perfilusuario="";
					$b=0;
					WHILE ($regseek = mysql_fetch_row($resultadoseek))
					{
							
							$perfilusuario.= $regseek[1].",";
					
						$b++;

					}

					//echo "PERFILES $transid= ".$perfilusuario;
					echo "<td align='center'>";
								echo "<input type='checkbox' name='p".$transid."1' value='1'";
								if (ereg("1",$perfilusuario)) echo "CHECKED";
								echo " style='background:#ff0000'>";
					echo "</td>";

					echo "<td  align='center'>";
								echo "<input type='checkbox' name='p".$transid."2' value='2'";
								if (ereg("2",$perfilusuario)) echo "CHECKED";
								echo ">";
					echo "</td>";

					echo "<td  align='center'>";
								echo "<input type='checkbox' name='p".$transid."3' value='3'";
								if (ereg("3",$perfilusuario)) echo "CHECKED";
								echo ">";
					echo "</td>";
					echo "<td  align='center'>";
								echo "<input type='checkbox' name='p".$transid."4' value='4'";
								if (ereg("4",$perfilusuario)) echo "CHECKED";
								echo ">";
					echo "</td>";

					echo "</tr>\n";
					$a++;
				}

				echo "</table>\n";
		?>	

				



	</td>
	</tr>
	
	</table>

	<table border='0' width='600'>
	<tr>
	<td align='right'>
		
				

		<?php


			echo "<table border='0'  cellpadding='5' cellspacing='5'>\n";
			echo "<tr>\n";
			echo "<td><input type='hidden' name='cid' value='".$campo1."'></td>";
			echo "<td >\n";
			echo "	<input type='RESET' value='Limpiar'>";
			echo "</td>\n";
			echo "<td >\n";
			echo "<input type='SUBMIT' value='Actualizar Cambios' >";
			echo "</td>\n";
			echo "</tr>\n";
			echo "</table>\n";

		?>


	</td>
	</tr>
	</table>


	</form>

<?php include("footer.php");?>

			