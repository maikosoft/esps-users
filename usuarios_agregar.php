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
		<h2>Agregar Nuevo</h2>
		
		
		<div id="tab1">
<?php
		require_once "inc/formvalidator.php";

		if(isset($_POST['enviar'])) { // comprobamos que se han enviado los datos desde el formulario
			//pasamos todas las POST a $variable
			foreach ($HTTP_POST_VARS as $indice=>$cadena) {
				$$indice = $cadena;
				
			}
			$priv = $_POST['priv']; 
			
			
			//Setup Validations
			$validator = new FormValidator();
			$validator->addValidation("usuario_nombre","req","El campo Usuario es requerido");
			$validator->addValidation("usuario_nombre","alnum","El campo Usuario solo acepta letras y numeros");
			$validator->addValidation("usuario_email","email","Email Invalido");
			$validator->addValidation("usuario_email","req","Email requerido");
			$validator->addValidation("usuario_clave","req","Clave requerida");
			$validator->addValidation("usuario_clave","eqelmnt=usuario_clave_conf","Las Claves no coinciden");
			//Now, validate the form
			if($validator->ValidateForm())
			{
				//Validation success. 
				// "limpiamos" los campos del formulario de posibles códigos maliciosos
            	$usuario_nombre = mysql_real_escape_string($_POST['usuario_nombre']);
            	$usuario_clave = mysql_real_escape_string($_POST['usuario_clave']);
            	$usuario_email = mysql_real_escape_string($_POST['usuario_email']);

				
				$usuario = 	Nemesis::verificar_existencia("*","usuarios","`usuario_nombre` = '$usuario_nombre'");
				//$cat = 		Nemesis::select("*","categorias","`id_cat` != 'NULL'","`nombre` ASC");
				
				if($usuario == true) {
					echo "<div class=\"error_message round\">El Usuario <strong>$usuario_nombre</strong> ya se encuentra dado de alta.</div>";
					
				} else { // todo se valido bien
					$usuario_clave = md5($usuario_clave);
					Nemesis::insert("usuarios","`usuario_nombre`,`usuario_clave`,`usuario_email`,`usuario_freg`,`priv`","'$usuario_nombre','$usuario_clave','$usuario_email',NOW(),'$priv'");
					echo "<div class=\"success round\">El Usuario <strong>$usuario_nombre</strong> se ha guardado.</div>";
				}
			}
			else
			{
				echo "<div class=\"error_message round\">";
				echo "<strong>Errores al Validar:</strong>";
		
				$error_hash = $validator->GetErrors();
				foreach($error_hash as $inpname => $inp_err)
				{
					echo "<p>$inp_err</p>\n";
				}
				echo "</div>";
			}//else

    	} 	
?>
			<form action="" method="post">
            <ul>
            	
            	<li>
				<label>Usuario *</label>
				<div><input type="text" name="usuario_nombre" maxlength="15" class="text short" value="<? echo $_POST['usuario_nombre']; ?>"/></div>
				</li>
                <li>
				<label>Contrase&ntilde;a *</label>
				<div><input type="password" name="usuario_clave" maxlength="15" class="text short" /></div>
				</li>
                <li>
				<label>Confirmar Contrase&ntilde;a *</label>
				<div><input type="password" name="usuario_clave_conf" maxlength="15" class="text short" /></div>
				</li>
                <li>
				<label>Email</label>
				<div><input type="text" name="usuario_email" maxlength="50" class="text short" value="<? echo $_POST['usuario_email']; ?>"/></div>
				</li>
				<li>
				<label>privilegios</label>
				<div>
					<select name="priv" class="select" id="priv">
						<option value="0" selected>Distribuidor</option>
						<option value="99">Administrador</option>
					</select>
				</div>
				</li>
            </ul>
            <input type="submit" name="enviar" id="submit" class="button" value="Agregar" />
            <input type="reset" value="Borrar" class="button" /> 
            </form>

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