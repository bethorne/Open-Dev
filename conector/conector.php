<?php

		$servidor= "localhost";
		$dbs="baro";
		$login="root"; 
		$pass= "root"; 
		
		$conn=mysql_connect($servidor,$login ,$pass ) or die ('No Puedo conectar a la Base de Datos. Mensaje: ' . mysql_error());
		mysql_select_db($dbs);



?>