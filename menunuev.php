
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

  $("#demo img").load(function() {
    $(this).wrap(function(){
      return '<span class="image-wrap ' + $(this).attr('class') + '" style="position:relative; display:inline-block; background:url(' + $(this).attr('src') + ') no-repeat center center; width: ' + $(this).width() + 'px; height: ' + $(this).height() + 'px;" />';
    });
    $(this).css("opacity","0");
  });

});
</script>
 
<style>

.box {
	margin: 0 0 50px;
	border-top: solid 1px #ccc;
	background:#354b9b;
}
.body{
	
	background-color:#354b9b;
	}
 

/************************************************************************************
REFLECTION
*************************************************************************************/
.reflection .image-wrap {
	background-color:#354b9b;
	-webkit-box-shadow: inset 0 0 1px rgba(0,0,0,.5), inset 0 2px 0 rgba(255,255,255,.5), inset 0 -1px 0 rgba(0,0,0,.5);
	-moz-box-shadow: inset 0 0 1px rgba(0,0,0,.5), inset 0 2px 0 rgba(255,255,255,.5), inset 0 -1px 0 rgba(0,0,0,.5);
	box-shadow: inset 0 0 1px rgba(0,0,0,.5), inset 0 2px 0 rgba(255,255,255,.5), inset 0 -1px 0 rgba(0,0,0,.5);
	-webkit-transition: .5s;
	-moz-transition: .5s;
	transition: .5s;
	-webkit-border-radius: 20px;
	-moz-border-radius: 20px;
	border-radius: 20px;
}
.reflection .image-wrap:after {
	background-color:#354b9b;
	position: absolute;
	content: ' ';
	width: 100%;
	height: 30px;
	bottom: -31px;
	left: 0;
	-webkit-border-top-left-radius: 20px;
	-webkit-border-top-right-radius: 20px;
	-moz-border-radius-topleft: 20px;
	-moz-border-radius-topright: 20px;
	border-top-left-radius: 20px;
	border-top-right-radius: 20px;
	background: -moz-linear-gradient(top, rgba(0,0,0,.3) 0%, rgba(255,255,255,0) 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,.3)), color-stop(100%,rgba(255,255,255,0)));
	background: linear-gradient(top, rgba(0,0,0,.3) 0%,rgba(255,255,255,0) 100%);
}
.reflection .image-wrap:hover {
	position: relative;
	top: -8px;
}

/************************************************************************************
GLOSSY + REFLECTION
*************************************************************************************/
.glossy-reflection {
	background-color:#354b9b;
	padding: 20px 40px 50px;
	color: #fff;
	-webkit-border-radius: 20px;
	-moz-border-radius: 20px;
	border-radius: 20px;
}
.glossy-reflection .image-wrap {
	-webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,.5), inset 0 1px 0 rgba(255,255,255,.6);
	-moz-box-shadow: inset 0 -1px 0 rgba(0,0,0,.5), inset 0 1px 0 rgba(255,255,255,.6);
	box-shadow: inset 0 -1px 0 rgba(0,0,0,.5), inset 0 1px 0 rgba(255,255,255,.6);
	-webkit-transition: 1s;
	-moz-transition: 1s;
	transition: 1s;
	-webkit-border-radius: 20px;
	-moz-border-radius: 20px;
	border-radius: 20px;
}
.glossy-reflection .image-wrap:before {
	position: absolute;
	content: ' ';
	width: 100%;
	height: 50%;
	top: 0;
	left: 0;
	-webkit-border-radius: 20px;
	-moz-border-radius: 20px;
	border-radius: 20px;
	background: -moz-linear-gradient(top, rgba(255,255,255,0.7) 0%, rgba(255,255,255,.1) 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0.7)), color-stop(100%,rgba(255,255,255,.1)));
	background: linear-gradient(top, rgba(255,255,255,0.7) 0%,rgba(255,255,255,.1) 100%);
}
.glossy-reflection .image-wrap:after {
	position: absolute;
	content: ' ';
	width: 100%;
	height: 30px;
	bottom: -31px;
	left: 0;
	-webkit-border-top-left-radius: 20px;
	-webkit-border-top-right-radius: 20px;
	-moz-border-radius-topleft: 20px;
	-moz-border-radius-topright: 20px;
	border-top-left-radius: 20px;
	border-top-right-radius: 20px;
	background: -moz-linear-gradient(top, rgba(230,230,230,.3) 0%, rgba(230,230,230,0) 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(230,230,230,.3)), color-stop(100%,rgba(230,230,230,0)));
	background: linear-gradient(top, rgba(230,230,230,.3) 0%,rgba(230,230,230,0) 100%);
}
 
</style>
</head>

<body >

 

<div id="demo">

 
	
	<div class="box reflection">
		<h3>Reflection (mouse over images here)</h3>
		<a href="""><img src="images/logos/img.png" value="<a id='mainmenu' href='submenu.php?c=1'></a></a>
		<a href="#"><img src="images/logos/img.png"></a>
		<a href="#"><img src="images/logos/img.png"></a>
		<a href="#"><img src="images/logos/img.png"></a>
	</div>
	
	 

	<div class="box glossy-reflection">
		<h3>Glossy + Reflection</h3>
		<a href="#"><img src="images/logos/img.png"></a>
		<a href="#"><img src="images/logos/img.png"></a>
		<a href="#"><img src="images/logos/img.png"></a>
		<a href="#"><img src="images/logos/img.png"></a>
	</div>
	
 

</div>
<!-- /demo -->

</body>
</html>
