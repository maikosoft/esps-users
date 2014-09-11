<?php
    session_start();
    if(!isset($_SESSION['usuario_nombre'])) {
		header("Location: index.php?error=3");
    }
?> 