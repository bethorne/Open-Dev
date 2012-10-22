<?php
// iniciamos session para no propagar por url variables que nos van a ayudar
// a mejorar la rapidez y la presentacion.
session_start();
?>


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
<center>
<table border='0' height='400'>
  <tr>
    <td valign='top' ><?php include("../../header-zero.php")?>
</td>
  </tr>
  <tr>
    <td><label id='subtitulo'> BUSCAR PRODUCTO</label>
	<br/>
	<label id='comentariogris'> Complete uno de los campos para realizar la b&uacute;squeda. Si desea listar todos los productos, haga click en 'buscar nombre' con el campo vac&iacute;o.</label>
	<hr/></td>
  </tr>
  <tr>
    <td><?php
	// Parametros a ser usados por el Paginador y el Buscador
	$cantidadRegistrosPorPagina	= 10;
    $cantidadEnlaces            = 10; // Cantidad de enlaces que tendra el paginador.
    $totalRegistros             = 0;
    
    // Vemos si viene por el paginador o por el form del buscador
    if (isset($_POST['buscar'])) { // Viene por el buscador
        $pagina                 = 0;
        $inicioLimit            = 0;
        $_SESSION['BUSCAR']     = $_POST['buscar'];
        // Configuro el paginador
        require_once 'BuscadorFullText.php';
        $objBuscador				= new BuscadorFullText($_POST['buscar'], 'tbk_producto');
        // Agregamos los campos donde se buscara las palabras o criterios de busqueda
        $objBuscador->addCamposFullText('nombre_pro, 
codigo_pro');

        // Campos que se obtendran como resultado
        $objBuscador->addCamposResultado(array('nombre_pro', 'codigo_pro' , 'id_pro'));

        // Parametros que pueden variar en este caso debe coincidir el nombre del campo en el form html
        // con el nombre en la tabla MySQL
        if (isset($_POST['nombre_pro']) && $_POST['nombre_pro'] ) {
            $objBuscador->addParametrosVariables('nombre_pro' , '=');
        }
        // añade a la consulta una condicion fija
       
        
        // Para limitar la cantidad de caracteres en la salida de algun campo
       
        $objBuscador->limitarLargo('nombre_pro', 250);
        // Capturamos la consulta que se debe realizar y agregamos el limit
        $consulta                = $objBuscador->getConsultaMysql();
        $_SESSION['CONSULTA']    = $consulta;

    } else { // Viene por el paginador
        $pagina					= isset($_GET['pagina'])? $_GET['pagina'] : 0;
        $inicioLimit			= $cantidadRegistrosPorPagina * $pagina;
        $consulta               = isset($_SESSION['CONSULTA'])?$_SESSION['CONSULTA'] : '';
        $_SESSION['BUSCAR']     = isset($_SESSION['BUSCAR'])? $_SESSION['BUSCAR'] : '';
    }

	// incluimos e instanciamos la clase buscadorFullText, pasando como parametros
    // el valor del campo de busqueda y la tabla a buscar.
	?>
     <center>
	<form id="form1" name="form1" method="post" action="">
		<input type="text" name="buscar" id="buscar" value="<?php echo $_SESSION['BUSCAR']; ?>" />
			
	  	<input type="submit" name="enviar" id="enviar" value="Buscar" />
    </form>
    <label id='subtitulo'> Resultado B&uacute;queda </label>
			</center>
            
    <?php
	$consultaLimit      = sprintf($consulta, $inicioLimit, $cantidadRegistrosPorPagina);
    echo '</div>';
echo"<table border='0' cellspacing='5' cellpadding='5' width='750'  >";
    if ($consultaLimit) {
        // CONEXION MYSQL
        // Bueno ahora lo hacemos con la clasica mysql_connect.
    include("../../conector/conector.php");
        $resultados         = mysql_query($consultaLimit, $conn);
        $resultadosCantidad = mysql_fetch_row(mysql_query("SELECT FOUND_ROWS();", $conn));
        $totalRegistros     = $resultadosCantidad[0];   // Se usara en el Paginador
        // Mostramos los resultados de la forma clasica
					echo "				
						<tr>
							<td/>
						<th id='etiqueta'> CODIGO</th>
						<th id='etiqueta'> NOMBRE</th>
					
						<th id='etiqueta'> STOCK </th>
						<th id='etiqueta'> PRECIO</th>
						
						</tr>";
						
       $i=0;
        while($fila = mysql_fetch_array($resultados)) {
						//PRECIO PRODUCTO
								$srprecio = "SELECT  * FROM tbk_producto_valor WHERE id_pro = ".$fila['id_pro'];
							$respres  = mysql_query($srprecio, $conn);
							
							$fichaprecio = mysql_fetch_row($respres);
							
							$precio  = $fichaprecio[3];
							// STOCK producto
							
							$searchprecio = "SELECT  * FROM tbk_stock WHERE id_pro = ".$fila['id_pro'];
							$respre  = mysql_query($searchprecio, $conn);
							
							$fichastock = mysql_fetch_row($respre);
							
							$sminimo  = $fichastock[3];
							$salerta  = $fichastock[4];
							$smaximo  = $fichastock[5];
							$sstock   = $fichastock[2];
							
							
							
             echo "<tr><td  bordercolor='red' id='etiqueta' width='5'><a  href='#' onClick='window.opener.np.codigo.value=&quot; ". $fila['codigo_pro'] ."&quot; ; window.close()'><img src='../../images/flechaizq.jpg' border='0'></a></td><td id='data' width='20'>". $fila['codigo_pro'] ."</td><td id='data'>". $fila['nombre_pro'] ."</td><td id='data'><center>".$sstock."</center></td><td id='data'><center>".$precio."</center></td></tr>";
							$i++;
        }
	 
    } else { // Muestro Propiedades del Buscador
    ?></table>
     <div align="center">
  <center>
  <table border="0" cellpadding="0" cellspacing="0" width="450" id="AutoNumber1" height="105">
    <tr>
      <td height="17" colspan="2">Propiedades del Buscador de producto</td>
      </tr>
    <tr>
      <td width="11%" height="88">&nbsp;</td>
      <td width="89%" height="88">
        <p align="center"><span style="border-bottom: 1px dotted #000000">El Producto se puede Buscar por alguna palabra del producto por completo por Ej: &quot;cemento melon 25 Kg.&quot;</span> Ud. Puede buscar solamente la palabra Melon y buscara todos lo productos que contengan la palabra &quot;Melon&quot;, o tambien puede Buscar por Codigo de Producto si se lo sabe</td>
    </tr>
    </table>
  </center>
</div>

    <?php
    }
    // Comenzamos con el paginador.
    require_once 'Paginador.php';
    // Instanciamos la clase Paginador
    $paginador          = new Paginador();

    // Configuramos cuanto registros por pagina que debe ser igual a el limit de la consulta mysql
    $paginador->setCantidadRegistros($cantidadRegistrosPorPagina);
    $paginador->setCantidadEnlaces($cantidadEnlaces);
    
    // Y mandamos a paginar desde la pagina actual y le pasamos tambien el total
    // de registros de la consulta mysql.
    $datos              = $paginador->paginar($pagina, $totalRegistros);
    

    // Preguntamos si retorno algo, si retorno paginamos con los datos que nos da el
    // paginador que es un arreglo.
    if ($datos) {
        echo '<div align="center">';
        echo 'Pagina: ' . ($pagina + 1) . ' de ' . $paginador->getCantidadPaginas() . '<br />';
        echo 'Registros encontrados: ' . $totalRegistros . '<br />';
        foreach ($datos as $enlace) {
        ?>
            <a href="?pagina=<?php echo $enlace['numero']; ?>" title="<?php echo $enlace['title']; ?>" style="text-decoration:none;"><?php echo $enlace['vista']; ?></a>
        <?php
        }
        echo "";
    }
    ?></td>
  </tr>
</table>
</center>
