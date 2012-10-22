<?php

session_start();

if (!empty($_POST[crut])) $_SESSION[UID]= $_POST[crut];
if (!empty($_GET[puid])) $_SESSION[PID]= $_GET[puid];

$rut  = $_SESSION[UID];
$puid = $_SESSION[PID];
$iva  = $_SESSION[IVA];


if ($_GET[s] =="x") 
	{
		session_unset();
		$rut="";
		$puid="";
	}

?>

