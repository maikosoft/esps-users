<?php
include("modulos.php");
include("inc/nemesis.php");
$connection = Nemesis::get_connection();

session_start(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  dir="ltr" lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title><? 
$cat = Nemesis::select("*","configuracion","`opcion` = 'titulo'");
while ($row = $cat->fetch_array()) { echo $row["valor"]; } ?></title>

<link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
<link rel='stylesheet' href='css/navigation.css' type='text/css' media='all' />
<link rel='stylesheet' href='css/form.css' type='text/css' media='all' />
<link rel='stylesheet' href='css/table.css' type='text/css' media='all' />
<link rel='stylesheet' href='css/login.css' type='text/css' media='all' />

<script type='text/javascript' src='js/minmax.js'></script>

<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.droppy.js'></script>
<script type='text/javascript' src='js/jquery.curvycorners.js'></script>
<script type='text/javascript' src='js/jquery.pngFix.js'></script>
<script type='text/javascript' src='js/jquery.idTabs.js'></script>

<script type="text/javascript">
$(document).ready(function(){
	/* Navigation */
	$('#navigation').droppy({
		/* dropdown speed */
		speed: 10
	});
	/* PNG fix */
	$(document).pngFix();
	/* Round corner */
	$('.round').corner({
		/* top left */
		tl: { radius: 5 },
		/* top right */
		tr: { radius: 5 },
		/* bottom left */
		bl: { radius: 5 },
		/* bottom right */
		br: { radius: 5 }
	});
});
</script>

</head>
<body>
<div id="login">

<h1><a href="#"><img src="images/logo.png"/></a></h1>
<?php

if(empty($_SESSION['usuario_nombre']) OR $_SESSION['priv'] != '99') {
	if($_GET['error'] == 1) {
		echo '<div class="error_message round"><strong>ERROR:</strong> Imposible iniciar sesi&oacute;n, verifica tus datos.</div>';
	}
	if($_GET['error'] == 2) {
		echo '<div class="error_message round"><strong>ERROR:</strong> El usuario o la contraseña no han sido ingresados.</div>';
	}
	if($_GET['error'] == 3) {
		echo '<div class="error_message round"><strong>ERROR:</strong> Pagina reestringida, inicia sesi&oacute;n.</div>';
	}
?>
    <form action="comprobar.php" class="round" method="post">
    
    <!--
    <div class="message round">Any message can go here.</div>
    <div class="error_message round"><strong>ERROR:</strong> All fields need to be filled.</div>
    -->
    <ul>
        <li>
            <label>Usuario</label>
            <div><input type="text" name="usuario_nombre" class="text max" value=""/></div>
        </li>
        <li>
            <label>Contrase&ntilde;a</label>
            <div><input type="password" name="usuario_clave" class="text max" value=""/></div>
            <!-- <label class="note"><a href="password.html">Forgot password?</a></label> -->
        </li>
        <!--
        <li>
            <div><input type="checkbox" name="" class="checkbox" value="" /> <label class="choice">Remember Me</label></div>
        </li>
        -->
        <li>
            <input type="submit" name="enviar" id="submit" class="button" value="Enviar" />
            
        </li>
    </ul>
    </form>
<?
} else {
?>
	<div class="success round"><strong>Ya te encuentras Logueado!</strong> <a href="escritorio.php">Entrar</a>.</div>
<?
}
?>

</div>
</body>
</html>