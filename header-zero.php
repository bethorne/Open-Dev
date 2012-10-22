<?php

session_start();

if (!empty($_POST[rut])) $_SESSION[UID]= $_POST[rut];
if (!empty($_GET[puid])) $_SESSION[PID]= $_GET[puid];

$rut  = $_SESSION[UID];
$puid = $_SESSION[PID];


if ($_GET[s] =="x") 
	{
		session_unset();
		$rut="";
		$puid="";
	}
error_reporting(0);
?>



	<?php
	
	$here = $_SERVER[PHP_SELF]."?op=".$_GET['op'];
	//echo "here=".$here;

	$autorefresh = 0;
	if (strcmp($here,'/s-buzon.php?op=1')==0)
	{
		echo "<meta http-equiv='refresh' content='120;url=s-buzon.php?op=1'>\n";
		$autorefresh = 1;


	}

	?>

		<script type="text/javascript" src="scripts/javascript/valida_rut.js"></script>
	
		<link rel="stylesheet" type="text/css" href="scripts/javascript/superfish/css/superfish.css" media="screen">
		<script type="text/javascript" src="scripts/javascript/superfish/js/jquery-1.2.6.min.js"></script>
		<script type="text/javascript" src="scripts/javascript/superfish/js/hoverIntent.js"></script>
		<script type="text/javascript" src="scripts/javascript/superfish/js/superfish.js"></script>
		<script type="text/javascript">

		// initialise plugins
		jQuery(function(){
			jQuery('ul.sf-menu').superfish();
		});

		</script>


	<!-- link calendar files  --> 
	<script language="JavaScript" src="scripts/javascript/calendar_db.js"></script> 
	<link rel="stylesheet" href="scripts/javascript/calendar.css"> 
 



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
		


		function agregar(cantidad,codigo, producto,precio)
		{
		
			//alert(producto + ' (' + cantidad +  ')  valor: ' + precio);
			var entrada = codigo + ' | ' + producto.substring(0,40) + '...|'  + cantidad + '| $ ' + precio + ' c/u\n';
			
			
			alerta ="";
			if (precio == 0) 
				{
					alerta ="Aviso\n\nEste producto no tiene precio definido por lo que no puede ser considerado para una venta.";
				}
			if (cantidad == 0) 
				{
					alerta ="Aviso\n\nDebe ingresar una cantidad para considerarlo en la Lista de Compras.";
				}
			
			if (alerta == "")
			{
				np.lista.value = np.lista.value + entrada;
			}
			else
				{
					alert(alerta);
				}
			
			
					
			return true
		}
		
		
		
		function agregarcarrito(cantidad,codigo, producto,precio)
		{
			
			//alert(producto + ' (' + cantidad +  ')  valor: ' + precio);
			var entrada = codigo + ' | ' + producto.substring(0,140) + '...|'  + cantidad + '| $ ' + precio + ' c/u\n';

			
			alerta ="";
			if (precio == 0) 
				{
					alerta ="Aviso\n\nEste producto no tiene precio definido por lo que no puede ser considerado para una venta.";
				}
			if (cantidad == 0) 
				{
					alerta ="Aviso\n\nDebe ingresar una cantidad para considerarlo en la Lista de Compras.";
				}
			
			if (alerta == "")
			{
				//compras.lista.value = compras.lista.value + entrada;
				window.opener.compras.lista.value = window.opener.compras.lista.value + entrada;
				
			}
			else
				{
					alert(alerta);
				}
			
			
					
			return true
		}
		
		
		function agregaacompra(posicion)
		{
			
			alert(posicion);
			var entrada = codigo + ' | ' + producto.substring(0,140) + '...|'  + cantidad + '| $ ' + precio + ' c/u\n';

			
			alerta ="";
			if (precio == 0) 
				{
					alerta ="Aviso\n\nEste producto no tiene precio definido por lo que no puede ser considerado para una venta.";
				}
			if (cantidad == 0) 
				{
					alerta ="Aviso\n\nDebe ingresar una cantidad para considerarlo en la Lista de Compras.";
				}
			
			if (alerta == "")
			{
				//compras.lista.value = compras.lista.value + entrada;
				window.opener.compras.lista.value = window.opener.compras.lista.value + entrada;
				
			}
			else
				{
					alert(alerta);
				}
			
			
					
			return true
		}
		
		
		function multiplica(posicion)
		{
		

			if (posicion == '1' ) { boleta.fccolumna1.value= boleta.fccantidadpro1.value * boleta.fcprecio1.value; }
			if (posicion == '2' ) { boleta.fccolumna2.value= boleta.fccantidadpro2.value * boleta.fcprecio2.value; }
			
			return true
		}
		
		
		
		function borrarlista()
		{
		
			
			np.lista.value  = '';
			np.listaprecios.value  = '';
			
		
			return true
		}
		
		
		
		function calcularcuota(cuota)
		{
				apagar = (boleta.total.value / cuota);
				boleta.valorcuota.value=  apagar.toFixed(0);
			
			return true
		}
		
		
		

	</SCRIPT>



<style>


	#titulo
	{

		font-family: Trebuchet MS;
		font-size: 32px;
		font-weight:bold;
		color: #888888;
	}

	#subtitulo
	{

		font-family: Trebuchet MS;
		font-size: 18px;
		font-weight:bold;
		color: #444444;


	}

	#menu
	{

		font-family :Trebuchet MS, Arial;
		font-size:12px;
		color:#555555;
		text-decoration: none;
	}


	#menualternativo
	{

		font-family :Trebuchet MS, Arial;
		font-size:12px;
		color:#888888;
		text-decoration: none;
	}
	

	input
	{
		border: solid 1px #ccc;
		font-family: Trebuchet MS, Arial;
		font-weight:bold;
		font-size:12px;
		bgcolor:#ccc;
		color:#2222aa;
	}
	
	.num
	{
		
		font-family: Trebuchet MS, Arial;
		font-size:32px;
		color:#00a;
		text-align:right;
	
	}
	
	select
	{
		font-size: 11px;
		border: solid 1px #cccccc;
		font-family: Trebuchet MS, Arial;
		color:#888888;
	}

	textarea
	{
		font-family: Verdana, Arial;
		font-size:14px;
		color:#333;
		border: solid 1px #ccc;
	}	
	
	
	
	#usuario
	{

		font-family: Trebuchet MS;
		font-size: 14px;
		font-weight:bold;
		color: #555555;
	}

	


	fieldset
	{

		border      : solid 1px #dddddd;
		background  : #efefef;

	}



	
	
	
	td#etiqueta
	{
		
		background  :#ccccff;
		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#888888;
		text-decoration:none;

		
	}
	
	
	td#datacuota
	{
		
		background  :#ada;
		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#000;

		
	}
	
	#etiqueta
	{
		
		background  :#eeeeee;
		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#888888;
		text-decoration:none;

		
	}
	
	#etiquetazul
	{
		

		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#359;
		text-decoration:none;

		
	}
		
		
	#comentario
	{

		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#359;

		
	}

	td#data
	{

		font-family :arial;
		font-size   :11px;
		color       :#555555;
		border      : solid 1px #aaaaaa;
		background  :#ffffff;
		
	}
	
	#messagge
	{

		font-family :sans-serif, arial;
		font-size   :14px;
		color       :#333;
	
		background  :#fff;
		
	}

	#datamini
	{

		font-family :arial;
		font-size   :11px;
		color       :#000000;
		border      : solid 1px #aaaaaa;
		background  :#ffffff;
		
	}
	
	#alerta
	{

		font-family :tahoma, arial;
		font-size   :11px;
		color       :#000000;


		
	}

	a
	{
		font-family: arial;
		font-size:14px;
	}

	#mini
	{
		font-size:11px;
	}



</style>
</HEAD>

<!-- desactica la carga del countdown cuando no está en la bandeja de entrada -->


<BODY bgcolor='#ffffff'> 

<center>
<table border="0" >
<tr>
<td align="center">

<!-- cuerpo del sitio -->


<table border="0"  height="350" cellspacing="0" cellpadding="0"  >

<tr>
<td align="center" valign='top'  >

		<?php
		
		include("conector/conector.php");
		
		

		$ins="";

		$out="";
		//$rut= $_POST["rut"];
		$pass= $_POST["pass"];
		$ins = $_POST["ins"];

		$vector_usuarios ="";
		$consulta = "SELECT * FROM tbk_user ";		
		$resultadoconsulta = mysql_query($consulta, $conn);
		
		$h=0;
		While ($registro= mysql_fetch_array($resultadoconsulta))
		{
			
			$vector_usuarios[$registro[0]] = $registro[2]." ".$registro[3]." ".substr($registro[4],0,1).".";
			$h++;
		}
		
		


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

					$uid= $registro[0];
					$rutUsuario = $registro[1];
					$nombreUsuario = $registro[2]." ".$registro[3]." ".$registro[4];
					$passUsuario = $registro[10];
					$perfiles = $registro[8];
					date_default_timezone_set('America/Santiago');
					$hoy = date("d-m-Y");

					$out="<a id='menualternativo' href='home.php'> Inicio </a> | <a id='menualternativo' href='home.php?s=x'><b>Cerrar Sesi&oacute;n</b></a> ";

	
					//echo "-->".$rut."=".$rutUsuario."? ".$pass."-".$passUsuario."?";
					if (ereg($rut,$rutUsuario)) break;
					$i++;
				}


			// busca perfiles ----------------------------------------------------------

			$perfiles= "";
			$consultaper = "SELECT * FROM tbk_perfil_usuario WHERE id_bk = ".$uid;
			//echo "consulta = ".$consultaper;
			$resultadoper = mysql_query($consultaper, $conn);

			
			$j=0;
			While ($registroper = mysql_fetch_array($resultadoper))
			{
				$perfiles.= $registroper[1]."," ;
				//echo "-".$registroper[1]."-" ;
				$j++;
			}


			//echo $perfiles."-";
			// -------------------------------------------------------
			// revisa  perfil seleccionado. Si no existe, asigna a puid  una caedna vacia

			$pfs = explode(",",$perfiles);
			$c=0;
			$contiene = 0;
			While ($pp = $pfs[$c])
			{
			
					if ($puid == $pp) $contiene = 1;

				$c++;
				
			}

			//echo "CONTIENE ".$contiene;
			if ($contiene == 0) 
			{
				$puid ="";
				$rut  ="";
			}
				

			// -------------------------------------------------------------------------

			// Crea combo con nombres de perfiles

			$nombreperfiles[]= "";
			$consultaper = "SELECT * FROM tbk_perfil WHERE 1";
			//echo "consulta = ".$consultaper;
			$resultadoper = mysql_query($consultaper, $conn);

			$vectores_perfiles[]="";
			$k=0;

			While ($registroper = mysql_fetch_array($resultadoper))
			{
				$vector_perfiles[$registroper[0]]= $registroper[1];

				//echo "-".$registroper[1]."-" ;
				$k++;
			}


			//print_r($vector_perfiles);




			
			// --------------------------------------------------------
			// Crea combo con nombres de usuarios

			$nombreusuarios[]= "";
			$consultaper = "SELECT * FROM tbk_user WHERE 1";
			//echo "consulta = ".$consultaper;
			$resultadoper = mysql_query($consultaper, $conn);

			$vectores_usuarios[]="";
			$k=0;

			While ($registroper = mysql_fetch_array($resultadoper))
			{
				$vector_usuarios[$registroper[0]]= $registroper[2]." ".$registroper[3]." ".$registroper[4];
				$k++;
			}

			//print_r($vector_usuarios);

			//
			if ($ins  == 1)
			{
				if (strcmp($pass,$passUsuario)!=0)
				{
					echo '<table border="0" width="700" >
					<tr>
					<td colspan="3">
						<img src="images/bandera.jpg" height="30">
					</td>
					</tr>
					</table>';

					$texto= "Error Sistema. Contrase&ntilde;a no es v&aacute;lida. <p/>Int&aacute;ntelo nuevamente. ";
					$action="../index.php?s=x";
					include("mensaje.php");
				
					echo '<p/>
					<center>
					<font face="arial" size="1" color="#000000">
					PROYECTO r-77 CEL: (9) 95726495
					<br>
					email: lquintan@hotmail.com / contacto@r-77.cl
					</font>
					</center>	';

					exit;
				}	
			}
		}
	
					
	?>




	<table " cellspacing="0" cellpadding="0" border="0"   >
	
	<tr>
	<td  >
		
<?php 
		if (!empty($rut)) 
		{
			
			SWITCH($puid)
			{	
				
			case '1':
					//echo "	<a id='menualternativo' href='home.php'><b>Inicio</b></a> ";
					
					echo "<table border='0'>";
					echo "<tr>";

					echo "<td>";
							//include("menu.php");
					echo "</td>";
					echo "</tr>";
					echo "</table>";

					break;
			
			case '2':
					echo "  <a id='menualternativo' href='http://www.ibritanico.cl'><b>Cont&aacute;ctanos</b></a> ";

					


					break;

			}

		


		}
?>
	</td>

	<td  align="right"  >
		
		<?php if (empty($rut)) :?>

			
			| <a id="menualternativo" href="../../index.php"><b>login</b></a>
			
			<?php 	if (!($_SERVER['PHP_SELF'] == "/sbl/acceso.php")) exit();    ?>
			
			
		<?php endif ?>
		

	</td>
	</tr>
	</table>
	
	<p/>
