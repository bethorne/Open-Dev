<?php include("header.php") ?>

<?php


	$c = $_GET['c'];
	
	echo "<table border='0' width='1000' height='380' >";
	echo "<tr><td height='20' /></tr>";

					echo "<tr>";
					echo " 	<td valign='top' >";
					echo "		<img src='images/logos/botoncaja.jpg'>";
					echo " </td>";
					echo " <td id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg' >";


					echo "			<li><label id='titulomainmenu'> COMPRAS</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li> <a id='mainmenu' href='nuevafacturacompra.php'>Nueva Compra</a></li>";
					echo "				<li> <a id='mainmenu' href='documentoscompra.php'>Buscar Compra </a> </li>";
					echo "				<li> <a id='mainmenu' href='documentoscompra_anular.php'>Anular Compra</a> </li>";
					echo "				<li> GUIAS";
					echo "				<ul>";
					echo "					<li> <a id='mainmenu' href='crearguiacompra.php'>Nueva Compra con Gu&iacute;a </li>";
					echo "					<li> <a id='mainmenu' href='guiascompra.php'>Buscar Gu&iacute;a</a> </li>";
					echo "				</ul>";
					echo "				</li>";
					echo "			</ul>";
					echo "			</li>";
					echo "			<p/><br/>";
					
					echo "			<li> <label id='titulomainmenu'>CREDITOS</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='buscarclientecredito.php'>Nuevo Cr&eacute;dito a Cliente</li>";
					echo "				<li><a id='mainmenu' href='buscarclientecreditoautorizado.php'>Autorizar Nuevo Cr&eacute;dito</a></li>";
					echo "				<li><a id='mainmenu' href='creditoshistorial.php'>Historia de Cr&eacute;ditos a Cliente</a></li>";
					echo "			</ul>";
					echo "			</li>";
					echo " </td>";


					echo " <td id='mainmenu'  valign='top' height='400'  background='images/logos/fondo_menu.jpg'  >";

					echo "			<li><label id='titulomainmenu'> CAJA</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='cajachica.php'>Ingresar Caja Chica del D&iacute;a</a></li>";
					echo "				<li><a id='mainmenu' href='cajadiaria.php'>Arqueo de Caja</a></li>";
					echo "				<li><a id='mainmenu' href='informecajas.php'>Informe Cajas Diarias Realizas</a></li>";
					echo "			</ul>";
					echo "			</li>";
					echo " 			<br/><p/>";
					echo "			<li> <label id='titulomainmenu'>GASTOS </label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='gastonuevo.php'>Ingresar Nuevo Gasto</li>";
					echo "				<li><a id='mainmenu' href='gastolistado.php'>Informe de Gastos</li>";
					echo "			</ul>";
					echo "			</li>";
					echo " 			<br/><p/>";
					echo "			<li> <label id='titulomainmenu'>PAGOS</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='pagos2.php'>Pago de Abono</a></li>";
					echo "				<li><a id='mainmenu' href='pagos.php'>Pago de Factura</a></li>";
					echo "				<li><a id='mainmenu' href='pagos3.php'>Pago de Boleta</a></li>";
					echo "			</ul>";
					echo "			</li>";


					echo " </td>";
					
					echo " <td id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg' >";
					

					echo "			<li> <label id='titulomainmenu'>IMPRESIONES</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='imprimirdoc.php'>Imprimir Factura</a></li>";
					echo "				<li><a id='mainmenu' href='imprimirguia.php'>Imprimir Gu&iacute;a</li>";
					echo "				<li><a id='mainmenu' href='imprimirnota.php'>Imprimir Notas</a></li>";
					echo "				<li><a id='mainmenu' href='imprimirboleta.php'>Imprimir Boleta</a></li>";
					echo "			</ul>";
					echo "			</ul>";
					echo "			</li>";
					echo " 			<br/><p/>";
					echo "			<li> <label id='titulomainmenu'>INFORME COMPRAS</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='informeproveedores.php'>Informe Proveedores</a></li>";
					echo "				<li><a id='mainmenu' href='informecompras.php'>Informe Compras</a> </li>";
					echo "			</ul>";
					echo "			</li>";
					echo "			<br/><p/>";
					echo "			<li> <label id='titulomainmenu'>INFORME VENTAS</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='informeventas.php'>Informe Ventas Diarias</a><br/>(por documentos)</li>";
					echo "				<li><a id='mainmenu' href='informecajas.php'>Informe Cajas Diarias</a><br/>(por cajas diarias)</li>";
					
					echo "			</ul>";
					echo "			</li>";

					echo " </td>";
					echo " <td id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg' >";

					echo "			<li> <label id='titulomainmenu'>INFORME CLIENTES</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='informeclientes.php'>Listado de Clientes</a></li>";
					echo "				<li><a id='mainmenu' href='informedeudasclientes.php'>Informe de Deudas </a></li>";
					echo "				<li><a id='mainmenu' href='informecreditosclientes.php'>Informede  Cr&eacute;ditos</a></li>";
					echo "				<li><a id='mainmenu' href='informeabonosclientes.php'> Informe de Abonos</a></li>";
					echo "			</ul>";
					echo "			</li>";

					
					echo " </td>";
					echo " </tr>";
					echo " 	</table>";
					echo "</td>";
					echo "</tr>";

				echo "<tr><td /></tr>";
				


	echo "</table>";

?>
<?php include("footer.php"); ?>