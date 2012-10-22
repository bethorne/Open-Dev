<?php include("header.php")?>

<p/>
<table border="0" width="700" height="300" >
<tr>
<td valign="top">	


<?php
			

			echo "<img src='images/imagenes.gif'>\n";
			echo "<br/>\n";


$destino = 'pictures/' ;
// Leemos el tama√±o del fichero
$total = $_FILES [ 'file' ]['name'];

$i=0;

while (!empty($_FILES [ 'file' ]['name'][$i]))
{
    $nombres[$i]= $_FILES [ 'file' ]['name'][$i];
    $tamanos[$i]= $_FILES [ 'file' ]['size'][$i];
    $tipos[$i]= $_FILES [ 'file' ]['type'][$i];
   	

   // echo $nombres[$i].": ".$tamanos[$i]."<p>";
    $i++;    
}

$tresd[0] = $_POST['tresd1'];
$tresd[1] = $_POST['tresd2'];
$tresd[2] = $_POST['tresd3'];
$tresd[3] = $_POST['tresd4'];
$tresd[4] = $_POST['tresd5'];
$tresd[5] = $_POST['tresd6'];
$tresd[6] = $_POST['tresd7'];
$tresd[7] = $_POST['tresd8'];
$tresd[8] = $_POST['tresd9'];
$tresd[9] = $_POST['tresd10'];

$idnew = $_GET['new'];

$com = $_POST['comentario'];

//print_r($tresd);

//print_r($tamanos);

$numero = $i -1;

$i=0;
for ($i; $i <= $numero; $i++)
{
  
  $nombre = $nombres[$i];
  $tamano = $tamanos[$i]; 
  $tamanoKB= round(($tamano/1024),0);
  $tipo = $tipos[$i];
  $tresd = $tresd[$i];
  
  // Comprobamos el tamaÒo
  // $maxUpload = abs(ini_get("upload_max_filesize")) * 1024 * 1024;

   $maxUpload = abs(1000) * 1024 ;



if( ($tamano > 0) && ($tamano <  $maxUpload) )
{

    if (file_exists($destino . '/' . $nombre))
    {
        $msg="Archivo ya existe. Renombrando archivo a: ";
        $re_file = explode(".",$nombre);
        $z=0;
        while ($re_file[$z])
        {
           // echo $re_file[$z];
            $z++;
        }
        $ahora = mktime(date("h") , date("i") , date("s") , date("m")  , date("d"), date("Y"));
        $nombre = $re_file[($z-2)]."_".$ahora.".".$re_file[($z-1)];
        
        $msg.= $nombre;
        //echo $nombre;

    }

    
    if (move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ][$i], $destino . '/' . $nombre))
    {

        ?>


        
        <!-- este codigo crea la tabla de EXITO -->
        
	 <BR/>
        <table border ="0" width="650" style="border:solid 1px #eeeeee">
        <tr>
        <td rowspan="2" width="450">
               <label id='t4_grafito'><b> <?=$nombre?></label><b/><Br/> <label id='t5_grafito'>[<?=$tamanoKB?> KB] - <?=$tipo?></label>
        </td>
        <td width="220" align="right">
                <label id='t4_grafito'><b> Archivo subido exitosamente.</b></label>
        </td>
        
	<!-- ahora hay que crear el thumb y grabar en base de datos. Si todo resulta ok se mostrar· una columna con una 
	pequeÒa flecha verde -->
         

	<?php

	// crea THUMBNAIL

	//echo "::".$destino."-".$nombre."-".$tipo;

	SWITCH($tipo)
	{
		case 'image/jpeg' :


					$source=$nombre; // archivo de origen
					$dest="th_".$nombre; // archivo de destino
					$width_d=200; // ancho de salida
					$height_d=200; // alto de salida
					list($width_s, $height_s, $type, $attr) = getimagesize($destino."/".$source, $info2); // obtengo informaciÛn del archivo
					$gd_s = imagecreatefromjpeg($destino."/".$source); // crea el recurso gd para el origen
					$gd_d = imagecreatetruecolor($width_d, $height_d); // crea el recurso gd para la salida
					// desactivo el procesamiento automatico de alpha
					imagealphablending($gd_d, false);
					// hago que el alpha original se grabe en el archivo destino
					imagesavealpha($gd_d, true);
					imagecopyresampled($gd_d, $gd_s, 0, 0, 0, 0, $width_d, $height_d, $width_s, $height_s); // redimensiona
					imagejpeg($gd_d, $destino."/thumb/".$dest); // graba
					// Se liberan recursos
					imagedestroy($gd_s);
					imagedestroy($gd_d);

					break;
		case 'image/pjpeg' :


					$source=$nombre; // archivo de origen
					$dest="th_".$nombre; // archivo de destino
					$width_d=200; // ancho de salida
					$height_d=200; // alto de salida
					list($width_s, $height_s, $type, $attr) = getimagesize($destino."/".$source, $info2); // obtengo informaciÛn del archivo
					$gd_s = imagecreatefromjpeg($destino."/".$source); // crea el recurso gd para el origen
					$gd_d = imagecreatetruecolor($width_d, $height_d); // crea el recurso gd para la salida
					// desactivo el procesamiento automatico de alpha
					imagealphablending($gd_d, false);
					// hago que el alpha original se grabe en el archivo destino
					imagesavealpha($gd_d, true);
					imagecopyresampled($gd_d, $gd_s, 0, 0, 0, 0, $width_d, $height_d, $width_s, $height_s); // redimensiona
					imagejpeg($gd_d, $destino."/thumb/".$dest); // graba
					// Se liberan recursos
					imagedestroy($gd_s);
					imagedestroy($gd_d);

					break;
		case 'image/png' :
					

					$source=$nombre; // archivo de origen
					$dest="th_".$nombre; // archivo de destino
					$width_d=200; // ancho de salida
					$height_d=200; // alto de salida
					list($width_s, $height_s, $type, $attr) = getimagesize($destino."/".$source, $info2); // obtengo informaciÛn del archivo
					$gd_s = imagecreatefrompng($destino."/".$source); // crea el recurso gd para el origen
					$gd_d = imagecreatetruecolor($width_d, $height_d); // crea el recurso gd para la salida
					// desactivo el procesamiento automatico de alpha
					imagealphablending($gd_d, false);
					// hago que el alpha original se grabe en el archivo destino
					imagesavealpha($gd_d, true);
					imagecopyresampled($gd_d, $gd_s, 0, 0, 0, 0, $width_d, $height_d, $width_s, $height_s); // redimensiona
					imagepng($gd_d, $destino."/thumb/".$dest); // graba
					// Se liberan recursos
					imagedestroy($gd_s);
					imagedestroy($gd_d);

					break;	

		case 'image/x-png' :
					

					$source=$nombre; // archivo de origen
					$dest="th_".$nombre; // archivo de destino
					$width_d=200; // ancho de salida
					$height_d=200; // alto de salida
					list($width_s, $height_s, $type, $attr) = getimagesize($destino."/".$source, $info2); // obtengo informaciÛn del archivo
					$gd_s = imagecreatefrompng($destino."/".$source); // crea el recurso gd para el origen
					$gd_d = imagecreatetruecolor($width_d, $height_d); // crea el recurso gd para la salida
					// desactivo el procesamiento automatico de alpha
					imagealphablending($gd_d, false);
					// hago que el alpha original se grabe en el archivo destino
					imagesavealpha($gd_d, true);
					imagecopyresampled($gd_d, $gd_s, 0, 0, 0, 0, $width_d, $height_d, $width_s, $height_s); // redimensiona
					imagepng($gd_d, $destino."/thumb/".$dest); // graba
					// Se liberan recursos
					imagedestroy($gd_s);
					imagedestroy($gd_d);

					break;	
		case 'image/gif' :
					

					$source=$nombre; // archivo de origen
					$dest="th_".$nombre; // archivo de destino
					$width_d=200; // ancho de salida
					$height_d=200; // alto de salida
					list($width_s, $height_s, $type, $attr) = getimagesize($destino."/".$source, $info2); // obtengo informaciÛn del archivo
					$gd_s = imagecreatefromgif($destino."/".$source); // crea el recurso gd para el origen
					$gd_d = imagecreatetruecolor($width_d, $height_d); // crea el recurso gd para la salida
					// desactivo el procesamiento automatico de alpha
					imagealphablending($gd_d, false);
					// hago que el alpha original se grabe en el archivo destino
					imagesavealpha($gd_d, true);
					imagecopyresampled($gd_d, $gd_s, 0, 0, 0, 0, $width_d, $height_d, $width_s, $height_s); // redimensiona
					imagegif($gd_d, $destino."/thumb/".$dest); // graba
					// Se liberan recursos
					imagedestroy($gd_s);
					imagedestroy($gd_d);

					break;
	}


		// almacenar registro de imagenes en BD
		
	

		$querypic = "INSERT INTO tb_picturenew VALUES('','".$nombre."','".$idnew."','".$com."')"; 
		//echo "INSERTAR =".$querypic;

		if ($resultadopic = mysql_query($querypic, $conn))  echo "<td><img src='images/adjunto.gif'></td>";
		
		
	?>

	</tr>
	</table>






        <?php
    }
}
else 
        {
     
	
        // archivo supera tama√±o maximo o existe?
         
        ?>
        <!-- este codigo crea la tabla de FRACASO -->
	 <BR/>
        <table border ="0" width="650" style="border:solid 1px #eeeeee">
        <tr>
        <td rowspan="2" width="450">
               <label id='t4_grafito'><b> <?=$nombre?></label><b/><Br/> <label id='t5_grafito'>[<?=$tamanoKB?> KB]</label>
        </td>
        <td width="200">
                <label id='t4_grafito'><b> Archivo excede el l&iacute;mite.</b></label><br><label id='t5_grafito'> El tama&ntilde;o m&aacute;ximo permitido <font color="green"><b>(1 MB)</b></label>
        </td>
        </tr>
        </table>     

   
        <?php
        }



}



 ?>

</td>
</tr>
<tr>
<td align='center'>
	<a id='t4_grafito' href='publicidad.php'><b> Continuar </b></label>
</td>
</tr>
</table>


	<p/><br/>


<?php include("footer.php");

