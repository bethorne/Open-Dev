<?php
  include("header.php")  ;
	 
	$busca =0;
	$periodo 	= $_POST['periodo'];
	$yearguia	= $_POST['yearguia'];
	
if (($periodo != '') AND ($yearguia != ''))
	{
	
		//echo "<p> Hay datos,, preguntemos ";
	
		
			//$searchgv = "SELECT * FROM tbk_documento WHERE tipo_doc = 2  AND estado_doc = 1 AND SUBSTR(fecha_doc, 7,4) = '".$yearguia."'  AND SUBSTR(fecha_doc, 4,2) ='".$periodo."' ORDER BY  rut_cli ASC";
			//$searchgv="SELECT *  FROM tbk_documento WHERE codigo_doc <>  '' AND SUBSTR( fecha_doc, 4, 2 ) =  '".$periodo."' AND SUBSTR( fecha_doc, 7, 4 ) =  '".$yearguia."' ORDER BY fecha_doc";
		
			$busca = 1;
	}
// archivos incluidos. Librerías PHP para poder graficar.
include "FusionCharts.php";
include "Functions.php";


/*CONECTAR BD Y GUARDAR DATOS*/
//SELECT `fecha_doc`,`total_doc`  FROM tbk_documento WHERE codigo_doc <>  '' AND SUBSTR( fecha_doc, 4, 2 ) =  '07' AND SUBSTR( fecha_doc, 7, 4 ) =  '2012' ORDER BY fecha_doc
include("../baro/conector/conector.php");
			
			?>
           
              <?php
//echo"$fecha - $intTotalAnio1";

// Gráfico de Barras. 4 Variables, 4 barras.
// Estas variables serán usadas para representar los valores de cada unas de las 4 barras.
// Inicializo las variables a utilizar.

// $strXML: Para concatenar los parámetros finales para el gráfico.
$strXML = "";
// Armo los parámetros para el gráfico. Todos estos datos se concatenan en una variable.
// Encabezado de la variable XML. Comienza con la etiqueta "Chart".
// caption: define el título del gráfico.
// bgColor: define el color de fondo que tendrá el gráfico.
// baseFontSize: Tamaño de la fuente que se usará en el gráfico.
// showValues: = 1 indica que se mostrarán los valores de cada barra. = 0 No mostrará los valores en el gráfico.
// xAxisName: define el texto que irá sobre el eje X. Abajo del gráfico. También está xAxisName.
$strXML = "<chart caption = 'Total Deudas ' bgColor='#CDDEE5' baseFontSize='12' showValues='1' xAxisName='Meses' formatNumberScale='0'>";
//$strXML ="<chart palette='4' decimals='0' enableSmartLabels='1' enableRotation='0' bgColor='99CCFF,FFFFFF' bgAlpha='40,100' bgRatio='0,100' bgAngle='360' showBorder='1' startingAngle='70'>";
// Armado de cada barra.
// set label: asigno el nombre de cada barra.
// value: asigno el valor para cada barra.
// color: color que tendrá cada barra. Si no lo defino, tomará colores por defecto.
//	$searchgv="SELECT `fecha_doc`,`total_doc`  FROM tbk_documento WHERE codigo_doc <>  '' AND SUBSTR( fecha_doc, 4, 2 ) =  '".$periodo."' AND SUBSTR( fecha_doc, 7, 4 ) =  '".$yearguia."' ORDER BY fecha_doc";
 //$searchgv=" SELECT `fecha_doc`,sum(`total_doc`)  FROM tbk_documento WHERE codigo_doc <>  '' group by SUBSTR( fecha_doc, 4, 2 )";
$searchgv="SELECT  `fecha_pc` , SUM(  `valor_cuota_pc` ) 
FROM tbk_pago_cuota
WHERE  `valor_cuota_atraso_pc` <>  ''
GROUP BY SUBSTR( fecha_pc, 4, 2 ) ";
$resp = mysql_query($searchgv, $conn);
		$i=0;
		
		WHILE($linea = mysql_fetch_row($resp))
			{

				$fecha			= $linea[0];
				$intTotalAnio1 = $linea[1];
			
$strXML .= "<set label ='".$fecha."'  value ='".$intTotalAnio1."' color = 'EA1000' />";

			}
// Cerramos la etiqueta "chart".
$strXML .= "</chart>";

// Por último imprimo el gráfico.
// renderChartHTML: función que se encuentra en el archivo FusionCharts.php
// Envía varios parámetros.
// 1er parámetro: indica la ruta y nombre del archivo "swf" que contiene el gráfico. En este caso Columnas ( barras) 3D
// 2do parámetro: indica el archivo "xml" a usarse para graficar. En este caso queda vacío "", ya que los parámetros lo pasamos por PHP.
// 3er parámetro: $strXML, es el archivo parámetro para el gráfico. 
// 4to parámetro: "ejemplo". Es el identificador del gráfico. Puede ser cualquier nombre.
// 5to y 6to parámetro: indica ancho y alto que tendrá el gráfico.
// 7mo parámetro: "false". Trata del "modo debug". No es im,portante en nuestro caso, pero pueden ponerlo a true ara probarlo.
echo renderChartHTML("Column3D.swf", "",$strXML, "Deudas", 500, 400, false);


$i++;
		
?>
<table border='0' cellspacing='5' cellpadding='5'>
			<tr>
			<td id='etiqueta'>
		
			
				<a href="javascript:window.history.go(-1)"> Volver </a>
		
			
			</td>
			</tr>
			</table>