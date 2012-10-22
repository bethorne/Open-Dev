<?php include("header.php")?>


<?php
	

	$fecha 		= $_POST['fecha'];
	$rutcli 	= $_POST['rutcli'];
	$monto  	= $_POST['monto'];
	$autoriza 	= $_POST['autoriza'];
	

	//echo "Ficha recibida: ".$fecha." -". $rutcli." - ".$monto." - ".$autoriza; 
	
	//busca creditos activos
	
	$buscacred = "UPDATE tbk_credito  SET estado_cre  = 0 WHERE rut_cli ='".$rutcli."'";
	$rescred  = mysql_query($buscacred, $conn);
	
	$fichacred  = mysql_fetch_row($rescred);
	

	$nuevocredito = 1;  

	if ($nuevocredito == 1 )
	{
			$insertar = "INSERT INTO tbk_credito VALUES (";
			$insertar.="'".$rutcli."',";
			$insertar.="'".$monto."',";
			$insertar.="'".$monto."',";
			$insertar.="'".$fecha."',";
			$insertar.="'".$fecha."',";

			$insertar.="'".$autoriza."',";
			$insertar.="'1'";
			
			$insertar.=")";
			//echo "<p>".$insertar;
			
			if ($res= mysql_query($insertar, $conn))
			{
			
				$tipomensaje = 1;
				$texto = "Asignaci&oacute;n de Cr&eacute;dito fue utorizada exitosamente.";
				include("mensaje.php");
			}
	}
	else
		{
			$tipomensaje = 0;
			$texto = "Asignaci&oacute;n de Cr&eacute;dito no autorizada<br/> El cliente ya cuenta con un cr&eacute;dito activo.";
			include("mensaje.php");
		}
	
?>


<?php include("footer.php");