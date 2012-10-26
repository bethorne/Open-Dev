<?php
#www.lawebdelprogramador.com
#Crear Tabla
$link=mysql_connect("localhost","root","");

//abrimos la base de datos
mysql_select_db("baro",$link);

$result=mysql_query("DROP TABLE tbk_docprocompras",$link);
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