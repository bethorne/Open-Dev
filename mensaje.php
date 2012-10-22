<?php

SWITCH ($tipomensaje)
{
case '0' :
			echo "<table border='0'  width='400' bgcolor='#ffdddd'><tr><td align='left'> <table border='0'><tr><td valign='top'><img src='images/alerta.gif'></td><td><label id='alerta'>".$texto."</label></td></tr></table> </td></tr></table>";
			break;
case '1' :
			echo "<table border='0'   width='400' bgcolor='#ddffdd'><tr><td align='left'> <table border='0'><tr><td valign='top'><img src='images/alerta.gif'></td><td><label id='alerta'>".$texto."</label></td></tr></table> </td></tr></table>";
			break;
case '2' :
			echo "<table border='0'   width='400' bgcolor='#ddffdd'><tr><td align='left'> <table border='0'><tr><td valign='top'><img src='images/alerta.gif'></td><td><label id='alerta'>".$texto."</label></td></tr></table> </td></tr></table>";
			break;
}
					



?>