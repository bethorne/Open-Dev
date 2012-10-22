<?php include("header.php");?>


	<form name=" forma" action="procesa_orden.php?ax=26" method = "POST">

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
			$grut = $_GET['urut'];

			$consulta = "SELECT *  FROM tbk_user WHERE id_bk= ".$pid;
			//echo $consulta;
			$resultadoconsulta = mysql_query($consulta, $conn);

			$a=0;
	
			WHILE ($registro = mysql_fetch_row($resultadoconsulta))
			{

					$puid = $registro[0];
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
			echo "	USUARIO";
			echo "</td>\n";
			echo "<td id='data'>\n";
				echo "[".$campo1."] ".$campo2." ".$campo3." ".$campo4;
			echo "</td>\n";
			echo "</tr>\n";


			
		?>	
		
		</table>

		</fieldsert>
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

		<fieldset>
		<legend id='menu'> Nueva Contrase&ntilde;a</legend>
			
		<?php


			echo "<table border='0' width='500' cellpadding='5' cellspacing='5'>\n";
			echo "<tr>\n";
			echo "<td id='etiqueta'>\n";
			echo "	CONTRASE&Ntilde;A";
			echo "</td>\n";
			echo "<td id='data'>\n";
			echo "<input type='password' name='pass' size='30'>";
			echo "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo "<td id='etiqueta'>\n";
			echo "	REPETIR CONTRASE&Ntilde;A";
			echo "</td>\n";
			echo "<td id='data'>\n";
			echo "<input type='password' name='pass2' size='30'>";
			echo "</td>\n";
			echo "</tr>\n";
			echo "</table>\n";

		?>
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
			echo "<td><input type='hidden' name='cid' value='".$campo1."'></td>";
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

<?php include("footer.php");?>
