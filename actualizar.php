<?php
#www.lawebdelprogramador.com
#Crear Tabla
$link=mysql_connect("localhost","root","root");

//abrimos la base de datos
mysql_select_db("baro",$link);

$result=mysql_query("CREATE TABLE IF NOT EXISTS `tbk_docprocompra` (
  `id_docc` bigint(20) NOT NULL,
  `cbarra_pro` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `tipodespacho_fpc` int(2) DEFAULT NULL,
  `cantidad_fpc` int(11) DEFAULT NULL,
  `valor_fpc` bigint(20) DEFAULT NULL,
  `guia_fpc` int(11) DEFAULT NULL COMMENT 'cantidad recepcionada mediante guia',
  `estado_fpc` int(11) DEFAULT NULL COMMENT '0: aceptado 1: rechazado',
  `descuen1` bigint(20) DEFAULT NULL,
  `descuen2` bigint(20) DEFAULT NULL,
  `descuen3` bigint(20) DEFAULT NULL,
  KEY `cbarra_pro` (`cbarra_pro`),
  KEY `tipodespacho_fpc` (`tipodespacho_fpc`),
  KEY `id_fact` (`id_docc`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Productos por Documento'",$link);
# para crear un campo unico y autonumerico seria:
# id smallint not null auto_increment, primary key(id)
if($result==0)
{
	printf("No se ha podido crear la tabla<P>\n");
}else{
	printf("La tabla se ha creado correctamente<P>\n");
}
mysql_close($link);
?>