<?php

session_start();

if (!empty($_POST[rut])) $_SESSION[UID]= $_POST[rut];
if (!empty($_GET[puid])) $_SESSION[PID]= $_GET[puid];

$rut  = $_SESSION[UID];
$puid = $_SESSION[PID];
$iva  = $_SESSION[IVA];


if ($_GET[s] =="x") 
	{
		session_unset();
		$rut="";
		$puid="";
		$iva ="";
	}
error_reporting(0);
?>

<HTML>
<HEAD>


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
		

		valor1 = 0;
		valor2 = 0;
		function agregar(cantidad,codigo, producto,precio,stock)
		{
		
			//alert(producto + ' (' + cantidad +  ')  valor: ' + precio);
			var entrada =  '\n# |' + codigo + ' | ' + producto.substring(0,30) + '...|'  + cantidad + '| $ ' + precio + ' c/u';
			
			
			alerta ="";
			
			valor1 = eval(cantidad);
			valor2 = eval(stock);
			
			if (valor1 <= valor2)
			{
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
			
			}
			else
			{
				alerta ="Aviso\n\nEste producto no tiene sufiente stock.";
				alert(alerta);
			
			}
					
			return true
		}
		
		
		
		function borradelista(dato)
		{
		
			var posicion = dato - 1;
			
		//	alert(posicion);
			listado = np.lista.value;
			cada = listado.split('\n');
			
			
			if (confirm('¿Desea eliminar la linea?\n\n '+ cada[posicion]))
			{
			
					i=0;
					nuevalista ='';
					for (i = 0; i < cada.length; i++)
					{
						//alert("elemento: " + cada[i]);
						nuevalinea = cada[i];
						
						nuevalinea.replace('\n',"");
						if (i != posicion) nuevalista = nuevalista + nuevalinea + '\n';
					
					}

					largo =  nuevalista.length - 1 ;
					np.lista.value = nuevalista.substring(0,largo);
			
			}
			
			
			return true;
		
		}
		
		

		function multiplica(posicion)
		{
		

			if (posicion == '1' )
			 {
				
				descuento1=boleta.fcprecio1.value * ((100 - boleta.descuen11.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen21.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen31.value )/100);
				 boleta.fccolumna1.value = Math.round(descuento3 * boleta.fccantidadpro1.value) ;
			 
			 }
			if (posicion == '2' ) 
			{ 
			
			
				descuento1=boleta.fcprecio2.value * ((100 - boleta.descuen12.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen22.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen32.value )/100);
				 boleta.fccolumna2.value = Math.round(descuento3 * boleta.fccantidadpro2.value) ;
			 
			}
			if (posicion == '3' ) {
				
				
				 descuento1=boleta.fcprecio3.value * ((100 - boleta.descuen13.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen23.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen33.value )/100);
				 boleta.fccolumna3.value = Math.round(descuento3 * boleta.fccantidadpro2.value) ;
				  }
			if (posicion == '4' ) {
				descuento1=boleta.fcprecio4.value * ((100 - boleta.descuen14.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen24.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen34.value )/100);
				 boleta.fccolumna4.value = Math.round(descuento3 * boleta.fccantidadpro4.value) ;
				 }
			if (posicion == '5' ) { 
			
			descuento1=boleta.fcprecio5.value * ((100 - boleta.descuen15.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen25.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen35.value )/100);
				 boleta.fccolumna5.value = Math.round(descuento3 * boleta.fccantidadpro5.value) ;
			}
			if (posicion == '6' ) {
				
				 descuento1=boleta.fcprecio6.value * ((100 - boleta.descuen16.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen26.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen36.value )/100);
				 boleta.fccolumna6.value = Math.round(descuento3 * boleta.fccantidadpro6.value) ;
			}
				 
			if (posicion == '7' ) {
				
				 descuento1=boleta.fcprecio7.value * ((100 - boleta.descuen17.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen27.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen37.value )/100);
				 boleta.fccolumna7.value = Math.round(descuento3 * boleta.fccantidadpro7.value) ;
			}
			if (posicion == '8' ) {
				 
				  descuento1=boleta.fcprecio8.value * ((100 - boleta.descuen18.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen28.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen38.value )/100);
				 boleta.fccolumna8.value = Math.round(descuento3 * boleta.fccantidadpro8.value) ;
			}
				 
			if (posicion == '9' ) {
				 
				  descuento1=boleta.fcprecio9.value * ((100 - boleta.descuen19.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen29.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen39.value )/100);
				 boleta.fccolumna9.value = Math.round(descuento3 * boleta.fccantidadpro9.value) ;
			}
				 
			if (posicion == '10' ) {
				descuento1=boleta.fcprecio10.value * ((100 - boleta.descuen110.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen210.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen310.value )/100);
				 boleta.fccolumna10.value = Math.round(descuento3 * boleta.fccantidadpro10.value) ;
				 
				  }
			if (posicion == '11' ) {
				 
				 descuento1=boleta.fcprecio11.value * ((100 - boleta.descuen111.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen211.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen311.value )/100);
				 boleta.fccolumna11.value = Math.round(descuento3 * boleta.fccantidadpro11.value) ;
				 
				  }
			if (posicion == '12' ) {
				 descuento1=boleta.fcprecio12.value * ((100 - boleta.descuen112.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen212.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen312.value )/100);
				 boleta.fccolumna12.value = Math.round(descuento3 * boleta.fccantidadpro12.value) ;
				 }
			if (posicion == '13' ) {
				descuento1=boleta.fcprecio13.value * ((100 - boleta.descuen113.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen213.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen313.value )/100);
				 boleta.fccolumna13.value = Math.round(descuento3 * boleta.fccantidadpro13.value) ;
				 }
			if (posicion == '14' ) {
				 descuento1=boleta.fcprecio14.value * ((100 - boleta.descuen114.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen214.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen314.value )/100);
				 boleta.fccolumna14.value = Math.round(descuento3 * boleta.fccantidadpro14.value) ;
				 }
			if (posicion == '15' ) {
				 descuento1=boleta.fcprecio15.value * ((100 - boleta.descuen115.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen215.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen315.value )/100);
				 boleta.fccolumna15.value = Math.round(descuento3 * boleta.fccantidadpro15.value) ;
				  }
			if (posicion == '16' ) { 
			descuento1=boleta.fcprecio16.value * ((100 - boleta.descuen116.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen216.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen316.value )/100);
				 boleta.fccolumna16.value = Math.round(descuento3 * boleta.fccantidadpro16.value) ;
				  }
			if (posicion == '17' ) {
				descuento1=boleta.fcprecio17.value * ((100 - boleta.descuen117.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen217.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen317.value )/100);
				 boleta.fccolumna17.value = Math.round(descuento3 * boleta.fccantidadpro17.value) ;
				 }
			if (posicion == '18' ) {
				descuento1=boleta.fcprecio18.value * ((100 - boleta.descuen118.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen218.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen318.value )/100);
				 boleta.fccolumna18.value = Math.round(descuento3 * boleta.fccantidadpro18.value) ;
				 }
			if (posicion == '19' ) { 
			descuento1=boleta.fcprecio19.value * ((100 - boleta.descuen1919.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen219.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen319.value )/100);
				 boleta.fccolumna19.value = Math.round(descuento3 * boleta.fccantidadpro19.value) ;
				  }
			if (posicion == '20' ) {
				
				 descuento1=boleta.fcprecio20.value * ((100 - boleta.descuen120.value )/100);
				descuento2=descuento1 * ((100 - boleta.descuen220.value )/100);
				descuento3=descuento2 * ((100 - boleta.descuen320.value )/100);
				 boleta.fccolumna20.value = Math.round(descuento3 * boleta.fccantidadpro20.value) ;
				 }
			
			
			
			
			
			return true
		}
		
		
		
		var valor1 = 0;
		var valor2 = 0;
		var valor3 = 0;
		var valor4 = 0;
		var valor5 = 0;
		var valor6 = 0;
		var valor7 = 0;
		var valor8 = 0;
		var valor9 = 0;
		var valor10 = 0;
		var valor11 = 0;	
		var valor12 = 0;
		var valor13 = 0;
		var valor14 = 0;
		var valor15 = 0;
		
		var totalneto = 0;
		var totaliva  = 0;
		var totalfactura = 0;
		
		
		function totalfacturacompra()
		{
		

			if (boleta.fccolumna1.value  != '')  { valor1  =  parseInt(boleta.fccolumna1.value); }
			if (boleta.fccolumna2.value  != '')  { valor2  =  parseInt(boleta.fccolumna2.value); }
			if (boleta.fccolumna3.value  != '')  { valor3  =  parseInt(boleta.fccolumna3.value); }
			if (boleta.fccolumna4.value  != '')  { valor4  =  parseInt(boleta.fccolumna4.value); }
			if (boleta.fccolumna5.value  != '')  { valor5  =  parseInt(boleta.fccolumna5.value); }
			if (boleta.fccolumna6.value  != '')  { valor6  =  parseInt(boleta.fccolumna6.value); }
			if (boleta.fccolumna7.value  != '')  { valor7  =  parseInt(boleta.fccolumna7.value); }
			if (boleta.fccolumna8.value  != '')  { valor8  =  parseInt(boleta.fccolumna8.value); }
			if (boleta.fccolumna9.value  != '')  { valor9  =  parseInt(boleta.fccolumna9.value); }
			if (boleta.fccolumna10.value  != '')  { valor10  =  parseInt(boleta.fccolumna10.value); }
			if (boleta.fccolumna11.value  != '')  { valor11  =  parseInt(boleta.fccolumna11.value); }
			if (boleta.fccolumna12.value  != '')  { valor12  =  parseInt(boleta.fccolumna12.value); }
			if (boleta.fccolumna13.value  != '')  { valor13  =  parseInt(boleta.fccolumna13.value); }
			if (boleta.fccolumna14.value  != '')  { valor14  =  parseInt(boleta.fccolumna14.value); }
			if (boleta.fccolumna15.value  != '')  { valor15  =  parseInt(boleta.fccolumna15.value); }
			
			
			totalneto = 0;
			
			if (boleta.fcestado1.value == 0)  totalneto = totalneto + valor1;
			if (boleta.fcestado2.value == 0)  totalneto = totalneto + valor2;
			if (boleta.fcestado3.value == 0)  totalneto = totalneto + valor3;
			if (boleta.fcestado4.value == 0)  totalneto = totalneto + valor4;
			if (boleta.fcestado5.value == 0)  totalneto = totalneto + valor5;
			if (boleta.fcestado6.value == 0)  totalneto = totalneto + valor6;
			if (boleta.fcestado7.value == 0)  totalneto = totalneto + valor7;
			if (boleta.fcestado8.value == 0)  totalneto = totalneto + valor8;
			if (boleta.fcestado9.value == 0)  totalneto = totalneto + valor9;
			if (boleta.fcestado10.value == 0)  totalneto = totalneto + valor10;
			if (boleta.fcestado11.value == 0)  totalneto = totalneto + valor11;
			if (boleta.fcestado12.value == 0)  totalneto = totalneto + valor12;
			if (boleta.fcestado13.value == 0)  totalneto = totalneto + valor13;
			if (boleta.fcestado14.value == 0)  totalneto = totalneto + valor14;
			if (boleta.fcestado15.value == 0)  totalneto = totalneto + valor15;

			
				
			boleta.fcneto.value = totalneto; 
			totaliva = 0;
			
			if (boleta.fctipodoc.value == 3)
			{
				
				totaliva =  (totalneto * <?=$iva?> ) / 100 ;
			}
			
			
			boleta.fciva.value = Math.round(totaliva);
			
			totalfactura  = totalneto +  totaliva;
			
			boleta.fctotal.value  = Math.round(totalfactura);
			
			if (boleta.fctipodoc.value == 2)
			{
				totalfactura  = 0;
				boleta.fcneto.value = 0; 
				boleta.fctotal.value  = 0;
			}
			
			
			
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
		
		
		function asignacodigo(doc)
		{
				
				if (doc == '1') boleta.cfactura.value= boleta.ff.value;
				if (doc == '2') boleta.cfactura.value= boleta.bb.value;
				
	
			return true
		}
		
		

	</SCRIPT>



<style>


	#titulo
	{

		font-family: Trebuchet MS;
		font-size: 32px;
		font-weight:bold;
		color:#FFF;
	}

	#subtitulo
	{

		font-family: Trebuchet MS;
		font-size: 18px;
		font-weight:bold;
		color: #FFF;


	}

	#menu
	{

		font-family :Trebuchet MS, Arial;
		font-size:12px;
		color:#FFF;
		text-decoration: none;
	}


	#menualternativo
	{

		font-family :Trebuchet MS, Arial;
		font-size:12px;
		color:#888888;
		text-decoration: none;
	}
	
	#menublanco
	{

		font-family :Trebuchet MS, Arial;
		font-size:12px;
		color:#fff;
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
		font-size:9px;
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
		
		background  :#225599;
		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#ffffff;

		
	}
	
	#etiqueta
	{
		
		background  :#225599;
		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#ffffff;
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

	#comentariogris
	{

		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#ffffff;

		
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
	
	td#mainmenu
	{
		font-family :arial;
		font-size   :11px;
		color       :#888;
		font-weight :bold;	
		border      :none;
		text-decoration:none;	
		border-right:solid 2px #ccc;
		border-top:solid 1px #eee;	
		border-bottom:solid 2px #ccc;
		padding-top:30px;
		/*background-color:#eef;*/
		
	}
	
	a#mainmenu
	{
		font-family :arial;
		font-size   :11px;
		color       :#888;
		font-weight :bold;	
		border      :none;
		text-decoration:none;		
		
	}
	a:hover#mainmenu
	{
		font-family :arial;
		font-size   :11px;
		color       :#fb4;
		font-weight :bold;	
		border      :none;
		text-decoration:none;		
		
	}
	
	#titulomainmenu
	{
		font-family :trebuchet ms,verdana, arial;
		font-size   :12px;
		color       :#fff;
		font-weight :bold;	
		padding:5px;
		background-color:#bbb;

	
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

	#ficha
	{
		font-family :trebuchet ms,verdana, arial;
		font-size   :11px;
		color       :#888;
		font-weight :bold;	
	}
	body{
		
	
		
		background-size:contain;
		
		background-repeat:no-repeat;
		background-position:center;
		background-color:#354b9b;
		}
</style>
</HEAD>

 <BODY  >
 
 
<center>
<table border="0"  height='600' width="100%" >
<tr>
<td align="center" valign='top'>

<!-- cuerpo del sitio -->


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





	<table border="0" width="100%"  >
	<tr>
	<td align='left' >
	
		
		<?php include("fichaempresa.php"); ?>
		
		<table border='0' width='100%'>
		<tr>
		<td align='left' width='80'>
				<img height='100' width='200' src='<?=$logo?>'>
		</td>
		<td>
			<label id='menu'> <?=$Empresaencabezado?></label>
			<br/>
			<label id='subtitulo'><?=$Empresanombre?></label>
		</td>

		</tr>
		</table>
	</td>

	<td valign="top" align='right'>
	
			<label id="usuario">	<?php  if (!empty($nombreUsuario)) echo "<b>".$nombreUsuario."</b>" ?></label>
			<br/>
	
			<?php
					
					if (!empty($perfiles))
					{
						$cadena = explode(",",$perfiles);
						$a=0;
						echo "<form name='form'><SELECT name='pid' Onchange='window.location.href=\"home.php?puid=\" + form.pid.options[form.pid.selectedIndex].value'>\n";
						echo "<option />\n";

						while (!empty($cadena[$a]))
						{
					
							echo "<option value='".$cadena[$a]."'";
					
							if ($puid == $cadena[$a]) echo " SELECTED ";
		
							echo ">".$vector_perfiles[$cadena[$a]]."</option>\n";
							$a++;

						}
						echo "</SELECT><br/><label id='menualternativo'>".$out."</label>\n";
						echo "</form>\n";
					}
			?>
			

	</td>
	</tr>
	</table>

<!-- <hr style='border:solid 1px #eef' /> -->

	<table width="100%" cellspacing="0" cellpadding="0" border="0"   >
	
	<tr>
	<td  >
		
	<?php 
		if (!empty($rut)) 
		{
			
			SWITCH($puid)
			{	
				
			case '1':
					//echo "	<a id='menualternativo' href='home.php'><b>Inicio</b></a> ";
					/*
					echo "<table border='0'>";
					echo "<tr>";

					echo "<td>";
							// include("menu.php");
					echo "</td>";
					echo "</tr>";
					echo "</table>";
					*/
					?>
					<table border='0' bgcolor='#ffffff' cellspacing='0' cellpadding='5'>
					<tr>
					<td background='images/logos/inicio_boton_menu.jpg' height='51' width='35'/>
					<td background='images/logos/fondo_boton_menu.jpg' height='50' >
						<a id='mainmenu' href='submenu.php?c=1'>COMPRAS .</a>
					</td>
					<td   background='images/logos/fondo_boton_menu.jpg' height='50' >
						<a id='mainmenu' href='submenu.php?c=2'>BODEGA .</a>
					</td>
					<td  background='images/logos/fondo_boton_menu.jpg' height='50'>
						<a id='mainmenu' href='submenu.php?c=3'>VENTAS .</a>
					</td>
					<td   background='images/logos/fondo_boton_menu.jpg' height='50'>
						<a id='mainmenu' href='submenu.php?c=5'>CLIENTES .</a>
					</td>
					<td  background='images/logos/fondo_boton_menu.jpg' height='50'>
						<a id='mainmenu' href='submenu.php?c=6'>INFORMES .</a>
					</td>
					<td background='images/logos/fondo_boton_menu.jpg' height='50'>
						<a id='mainmenu' href='submenu.php?c=7'>ADMINISTRACI&Oacute;N .</a>
					</td>
                 
                    <td background='images/logos/fondo_boton_menu.jpg' height='50'>
						<a id='mainmenu' href='submenu.php?c=8'>LIBRO CONT.</a>
					</td>
                    <td background='images/logos/fondo_boton_menu.jpg' height='50'>
						<a id='mainmenu' href='registrovehiculos.php'>REGISTRO VEHICULOS.</a>
					</td>
                    <td background='images/logos/fondo_boton_menu.jpg' height='50'>
						<a id='mainmenu' href='submenu.php?c=10'>ARRIENDOS.</a>
					</td>
					<td background='images/logos/fin_boton_menu.jpg' height='50' width='35'/>
					</tr>
					</table>
					
					<?php
					break;
			
			case '2':
					
					break;

			}

		


		}
	?>
	</td>
	</tr>
	</table>
	

	<table border='0' width='100%'>
	<tr>
	<td  align="right"  >
		
		<?php if (empty($rutUsuario)) :?>
			
			<?php 	if (!($_SERVER['PHP_SELF'] == "/sbl/acceso.php")) : ?>
			<table border='0' width='100%' bgcolor='#ffffff'>
			<tr>
			<td  valign='top' align='right' height='30'>
				 <a id="menualternativo" href="#"><b>Cont&aacute;ctanos</b></a> 
				| <a id="menualternativo" href="index.php"><b>login</b></a>
				</td>
			</tr>
			</table>
			
			
			
			<table border="0" width="100%"  >
			<tr>
			<td align='center'>
			
				<img src='images/logos/intro.png'>

			</td>
			</tr>
			</table>
			<?php endif ?>
			
			<?php 	if (!($_SERVER['PHP_SELF'] == "/sbl/acceso.php")) exit();    ?>
						
			
		<?php endif ?>
		

	</td>
	</tr>
	</table>

