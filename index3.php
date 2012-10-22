<?php
//header ("Location: home.php"); 
	include("fichaempresa.php");
?>

<html>
<head>
<style>
#titulo
	{

		font-family: Trebuchet MS;
		font-size: 32px;
		font-weight:bold;
		color:#FFF;
	}

	#subtitulo
	{

		font-family: Trebuchet MS;
		font-size: 18px;
		font-weight:bold;
		color:#FFF;


	}

	#menu
	{

		font-family :Trebuchet MS, Arial;
		font-size:12px;
		color:#FFF;
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
		font-size: 11px;
		font-family: Trebuchet MS, Arial;
		font-weight:bold;
		font-size:12px;
		color:#00a;
		border: solid 1px #ccc;
	}	
	
	
	
	#usuario
	{

		font-family: Trebuchet MS;
		font-size: 14px;
		font-weight:bold;
		color:#FFF;
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
	
	td#atrasocuota
	{
		
		background  :#daa;
		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#ffffff;

		
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
	
	#etiquetacredito
	{
		
		background  :#bac;
		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#fff;
		text-decoration:none;

		
	}
	
	#etiquetadebito
	{
		
		background  :#cba;
		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#fff;
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
	
	#comentariogris
	{

		font-family :arial;
		font-size   :11px;
		font-weight :bold;		
		color       :#fff;

		
	}


	td#data
	{

		font-family :arial;
		font-size   :11px;
		color       :#555555;
		border      : solid 1px #aaaaaa;
		background  :#fff;
		
	}
	
	td#data4
	{

		font-family :arial;
		font-size   :11px;
		color       :#555555;
		border      :solid 1px #aaaaaa;
		background  :#eef;
		
	}
	


		
	td#data2
	{

		font-family :times,arial;
		font-size   :14px;
		font-style	: italic;
		color       :#555555;
		border      : solid 1px #aaaaaa;
		background  :#ffffff;
		
	}
	
	
	td#data3
	{

		font-family :times,arial;
		font-size   :14px;
		font-style	: italic;
		color       :#555555;
		border      :none;
		
		
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
	
	td#mainmenu
	{
		font-family :arial;
		font-size   :11px;
		color       :#888;
		font-weight :bold;	
		border      :none;
		text-decoration:none;	
		border-right:solid 2px #ccc;
		border-top:solid 1px #eee;	
		border-bottom:solid 2px #ccc;
		padding-top:30px;
		/*background-color:#eef;*/
		
	}
	
	a#mainmenu
	{
		font-family :arial;
		font-size   :11px;
		color       :#888;
		font-weight :bold;	
		border      :none;
		text-decoration:none;		
		
	}
	a:hover#mainmenu
	{
		font-family :arial;
		font-size   :11px;
		color       :#fb4;
		font-weight :bold;	
		border      :none;
		text-decoration:none;		
		
	}
	
	#titulomainmenu
	{
		font-family :trebuchet ms,verdana, arial;
		font-size   :12px;
		color       :#fff;
		font-weight :bold;	
		padding:5px;
		background-color:#bbb;

	
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


body{
		
		
		z-index:1;
		
		background-size:contain;
		
		background-repeat:no-repeat;
		background-position:center;
		background-color:#354b9b;
		}
</style>
</head>

<!--<BODY bgcolor="#ffffff"> -->
 <BODY > 
 
	<table border="0" width="100%"  >
	<tr>
	<td align='left' >
	
		
		<?php include("fichaempresa.php"); ?>
		
		<table border='0' width='100%'>
		<tr>
		<td align='left' width='80'>
				<img height='100' width='200' src='<?=$logo?>'>
		</td>
		<td>
			<label id='menu'> <?=$Empresaencabezado?></label>
			<br/>
			<label id='subtitulo'><?=$Empresanombre?></label>
		</td>

		</tr>
		</table>
			</td>
			</tr>
			</table>
			
			<table border='0' width='100%' >
			<tr>
			<td  valign='top' align='right' height='30'>
				 <a id="menualternativo" href="#"><b>Cont&aacute;ctanos</b></a> 
				| <a id="menualternativo" href="acceso.php"><b>login</b></a>
				</td>
			</tr>
			</table>
			
			
			
			<table border="0" width="100%"  >
			<tr>
			<td align='center'>
			
				<img src='images/logos/intro.png'>

			</td>
			</tr>
			</table>
</td>
</tr>
</table>
</BODY>
</HTML>
