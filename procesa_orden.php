<?php include("header.php");?>

	<table border="0" width="780" height="450" >
	<tr>
	<td  align="center" >

		<?php
			$ax = $_GET[ax];

			// recopilando informacion
				
			$nombresf	= $_POST['nombres'];
			$paternof	= $_POST['paterno'];
			$maternof	= $_POST['materno'];
			$sexof  	= $_POST['sexo'];
			$contactof	= $_POST['email'];
			
			$gcid = $_GET['cid'];
		
			$gtid 	= $_GET['tid'];
			$grut 	= $_GET['urut'];
			$pcid 	= $_POST['cid'];
			$nu 	= $_GET['nu'];
			$gpass	= $_POST['pass2'];
			

			
			$fechaHoy = date('d/m/Y');

			$idnew 	= $_POST['new'];
			$gidnew 	= $_GET['new'];
			$idfecha 	= $_POST['fecha'];
			$titulo 	= $_POST['titulo'];
			$subtitulo 	= $_POST['subtitulo'];
			$resumen	= $_POST['resumen'];
			$cuerpo 	= $_POST['noticia'];

			$f=$_GET['f'];
			
	
			



			Switch($ax)
			{
				case '1': 
					

					$insert = "INSERT INTO tb_new VALUES ('', ";
					$insert.= "'".$idfecha."',";
					$insert.= "'".$titulo."',";
					$insert.= "'".$subtitulo."',";
					$insert.= "'".$resumen."',";
					$insert.= "'".$cuerpo."',";
					$insert.= "'".$uid."')";

					
					//echo "INSERTAR ::".$insert;

					if ($resultadoINS = mysql_query($insert, $conn)) 
					{
								$sql_idTrans = mysql_query("SELECT last_insert_id() FROM tb_new");
								$idnew = mysql_fetch_row($sql_idTrans);
								$texto = "La <b>noticia</b>  ha sido ingresada al sistema exitosamente. <br> Ahora si desea puede asociar im&aacute;genes (hasta 3)  a la noticia.";
								
								$tipomensaje=1;
								$action ="orderin2.php?new=".$idnew[0];
								include("mensaje.php");
					}
					else 
						{
								$tipomensaje=0;
								$texto = "La <b>transacci&oacute;n</b> no ha sido ingresada al sistema. <br> Int&eacute;ntelo nuevamente y si contin&uacute;a el problema comun&iacute;quese con el administrador";
								$action ="misnoticias.php";
								include("mensaje.php");
						}
				


	
					break;
		
			case '12':
					
					break;

			case '2':
					break;

			case '26':
					

					$insert = "UPDATE tbk_user_pass SET ";
				
					$insert.= "pass_bk = '".$gpass."' ";
					$update = $insert. " WHERE rut_bk = '".$pcid."'";

					if (mysql_query($update, $conn)) 
					{

						$texto= "La contrase&ntilde;a sido <b>actualizada</b> exitosamente. ";
						$tipomensaje=1;
					}
					else
					{
						$texto= "No se ha  podido cambiar  la contrase&ntilde;a.<p/>Si el problema persiste comun&iacute;quese con el admimnistrador para ver las causas";
						$tipomensaje=0;
					}
					
					
					$action ="adminusuarios.php";
					include("mensaje.php");
					break;

			case '27':
					
					
					$insert = "UPDATE tbk_user SET ";
					$insert.= "nombres_bk = '".$nombresf."', ";
					$insert.= "paterno_bk = '".$paternof."', ";
					$insert.= "materno_bk = '".$maternof."', ";
					$insert.= "sexo_bk 	 = '".$sexof."', ";
					$insert.= "email_bk   = '".$contactof."' ";




					$update = $insert. " WHERE id_bk = '".$pcid."'";
					//echo "UPDATE ::".$update;

					if (mysql_query($update, $conn)) 
					{

						$texto= "La ficha del usuario <b> ".$nombresf." ".$paternof." ".$maternof."</b> se ha actualizado exitosamente. ";
						$tipomensaje=1;
					}
					else
					{
						$texto= "No se ha  podido modificar   la ficha del usuario.<p/>Si el problema persiste comun&iacute;quese con el admimnistrador para ver las causas";
						$tipomensaje=0;
					}
					
	

					$action ="adminusuarios.php";
					include("mensaje.php");
					break;

			case '3':
					
					$update = "UPDATE tbk_estado SET id_bk=0,paso2_es=0,paso3_es=0, paso4_es=0, paso6_es='',paso7_es='' WHERE id_trans =".$gtid;
					
					
					if (mysql_query($update, $conn)) 
					{

						$texto= "La <b>eliminacion</b> se ha realizado exitosamente";
						$tipomensaje=1;
					}
					else
					{
						$texto= "La <b>eliminacion</b> ha fallado.<p/>Comun&iacute;quese con el admimnistrador para ver las causas";
						$tipomensaje=0;
					}
					
					
					$action ="estado.php";
					include("mensaje.php");
					
					break;

			case '31':
					
					$delete = "DELETE FROM tb_picturenew WHERE id_pic=".$gidnew;
					
					$b=1;
					if (mysql_query($delete, $conn)) 
					{

						$dir='pictures/thumb/th_'.$f; //puedes usar dobles comillas si quieres 
						//echo "::".$dir;
						if(file_exists($dir)) 
						{ 
							if(unlink($dir)) 
							$b=0;
						} 

						$dir='pictures/'.$f; //puedes usar dobles comillas si quieres 
						//echo "::".$dir;
						if(file_exists($dir)) 
						{ 
							if(unlink($dir)) 
							$b=0;
						} 

						$texto= "La imagen ha sido eliminada exitosamente"; 
						$tipomensaje=1;
					}
					else
					{
						$texto= "La imagen no ha podido ser eliminada. Int&eacute;ntelo nuevamente o cont&aacute;ctese con el administrador";
						$tipomensaje=0;
					}
					


					$action ="publicidad.php";
					include("mensaje.php");
					
					break;


			case '32': //elimina usuario
					   // paso 1. Tiene noticias? .. SI => No se puede eliminar
						
					$deletebusca = "SELECT * FROM tb_new WHERE uid_new = ".$gcid;
					//echo $deletebusca;
					$texto = "0";
					$vb=0;
					
					if ($deleteres = mysql_query($deletebusca, $conn))
					{
						$numnew = mysql_numrows($deleteres);
						if ($numnew ==0) { $vb=1; }
									
					}
					
					if ($vb==1)
					{
					
						
						$delete = "DELETE FROM tbk_user_pass WHERE rut_bk='".$grut."'";
						//echo $delete;
					
						// elimnar clave ingreso
						if (mysql_query($delete, $conn)) 
						{

							$texto= "1";
						}
						else
						{
							$texto= "Error en la eliminaci&oacute;n (1).<p/> Si el problema persiste p&oacute;ngase en contacto con el administrador";
						}
					
						// eliminar perfiles
					
						if ($texto == '1')
						{
							
							$delete = "DELETE FROM tbk_perfil_usuario  WHERE id_bk=".$gcid;
							//echo $delete;
					
							$texto ="0";
							if (mysql_query($delete, $conn)) 
							{

								$texto= "1";
							}
							else
							{
								$texto= "Error en la eliminaci&oacute;n (2).<p/> Si el problema persiste p&oacute;ngase en contacto con el administrador";
							}
						
							
							if ($texto == '1')
							{
						
								$delete = "DELETE FROM tbk_user WHERE id_bk=".$gcid;
								//echo $delete;
					
								if (mysql_query($delete, $conn)) 
								{

									$texto= "El usuario ha  sido <b>eliminado</b> satisfactoriamente.";
									$tipomensaje=1;
								}
								else
								{
									$texto= "Error en la eliminaci&oacute;n (3).<p/> Si el problema persiste p&oacute;ngase en contacto con el administrador";
									$tipomensaje=0;
								}


							}
					
						}
					}
					else
					{
						$texto= "Error en la eliminaci&oacute;n (3).<b> El usuario posee noticias publicadas en el sistema</b>.<br/> Para eliminarlo elimine esas noticias.<p/> Si el problema persiste p&oacute;ngase en contacto con el administrador";
						$tipomensaje=0;
					
					}
					$action ="adminusuarios.php";
					include("mensaje.php");
					
					break;



			case '96':
		
					
					$texto = "<img src='images/alerta.gif'> Est&aacute; seguro que desea <b>Eliminar</b> este usuario <b><i>[".trim($nu)."]</i></b>? <p/> :: <b> Advertencia </b> <br/><i>Eliminar un usuario implica borrar todo su historial del sistema,  informaci&oacute;n que ser&aacute; irrecuperable. Si desea continuar y eliminar toda la informaci&oacute;n pulse  <b>Continuar</b></i> ";					
					$action ="procesa_orden.php?ax=32&urut=".$grut."&cid=".$gcid;
					
					
					$desaction ="adminusuarios.php";
					include("mensaje.php");
					
					break;


			case '97':
		
					
					$texto = "<img src='images/alerta.gif'> Est&aacute; seguro que desea <b>Eliminar</b> este cartel publicitario? ";					
					$action ="procesa_orden.php?ax=31&new=".$gidnew."&f=".$f;
					$desaction ="publicidad.php";
					include("mensaje.php");
					
					break;


			case '98':
		
					
					$texto = "<img src='images/alerta.gif'> Est&aacute; seguro que desea <b>Rechazar</b> la asignaci&oacute;n de <label id='datamini'> ".$vector_usuarios[$gcid]." </label>  a la transacci&oacute;n ?";					
					$action ="procesa_orden.php?ax=22&tid=".$gtid;
					$desaction ="asignaciones.php";
					include("mensaje.php");
					
					break;
					
			case '99':
		
					$com=$_GET['com'];
					$texto = "Est&aacute; seguro que desea <b>Eliminar</b> la asignaci&oacute;n de <label id='datamini'> ".$vector_usuarios[$gcid]." </label> de la transacci&oacute;n ?";					
					$action ="procesa_orden.php?ax=3&tid=".$gtid;
					$desaction ="estado.php";
					include("mensaje.php");
					
					break;
					
			}		
		?>


	</td>
	</tr>
	</table>

<?php include("footer.php");?>
