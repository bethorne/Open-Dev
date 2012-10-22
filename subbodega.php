<?php include("header.php") ?>

<?php


	$c = $_GET['c'];
	
	echo "<table border='0' width='1000' height='380' >";
	echo "<tr><td height='20' /></tr>";

					echo "<tr>";
					echo "<td valign='top'>";
					echo "	<table border='0' cellspacing='10' cellpadding='10'    >";
					echo "	<tr>";
					echo " 	<td valign='top' width='150'>";
					echo "		<img src='images/logos/botoncompras.jpg'>";
					echo " </td>";
					
					echo " <td id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg' >";

					echo "			<li> <label id='titulomainmenu'>PROVEEDORES</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='nuevoproveedor.php'>Nueva Ficha Proveedor</a></li>";
					echo "				<li><a id='mainmenu' href='editarproveedor.php'>Editar Ficha Proveedor</a></li>";
					echo "				<li><a id='mainmenu' href='editarproveedor.php'>Buscar Ficha Proveedor</a></li>";
				
				
					echo "			</ul>";
					echo "			</li>";
					echo "			<p/><br/>";
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

					echo " </td>";
					
					echo " <td id='mainmenu'  valign='top' height='400'  background='images/logos/fondo_menu.jpg'  >";

					echo "			<li> <label id='titulomainmenu'>PRODUCTOS en existencias</label>";
					echo "			<ul>";
					echo "				<li>PRODUCTO";
					echo "				<ul>";
					echo "					<li><a id='mainmenu' href='nuevoproducto.php'>Nuevo Producto</a> </li>";
					echo "					<li><a id='mainmenu' href='buscar.php'>Editar Producto </a></li>";
					echo "					<li><a id='mainmenu' href='buscar.php'>Buscar Producto</a> </li>";
					echo "					<li><a id='mainmenu' href='stock.php'>Stock  Producto</a> </li>";
					echo "					<li><a id='mainmenu' href='productovalor.php'>Fijar Precio Producto</a></li>";
					echo "				</ul>";
					echo "				</li>";
					echo "				<li> FAMILIAS ";
					echo "				<ul>";
					echo "					<li><a id='mainmenu' href='familias.php'>Administrar Familias de Producto</a> </li>";
					echo "				</ul>";
					echo "				</li>";
					echo "				<li> UNIDADES DE MEDIDA ";
					echo "				<ul>";
					echo "					<li><a id='mainmenu' href='unidadesdemedida.php'>Administrar Unidades de Medida</a> </li>";
					echo "				</ul>";
					echo "				</li>";
					echo "			</ul>";
					echo "			</li>";
					echo "			<p/><br/>";
					echo "			<li> <label id='titulomainmenu'>INFORMES BODEGA</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='informeproductos.php'>Informe Productos</a></li>";
					echo "				<li><a id='mainmenu' href='informeumedidas.php'>Informe Unidades de Medida</a></li>";
					echo "				<li><a id='mainmenu' href='informepedidos.php'>Listado de Pedidos General</a></li>";
					echo "				<li><a id='mainmenu' href='informemermas.php'>Informe de Mermas</a></li>";
					echo "			</ul>";
					echo "			</li>";
					echo " </td>";
					
					echo " <td id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg' >";

					echo "			<li> <label id='titulomainmenu'>KARDEX</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "					<li><a id='mainmenu' href='kardex_ver.php'>Kardex General</a> </li>";
					echo "					<li><a id='mainmenu' href='kardex_producto.php'>Kardex por Producto</a> </li>";
					echo "			</ul>";
					echo "			<p/><br/>";
					echo "			<li> <label id='titulomainmenu'>INVENTARIO</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='inventario_nuevo.php'>Levantar Inventario</a> </li>";
					echo "				<li><a id='mainmenu' href='pedido_nuevo.php'>Pedido Productos</a></li>";
					echo "				<li><a id='mainmenu' href='merma_nuevo.php'>Merma Productos</a></li>";
					echo "			</ul>";

					echo "			</li>";


		
					echo " </td>";
					echo " </tr>";
					echo " 	</table>";
					echo "</td>";
					echo "</tr>";
					

	echo "</table>";

?>
<?php include("footer.php"); ?>