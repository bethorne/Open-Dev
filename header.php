<?php

session_start();

if (!empty($_POST[crut])) $_SESSION[UID]= $_POST[crut];
if (!empty($_GET[puid])) $_SESSION[PID]= $_GET[puid];

$rut  = $_SESSION[UID];
$puid = $_SESSION[PID];
$iva  = $_SESSION[IVA];



if ($_GET[s] =="x") 
	{
		session_unset();
		$rut="";
		$puid="";
		$iva = "";
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

	
	
<link rel="stylesheet" media="screen" href="scripts/javascript/superfish/css/superfish.css" /> 

<SCRIPT SRC="scripts/javascript/valida_rut.js"></SCRIPT>
<SCRIPT SRC="scripts/javascript/valida_rutx.js"></SCRIPT>

<script type="text/javascript" src="scripts/javascript/superfish/js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="scripts/javascript/superfish/js/hoverIntent.js"></script>
<script type="text/javascript" src="scripts/javascript/superfish/js/superfish.js"></script>

<script> 
 
    $(document).ready(function() { 
        $('ul.sf-menu').superfish(); 
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
		



		function validatransaccion()
		{
			

			if (document.orden.idfactura.value == "")
			{
				alert("Mensaje del Sistema:\n\n> Campo Factura vac�o.\n\n# Complete el campo Factura.\n\n");

				return  false;
				exit;
			}
			
			if (document.orden.tpcapacita.value == "")
			{
				alert("Mensaje del Sistema:\n\n> Campo Tipo Capacitaci�n vac�o.\n\n# Complete el campo Tipo de Capacitaci�n seleccionando una de las opciones.\n\n");
								

				return  false;
				exit;
			}


			if (document.orden.idinstitucion.value == "")
			{
				alert("Mensaje del Sistema:\n\n> Campo Instituci�n vac�o.\n\n# Complete el campo Tipo de Capacitaci�n seleccionando una de la lista de instituciones o ingrese una nueva si es necesario.\n\n");
				

				return  false;
				exit;
			}


			if (document.orden.cid.value == "")
			{
				alert("Mensaje del Sistema:\n\n> Campo Capacitador vac�o.\n\n# Complete el campo Tipo de Capacitaci�n seleccionando una de la lista de instituciones o ingrese una nueva si es necesario.\n\n");
				

				return  false;
				exit;
			}



			return true;
		
		}
		
		
		function asignacodigo(tipo)
		{
	
	
			
			if (tipo == 1) boleta.codigodoc.value = boleta.paramboleta.value;
			if (tipo == 2) boleta.codigodoc.value = boleta.paramguia.value;
			if (tipo == 3) boleta.codigodoc.value = boleta.paramfac.value;
			if (tipo == 4) boleta.codigodoc.value = boleta.paramnvf.value;
			
			return true;
		}
		
		function seleca(frm)
		{
			if (frm == 1) 
			{
				boleta.cont.value = 'contado';
			boleta.cuotas.disabled='';
			boleta.diadepago.disabled='';
			boleta.mesdepago.disabled='';
			boleta.aniodepago.disabled='';
			}
		
			if (frm == 2){
			boleta.cuotas.disabled='disabled';
			boleta.diadepago.disabled='disabled';
			boleta.mesdepago.disabled='disabled';
			boleta.aniodepago.disabled='disabled';
			
			 boleta.cont.value = 'credito';
			
			}
			
			return true;
			}
		function cargando()
		{
	
			var capa = document.getElementById("carga").innerHTML = "hola";

			
			return true;
		}
		
		
		function calculamonto(c)
		{
			boleta.montopago.value= c;
		
			return true;
		}
		
		function calculararriendo()
		{
			var subtotal=0;
			var canti=0;
			var tota=0;
			if (boleta.totalarr.value != '')  			subtotal= parseInt(boleta.totalarr.value);
			if (boleta.cant.value != '')  			canti = parseInt(boleta.cant.value);
			
			tota= boleta.cant.value*boleta.valoruni.value;
			boleta.totalf.value = Math.round(tota*1)/1;
		 
			
				return true;
			}
		function calculadescuento()
		{
		
			var subtotal =0;
			var descuento=0;
			var total=0;
			
			if (boleta.subtotalvale.value != '')  			subtotal= parseInt(boleta.subtotalvale.value);
			
			if (boleta.descuentovale.value != '')  			descuento = parseInt(boleta.descuentovale.value);
			
			
			total  = (subtotal/100)* descuento;
			suma = parseInt(boleta.subtotalvale.value) - total;
			boleta.totalvale.value = Math.round(suma*1)/1 ;
		
		
			return true;
		}
		
		function calcularcuota(cuota)
		{
				var valortotal = 0;
				var interes = 0;
				
				if (boleta.totalvale.value != '')  
				
				{
					valortotal = parseInt(boleta.totalvale.value);
					
					
					if (cuota > 3)
					{
							interes  = (valortotal/10);
							valortotal = parseInt(valortotal) + parseInt(interes.toFixed(0));  
					}
					
					apagar = (valortotal/cuota);
					boleta.valorcuota.value=  apagar.toFixed(0);
					
					return true
				}
				else 
				{
					alert("Mensaje de Alerta\n\nCampo 'Total Vale' est� vac�o.\n\nPor favor presione el bot�n con el signo '=' a un lado del campo 'descuento' para realizar el c�lculo.");
					boleta.cuotas.selectedIndex = 0;
					return false
				}
			
		}
		
		
		function multiplica(posicion)
			{
			
				
				if (posicion == '1' ) { boleta.fccolumna1.value= boleta.fccantidadpro1.value * boleta.fcprecio1.value; }
				if (posicion == '2' ) { boleta.fccolumna2.value= boleta.fccantidadpro2.value * boleta.fcprecio2.value; }
				if (posicion == '3' ) { boleta.fccolumna3.value= boleta.fccantidadpro3.value * boleta.fcprecio3.value; }
				if (posicion == '4' ) { boleta.fccolumna4.value= boleta.fccantidadpro4.value * boleta.fcprecio4.value; }
				if (posicion == '5' ) { boleta.fccolumna5.value= boleta.fccantidadpro5.value * boleta.fcprecio5.value; }
				if (posicion == '6' ) { boleta.fccolumna6.value= boleta.fccantidadpro6.value * boleta.fcprecio6.value; }
				if (posicion == '7' ) { boleta.fccolumna7.value= boleta.fccantidadpro7.value * boleta.fcprecio7.value; }
				if (posicion == '8' ) { boleta.fccolumna8.value= boleta.fccantidadpro8.value * boleta.fcprecio8.value; }
				if (posicion == '9' ) { boleta.fccolumna9.value= boleta.fccantidadpro9.value * boleta.fcprecio9.value; }
				if (posicion == '10' ) { boleta.fccolumna10.value= boleta.fccantidadpro10.value * boleta.fcprecio10.value; }
				if (posicion == '11' ) { boleta.fccolumna11.value= boleta.fccantidadpro11.value * boleta.fcprecio11.value; }
				if (posicion == '12' ) { boleta.fccolumna12.value= boleta.fccantidadpro12.value * boleta.fcprecio12.value; }
				if (posicion == '13' ) { boleta.fccolumna13.value= boleta.fccantidadpro13.value * boleta.fcprecio13.value; }
				if (posicion == '14' ) { boleta.fccolumna14.value= boleta.fccantidadpro14.value * boleta.fcprecio14.value; }
				if (posicion == '15' ) { boleta.fccolumna15.value= boleta.fccantidadpro15.value * boleta.fcprecio15.value; }
				if (posicion == '16' ) { boleta.fccolumna16.value= boleta.fccantidadpro16.value * boleta.fcprecio16.value; }
				if (posicion == '17' ) { boleta.fccolumna17.value= boleta.fccantidadpro17.value * boleta.fcprecio17.value; }
				if (posicion == '18' ) { boleta.fccolumna18.value= boleta.fccantidadpro18.value * boleta.fcprecio18.value; }
				if (posicion == '19' ) { boleta.fccolumna19.value= boleta.fccantidadpro19.value * boleta.fcprecio19.value; }
				if (posicion == '20' ) { boleta.fccolumna20.value= boleta.fccantidadpro20.value * boleta.fcprecio20.value; }
				
				
				
				
				
				return true
			}
			
			
			function debito()
			{
			
				var total  = 0;
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
				var valor16 = 0;
				var valor17 = 0;
				var valor18 = 0;
				var valor19 = 0;
				var valor20 = 0;
				
				var valoriva = 0;
				var valortotal = 0;

				
				if (boleta.fccolumna1.value != '')  valor1 = parseInt(boleta.fccolumna1.value);
				if (boleta.fccolumna2.value != '')  valor2 = parseInt(boleta.fccolumna2.value);
				if (boleta.fccolumna3.value != '')  valor3 = parseInt(boleta.fccolumna3.value);
				if (boleta.fccolumna4.value != '')  valor4 = parseInt(boleta.fccolumna4.value);
				if (boleta.fccolumna5.value != '')  valor5 = parseInt(boleta.fccolumna5.value);
				if (boleta.fccolumna6.value != '')  valor6 = parseInt(boleta.fccolumna6.value);
				if (boleta.fccolumna7.value != '')  valor7 = parseInt(boleta.fccolumna7.value);
				if (boleta.fccolumna8.value != '')  valor8 = parseInt(boleta.fccolumna8.value);
				if (boleta.fccolumna9.value != '')  valor9 = parseInt(boleta.fccolumna9.value);
				if (boleta.fccolumna10.value != '')  valor10 = parseInt(boleta.fccolumna10.value);
				if (boleta.fccolumna11.value != '')  valor11 = parseInt(boleta.fccolumna11.value);
				if (boleta.fccolumna12.value != '')  valor12 = parseInt(boleta.fccolumna12.value);
				if (boleta.fccolumna13.value != '')  valor13 = parseInt(boleta.fccolumna13.value);
				if (boleta.fccolumna14.value != '')  valor14 = parseInt(boleta.fccolumna14.value);
				if (boleta.fccolumna15.value != '')  valor15 = parseInt(boleta.fccolumna15.value);
				if (boleta.fccolumna16.value != '')  valor16 = parseInt(boleta.fccolumna16.value);
				if (boleta.fccolumna17.value != '')  valor17 = parseInt(boleta.fccolumna17.value);
				if (boleta.fccolumna18.value != '')  valor18 = parseInt(boleta.fccolumna18.value);
				if (boleta.fccolumna19.value != '')  valor19 = parseInt(boleta.fccolumna19.value);
				if (boleta.fccolumna20.value != '')  valor20 = parseInt(boleta.fccolumna20.value);
				

				
				total =  total + valor1;
				total =  total + valor2;
				total =  total + valor3;
				total =  total + valor4;
				total =  total + valor5;
				total =  total + valor6;
				total =  total + valor7;
				total =  total + valor8;
				total =  total + valor9;
				total =  total + valor10;
				total =  total + valor11;
				total =  total + valor12;
				total =  total + valor13;
				total =  total + valor14;
				total =  total + valor15;
				total =  total + valor16;
				total =  total + valor17;
				total =  total + valor18;
				total =  total + valor19;
				total =  total + valor20;
				
				
				
				boleta.totalneto.value = total;
				
				valoriva = (total * <?=$iva?>) / 100;
				boleta.netoiva.value= valoriva.toFixed(0);
				
				valortotal = total + valoriva;
				boleta.totaldebito.value= valortotal.toFixed(0);
				
				
				
				
				
				return true
			}
		
		

		var valor1 = 0;
		var valor2 = 0;
		var valor3 = 0;
		var valor4 = 0;
		var valor5 = 0;
		var valor6 = 0;
		
		var valor7 = 0; 
		
		var total = 0;
		
		function totalabono()
		{
			if ( boleta.abonoparte1.value != '')  valor1 = parseInt(boleta.abonoparte1.value);
			if ( boleta.abonoparte2.value != '')  valor2 = parseInt(boleta.abonoparte2.value);
			if ( boleta.abonoparte3.value != '')  valor3 = parseInt(boleta.abonoparte3.value);
			if ( boleta.abonoparte4.value != '')  valor4 = parseInt(boleta.abonoparte4.value);
			if ( boleta.abonoparte5.value != '')  valor5 = parseInt(boleta.abonoparte5.value);
			if ( boleta.abonoparte6.value != '')  valor6 = parseInt(boleta.abonoparte6.value);
			if ( boleta.saldocredito.value != '') valor7 = parseInt(boleta.saldocredito.value);
			
			//alert("valores " +  valor1 + valor2 + valor3 + valor4 + valor6 +  "-" + valor5 +   valor7);
			
			if (valor5 <= valor7)
			{
				total = valor1 + valor2 + valor3 + valor4 + valor5 + valor6 ;
				boleta.abonototal.value = total;
			}
			else
			{
					alert("Mensaje de alerta\n\nAbono de cr�dito excede saldo del cr�dito");
					boleta.abonoparte5.value ='0';
					
			}
			
		
		
			return true;
		}
		
		
		var valor1 = 0;
		var valor2 = 0;
		var valor3 = 0;
		var valor4 = 0;
		
		function totalboleta()
		{
			if ( boleta.abonoparte1.value != '')  valor1 = parseInt(boleta.abonoparte1.value);
			if ( boleta.abonoparte2.value != '')  valor2 = parseInt(boleta.abonoparte2.value);
			if ( boleta.abonoparte3.value != '')  valor3 = parseInt(boleta.abonoparte3.value);
			if ( boleta.montopagoboleta.value != '')  valor4 = parseInt(boleta.montopagoboleta.value);
			
			
			//alert("valores " +  valor1 + valor2 + valor3 + valor4 + valor6 +  "-" + valor5 +   valor7);
			
			
				total = valor1 + valor2 + valor3  ;
				boleta.abonototal.value = total;
				

	
			return true;
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
		
		
		function calcularprecio()
		{
		
			if ( edita.preciocosto.value != '')  	valor1 = parseInt(edita.preciocosto.value);
			if ( edita.flete.value != '')  			valor2 = parseInt(edita.flete.value);
			if ( edita.ivap.value != '')  			valor3 = parseInt(edita.ivap.value);
			//if ( edita.alcredito.value != '')  		valor4 = parseInt(edita.alcredito.value);
			if ( edita.margen.value != '')  		valor5 = parseInt(edita.margen.value);
			
			
			
			
			valor7 = (valor2 * valor1)/100;
			
			valor6 = (valor5 * valor1)/100;

			
			valor10  = valor1 + valor6 + valor7;
			valor8 = (valor3 * valor10)/100;
			
			
			valor11	 = valor1 + valor6 + valor7+ valor8;
			
			
			edita.neto.value 		= valor10;
			edita.efectivo.value 	= valor11;
			
		
			return true;
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
		color:#FFF;


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
		font-size: 11px;
		font-family: Trebuchet MS, Arial;
		font-weight:bold;
		font-size:12px;
		color:#00a;
		border: solid 1px #ccc;
	}	
	
	
	
	#usuario
	{

		font-family: Trebuchet MS;
		font-size: 14px;
		font-weight:bold;
		color:#FFF;
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
	
	td#atrasocuota
	{
		
		background  :#daa;
		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#ffffff;

		
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
	
	#etiquetacredito
	{
		
		background  :#bac;
		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#fff;
		text-decoration:none;

		
	}
	
	#etiquetadebito
	{
		
		background  :#cba;
		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#fff;
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
		color       :#fff;

		
	}


	td#data
	{

		font-family :arial;
		font-size   :11px;
		color       :#555555;
		border      : solid 1px #aaaaaa;
		background  :#fff;
		
	}
	
	td#data4
	{

		font-family :arial;
		font-size   :11px;
		color       :#555555;
		border      :solid 1px #aaaaaa;
		background  :#eef;
		
	}
	


		
	td#data2
	{

		font-family :times,arial;
		font-size   :14px;
		font-style	: italic;
		color       :#555555;
		border      : solid 1px #aaaaaa;
		background  :#ffffff;
		
	}
	
	
	td#data3
	{

		font-family :times,arial;
		font-size   :14px;
		font-style	: italic;
		color       :#555555;
		border      :none;
		
		
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


body{
	
		
		z-index:1;
		
		background-size:contain;
		
		background-repeat:no-repeat;
		background-position:center;
		background-color:#354b9b;
		}
</style>
</HEAD>


<!--<BODY bgcolor="#ffffff"> -->
 <BODY >


 
<center>
<table border="0"  height='600' width="100%" >
<tr>
<td align="center"  valign='top'>

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

					$out="<a id='menualternativo' href='home.php?s=x'><b>Cerrar Sesi&oacute;n</b></a> ";

	
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
				//echo "PAss ".$pass." - PASSUSUARIO ".$passUsuario;			
				if (strcmp($pass,$passUsuario)!=0)
				{
					echo '<table border="0" width="700" >
					<tr>
					<td colspan="3">
						<img src="images/bandera.jpg" height="30">
					</td>
					</tr>
					</table>';

					$texto= "Error Sistema. Contrase&ntilde;a no es v&aacute;lida. Int&aacute;ntelo nuevamente. ";
					$action="index.php?s=x";
					$tipomensaje='0';
					
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
			
				
			
			// captura EL IVA
			
			if (empty($iva))
			{
				
				$buscaiva = "SELECT valor_param FROM tbk_parametro WHERE id_param = 1";
				$resultaIVA  = mysql_query($buscaiva, $conn);
				
				$row = mysql_fetch_row($resultaIVA);
				$iva = $row[0];
				
				
				$_SESSION[IVA] = $iva;
				
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
               
					<table border='0' bgcolor='#ffffff' cellspacing='0' cellpadding='5' >
					<tr>
					<td style="border-top-left-radius:30px;"; background='images/logos/inicio_boton_menu.jpg'  height='51' width='35'/>
					<td background='images/logos/fondo_boton_menu.jpg' height='50' >
						<a id='mainmenu' href='submenu.php?c=1'>COMPRAS .</a>
					</td>
					<td   background='images/logos/fondo_boton_menu.jpg' height='50' >
						<a id='mainmenu' href='submenu.php?c=2'>BODEGA .</a>
					</td>
					<td  background='images/logos/fondo_boton_menu.jpg' height='50'>
						<a id='mainmenu' href='submenu.php?c=3'>VENTAS.</a>
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
                   
                    
					<td background='images/logos/fin_boton_menu.jpg' height='50' width='35'/>
					</tr>
					</table>
					
					<?php
					break;
			
			case '4':
			
					?>
					<table border='0' bgcolor='#ffffff' cellspacing='0' cellpadding='5'>
					<tr>
					<td background='images/logos/inicio_boton_menu.jpg' height='51' width='35'/>
					<td  background='images/logos/fondo_boton_menu.jpg' height='50'>
						<a id='mainmenu' href='subventas.php?c=1'>VENTAS.</a>
					</td>
                     <td background='images/logos/fondo_boton_menu.jpg' height='50'>
						<a id='mainmenu' href='subventas.php?c=2'>COTIZACI�N.</a>
					</td>
                    <!----> <td background='images/logos/fondo_boton_menu.jpg' height='50'>
						<a id='mainmenu' href='submenu.php?c=10'>ARRIENDOS.</a>
					</td>
					<td background='images/logos/fin_boton_menu.jpg' height='50' width='35'/>
					</tr>
					</table>
					
					<?php
					break;
				
			case '3':
					
					?>
					<table border='0' bgcolor='#ffffff' cellspacing='0' cellpadding='5'>
					<tr>
					<td background='images/logos/inicio_boton_menu.jpg' height='51' width='35'/>

					<td   background='images/logos/fondo_boton_menu.jpg' height='50' >
						<a id='mainmenu' href='subbodega.php'>BODEGA .</a>
					</td>
					<td background='images/logos/fin_boton_menu.jpg' height='50' width='35'/>
					</tr>
					</table>
					
					<?php
					break;
			
			case '2':
					
					?>
					<table border='0' bgcolor='#ffffff' cellspacing='0' cellpadding='5'>
					<tr>
					<td background='images/logos/inicio_boton_menu.jpg' height='51' width='35'/>

					<td   background='images/logos/fondo_boton_menu.jpg' height='50' >
						<a id='mainmenu' href='subcaja.php'>CAJA .</a>
					</td>
					<td background='images/logos/fin_boton_menu.jpg' height='50' width='35'/>
					</tr>
					</table>
					
					<?php
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
		<?php
		if (empty($rutUsuario)) :?>
			
			<?php 	if (!($_SERVER['PHP_SELF'] == "/index.php")) : ?>
			<table border='0' width='100%' >
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
			
			<?php 	if (!($_SERVER['PHP_SELF'] == "/acceso.php")) exit();    ?>
						
			
		<?php endif ?>
		

	</td>
	</tr>
	</table>

