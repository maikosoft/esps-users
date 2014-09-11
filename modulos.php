<?

// MENU LATERAL //
function menulateral() {
?>
	<!-- <h3>Productos</h3>
	<ul class="links">
		<li><a href="productos.php">Productos</a></li>
		<li><a href="productos_agregar.php">Agregar Nuevo</a></li>	
	</ul>
    
    <h3>Categor&iacute;as</h3>
    <ul class="links">
		<li><a href="categorias.php">Categorias</a></li>
		<li><a href="categorias_agregar.php">Agregar Nueva</a></li>
    </ul> -->
     
    <h3>Usuarios</h3>
    <ul class="links">
		<li><a href="usuarios.php">Usuarios</a></li>
		<li><a href="usuarios_agregar.php">Agregar Nuevo</a></li>
    </ul>
<?php
}


// TOP /////////////////////
function top() {
?>

	<h1><a href="#"><img src="images/logo.png" alt="KuroAdmin" /></a></h1>
	
	<div id="global_nav">
		<ul>
        	<?php
    		if(isset($_SESSION['usuario_nombre'])) {
			?>
        	<li>Bienvenido <strong><? echo $_SESSION['usuario_nombre']; ?></strong></li>
        	<li class="last"><a href="logout.php">Cerrar Sesi&oacute;n</a></li>
			<?php
    		}
			?> 
			
			
		</ul>
	</div>
<?php
}

// FOOT /////////////////////
function foot() {
?>

<p class="left">Desarrollado por <a href="http://www.magentacreativo.com">MagentaCreativo.com</a></p>
	<!-- <p class="right"><a href="#">escritorio</a> | <a href="#">productos</a></p> -->

<?php
}
?>