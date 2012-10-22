<?php include("header.php");?>

<?php


	$nrut		= $_POST['nrut'];
	$nombresf	= $_POST['nombresf'];
	$paternof	= $_POST['paternof'];
	$maternof	= $_POST['maternof'];
	$sexof  	= $_POST['sexof'];
	$contactof	= $_POST['emailf'];
	
	
	if ($nrut != '')
	{
					$insert = "INSERT INTO tbk_user VALUES (";
					$insert.= "'',";
					$insert.= "'".$nrut."',";
					$insert.= "'".$nombresf."',";
					$insert.= "'".$paternof."',";
					$insert.= "'".$maternof."',";
					$insert.= "'".$sexof."',";
					$insert.= "'".$contactof."',";
					$insert.= "'".date('d-m-Y')."',''";
					$insert.= ")";
	
					
					if ($rs = mysql_query($insert, $conn)) 
					{
						$insert2 = "INSERT INTO tbk_user_pass VALUES (";
						$insert2.= "'".$nrut."',";
						$insert2.= "'1234'";
						$insert2.= ")";
						
						$rs = mysql_query($insert2, $conn);
						
						echo
						
						$tipomensaje=1;
						$texto = "Usuario ha sido registrado exitosamente. La clave de Acceso es :: <b>1234</b>. <p/> <i> No olvide asignarle privilegios al usuario para que pueda acceder al sistema.</i>";
						include("mensaje.php");
					
					}
					else
					{
					
						$tipomensaje=0;
						$texto = "Usuario no ha sido registrado. Aseg&uacute;rese que el usuario no exista.";
						include("mensaje.php");
					}
	
	}



?>

	<form name='diagnostico' action='usuario.php' method='POST' onSubmit='return checkRutPersonaX(document.diagnostico.nrut.value)'>

	<table border="0" width="780" height="450"  >
	<tr>
	<td  align="center" valign="top">
		

		<table border="0" cellpadding="2" cellspacing="5" >
		<tr>
		<td>
			<fieldset>	
			<legend id='menu'> Ficha Usuario</legend>
		<?php
			
			
		
			echo "<table border='0' width='500' cellpadding='5' cellspacing='5'>\n";
			echo "<tr>\n";
			echo "<td id='etiqueta'>\n";
			echo "	RUT";
			echo "</td>\n";
			echo "<td id='data'>\n";
				echo "<input type='text' name='nrut' value='".$campo1."' size='45'>";
			echo "</td>\n";
			echo "</tr>\n";
			
			echo "<tr>\n";
			echo "<td id='etiqueta'>\n";
			echo "	Nombres";
			echo "</td>\n";
			echo "<td id='data'>\n";
				echo "<input type='text' name='nombresf' value='".$campo2."' size='45'>";
			echo "</td>\n";
			echo "</tr>\n";
			
			echo "<tr>\n";
			echo "<td id='etiqueta'>\n";
			echo "	Paterno";
			echo "</td>\n";
			echo "<td id='data'>\n";
			echo "<input type='text' name='paternof' value='".$campo3."' size='45'>";		
			echo "</td>\n";
			echo "</tr>\n";
			
			echo "<tr>\n";
			echo "<td id='etiqueta'>\n";
			echo "Materno";
			echo "</td >\n";
			echo "<td id='data'>\n";
				echo "<input type='text' name='maternof' value='".$campo4."' size='45'>";
			echo "</td>\n";
			echo "</tr>\n";
			
			echo "<tr>\n";
			echo "<td id='etiqueta'>\n";
			echo "	Sexo";
			echo "</td >\n";
			echo "<td id='data'>\n";
				echo " Femenino";
				echo "<input type='radio' name='sexof' value='0' ";
				if ($campo5 == 0) 
				{
					echo " CHECKED> ";			
				}
				else
				{
					echo " > ";			
				}
				

				echo "<input type='radio' name='sexof' value='1' ";
				if ($campo5 == 1) 
				{
					echo " CHECKED> ";			
				}
				else
				{
					echo " > ";			
				}
				
				echo " Masculino";

			echo "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo "<td id='etiqueta'>\n";
			echo "	Contacto";
			echo "</td>\n";
			echo "<td id='data'>\n";
				echo "<input type='text' name='emailf' value='".$campo6."' size='45'>";
			echo "</td>\n";
			echo "</tr>\n";
			
			echo "<tr>\n";
			echo "<td id='etiqueta'>\n";
			echo "	Fecha Inscripcio&oacute;n";
			echo "</td>\n";
			echo "<td id='data'>\n";
				echo $campo7;
			echo "</td>\n";
			echo "</tr>\n";

			
		?>	
		
		</table>

		<p/>


					
		
	</td>

	<td valign='top'>
		
		<fieldset>
		<legend id='menu'> Opciones </legend>

			<table border='0' cellspacing='5' cellpadding='5'>
			<tr>
			<td id='etiqueta'>
		
			
				<a href="javascript:window.history.go(-1)"> Volver </a>
		
			
			</td>
			</tr>
			</table>
		</fieldset>

	</td>
	</tr>
	</table>

	<br/>

	<table border="0" width="400"  >
	<tr>
	<td  align="right" valign="top">
	
		<table border='0'>
		<tr>
		<td>
				<input type='RESET' value='Limpiar'>
		</td>
		<td>
				<input type='hidden' name='cid' value='<?=$puid?>'>
				<input type='SUBMIT' value='Aceptar'>
		</td>
		</tr>
		</table>
		
	</td>
	</tr>
	</table>
	
	</form>

<?php include("footer.php");?>
