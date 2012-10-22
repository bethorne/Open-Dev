<?php include("header.php") ?>

<?php




function overnow($fechaparam)
{

	// determina si la fecha es mayor o menos que hoy

	$datenow = date('Y').date('m').date('d');
	$datenow="20120810";
	$fecha = substr($fechaparam,6,4).substr($fechaparam,3,2).substr($fechaparam,0,2);
	//echo "<br/>fecha::".$fecha." :: ".$datenow;
	
	
	$resta = (int)($datenow) - (int)($fecha);
    //echo "<br/> la diferencia es de :: ".$resta;	
	
	if ($fecha > $datenow)
	{
		//return true;
	}
	else
	{
		//echo "<br/>resta:: ". $resta;
		/*
		if (($resta >= 100) and ($resta < 200))
		{
			//echo "<br> El retraso es de mas de  30 dias";
		}
		if (($resta >= 200) and ($resta < 300))
		{
			echo "<br> El retraso es de mas de  60 dias";
		}
		*/
		
		
		
	}
	
	return $resta;
	
	
}

$look = $_POST['look'];

if (!empty($look)) 
	{
		//echo "revisando base de datos de cuotas";


		$srccuotas = "SELECT * FROM tbk_pago_cuota WHERE estado_pc=0";
		$rstcuotas = mysql_query($srccuotas, $conn);
		
		$pendientes=0;
		$vencidas =0;
		
		WHILE ($rowcuotas = mysql_fetch_row($rstcuotas))
		{

			$idfactura			=  $rowcuotas[0];
			$rutcli 			=  $rowcuotas[1];
			$valorcuota 		=  $rowcuotas[3];
			$fechavencimiento 	=  $rowcuotas[4];
			$fechapago			=  $rowcuotas[5];
			
			

			$resta = overnow($fechavencimiento);
			if ($resta < 0 )
			{
				//echo "<br/>PENDIENTE";
				// en este caso, las pendientes son cuotas a futuro.. no corresponde procesarlas.. solo contarlas para una estadistica
				$pendientes++;
			}
			else
			{
				//echo "<br/><label id='comentario'>$fechavencimiento :: $hoy :: PLAZO DE CUOTA VENCIDO</label>";
				//actualizar campo revisada en base de datos tbk_pago_cuota
				// actualizar dias de atraso.. con eso estaremos al otro lado.
				
				
				//calculando nuevo valor de cuota
				if ($resta > 8000) $resta = $resta - 8800;
				
				$factorX = round(($resta / 100),0);
				$interescuota = (2 * ($factorX + 1));
				
				$porcentajeinteres = round(($interescuota / 100),2)  + 1;
				
				$nuevovalorcuota = round($valorcuota * $porcentajeinteres,0);

				
				
				$updatecuota = "UPDATE tbk_pago_cuota SET diasatraso_pc = ".$resta.", valor_cuota_atraso_pc= ".$nuevovalorcuota."   WHERE id_fact ='".$idfactura."'  AND vencimiento_pc ='".$fechavencimiento."'";
				if ($rstcuota = mysql_query($updatecuota, $conn)) echo "";
				
				
				//echo "<br/>".$updatecuota;
				$vencidas++;
			} 
			
			$contador++;
		}

		//echo " <p/>REGISTRADOS REVISADOS:: ".$contador;
		//echo " <p/>CUOTAS PENDIENTES:: ".$pendientes;
		//echo " <p/>CUOTAS VENCIDAS: ".$vencidas;

	}
?>

<table border='0' width='870'>
<tr>
<td>
	
	
	<label id='subtitulo'> Indice de Pago de Cuotas </label>
	<p/>
				
	<fieldset>
		<table border='0'>
		<tr>
		<td>
		
			<label id='comentario'>El &Iacute;ndice de Pago de Cuotas es un c&aacute;lculo de un indicador del comportamiento de pago de cuotas del (los) clientes producto de las compras que ha realizando en la empresa.
			<p/>
			Para Ejecutar este procedimiento, debe presionar el boton COMENZAR.
			<p/>
			Nota: Se aconseja ejecutar este procedimiento  cada d&iacute;a al iniciar el sistema de inventario. Es un procedimiento que toma alg&uacute;n tiempo  y est&aacute; restringido exclusivamente a los administradores del sistema inform&aacute;tico. 
			</label>
		</td>
		</tr>
		</table>
	
	</fieldset>

		<p/>
		<p/>
	
	<fieldset>
		<table border='0'>
		<tr>
		<td width='400'>
				<form name='indices' action='ip.php' method='POST'>
					<input type='Submit' value='COMENZAR' onClick ='indices.look.value=1' style='font-size:42px'>
					<input type='hidden' name='look' value=''>
					<br/>
					<label id='comentario'> Una vez comenzado el procedimiento, por favor espere que  finalice </label>
				</form>
		</td>
		<td width='500' valign='top'>
			
			<label id='subtitulo'> Estad&iacute;sticas</label>
			<p/>
		
			<table border='1' cellspacing='5' cellpadding='5'>
			<tr>
			<td id='etiqueta'>
				Registros analizados
			
			</td>
			<td id='data'>
					<?=$contador?>
			</td>
			</tr>
			
			<tr>
			<td id='etiqueta'>
				Cuotas por Pagar
			
			</td>
			<td id='data'>
					<?=$pendientes?>
			</td>
			</tr>
			
			<tr>
			<td id='etiqueta'>
				Cuotas Vencidas
			
			</td>
			<td id='data'>
					<?=$vencidas?>
			</td>
			</tr>
			
			</table>
		</td>
		</tr>
		</table>
	
	</fieldset>



</td>
</tr>
</table>

<?php include("footer.php") ?>