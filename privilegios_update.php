<?php include("header.php");?>


	<table border="0" width="880" >
	<tr>
	<td  align="center" valign='top' >
			
			
			<?php

				//listar  asignaciones, junto con sus diferentes estados para este vendedor

				$consulta = "SELECT * FROM tbk_user WHERE 1";
				$resultado = mysql_query($consulta, $conn);

				$a=0;
				
				echo "<p/><label id='subtitulo'> :: Tabla de Perfiles de Usuario</label><p/>\n";
			
				echo "<table border='0'  bgcolor='#ffffff' cellspacing='5' cellpadding='5' >\n";
				echo "<th>id</th><th>R.U.T.</th><th>Nombre</th><th>Ap. Paterno</th><th>Ap. Materno</th><th>Administrador</th><th>Redactor</th>\n";
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


					//echo "PERFILES $transid= ".$perfilusuario;
					echo "<td align='center' id='data'>";
						$cadena = "p".$transid."1";

						if (!empty($_POST[$cadena]))
						{
							$insertar = "INSERT INTO tbk_perfil_usuario VALUES('".$transid."','1')";
							//echo $insertar;
							if (mysql_query($insertar, $conn)) echo "1";

						}
						else
						{
							$eliminar = "DELETE FROM tbk_perfil_usuario WHERE id_bk =".$transid." AND id_per =1";
							if (mysql_query($eliminar, $conn)) echo "0";
						}

								
					echo "</td>";

					echo "<td  align='center' id='data'>";
						$cadena = "p".$transid."2";

						if (!empty($_POST[$cadena]))
						{
							$insertar = "INSERT INTO tbk_perfil_usuario VALUES('".$transid."','2')";
							//echo $insertar;
							if (mysql_query($insertar, $conn)) echo "1";

						}
						else
						{
							$eliminar = "DELETE FROM tbk_perfil_usuario WHERE id_bk =".$transid." AND id_per = 2";
							if (mysql_query($eliminar, $conn)) echo "0";
						}

					echo "</td>";
					

					echo "<td  align='center' id='data'>";
						$cadena = "p".$transid."3";

						if (!empty($_POST[$cadena]))
						{
							$insertar = "INSERT INTO tbk_perfil_usuario VALUES('".$transid."','3')";
							//echo $insertar;
							if (mysql_query($insertar, $conn)) echo "1";

						}
						else
						{
							$eliminar = "DELETE FROM tbk_perfil_usuario WHERE id_bk =".$transid." AND id_per =3";
							if (mysql_query($eliminar, $conn)) echo "0";
						}

					echo "</td>";
					
					echo "<td  align='center' id='data'>";
						$cadena = "p".$transid."4";

						if (!empty($_POST[$cadena]))
						{
							$insertar = "INSERT INTO tbk_perfil_usuario VALUES('".$transid."','4')";
							//echo $insertar;
							if (mysql_query($insertar, $conn)) echo "1";

						}
						else
						{
							$eliminar = "DELETE FROM tbk_perfil_usuario WHERE id_bk =".$transid." AND id_per =4";
							if (mysql_query($eliminar, $conn)) echo "0";
						}

					echo "</td>";
					echo "</tr>\n";

					
					$a++;
				}

				echo "</tr>";
				echo "<td/>";
				echo "<td id='data' colspan='6'>";
					echo "<b>0:</b> Perfil Eliminado <b>1:</b> Perfil Asignado";
				echo "</td>";
				echo "</tr>";
				echo "</table>\n";
		?>	

				



	</td>
	</tr>
	
	</table>

	<form action ="privilegios.php" method="POST">
	<table border='0' width='600'>
	<tr>
	<td align='right'>
		
				

		<?php


			echo "<table border='0'  cellpadding='5' cellspacing='5'>\n";
			echo "<tr>\n";
			echo "<td >\n";
			echo "<input type='SUBMIT' value='Continuar' >";
			echo "</td>\n";
			echo "</tr>\n";
			echo "</table>\n";

		?>


	</td>
	</tr>
	</table>


	</form>

<?php include("footer.php");?>

			