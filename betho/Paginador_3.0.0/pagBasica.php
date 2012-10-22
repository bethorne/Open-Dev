<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="estilosPaginador/digg.css" type="text/css" rel="stylesheet"></link>
<title>ObjetivoPHP.com - Paginador 2.3.0</title>
</head>
<body>
    <?php
    error_reporting(E_ALL | E_STRICT);
    $cantidadRegistrosPorPagina	= 10;
    $cantidadEnlaces            = 10;
    $totalRegistros             = 2365;
    $pagina                     = isset($_GET['pagina'])? $_GET['pagina'] : 0;
    
    require_once 'Paginador.php';
    $paginador  = new Paginador();

    $paginador->setCantidadRegistros($cantidadRegistrosPorPagina);
     /** AQUI INCLUIREMOS NUESTRO CODIGO DE CONFIGURACION DE ESTILOS */
     //$paginador->setClass('numero',          '<>');
    //$paginador->setClass('actual',          'active');
    //$paginador->setClass('siguiente',       'next',         'next-off');
    //$paginador->setClass('bloqueAnterior',  'previous',     'previous-off');
    //$paginador->setClass('bloqueSiguiente', 'next',         'next-off');
    //$paginador->setClass('primero',         'previous',     'previous-off');
    //$paginador->setClass('ultimo',          'next',         'next-off');
    

    $paginador->setCantidadEnlaces(7);
    $paginador->setOmitir(array('primero',
                                'bloqueAnterior',
                                'ultimo',
                                'bloqueSiguiente'));
    $paginador->setMarcador(null, null);
    
    $paginador->setTitulosVista('anterior',  '<<Previous');
    $paginador->setTitulosVista('siguiente', 'next>>');
    
    $paginador->setClass('anterior',        'previous',     'previous-off');
    $paginador->setClass('siguiente',       'next',         'next-off');
    $paginador->setClass('actual',          'active');
    $paginador->setClass('numero',          '<>');
    
    $datos      = $paginador->paginar($pagina, $totalRegistros);
    $enlaces    = $paginador->getHtmlPaginacion('pagina', 'li');
    ?>
    <ul id="pagination-digg">
    <?php
        foreach ($enlaces as $enlace) {
            echo $enlace . "\n";
        }
    ?>
    </ul>
</body>
</html>