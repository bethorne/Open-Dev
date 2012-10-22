<?php include("header.php");?>

	<form name="forma" action="procesa_orden.php?ax=27" method = "POST">

	<table border="0" width="780" height="450"  >
	<tr>
	<td  align="center" valign="top">
		

		<table border="0" cellpadding="2" cellspacing="5" >
		<tr>
		<td>
			<fieldset>	
			<legend id='menu'> Ficha Transacci&oacute;n</legend>
		<?php
			
			
				
			$pid = $_GET['pid'];

			$consulta = "SELECT *  FROM tbk_user WHERE id_bk= ".$pid;
			//echo $consulta;
			$resultadoconsulta = mysql_query($consulta, $conn);

			$a=0;
	
			WHILE ($registro = mysql_fetch_row($resultadoconsulta))
			{

					$puid 		= $registro[0];
					$campo1 	= $registro[1];
					$campo2 	= $registro[2];
					$campo3 	= $registro[3];
					$campo4 	= $registro[4];
					$campo5 	= $registro[5];
					$campo6       = $registro[6];
					$campo7       = $registro[7];
					$campo8	= $registro[8];


				$a++;
			}



			
		
			echo "<table border='0' width='500' cellpadding='5' cellspacing='5'>\n";
			echo "<tr>\n";
			echo "<td id='etiqueta'>\n";
			echo "	USUARIO ID";
			echo "</td>\n";
			echo "<td id='data'>\n";
				echo $pid;
			echo "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo "<td id='etiqueta'>\n";
			echo "	RUT";
			echo "</td>\n";
			echo "<td id='data'>\n";
				echo $campo1;
			echo "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo "<td id='etiqueta'>\n";
			echo "	Nombres";
			echo "</td>\n";
			echo "<td id='data'>\n";
				echo "<input type='text' name='nombres' value='".$campo2."'>";
			echo "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo "<td id='etiqueta'>\n";
			echo "	Paterno";
			echo "</td>\n";
			echo "<td id='data'>\n";
				echo   "<input type='text' name='paterno' value='".$campo3."'>";		
			echo "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo "<td id='etiqueta'>\n";
			echo "Materno";
			echo "</td >\n";
			echo "<td id='data'>\n";
				echo "<input type='text' name='materno' value='".$campo4."'>";
			echo "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo "<td id='etiqueta'>\n";
			echo "	Sexo";
			echo "</td >\n";
			echo "<td id='data'>\n";
				echo " Femenino";
				echo "<input type='radio' name='sexo' value='0' ";
				if ($campo5 == 0) 
				{
					echo " CHECKED> ";			
				}
				else
				{
					echo " > ";			
				}
				

				echo "<input type='radio' name='sexo' value='1' ";
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
				echo "<input type='text' name='email' value='".$campo6."'>";
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
	
	<tr>

	<td>

		
		<table border='0' width='500'>
		<tr>
		<td align='right'>
		<?php


			echo "<table border='0'  cellpadding='5' cellspacing='5'>\n";
			echo "<tr>\n";
			echo "<td><input type='hidden' name='cid' value='".$puid."'></td>";
			echo "<td >\n";
			echo "	<input type='RESET' value='Limpiar'>";
			echo "</td>\n";
			echo "<td >\n";
			echo "	<input type='SUBMIT' value='Aceptar' >";

			echo "</td>\n";
			echo "</tr>\n";
			echo "</table>\n";

		?>

		</td>
		</tr>
		</table>

	
	</td>
	</tr>
	</table>
	
	</form>

	<br/>


<?php include("footer.php");?>
