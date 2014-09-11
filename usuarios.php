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

<!-- <script type='text/javascript' src='js/jquery.js'></script> -->
<script type='text/javascript' src='js/jquery.droppy.js'></script>
<script type='text/javascript' src='js/jquery.curvycorners.js'></script>
<script type='text/javascript' src='js/jquery.pngFix.js'></script>
<script type='text/javascript' src='js/jquery.idTabs.js'></script>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/blitzer/jquery-ui.css" type="text/css" />
<script src="js/jquery.easy-confirm-dialog.js"></script>

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
	<!-- <span class="right">Este es el escritorio</span> -->
</div>
<div id="sidebar">

	
	<div class="side-box">
		<?php menulateral(); ?>
	</div>
	
	

</div>

<div id="content">
<div id="content-container">

	<div class="box round">
		<h2>Usuarios</h2>
		
		
		<div id="tab1">
        
<?php
				
				$cat2 = Nemesis::select("*","usuarios","`id_usuario` != 'NULL'","`usuario_nombre` ASC");
 				
				
				if($row = $cat2->fetch_array()) {
					
					echo '<table>';
					// cabecera
					echo '<thead>';
					echo '<tr>';
					echo '<th scope="col">Usuario</th>';
					echo '<th scope="col">Email</th>';
					echo '<th scope="col">Privilegios</th>';
					echo '<th scope="col">Fecha de Reg.</th>';
					echo '<th scope="col">Acciones</th>';
					echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					
					while ($row = $cat2->fetch_array()) {
						echo '<tr class="odd">';
						echo '<td>'.$row[usuario_nombre].'</td>';
						echo '<td>'.$row[usuario_email].'</td>';
						echo '<td>';
						if ($row['priv'] == '99') {
							echo 'Administrador';
						} else if ($row['priv'] == '0') {
							echo 'Distribuidor';
						}
						echo '</td>';
						echo '<td>'.$row[usuario_freg].'</td>';
						echo '<td><a href="usuarios_editar.php?id='.$row[id_usuario].'">Editar</a> | <a class="confirm" href="usuarios_eliminar.php?id='.$row[id_usuario].'&confirm=true" title="¿Seguro que desea elmiminar éste usuario">Eliminar</a></td>';
						echo '</tr>';
					}
					
					//cierre
					echo '</tbody>';
					echo '</table>';
					
				} else {
					echo "No existen registros";
				}
?>
		</div>

		
	
	</div>
	

	

</div>
</div>



</div>

<div id="footer">
	<?php foot(); ?>
</div>
<script>
	$(".confirm").easyconfirm();
	$("#alert").click(function() {
		alert("You approved the action");
	});
</script>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
 	  	<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
</body>
</html>