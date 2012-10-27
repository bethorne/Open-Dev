 	<?php include('header.php') ?>

<?php


	$c = $_GET['c'];
	
	echo "<table border='0' width='1000' height='380'  >";
	echo "<tr><td height='20' /></tr>";
	
	SWITCH($c)
	{
		case '1' :
					echo "<tr>";
					echo "<td valign='top'>";
					echo "	<table border='0' cellspacing='10' cellpadding='10'    >";
					echo "	<tr>";
					echo " 	<td valign='top' >";
					echo "		<img src='images/logos/botoncompras.jpg'>";
					echo " </td>";
					
					echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg' >";

					echo "			<li> <label id='titulomainmenu'>PROVEEDORES</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='nuevoproveedor.php'>Nueva Ficha Proveedor</a></li>";
					echo "				<li><a id='mainmenu' href='editarproveedor.php'>Editar Ficha Proveedor</a></li>";
					echo "				<li><a id='mainmenu' href='editarproveedor.php'>Buscar Ficha Proveedor</a></li>";
					echo "				<li><a id='mainmenu' href='borrarproveedor.php'>Borrar Ficha Proveedor</a></li>";
				
					echo "			</ul>";
					echo "			</li>";
					echo "			<li> <label id='titulomainmenu'>CENTRO COSTOS</label>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='centrocostos.php'>Centro de Costos</a></li>";
					echo "			</ul>";
					echo "			</li>";
					echo "			<li> <label id='titulomainmenu'>PAGOS Y CTA. CORRIENTE</label>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='pagofacturapro.php'>Pagos de Facturas</a></li>";
					echo "				<li><a id='mainmenu' href='cuentacorrientepro.php'>Cartola Cuenta Corriente</a></li>";
					echo "			</ul>";
					echo "			</li>";
					echo " </td>";
					
					echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg'  >";

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
					echo " </tr>";
					echo " 	</table>";
					echo "</td>";
					echo "</tr>";
					
					break;
					
					
		case '2' :
					echo "<tr>";
					echo "<td valign='top'>";
					echo "	<table border='0' cellspacing='10' cellpadding='10'>";
					echo "	<tr>";
					echo " 	<td valign='top'>";
					echo "		<img src='images/logos/botonbodega.jpg'>";
					echo " </td>";
					
					echo " <td  style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;' id='mainmenu'  valign='top' height='400'  background='images/logos/fondo_menu.jpg'  >";

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
					echo " </td>";
					
					echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg' >";

					echo "			<li> <label id='titulomainmenu'>KARDEX</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "					<li><a id='mainmenu' href='kardex_ver.php'>Kardex General</a> </li>";
					echo "					<li><a id='mainmenu' href='kardex_producto.php'>Kardex por Producto</a> </li>";
					echo "			</ul>";
					echo " </td>";
					
					echo " <td  style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu'  valign='top' height='400'  background='images/logos/fondo_menu.jpg' >";

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
					
					break;
					
		
		case '3' :
					echo "<tr>";
					echo "<td valign='top'>";
					echo "	<table border='0' cellspacing='10' cellpadding='10'>";
					echo "	<tr>";
					echo " 	<td valign='top'>";
					echo "		<img src='images/logos/botonventas.jpg'>";
					echo " </td>";
					
					echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg'  >";

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
					echo "				<p/>";
					echo "				<li> FACTURACION DE GUIAS DE DESPACHO";
					echo "				<ul>";
					echo "					<li><a id='mainmenu' href='consultarguiasdeventa.php'>Facturar Gu&iacute;as</a></li>";
					echo "				</ul>";
					echo "				</li>";
					echo "				<p/>";
					echo "				<li> FACTURACION DE NVF";
					echo "				<ul>";
					echo "					<li><a id='mainmenu' href='consultarnvfdeventa.php'>Facturar NVF</a></li>";
					echo "				</ul>";
					echo "				</li>";
					echo "			</ul>";
					echo "			</li>";


					echo " </td>";
					echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu'  valign='top' height='400'  background='images/logos/fondo_menu.jpg'  >";

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
					echo "				<li><a id='mainmenu' target='popup' onClick='window.open(this.href, this.target, 'width=500,height=400'); return false;' href='gastolistado.php'>Informe de Gastos</li>";
					echo "			</ul>";
					echo "			</li>";
					echo " </td>";
					echo " </tr>";
					echo " 	</table>";
					echo "</td>";
					echo "</tr>";
					
					break;
					
		case '4' :
					echo "<tr>";
					echo "<td valign='top'>";
					echo "	<table border='0' cellspacing='10' cellpadding='10' >";
					echo "	<tr>";
					echo " 	<td valign='top'>";
					echo "		<img src='images/logos/botonpagos.jpg'>";
					echo "  </td>";

					echo "  </tr>";
					echo "  </table>";
					echo "</td>";
					echo "</tr>";
					
					break;
		case '5' :
					echo "<tr>";
					echo "<td valign='top' >";
					echo "	<table border='0' cellspacing='10' cellpadding='10' >";
					echo "	<tr>";
					echo " 	<td valign='top'>";
					echo "		<img src='images/logos/botonclientes.jpg'>";
					echo " </td>";
					
					echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg' >";

					echo "			<li> <label id='titulomainmenu'>CLIENTES</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='nuevocliente.php'>Nueva Ficha Cliente </a></li>";
					echo "				<li><a id='mainmenu' href='editarcliente.php'>Editar Ficha Cliente</a></li>";
					echo "				<li><a id='mainmenu' href='buscarcliente.php'>Buscar Ficha Cliente</a></li>";
					echo "			</ul>";
					echo "			</li>";
					echo " </td>";		
					
					echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu' valign='top'height='400'  background='images/logos/fondo_menu.jpg'  >";
					echo "			<li> <label id='titulomainmenu'>PAGOS</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='pagos2.php'>Pago de Abono</a></li>";
					echo "				<li><a id='mainmenu' href='pagos.php'>Pago de Factura</a></li>";
					echo "				<li><a id='mainmenu' href='pagos3.php'>Pago de Boleta</a></li>";
					echo "			</ul>";
					echo "			</li>";
					echo "			<br/><p/>";
					echo "			<li> <label id='titulomainmenu'>ABONOS</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='informeabonocliente.php'>Informe Abonos de Cliente</a></li>";
					echo "			</ul>";
					echo "			</li>";

					echo " </td>";
					
					echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg' >";

					echo "			<li> <label id='titulomainmenu'>CREDITOS</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='buscarclientecredito.php'>Nuevo Cr&eacute;dito a Cliente</li>";
					echo "				<li><a id='mainmenu' href='buscarclientecreditoautorizado.php'>Autorizar Nuevo Cr&eacute;dito</a></li>";
					echo "				<li><a id='mainmenu' href='creditoshistorial.php'>Historia de Cr&eacute;ditos a Cliente</a></li>";
					echo "			</ul>";
					echo "			</li>";

					echo " </td>";
					echo " </tr>";
					echo " </table>";
					echo "</td>";
					echo "</tr>";
					
					break;					
		case '6' :
					echo "<tr>";
					echo "<td valign='top'>";
					echo "	<table border='0' cellspacing='10' cellpadding='10'>";
					echo "	<tr>";
					echo " 	<td valign='top'>";
					echo "		<img src='images/logos/botoninformes.jpg'>";
					echo " </td>";
					echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg'  >";

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

					echo " </td>";
					echo " <td  style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;' id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg'  >";

					echo "			<li> <label id='titulomainmenu'>COMPRAS</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='informeproveedores.php'>Informe Proveedores</a></li>";
					echo "				<li><a id='mainmenu' href='informecompras.php'>Informe Compras</a> </li>";
					echo "			</ul>";
					echo "			</li>";
					
					echo "			<br/><p/>";
					echo "			<li> <label id='titulomainmenu'>VENTAS</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='informeventas.php'>Informe Ventas Diarias</a><br/>(por documentos)</li>";
					echo "				<li><a id='mainmenu' href='informecajas.php'>Informe Cajas Diarias</a><br/>(por cajas diarias)</li>";
					
					echo "			</ul>";
					echo "			</li>";
					
					echo "			<br/><p/>";
					echo "			<li> <label id='titulomainmenu'>GRAFICOS</label>";
					echo "			<p/>";
						echo "			<ul>";
					echo "				<li><a id='mainmenu' href='graficosventas.php'>Graficos de Ventas</a><br/></li>";
					echo "				<li><a id='mainmenu' href='graficoscompras.php'>Graficos de Compras</a><br/></li>";
					echo "				<li><a id='mainmenu' href='graficosdeudas.php'>Graficos de Deudas</a><br/></li>";
					echo "				<li><a id='mainmenu' href='prod_mas_top.php'>Graficos productos mas vendidos</a><br/></li>";
					echo "			</ul>";
					echo "			</li>";

					echo " </td>";
					echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg' >";

					echo "			<li> <label id='titulomainmenu'>BODEGA</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='informeproductos.php'>Informe Productos</a></li>";
					echo "				<li><a id='mainmenu' href='informeumedidas.php'>Informe Unidades de Medida</a></li>";
					echo "				<li><a id='mainmenu' href='informepedidos.php'>Listado de Pedidos General</a></li>";
					echo "				<li><a id='mainmenu' href='informemermas.php'>Informe de Mermas</a></li>";
					echo "			</ul>";
					echo "			</li>";

					echo " </td>";
					echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg' >";

					echo "			<li> <label id='titulomainmenu'>CLIENTES</label>";
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
					echo " </table>";
					echo "</td>";
					echo "</tr>";
					
					break;

		case '7' :
					echo "<tr>";
					echo "<td valign='top'>";
					echo "	<table border='0' cellspacing='10' cellpadding='10'>";
					echo "	<tr>";
					echo " 	<td valign='top'>";
					echo "		<img src='images/logos/botonadministracion.jpg'>";
					echo " </td>";
					echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg' >";

					echo "			<li> <label id='titulomainmenu'>INDICE DE PAGOS</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='ip.php'>&Iacute;ndice de Pagos</a></li>";
					echo "				<li><a id='mainmenu' href='actualizar.php'>Actualizar Base de dato</a></li>";
					echo "				<li><a id='mainmenu' href='borrarbd.php'>borrar Base de dato</a></li>";
					echo "			</ul>";
					echo "			</li>";

					echo " </td>";

					echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg'  >";

					echo "			<li><label id='titulomainmenu'> ADMINISTRACION DE USUARIOS</label>";
					echo "			<p/>";
					echo "			<ul>";
					
					echo "				<li><a id='mainmenu' href='usuario.php'>Nuevo Usuario</a></li>";
					echo "				<li><a id='mainmenu' href='adminusuarios.php'>Administrar Perfiles de Usuario</a></li>";
					echo "				<li><a id='mainmenu' href='privilegios.php'>Administrar Privilegios de Usuario</a></li>";

					echo "			</ul>";
					echo "			</li>";
					echo "			<br/><p/>";
					
					echo "			<li><label id='titulomainmenu'> PARAMETROS DEL SISTEMA</label>";
					echo "			<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='parametros.php'>Administra Par&aacute;metros del Sistema </a></li>";

					echo "			</ul>";
					echo "			</li>";

					echo " </td>";
					echo " </tr>";
					echo " 	</table>";
					echo "</td>";
					echo "</tr>";
					
					break;
		
			case '8' : //LIBRO CONTABLE
					echo "<tr>";
					echo "<td valign='top' >";
					echo "	<table border='0' cellspacing='10' cellpadding='10' >";
					echo "	<tr>";
					echo " 	<td    valign='top'> </td>";
					echo "			<li> <label id='titulomainmenu'>LIBRO DE CONTABLE</label>";
					echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg' > </li>
					<p/>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' target='_blank' href='informeventas1.php'>Libro de Ventas</a></li>";
					echo "				<li><a id='mainmenu' href='informecompralbr.php'>Libro de Compras</a></li>";
					echo "			</ul>";
					echo" </td>";		
					
					
					
					echo " </tr>";
					echo " </table>";
					echo "</td>";
					echo "</tr>";
					break;
					
		/*	case '9' : //COBRANZA
					echo "<tr>";
					echo "<td valign='top' >";
					echo "	<table border='0' cellspacing='10' cellpadding='10' >";
					echo "	<tr>";
					echo " 	<td valign='top'>&nbsp;</td>";
					echo "			<li> <label id='titulomainmenu'>LIBRO DE COBRANZA</label>";
					echo " <td id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg' >&nbsp;</td>";		
					
					echo " <td id='mainmenu' valign='top'height='400'  background='images/logos/fondo_menu.jpg'  ></td>";
					
					echo " <td id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg' >&nbsp;</td>";
					echo " </tr>";
					echo " </table>";
					echo "</td>";
					echo "</tr>";
					break;*/	
					
			case '10' ://ARRIENDO
				echo "<tr>";
					echo "<td valign='top'>";
					echo "	<table border='0' cellspacing='10' cellpadding='10'>";
					echo "	<tr>";
					echo " 	<td valign='top'>";
					echo "		<img src='images/logos/botonventas.jpg'>";
					echo " </td>";
					
					echo " <td style=' background-color:#FFF; z-index:5;  border-bottom-left-radius:30px; border-top-right-radius:30px; box-shadow: 5px 5px 5px #999;'  id='mainmenu' valign='top' height='400'  background='images/logos/fondo_menu.jpg'  >";

					echo "			<li> <label id='titulomainmenu'>ARRIENDO</label>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='historialcotizacion.php'>Realizar Arriendo</a></li>";
					echo "			</ul>";
					echo "			</li>";
					echo " 			<br/><p/>";
					echo "			<li> <label id='titulomainmenu'>VALES ARRIENDO</label>";
					echo "			<ul>";
					echo "				<li><a id='mainmenu' href='valesarriendo.php'>Buscar Arriendo</a></li>";
					echo "				<li><a id='mainmenu' href='vales_anular_arriendos.php'>Anular Vale Arriendo</a></li>";
					echo "				<li><a id='mainmenu' href='vales_anulados_arriendos.php'>Ver Vales Anulados</a></li>";
					echo "			</ul>";
					echo "			</li>";	/**/

										
		default:
		
				echo "<tr><td /></tr>";
				

	}
	echo "</table>";

?>
<?php include("footer.php"); ?>