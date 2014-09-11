<?php
    session_start();
    include("inc/nemesis.php");
	$connection = Nemesis::get_connection();
    if(isset($_POST['enviar'])) { // comprobamos que se hayan enviado los datos del formulario
        // comprobamos que los campos usuarios_nombre y usuario_clave no estén vacíos
        if(empty($_POST['usuario_nombre']) || empty($_POST['usuario_clave'])) {
            header("Location: index.php?error=2");
        }else {
			
            // "limpiamos" los campos del formulario de posibles códigos maliciosos
            $usuario_nombre = $connection->real_escape_string($_POST['usuario_nombre']);
            $usuario_clave = $connection->real_escape_string($_POST['usuario_clave']);
            // $usuario_nombre = $_POST['usuario_nombre'];
            // $usuario_clave = $_POST['usuario_clave'];
            $usuario_clave = md5($usuario_clave);
			
			
            // comprobamos que los datos ingresados en el formulario coincidan con los de la BD
            $cat = Nemesis::select("*","usuarios","`usuario_nombre` = '$usuario_nombre' AND `usuario_clave` = '$usuario_clave' AND `priv` = '99'");
 				
				if($row = $cat->fetch_array()) {
					
					$_SESSION['id_usuario'] = $row['id_usuario']; // creamos la sesion "usuario_id" y le asignamos como valor el campo usuario_id
                	$_SESSION['usuario_nombre'] = $row["usuario_nombre"]; // creamos la sesion "usuario_nombre" y le asignamos como valor el campo usuario_nombre
                    $_SESSION['priv'] = $row["priv"];
                	header("Location: escritorio.php");
				} else {
					header("Location: index.php?error=1");
				}
					

        }
    }else {
        header("Location: index.php?error=1");
    }
?> 