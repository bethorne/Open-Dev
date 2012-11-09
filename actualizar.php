
<?php
#www.lawebdelprogramador.com
#Crear Tabla
$link=mysql_connect("localhost","root","root");

//abrimos la base de datos
mysql_select_db("baro",$link);

$result=mysql_query("ALTER TABLE  `tbk_documentocompra` ADD  `pago1` INT( 5 ) NOT NULL ,
ADD  `bancocheque` INT( 5 ) NOT NULL",$link);
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
