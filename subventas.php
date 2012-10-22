<?php include("header.php") ?>

<?php


	$c = $_GET['c'];
	
	echo "<table border='0' width='950' height='380' >";
	echo "<tr><td height='20' /></tr>";

		SWITCH($c)
	{
		case '1' :
					echo "<tr>";
					echo "<td  valign='top'>";
					echo "	<table border='0' cellspacing='10' cellpadding='10'>";
					echo "	<tr>";
					echo " 	<td valign='top' width='200'>";
					echo "		<img src='images/logos/botonventas.jpg'>";
					echo " </td>";
					

					echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu'  valign='top' height='400'  background='images/logos/fondo_menu.jpg'  >";

					echo "			<li> <label id='titulomainmenu'>CLIENTES</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='nuevocliente.php'>Nueva Ficha Cliente </a></li>";
					echo "				<li><a id='mainmenu' href='editarcliente.php'>Editar Ficha Cliente</a></li>";
					echo "				<li><a id='mainmenu' href='buscarcliente.php'>Buscar Ficha Cliente</a></li>";
					echo "			</ul>";
					echo "			</li>";
					echo " 			<br/><p/>";
					echo "			<li> <label id='titulomainmenu'>PRODUCTOS </label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='kardex_producto.php'>Consulta Producto</li>";
					echo "			</ul>";
					echo "			</li>";
					echo " </td>";
					
										echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;' id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg'  >";

					echo "			<li> <label id='titulomainmenu'>VENTAS DIARIAS</label>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='historial.php'>Realizar Venta</a></li>";
					echo "			</ul>";
					echo "			</li>";
					echo " 			<br/><p/>";
					echo "			<li> <label id='titulomainmenu'>VALES</label>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='vales.php'>Buscar Vales</a></li>";
					echo "				<li><a id='mainmenu' href='vales_anular.php'>Anular Vale</a></li>";
					echo "				<li><a id='mainmenu' href='vales_anulados.php'>Ver Vales Anulados</a></li>";
					echo "			</ul>";
					echo "			</li>";


					echo " </td>";
					echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu' valign='top'  height='400'  background='images/logos/fondo_menu.jpg'  >";

					echo "			<li><label id='titulomainmenu'>DOCUMENTOS DE VENTA</label>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='facturas.php'>Buscar Documento</a></li>";
					echo "				<li><a id='mainmenu' href='facturas_anular.php'>Anular Documento</a></li>";
					echo "				<li><a id='mainmenu' href='facturas_anuladas.php'>Ver Documento Anulado</a></li>";
					echo "				<p/>";
					echo "				<li> ADMINISTRAR GUIAS";
					echo "				<ul>";
					echo "					<li><a id='mainmenu' href='crearguia.php'>Crear Gu&iacute;a de Despacho</a></li>";
					echo "					<li><a id='mainmenu' href='guias.php'>Buscar Gu&iacute;a de Despacho</a></li>";
					echo "					<li><a id='mainmenu' href='guias_anular.php'>Anular Gu&iacute;a de Despacho</a></li>";
					echo "					<li><a id='mainmenu' href='guias_anuladas.php'>Ver Gu&iacute;a de Despacho Anulada</a></li>";
					echo "				</ul>";
					echo "				</li>";
					echo "				<p/>";
					echo "				<li> ADMINISTRAR NOTAS DEBITO";
					echo "				<ul>";
					echo "					<li><a id='mainmenu' href='crearnotadebito.php'>Crear Nota D&eacute;bito</a></li>";
					echo "					<li><a id='mainmenu' href='notas.php'> Buscar Nota D&eacute;bito</a></li>";
					echo "				</ul>";
					echo "				</li>";
					echo "				<p/>";
					echo "				<li> ADMINISTRAR NOTAS CREDITO";
					echo "				<ul>";
					echo "					<li><a id='mainmenu' href='crearnotacredito.php'>Crear Nota Cr&eacute;dito</a></li>";
					echo "					<li><a id='mainmenu' href='notascredito.php'>Buscar Nota Cr&eacute;dito</a></li>";
					echo "				</ul>";
					echo "				</li>";
					echo "			</ul>";
					echo "			</li>";


					echo " </td>";
					echo " </tr>";
					echo " 	</table>";
					echo "</td>";
					echo "</tr>";
					break;
			case '2':
					echo "<tr>";
					echo "<td valign='top'>";
					echo "	<table border='0' cellspacing='10' cellpadding='10'>";
					echo "	<tr>";
					echo " 	<td valign='top'>";
					echo "		<img src='images/logos/botonventas.jpg'>";
					echo " </td>";
					
					echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg'  >";

					echo "			<li> <label id='titulomainmenu'>COTIZACION</label>";
					echo "			<ul>";
					echo "				<li><a target='_new' id='mainmenu' href='cotizacion.php'>Realizar Cotizacion</a></li>";
					echo "			</ul>";
					echo "			</li>";
					echo " 			<br/><p/>";
					echo "			<li> <label id='titulomainmenu'>VALES COTIZACION</label>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='valesCOTIZACION.php'>Buscar Cotizacion</a></li>";
					echo "				<li><a id='mainmenu' href='anular_cot.php'>Anular Vale Cotizacion</a></li>";
					echo "				<li><a id='mainmenu' href='cot_anulados.php'>Ver Vales Anulados</a></li>";
					echo "			</ul>";
					echo "			</li>";
					break;
			
		default:
				echo "<tr><td /></tr>";
				

		
				
	}
	
	echo "</table>";

?>
<?php include("footer.php"); ?>