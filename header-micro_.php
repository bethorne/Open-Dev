<?php

session_start();

if (!empty($_POST[rut])) $_SESSION[UID]= $_POST[rut];

$rut = $_SESSION[UID];


if ($_GET[s] =="x") 
	{
		session_unset();
		$rut="";
	}

?>

<HTML>
<HEAD>


	<?php
	
	$here = $_SERVER[PHP_SELF]."?op=".$_GET['op'];
	//echo "here=".$here;

	$autorefresh = 0;
	if (strcmp($here,'/webnote/s-buzon.php?op=1')==0)
	{
		echo "<meta http-equiv='refresh' content='120;url=http://www.r-77.cl/webnote/s-buzon.php?op=1'>\n";
		$autorefresh = 1;


	}

	?>

	

	 



	
</head> 


	<SCRIPT language="javascript">
	
		function validar_registro()
		{
			mensaje="";
			salida = true;
			if (document.diagnostico.pss1.value!=document.diagnostico.pss2.value) 
			{
					mensaje = "<SBook> Alerta: \n\n Claves No Coinciden.";
					alert(mensaje);
					document.diagnostico.pss1.select();
					return  false;
			}
			else 
			{
				if (document.diagnostico.pss1.value=="")
				{ 
					mensaje = "<SBook> Alerta: \n\n El Campo Clave es obligatorio. No se permite el campo vacio.";
					alert(mensaje);
					document.diagnostico.pss1.select();
					return  false;
				}
			}
			if (document.diagnostico.paterno.value=="")
			{
					mensaje = "<SBook> Alerta: \n\n El Campo Apellido Paterno es obligatorio. No se permite el campo vacio.";
					alert(mensaje);
					document.diagnostico.paterno.select();
					return  false;
			}
/*			
			if (document.diagnostico.materno.value=="")
			{
				mensaje = mensaje + "<SBook> Alerta: \n\n El Campo Apellido Materno es obligatorio. No se permite el campo vacio.";
				salida  = false;
			}
*/			
						
			if (salida)
			{	
				return checkRutPersona(document.diagnostico.rut.value);
			}


		return true;
		}
		


	</SCRIPT>

<style>
	
	#titulo
	{
		font-family: Arial, Verdana, Trebuchet MS;
		font-size: 32px;
		font-weight:bold;
		color: #000000;
	}

	#cuerpo
	{
		font-family: times;
		font-size: 15px;
		color: #222222;
	}


</style>


	
	
</HEAD>

<!-- desactica la carga del countdown cuando no está en la bandeja de entrada -->

<?php if ($autorefresh == 1) :?>
<BODY onLoad="startCountdown()"  bgcolor='#555555'> 
<?php else :?>
<BODY  bgcolor='#555555'> 
<?php endif ?>



<?php
function mostrar_caritas($texto) 
{

	$texto = nl2br($texto);
	$texto = str_replace (".=)", "<img src='/webnote/images/smiles/emoticon%20(41).gif'>", $texto);  
	$texto = str_replace (".:)", "<img src='/webnote/images/smiles/emoticon%20(48).gif'>", $texto);  
	$texto = str_replace (".¬¬", "<img src='/webnote/images/smiles/emoticon%20(192).gif'>", $texto);  
	$texto = str_replace (".:(", "<img src='/webnote/images/smiles/emoticon%20(12).gif'>", $texto);  
	$texto = str_replace (".???", "<img src='/webnote/images/smiles/emoticon%20(138).gif'>", $texto);  
	$texto = str_replace (".XD", "<img src='/webnote/images/smiles/emoticon%20(46).gif'>", $texto);  
	$texto = str_replace (".que1", "<img src='/webnote/images/smiles/emoticon%20(170).gif'>", $texto);  
	$texto = str_replace (".como1", "<img src='/webnote/images/smiles/emoticon%20(21).gif'>", $texto);  
	$texto = str_replace (".:|", "<img src='/webnote/images/smiles/emoticon%20(155).gif'>", $texto);  
	$texto = str_replace (".:p", "<img src='/webnote/images/smiles/emoticon%20(68).gif'>", $texto);  
	$texto = str_replace (".ups1", "<img src='/webnote/images/smiles/emoticon%20(198).gif'>", $texto);  
	$texto = str_replace (".nose1", "<img src='/webnote/images/smiles/nose.gif'>", $texto);  
	$texto = str_replace (".zz1", "<img src='/webnote/images/smiles/emoticon%20(189).gif'>", $texto);  
	$texto = str_replace (".turi1", "<img src='/webnote/images/smiles/turi.gif'>", $texto);  
	$texto = str_replace (".jiji1", "<img src='/webnote/images/smiles/emoticon%20(164).gif'>", $texto); 
	$texto = str_replace (".ok1", "<img src='/webnote/images/smiles/emoticon%20(94).gif'>", $texto);  
 	$texto = str_replace (".enojo1", "<img src='/webnote/images/smiles/emoticon%20(186).gif'>", $texto);  
  	$texto = str_replace (".hola1", "<img src='/webnote/images/smiles/15x4uqb.gif'>", $texto);  
	$texto = str_replace (".guac1", "<img src='/webnote/images/smiles/guacala.gif'>", $texto);  
	$texto = str_replace (".nocapto1", "<img src='/webnote/images/smiles/emoticon%20(181).gif'>", $texto);  
	$texto = str_replace (".imagino1", "<img src='/webnote/images/smiles/emoticon%20(33).gif'>", $texto);  
	$texto = str_replace (".jaja1", "<img src='/webnote/images/smiles/emoticon%20(103).gif'>", $texto);  
	$texto = str_replace (".8|", "<img src='/webnote/images/smiles/emoticon%20(181).gif'>", $texto);  












	


return $texto;
}
?>


<CENTER>
<table border="0"  height="350" cellspacing="0" cellpadding="0"  >

<tr>
<td align="center" valign="top">

		<?php


		include("conector/conector.php");


		
		//echo "<h1>HOLA</h1>\n";
		$conn=mysql_connect($servidor,$login ,$pass ) or die ('I cannot connect to the database because: ' . mysql_error());
		mysql_select_db($dbs);

		$ins="";

		$out="";
		//$rut= $_POST["rut"];
		$pass= $_POST["pass"];
		$ins = $_POST["ins"];

		//echo "INS".$ins;
		//echo "<br>";



		if (!empty($rut))
		{

				$consulta = "SELECT * FROM tbk_user,tbk_user_pass WHERE tbk_user.rut_bk LIKE '".$rut."' AND tbk_user_pass.rut_bk LIKE '".$rut."'";

				//echo $consulta;

				$resultado = mysql_query($consulta,$conn);


				$i=0;


				While ($registro= mysql_fetch_array($resultado))
				{	
	
					//echo "<pre>";
					//print_r($registro);
					//echo "</pre>\n";

					$rutUsuario = $registro[1];
					$nombreUsuario = $registro[2]." ".$registro[3]." ".$registro[4];
					$passUsuario = $registro[10];
					$perfiles = $registro[8];

					$out="<a id='t5_grafito' href='home.php?s=x'><b>Cerrar Sesi&oacute;n</b></a> ";

	
					//echo "-->".$rut."=".$rutUsuario."? ".$pass."-".$passUsuario."?";
					if (ereg($rut,$rutUsuario)) break;
					$i++;
				}
			
			if ($ins  == 1)
			{
				if (strcmp($pass,$passUsuario)!=0)
				{
					echo '<table border="0" width="700" >
					<tr>
					<td colspan="3">
						<img src="images/banner1.gif">
					</td>
					</tr>
					</table>';

					$texto= "Error en la contrase&ntilde;a ";
					$volver="acceso.php?s=x";
					include("mensaje.php");
				
					echo '<p/>
					<center>
					<font face="arial" size="1" color="#000000">
					PROYECTO REMO CEL: (9) 95726495
					<br>
					email: lquintan@hotmail.com / contacto@r-77.cl
					</font>
					</center>	';

					exit;
				}	
			}
		}
	
					
	?>





