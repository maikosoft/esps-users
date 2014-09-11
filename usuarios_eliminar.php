<?php
// valida sesion /// INCLUIR ANTES QUE NADA //
include("validar.php");
//////////////////////////////////////////////
include("modulos.php");
include("inc/nemesis.php");
$connection = Nemesis::get_connection();
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

<div id="header">

	<?php top(); ?>

</div>

<ul id="navigation">
	
</ul>

<div id="main">

<div id="title" class="round">
	<h1>Usuarios</h1>
	<span class="right"></span>
</div>
<div id="sidebar">

	
	<div class="side-box">
		<?php menulateral(); ?>
	</div>
	
	

</div>

<div id="content">
<div id="content-container">

	<div class="box round">
		<h2>Eliminar Usuario</h2>
		
		
		<div id="tab1">
<?php
		
			$id_usuario = $_GET['id']; 
			
		
			

				
				$usuario = 	Nemesis::verificar_existencia("*","usuarios","`id_usuario` = '$id_usuario'");
				//$cat = 		Nemesis::select("*","categorias","`id_cat` != 'NULL'","`nombre` ASC");
				
				if($usuario == true) {
					
					$cat = Nemesis::select("*","usuarios","`id_usuario` = '$id_usuario'");
					while ($row = $cat->fetch_array()) 
						{ 
							$usuario_nombre = $row["usuario_nombre"]; 
						}
					Nemesis::delete_from_table("usuarios","`id_usuario` = '$id_usuario'");
					echo '<div class="success round">El Usuario <strong>'.$usuario_nombre.'</strong> ha sido eliminado.</div>';
					echo '<div><a href="usuarios.php">Usuarios</a></div>';
				}
				else
				{
					echo '<div class="error_message round">';
					echo '<strong>Errores al Eliminar, contácte al administrador</strong>';
					echo '</div>';
				}//else
	
?>
			

		</div>
	</div>
</div>
</div>



</div>

<div id="footer">
	<?php foot(); ?>
</div>

</body>
</html>